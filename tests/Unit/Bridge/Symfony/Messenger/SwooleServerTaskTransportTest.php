<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Bridge\Symfony\Messenger;

use OpenSwooleBundle\Bridge\Symfony\Messenger\Exception\ReceiverNotAvailableException;
use OpenSwooleBundle\Bridge\Symfony\Messenger\SwooleServerTaskReceiver;
use OpenSwooleBundle\Bridge\Symfony\Messenger\SwooleServerTaskSender;
use OpenSwooleBundle\Bridge\Symfony\Messenger\SwooleServerTaskTransport;
use OpenSwooleBundle\Server\Config\Socket;
use OpenSwooleBundle\Server\Config\Sockets;
use OpenSwooleBundle\Server\HttpServer;
use OpenSwooleBundle\Server\HttpServerConfiguration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;

class SwooleServerTaskTransportTest extends TestCase
{
    use \Prophecy\PhpUnit\ProphecyTrait;

    public function testThatItThrowsExceptionOnAck(): void
    {
        $transport = new SwooleServerTaskTransport(new SwooleServerTaskReceiver(), new SwooleServerTaskSender($this->makeHttpServerDummy()));

        $this->expectException(ReceiverNotAvailableException::class);

        $transport->ack(new Envelope($this->prophesize('object')));
    }

    public function testThatItThrowsExceptionOnReject(): void
    {
        $transport = new SwooleServerTaskTransport(new SwooleServerTaskReceiver(), new SwooleServerTaskSender($this->makeHttpServerDummy()));

        $this->expectException(ReceiverNotAvailableException::class);

        $transport->reject(new Envelope($this->prophesize('object')));
    }

    private function makeHttpServerDummy(): HttpServer
    {
        return new HttpServer(new HttpServerConfiguration(new Sockets(new Socket())));
    }
}
