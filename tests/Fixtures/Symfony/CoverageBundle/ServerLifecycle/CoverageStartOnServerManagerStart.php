<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Fixtures\Symfony\CoverageBundle\ServerLifecycle;

use OpenSwooleBundle\Server\LifecycleHandler\ServerManagerStartHandlerInterface;
use OpenSwooleBundle\Tests\Fixtures\Symfony\CoverageBundle\Coverage\CodeCoverageManager;
use Swoole\Server;

final class CoverageStartOnServerManagerStart implements ServerManagerStartHandlerInterface
{
    private $codeCoverageManager;
    private $decorated;

    public function __construct(CodeCoverageManager $codeCoverageManager, ?ServerManagerStartHandlerInterface $decorated = null)
    {
        $this->codeCoverageManager = $codeCoverageManager;
        $this->decorated = $decorated;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Server $server): void
    {
        $this->codeCoverageManager->start('test_manager');

        if ($this->decorated instanceof ServerManagerStartHandlerInterface) {
            $this->decorated->handle($server);
        }
    }
}
