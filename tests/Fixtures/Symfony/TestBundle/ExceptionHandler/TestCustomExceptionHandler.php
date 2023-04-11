<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Fixtures\Symfony\TestBundle\ExceptionHandler;

use OpenSwooleBundle\Client\Http;
use OpenSwooleBundle\Server\RequestHandler\ExceptionHandler\ExceptionHandlerInterface;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Throwable;

final class TestCustomExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(Request $request, Throwable $exception, Response $response): void
    {
        $response->header(Http::HEADER_CONTENT_TYPE, Http::CONTENT_TYPE_TEXT_PLAIN);
        $response->status(500);
        $response->end('Very custom exception handler');
    }
}
