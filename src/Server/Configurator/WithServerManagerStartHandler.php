<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Server\Configurator;

use OpenSwooleBundle\Server\LifecycleHandler\ServerManagerStartHandlerInterface;
use Swoole\Http\Server;

final class WithServerManagerStartHandler implements ConfiguratorInterface
{
    private $handler;

    public function __construct(ServerManagerStartHandlerInterface $handler)
    {
        $this->handler = $handler;
    }

    /**
     * {@inheritdoc}
     */
    public function configure(Server $server): void
    {
        $server->on('ManagerStart', [$this->handler, 'handle']);
    }
}
