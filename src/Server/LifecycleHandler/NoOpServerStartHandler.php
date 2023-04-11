<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Server\LifecycleHandler;

use Swoole\Server;

final class NoOpServerStartHandler implements ServerStartHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(Server $server): void
    {
        // noop
    }
}
