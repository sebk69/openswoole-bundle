<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Server\LifecycleHandler;

use Swoole\Server;

interface ServerManagerStopHandlerInterface
{
    /**
     * Handle "OnManagerStop" event.
     *
     * Info: Handler is executed in manager process
     */
    public function handle(Server $server): void;
}
