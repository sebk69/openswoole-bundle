<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Server\Configurator;

use Assert\Assertion;
use OpenSwooleBundle\Component\GeneratedCollection;

final class CallableChainConfiguratorFactory
{
    public function make(iterable $configuratorCollection, ConfiguratorInterface ...$configurators): CallableChainConfigurator
    {
        return new CallableChainConfigurator(
            (new GeneratedCollection($configuratorCollection, ...$configurators))
                ->map(function ($configurator): callable {
                    Assertion::isInstanceOf($configurator, ConfiguratorInterface::class);

                    return [$configurator, 'configure'];
                })
        );
    }
}
