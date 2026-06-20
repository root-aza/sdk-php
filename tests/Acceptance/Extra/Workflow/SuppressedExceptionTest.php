<?php

declare(strict_types = 1);

namespace Temporal\Tests\Acceptance\Extra\Workflow\SuppressedExceptionTest;


use PHPUnit\Framework\Attributes\Test;
use React\Promise\PromiseInterface;
use Temporal\Client\WorkflowStubInterface;
use Temporal\Interceptor\WorkflowOutboundRequestInterceptor;
use Temporal\Tests\Acceptance\App\Attribute\Client;
use Temporal\Tests\Acceptance\App\Attribute\Stub;
use Temporal\Tests\Acceptance\App\TestCase;
use Temporal\Worker\Transport\Command\RequestInterface;
use Temporal\Workflow;
use Temporal\Workflow\ChildWorkflowOptions;
use Temporal\Workflow\QueryMethod;
use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;

final class SuppressedExceptionTest extends TestCase
{
    #[Test]
    public function childWorkflowStuck(
        #[Stub('Root_Suppressed_Exception_Workflow')]
        #[Client(timeout: 10)]
        WorkflowStubInterface $stub,
    ) {
        $executedChildWorkflow = false;
        $deadline              = \microtime(true) + 5.0; // 5-second timeout
        do {
            try {
                $executedChildWorkflow = $stub->query('isExecutedChildWorkflow')->getValue(0);
            }catch (\Throwable $e){
                dump($e);

                dump($stub);
            }

            if ($executedChildWorkflow) {
                break;
            }
        } while (\microtime(true) < $deadline);


        $this->assertTrue($executedChildWorkflow, 'Child_Suppressed_Exception_Workflow is stuck');
    }
}

#[WorkflowInterface]
final class RootSuppressedExceptionWorkflow
{
    public function __construct(
        private bool $executedChildWorkflow = false,
    ) {
    }

    #[WorkflowMethod('Root_Suppressed_Exception_Workflow')]
    public function start(): \Generator
    {
        $childWorkflow = Workflow::newChildWorkflowStub(
            ChildSuppressedExceptionWorkflow::class,
            ChildWorkflowOptions::new()
                ->withSearchAttributes([
                    'SuppressedException' => true,
                ])
        );

        yield $childWorkflow->start();

        $this->executedChildWorkflow = true;
    }

    #[QueryMethod]
    public function isExecutedChildWorkflow(): bool
    {
        return $this->executedChildWorkflow;
    }
}



#[WorkflowInterface]
final class ChildSuppressedExceptionWorkflow
{
    #[WorkflowMethod('Child_Suppressed_Exception_Workflow')]
    public function start(): \Generator
    {
        yield Workflow::getVersion('SUPPRESSED_EXCEPTION', 1, 1);
    }
}


final class SuppressedExceptionWorkflowOutboundRequestInterceptor implements WorkflowOutboundRequestInterceptor
{
    public function handleOutboundRequest(RequestInterface $request, callable $next): PromiseInterface
    {
        /** @var bool|null $attribute */
        $attribute = Workflow::getInfo()->searchAttributes['SuppressedException'] ?? null;

        if ($attribute) {
            $headers = $request->getHeader()
                ->withValue('suppressedException', $attribute)
            ;

            $request = $request->withHeader($headers);
        }

        return $next($request);
    }
}
