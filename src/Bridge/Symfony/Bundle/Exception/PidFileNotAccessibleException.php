<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Bridge\Symfony\Bundle\Exception;

/**
 * @internal
 */
final class PidFileNotAccessibleException extends \RuntimeException
{
    public static function forFile(string $pidFile): self
    {
        throw new self(\sprintf('Could not access pid file "%s".', $pidFile));
    }
}
