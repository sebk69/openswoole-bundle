<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Server\Configurator;

use OpenSwooleBundle\Server\Configurator\WithTaskHandler;
use OpenSwooleBundle\Server\HttpServerConfiguration;
use OpenSwooleBundle\Server\TaskHandler\NoOpTaskHandler;
use OpenSwooleBundle\Tests\Unit\Server\IntMother;
use OpenSwooleBundle\Tests\Unit\Server\SwooleHttpServerMock;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @runTestsInSeparateProcesses
 */
class WithTaskHandlerTest extends TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;
    /**
     * @var NoOpTaskHandler
     */
    private $noOpTaskHandler;

    /**
     * @var WithTaskHandler
     */
    private $configurator;

    /**
     * @var HttpServerConfiguration|ObjectProphecy
     */
    private $configurationProphecy;

    protected function setUp(): void
    {
        $this->noOpTaskHandler = new NoOpTaskHandler();
        $this->configurationProphecy = $this->prophesize(HttpServerConfiguration::class);

        /** @var HttpServerConfiguration $configurationMock */
        $configurationMock = $this->configurationProphecy->reveal();

        $this->configurator = new WithTaskHandler($this->noOpTaskHandler, $configurationMock);
    }

    public function testConfigure(): void
    {
        $this->configurationProphecy->getTaskWorkerCount()
            ->willReturn(IntMother::randomPositive())
            ->shouldBeCalled()
        ;

        $swooleServerOnEventSpy = SwooleHttpServerMock::make();

        $this->configurator->configure($swooleServerOnEventSpy);

        self::assertTrue($swooleServerOnEventSpy->registeredEvent);
        self::assertSame(['task', [$this->noOpTaskHandler, 'handle']], $swooleServerOnEventSpy->registeredEventPair);
    }

    public function testDoNotConfigureWhenNoTaskWorkers(): void
    {
        $this->configurationProphecy->getTaskWorkerCount()
            ->willReturn(0)
            ->shouldBeCalled()
        ;

        $swooleServerOnEventSpy = SwooleHttpServerMock::make();

        $this->configurator->configure($swooleServerOnEventSpy);

        self::assertFalse($swooleServerOnEventSpy->registeredEvent);
    }
}
