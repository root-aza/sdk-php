<?php

declare(strict_types=1);

namespace Temporal\Tests\Unit\Client\Mapper;

use Google\Protobuf\Timestamp;
use PHPUnit\Framework\TestCase;
use Temporal\Api\Common\V1\Memo;
use Temporal\Api\Common\V1\SearchAttributes;
use Temporal\Api\Common\V1\WorkflowExecution;
use Temporal\Api\Common\V1\WorkflowType;
use Temporal\Api\Workflow\V1\ResetPoints;
use Temporal\Api\Workflow\V1\WorkflowExecutionInfo;
use Temporal\DataConverter\DataConverter;
use Temporal\DataConverter\EncodedCollection;
use Temporal\Internal\Mapper\WorkflowExecutionInfoMapper;
use Temporal\Workflow\ResetPointInfo;
use Temporal\Workflow\WorkflowExecutionStatus;

final class WorkflowExecutionInfoMapperTestCase extends TestCase
{
    public function testFromPayload(): void
    {
        $mapper = $this->createMapper();

        $info = $mapper->fromMessage(
            new WorkflowExecutionInfo([
                'execution' => new WorkflowExecution([
                    'workflow_id' => '6007db2e-4beb-4d81-94ee-98cbd19f9c3c',
                    'run_id' => '9ebb5672-b0cd-474e-b008-9a14e3591863',
                ]),
                'type' => new WorkflowType(['name' => 'HistoryLengthWorkflow']),
                'start_time' => new Timestamp(['seconds' => \strtotime('2021-01-01T00:00:00.000000Z')]),
                'close_time' => new Timestamp(['seconds' => \strtotime('2021-02-01T00:00:00.000000Z')]),
                'status' => WorkflowExecutionStatus::Completed->value,
                'history_length' => 15,
                'parent_namespace_id' => 'parentNamespaceId',
                'parent_execution' => new WorkflowExecution([
                    'workflow_id' => 'f81c8119-d53a-4100-9d53-7dabac8849c2',
                    'run_id' => 'bcf079a9-e6f3-4040-93e8-ca185650a04e',
                ]),
                'execution_time' => new Timestamp(['seconds' => \strtotime('2021-01-01T00:00:00.000000Z')]),
                'memo' => (new Memo())
                    ->setFields(EncodedCollection::fromValues([
                        'mem1' => 'value1',
                        'mem2' => 'value2',
                    ], DataConverter::createDefault())->toPayloadArray()),
                'search_attributes' => (new SearchAttributes())
                    ->setIndexedFields(EncodedCollection::fromValues([
                        'attr1' => 'value1',
                        'attr2' => 'value2',
                    ], DataConverter::createDefault())->toPayloadArray()),
                'auto_reset_points' => (new ResetPoints())
                    ->setPoints([
                        (new \Temporal\Api\Workflow\V1\ResetPointInfo())
                            ->setRunId('runId')
                            ->setFirstWorkflowTaskCompletedId(1)
                            ->setCreateTime(new Timestamp(['seconds' => \strtotime('2021-01-01T00:00:00.000000Z')]))
                            ->setResettable(true)
                            ->setBinaryChecksum('binaryChecksum')
                    ]),
                'task_queue' => 'taskQueue',
                'state_transition_count' => 1,
                'history_size_bytes' => 1,
                'most_recent_worker_version_stamp' => (new \Temporal\Api\Common\V1\WorkerVersionStamp())
                    ->setBuildId('buildId')
                    ->setUseVersioning(true),
            ]),
        );

        $this->assertSame('6007db2e-4beb-4d81-94ee-98cbd19f9c3c', $info->execution->getID());
        $this->assertSame('9ebb5672-b0cd-474e-b008-9a14e3591863', $info->execution->getRunID());
        $this->assertSame('HistoryLengthWorkflow', $info->type->name);
        $this->assertSame('2021-01-01T00:00:00.000000Z', $info->startTime->format('Y-m-d\TH:i:s.u\Z'));
        $this->assertSame('2021-02-01T00:00:00.000000Z', $info->closeTime->format('Y-m-d\TH:i:s.u\Z'));
        $this->assertSame(WorkflowExecutionStatus::Completed, $info->status);
        $this->assertSame(15, $info->historyLength);
        $this->assertSame('parentNamespaceId', $info->parentNamespaceId);
        $this->assertSame('f81c8119-d53a-4100-9d53-7dabac8849c2', $info->parentExecution->getID());
        $this->assertSame('bcf079a9-e6f3-4040-93e8-ca185650a04e', $info->parentExecution->getRunID());
        $this->assertSame('2021-01-01T00:00:00.000000Z', $info->executionTime->format('Y-m-d\TH:i:s.u\Z'));
        $this->assertSame(2, $info->memo->count());
        $this->assertEquals(['mem1' => 'value1', 'mem2' => 'value2'], $info->memo->getValues());
        $this->assertEquals(['attr1' => 'value1', 'attr2' => 'value2'], $info->searchAttributes->getValues());
        $this->assertSame('taskQueue', $info->taskQueue);
        $this->assertSame(1, $info->stateTransitionCount);
        $this->assertCount(1, $info->autoResetPoints);
        $this->assertInstanceOf(ResetPointInfo::class, $info->autoResetPoints[0]);
        $this->assertSame('runId', $info->autoResetPoints[0]->runId);
        $this->assertSame(1, $info->autoResetPoints[0]->firstWorkflowTaskCompletedId);
        $this->assertSame('2021-01-01T00:00:00.000000Z', $info->autoResetPoints[0]->createTime->format('Y-m-d\TH:i:s.u\Z'));
        $this->assertTrue($info->autoResetPoints[0]->resettable);
        $this->assertSame('binaryChecksum', $info->autoResetPoints[0]->binaryChecksum);
        $this->assertSame(1, $info->historySizeBytes);
        $this->assertSame('buildId', $info->mostRecentWorkerVersionStamp->buildId);
        $this->assertTrue($info->mostRecentWorkerVersionStamp->useVersioning);
    }

    private function createMapper(): WorkflowExecutionInfoMapper
    {
        return new WorkflowExecutionInfoMapper(
            DataConverter::createDefault(),
        );
    }
}
