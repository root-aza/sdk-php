<?php

declare(strict_types=1);

namespace Temporal\Tests\Functional;

use Temporal\Api\Enums\V1\EventType;
use Temporal\Client\GRPC\ServiceClient;
use Temporal\Client\WorkflowClient;
use Temporal\Client\WorkflowOptions;
use Temporal\Testing\ActivityMocker;
use Temporal\Tests\TestCase;
use Temporal\Tests\Workflow\SimpleWorkflow;
use Temporal\Workflow\WorkflowExecution;

final class SimpleWorkflowTestCase extends TestCase
{
    private WorkflowClient $workflowClient;
    private ActivityMocker $activityMocks;

    protected function setUp(): void
    {
        $this->workflowClient = new WorkflowClient(
            ServiceClient::create('localhost:7233')
        );
        $this->activityMocks = new ActivityMocker();

        parent::setUp();
    }

    protected function tearDown(): void
    {
        $this->activityMocks->clear();
        parent::tearDown();
    }

    public function testWorkflowReturnsUpperCasedInput(): void
    {
        $this->activityMocks->expectCompletion('SimpleActivity.echo', 'world');
        $workflow = $this->workflowClient->newWorkflowStub(SimpleWorkflow::class);
        $run = $this->workflowClient->start($workflow, 'hello');
        $this->assertSame('world', $run->getResult('string'));
    }

    public function testEagerStartDoesntFail(): void
    {
        $workflow = $this->workflowClient
            ->newWorkflowStub(SimpleWorkflow::class, WorkflowOptions::new()->withEagerStart());
        $run = $this->workflowClient->start($workflow, 'hello');
        $this->assertSame('HELLO', $run->getResult('string'));
    }

    public function testCancelSignaledChildWorkflow(): void
    {
        $workflow = $this->workflowClient
            ->newWorkflowStub(\Temporal\Tests\Workflow\CancelSignaledChildWorkflow::class);
        $run = $this->workflowClient->start($workflow);

        $this->assertSame('canceled ok', $run->getResult('string', 10));

        $status = $workflow->getStatus();
        $this->assertSame([
			"start",
			"child started",
			"child signaled",
			"scope canceled",
			"process done",
        ], $status);

        $this->assertContainsEvent(
            $run->getExecution(),
            EventType::EVENT_TYPE_REQUEST_CANCEL_EXTERNAL_WORKFLOW_EXECUTION_INITIATED,
        );
    }

    private function assertContainsEvent(WorkflowExecution $execution, int $event): void
    {
        $history = $this->workflowClient->getWorkflowHistory(
            $execution,
        );
        foreach ($history as $item) {
            if ($item->getEventType() === $event) {
                return;
            }
        }

        throw new \Exception(\sprintf('Event %s not found', EventType::value($event)));
    }
}
