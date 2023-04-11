<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Server\Middleware;

interface MiddlewareFactory
{
    public function createMiddleware(callable $nextMiddleware): callable;
}
