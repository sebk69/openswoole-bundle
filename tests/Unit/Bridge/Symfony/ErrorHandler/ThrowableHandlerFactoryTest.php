<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Tests\Unit\Bridge\Symfony\ErrorHandler;

use OpenSwooleBundle\Bridge\Symfony\ErrorHandler\ThrowableHandlerFactory;
use PHPUnit\Framework\TestCase;

class ThrowableHandlerFactoryTest extends TestCase
{
    public function testThrowableHandlerCreation(): void
    {
        $handler = ThrowableHandlerFactory::newThrowableHandler();
        $methodName = $handler->getName();

        self::assertTrue('handleThrowable' === $methodName || 'handleException' === $methodName);
    }
}
