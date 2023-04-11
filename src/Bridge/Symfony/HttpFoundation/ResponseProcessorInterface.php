<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Bridge\Symfony\HttpFoundation;

use Swoole\Http\Response as SwooleResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

interface ResponseProcessorInterface
{
    public function process(HttpFoundationResponse $httpFoundationResponse, SwooleResponse $swooleSwooleResponse): void;
}
