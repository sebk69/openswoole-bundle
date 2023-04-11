<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Server\Configurator;

use OpenSwooleBundle\Server\Configurator\WithServerManagerStartHandler;
use OpenSwooleBundle\Server\LifecycleHandler\NoOpServerManagerStartHandler;
use OpenSwooleBundle\Tests\Unit\Server\SwooleHttpServerMock;
use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class WithServerManagerStartHandlerTest extends TestCase
{
    /**
     * @var NoOpServerManagerStartHandler
     */
    private $noOpServerManagerStartHandler;

    /**
     * @var WithServerManagerStartHandler
     */
    private $configurator;

    protected function setUp(): void
    {
        $this->noOpServerManagerStartHandler = new NoOpServerManagerStartHandler();

        $this->configurator = new WithServerManagerStartHandler($this->noOpServerManagerStartHandler);
    }

    public function testConfigure(): void
    {
        $swooleServerOnEventSpy = SwooleHttpServerMock::make();

        $this->configurator->configure($swooleServerOnEventSpy);

        self::assertTrue($swooleServerOnEventSpy->registeredEvent);
        self::assertSame(['ManagerStart', [$this->noOpServerManagerStartHandler, 'handle']], $swooleServerOnEventSpy->registeredEventPair);
    }
}
