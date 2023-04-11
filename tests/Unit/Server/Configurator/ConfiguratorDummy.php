<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Server\Configurator;

use OpenSwooleBundle\Server\Configurator\ConfiguratorInterface;
use Swoole\Http\Server;

final class ConfiguratorDummy implements ConfiguratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function configure(Server $server): void
    {
        // noop
    }
}
