<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Server\Session\Exception;

use RuntimeException as PHPRuntimeException;

final class RuntimeException extends PHPRuntimeException implements SessionExceptionInterface
{
}
