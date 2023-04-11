<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Server\Configurator;

use Swoole\Http\Server;

interface ConfiguratorInterface
{
    public function configure(Server $server): void;
}
