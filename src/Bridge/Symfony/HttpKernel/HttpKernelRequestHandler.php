<?php

declare(strict_types=1);

namespace OpenSwooleBundle\Bridge\Symfony\HttpKernel;

use OpenSwooleBundle\Bridge\Symfony\HttpFoundation\RequestFactoryInterface;
use OpenSwooleBundle\Bridge\Symfony\HttpFoundation\ResponseProcessorInjectorInterface;
use OpenSwooleBundle\Bridge\Symfony\HttpFoundation\ResponseProcessorInterface;
use OpenSwooleBundle\Server\RequestHandler\RequestHandlerInterface;
use OpenSwooleBundle\Server\Runtime\BootableInterface;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpKernel\TerminableInterface;

final class HttpKernelRequestHandler implements RequestHandlerInterface, BootableInterface
{
    private $processorInjector;
    private $kernel;
    private $requestFactory;
    private $responseProcessor;

    public function __construct(
        KernelInterface $kernel,
        RequestFactoryInterface $requestFactory,
        ResponseProcessorInjectorInterface $processorInjector,
        ResponseProcessorInterface $responseProcessor
    ) {
        $this->kernel = $kernel;
        $this->requestFactory = $requestFactory;
        $this->responseProcessor = $responseProcessor;
        $this->processorInjector = $processorInjector;
    }

    /**
     * {@inheritdoc}
     */
    public function boot(array $runtimeConfiguration = []): void
    {
        $this->kernel->boot();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function handle(SwooleRequest $request, SwooleResponse $response): void
    {
        $httpFoundationRequest = $this->requestFactory->make($request);
        $this->processorInjector->injectProcessor($httpFoundationRequest, $response);
        $httpFoundationResponse = $this->kernel->handle($httpFoundationRequest);
        $this->responseProcessor->process($httpFoundationResponse, $response);

        if ($this->kernel instanceof TerminableInterface) {
            $this->kernel->terminate($httpFoundationRequest, $httpFoundationResponse);
        }
    }
}
