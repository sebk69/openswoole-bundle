<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Server\Configurator;

use OpenSwooleBundle\Server\HttpServerConfiguration;
use OpenSwooleBundle\Server\TaskHandler\TaskFinishedHandlerInterface;
use Swoole\Http\Server;

final class WithTaskFinishedHandler implements ConfiguratorInterface
{
    private $handler;
    private $configuration;

    public function __construct(TaskFinishedHandlerInterface $handler, HttpServerConfiguration $configuration)
    {
        $this->handler = $handler;
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function configure(Server $server): void
    {
        if ($this->configuration->getTaskWorkerCount() > 0) {
            $server->on('finish', [$this->handler, 'handle']);
        }
    }
}
