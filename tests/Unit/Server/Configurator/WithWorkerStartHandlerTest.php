<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Server\Configurator;

use OpenSwooleBundle\Server\Configurator\WithWorkerStartHandler;
use OpenSwooleBundle\Server\WorkerHandler\NoOpWorkerStartHandler;
use OpenSwooleBundle\Tests\Unit\Server\SwooleHttpServerMock;
use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class WithWorkerStartHandlerTest extends TestCase
{
    /**
     * @var NoOpWorkerStartHandler
     */
    private $noOpWorkerStartHandler;

    /**
     * @var WithWorkerStartHandler
     */
    private $configurator;

    protected function setUp(): void
    {
        $this->noOpWorkerStartHandler = new NoOpWorkerStartHandler();

        $this->configurator = new WithWorkerStartHandler($this->noOpWorkerStartHandler);
    }

    public function testConfigure(): void
    {
        $swooleServerOnEventSpy = SwooleHttpServerMock::make();

        $this->configurator->configure($swooleServerOnEventSpy);

        self::assertTrue($swooleServerOnEventSpy->registeredEvent);
        self::assertSame(['WorkerStart', [$this->noOpWorkerStartHandler, 'handle']], $swooleServerOnEventSpy->registeredEventPair);
    }
}
