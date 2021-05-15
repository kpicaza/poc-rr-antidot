<?php

declare(strict_types=1);

// Delegate static file requests back to the PHP built-in webserver
use Antidot\Application\Http\Application;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\StreamFactory;
use Laminas\Diactoros\UploadedFileFactory;
use Psr\Container\ContainerInterface;
use Spiral\RoadRunner\Http\PSR7Worker;

if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}
chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$worker = \Spiral\RoadRunner\Worker::create();
/** @var ContainerInterface $container */

$worker = new PSR7Worker(
    $worker,
    new ServerRequestFactory(),
    new StreamFactory(),
    new UploadedFileFactory()
);

$container = require 'config/container.php';
/** @var Application $app */
$app = $container->get(Application::class);
// Execute programmatic/declarative middleware pipeline and routing
// configuration statements
(require 'router/middleware.php')($app, $container);
(require 'router/routes.php')($app, $container);

while ($request = $worker->waitRequest()) {
    try {
        $worker->respond($app->handle($request));
    } catch (Throwable $e) {
        $worker->getWorker()->error((string)$e);
    }
}
