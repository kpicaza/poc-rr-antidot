# Road Runner Antidot Framework

PHP full featured framework designed to allow you creating 100% framework agnostic code.

## Key Features

* **Road Runner Server**: High performance PHP server
* **Preconfigured Coding Style**: [Psr-1](https://www.php-fig.org/psr/psr-1) and [Psr-2](https://www.php-fig.org/psr/psr-2) code sniffer to help to respect standard
* **Logger**: [Psr-3](https://www.php-fig.org/psr/psr-3) implementation by [wshafer/monolog](https://github.com/wshafer/psr11-monolog)
* **Auto-loading**: [Psr-4](https://www.php-fig.org/psr/psr-4) Namespaces auto-loading
* **Request Response Lifecycle**: [Psr-7](https://www.php-fig.org/psr/psr-7) Request and responses using [Laminas Diactoros](https://docs.laminas.dev/laminas-diactoros/)
* **Auto-wired Dependency injection**: [Psr-11](https://www.php-fig.org/psr/psr-11) Auto-wired dependency injection container
* **Event Dispatcher**: [Psr-14](https://www.php-fig.org/psr/psr-14) Event dispatching system
* **Request pipeline**: [Psr-15](https://www.php-fig.org/psr/psr-15) Request handler and Middleware
* **Pipeline based router**: Intuitive to use route system
* **Different Config Translators**: [Laminas config](https://docs.laminas.dev/laminas-config/) style or [Symfony](https://symfony.com/doc/current/best_practices/configuration.html) style
* **Cli**: Ready to use Console Line Tool on top of [Symfony Console Tool](https://symfony.com/doc/current/components/console.html)

## Requirements

* PHP >=7.4
* [Composer](https://getcomposer.org/download/)

## Quick Start

```bash
git clone git@github.com:kpicaza/poc-rr-antidot.git
cd poc-rr-antidot
composer install
chmod +x rr
./rr serve
```

## Benchmark

Using [WRK](https://github.com/wg/wrk)

```
→ wrk -t8 -c256 -d15s http://127.0.0.1:8080/
Running 15s test @ http://127.0.0.1:8080/
  8 threads and 256 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency     6.97ms    0.86ms  24.70ms   85.12%
    Req/Sec     4.61k   260.38     7.07k    84.67%
  550574 requests in 15.07s, 98.71MB read
Requests/sec:  36536.29
Transfer/sec:      6.55MB
```

Using [Apache AB](https://httpd.apache.org/docs/2.4/programs/ab.html) 

```
→ ab -n 50000 -c 256 http://127.0.0.1:8080/
This is ApacheBench, Version 2.3 <$Revision: 1879490 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Server Software:        
Server Hostname:        127.0.0.1
Server Port:            8080

Document Path:          /
Document Length:        80 bytes

Concurrency Level:      256
Time taken for tests:   2.161 seconds
Complete requests:      50000
Failed requests:        0
Total transferred:      9400000 bytes
HTML transferred:       4000000 bytes
Requests per second:    23132.48 [#/sec] (mean)
Time per request:       11.067 [ms] (mean)
Time per request:       0.043 [ms] (mean, across all concurrent requests)
Transfer rate:          4246.98 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    4   0.5      4       6
Processing:     1    7   0.9      7      16
Waiting:        1    5   1.0      5      16
Total:          6   11   0.7     11      19

Percentage of the requests served within a certain time (ms)
  50%     11
  66%     11
  75%     11
  80%     11
  90%     12
  95%     12
  98%     13
  99%     13
 100%     19 (longest request)
```

## Special thanks & Sponsors

* **JetBrains:** Thanks for supporting us with the All Products Pack License for Open Source

<a href="https://www.jetbrains.com/?from=antidot-framework" target="_blank">
    <img alt="JetBrains" width="200" src="https://antidotfw.io/images/jetbrains-variant-4.png" style="width:263px !important;height:147px !important"/>
</a>

###### Disclaimer: 

* This framework is based on concepts and components of other open source software, especially [Laminas Request Handler Runner](https://docs.laminas.dev/laminas-httphandlerrunner/), [Mezzio](https://docs.mezzio.dev/mezzio/) and [Laminas API tools legacy Zend Stratigillity](https://api-tools.getlaminas.org/).
* The full or partial use of this software is the responsibility of the user.
