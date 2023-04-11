<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Bridge\Symfony\HttpFoundation\Session;

use OpenSwooleBundle\Bridge\Symfony\Event\SessionResetEvent;
use OpenSwooleBundle\Bridge\Symfony\HttpFoundation\Session\SwooleSessionStorage;
use OpenSwooleBundle\Bridge\Symfony\HttpFoundation\Session\SwooleSessionStorageFactory;
use OpenSwooleBundle\Server\Session\StorageInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

final class SwooleSessionStorageFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testCreateStorageCreatesSwooleSessionStorageInInitialState(): void
    {
        $subject = new SwooleSessionStorageFactory(
            $this->prophesize(StorageInterface::class)->reveal(),
            $this->prophesize(EventDispatcherInterface::class)->reveal(),
        );

        $result = $subject->createStorage(new Request());

        $this->assertInstanceOf(
            SwooleSessionStorage::class,
            $result
        );
        $this->assertFalse($result->isStarted());
        $this->assertSame(
            '',
            $result->getId()
        );
    }

    public function testCreateStorageAddsListenerForSwooleSessionResetEvent(): void
    {
        $dispatcher = $this->prophesize(EventDispatcherInterface::class);

        $dispatcher->addListener()
            ->withArguments([SessionResetEvent::NAME, Argument::type('closure')])
            ->shouldBeCalled()
        ;

        $subject = new SwooleSessionStorageFactory(
            $this->prophesize(StorageInterface::class)->reveal(),
            $dispatcher->reveal(),
        );

        $subject->createStorage(new Request());
    }
}
