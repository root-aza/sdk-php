<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: temporal/api/batch/v1/message.proto

namespace Temporal\Api\Batch\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * BatchOperationReset sends reset requests to batch workflows.
 * Keep the parameter in sync with temporal.api.workflowservice.v1.ResetWorkflowExecutionRequest.
 *
 * Generated from protobuf message <code>temporal.api.batch.v1.BatchOperationReset</code>
 */
class BatchOperationReset extends \Google\Protobuf\Internal\Message
{
    /**
     * Reset type.
     *
     * Generated from protobuf field <code>.temporal.api.enums.v1.ResetType reset_type = 1;</code>
     */
    protected $reset_type = 0;
    /**
     * History event reapply options.
     *
     * Generated from protobuf field <code>.temporal.api.enums.v1.ResetReapplyType reset_reapply_type = 2;</code>
     */
    protected $reset_reapply_type = 0;
    /**
     * The identity of the worker/client.
     *
     * Generated from protobuf field <code>string identity = 3;</code>
     */
    protected $identity = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $reset_type
     *           Reset type.
     *     @type int $reset_reapply_type
     *           History event reapply options.
     *     @type string $identity
     *           The identity of the worker/client.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Temporal\Api\Batch\V1\Message::initOnce();
        parent::__construct($data);
    }

    /**
     * Reset type.
     *
     * Generated from protobuf field <code>.temporal.api.enums.v1.ResetType reset_type = 1;</code>
     * @return int
     */
    public function getResetType()
    {
        return $this->reset_type;
    }

    /**
     * Reset type.
     *
     * Generated from protobuf field <code>.temporal.api.enums.v1.ResetType reset_type = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setResetType($var)
    {
        GPBUtil::checkEnum($var, \Temporal\Api\Enums\V1\ResetType::class);
        $this->reset_type = $var;

        return $this;
    }

    /**
     * History event reapply options.
     *
     * Generated from protobuf field <code>.temporal.api.enums.v1.ResetReapplyType reset_reapply_type = 2;</code>
     * @return int
     */
    public function getResetReapplyType()
    {
        return $this->reset_reapply_type;
    }

    /**
     * History event reapply options.
     *
     * Generated from protobuf field <code>.temporal.api.enums.v1.ResetReapplyType reset_reapply_type = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setResetReapplyType($var)
    {
        GPBUtil::checkEnum($var, \Temporal\Api\Enums\V1\ResetReapplyType::class);
        $this->reset_reapply_type = $var;

        return $this;
    }

    /**
     * The identity of the worker/client.
     *
     * Generated from protobuf field <code>string identity = 3;</code>
     * @return string
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * The identity of the worker/client.
     *
     * Generated from protobuf field <code>string identity = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setIdentity($var)
    {
        GPBUtil::checkString($var, True);
        $this->identity = $var;

        return $this;
    }

}

