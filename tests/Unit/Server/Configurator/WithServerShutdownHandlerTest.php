<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Server\Configurator;

use OpenSwooleBundle\Server\Configurator\WithServerShutdownHandler;
use OpenSwooleBundle\Server\LifecycleHandler\NoOpServerShutdownHandler;
use OpenSwooleBundle\Tests\Unit\Server\SwooleHttpServerMock;
use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class WithServerShutdownHandlerTest extends TestCase
{
    /**
     * @var NoOpServerShutdownHandler
     */
    private $noOpServerShutdownHandler;

    /**
     * @var WithServerShutdownHandler
     */
    private $configurator;

    protected function setUp(): void
    {
        $this->noOpServerShutdownHandler = new NoOpServerShutdownHandler();

        $this->configurator = new WithServerShutdownHandler($this->noOpServerShutdownHandler);
    }

    public function testConfigure(): void
    {
        $swooleServerOnEventSpy = SwooleHttpServerMock::make();

        $this->configurator->configure($swooleServerOnEventSpy);

        self::assertTrue($swooleServerOnEventSpy->registeredEvent);
        self::assertSame(['shutdown', [$this->noOpServerShutdownHandler, 'handle']], $swooleServerOnEventSpy->registeredEventPair);
    }
}
