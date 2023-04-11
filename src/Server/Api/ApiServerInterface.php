<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Server\Api;

interface ApiServerInterface
{
    /**
     * Get Swoole HTTP Server status.
     */
    public function status(): array;

    /**
     * Shutdown Swoole HTTP Server.
     */
    public function shutdown(): void;

    /**
     * Reload Swoole HTTP Server workers.
     */
    public function reload(): void;

    /**
     * Get Swoole HTTP Server metrics.
     */
    public function metrics(): array;
}
