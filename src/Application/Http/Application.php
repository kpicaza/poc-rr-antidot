<?php

declare(strict_types=1);

namespace App\Application\Http;

use Antidot\Application\Http\Middleware\Pipeline;
use Antidot\Application\Http\Response\ErrorResponseGenerator;
use Antidot\Application\Http\RouteFactory;
use Antidot\Application\Http\Router;
use Antidot\Application\Http\WebServerApplication;
use Antidot\Container\MiddlewareFactory;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;
use Throwable;

final class Application extends WebServerApplication implements RequestHandlerInterface
{
    private ErrorResponseGenerator $errorResponseGenerator;

    public function __construct(
        RequestHandlerRunner $runner,
        Pipeline $pipeline,
        Router $router,
        MiddlewareFactory $middlewareFactory,
        RouteFactory $routeFactory,
        ErrorResponseGenerator $errorResponseGenerator
    ) {
        parent::__construct($runner, $pipeline, $router, $middlewareFactory, $routeFactory);
        $this->errorResponseGenerator = $errorResponseGenerator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            return $this->pipeline->handle($request->withAttribute('request_id', Uuid::uuid4()->toString()));
        } catch (Throwable $exception) {
            return $this->errorResponseGenerator->__invoke($exception);
        }
    }
}
