<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Server\WorkerHandler;

use Swoole\Server;

final class NoOpWorkerStartHandler implements WorkerStartHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(Server $worker, int $workerId): void
    {
        // noop
    }
}
