<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Server\RequestHandler;

use OpenSwooleBundle\Server\RequestHandler\RequestHandlerInterface;
use Swoole\Http\Request;
use Swoole\Http\Response;

final class RequestHandlerDummy implements RequestHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(Request $request, Response $response): void
    {
    }
}
