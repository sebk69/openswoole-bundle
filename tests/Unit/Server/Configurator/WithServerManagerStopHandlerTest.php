<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Server\Configurator;

use OpenSwooleBundle\Server\Configurator\WithServerManagerStopHandler;
use OpenSwooleBundle\Server\LifecycleHandler\NoOpServerManagerStopHandler;
use OpenSwooleBundle\Tests\Unit\Server\SwooleHttpServerMock;
use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class WithServerManagerStopHandlerTest extends TestCase
{
    /**
     * @var NoOpServerManagerStopHandler
     */
    private $noOpServerManagerStopHandler;

    /**
     * @var WithServerManagerStopHandler
     */
    private $configurator;

    protected function setUp(): void
    {
        $this->noOpServerManagerStopHandler = new NoOpServerManagerStopHandler();

        $this->configurator = new WithServerManagerStopHandler($this->noOpServerManagerStopHandler);
    }

    public function testConfigure(): void
    {
        $swooleServerOnEventSpy = SwooleHttpServerMock::make();

        $this->configurator->configure($swooleServerOnEventSpy);

        self::assertTrue($swooleServerOnEventSpy->registeredEvent);
        self::assertSame(['ManagerStop', [$this->noOpServerManagerStopHandler, 'handle']], $swooleServerOnEventSpy->registeredEventPair);
    }
}
