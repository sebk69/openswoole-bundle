<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Fixtures\Symfony\CoverageBundle\ServerLifecycle;

use OpenSwooleBundle\Server\LifecycleHandler\ServerShutdownHandlerInterface;
use OpenSwooleBundle\Tests\Fixtures\Symfony\CoverageBundle\Coverage\CodeCoverageManager;
use Swoole\Server;

final class CoverageFinishOnServerShutdown implements ServerShutdownHandlerInterface
{
    private $codeCoverageManager;
    private $decorated;

    public function __construct(CodeCoverageManager $codeCoverageManager, ?ServerShutdownHandlerInterface $decorated = null)
    {
        $this->codeCoverageManager = $codeCoverageManager;
        $this->decorated = $decorated;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Server $server): void
    {
        if ($this->decorated instanceof ServerShutdownHandlerInterface) {
            $this->decorated->handle($server);
        }

        $this->codeCoverageManager->stop();
        $this->codeCoverageManager->finish('test_server');
    }
}
