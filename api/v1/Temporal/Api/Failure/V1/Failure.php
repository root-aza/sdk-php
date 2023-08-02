<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: temporal/api/failure/v1/message.proto

namespace Temporal\Api\Failure\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>temporal.api.failure.v1.Failure</code>
 */
class Failure extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string message = 1;</code>
     */
    protected $message = '';
    /**
     * The source this Failure originated in, e.g. TypeScriptSDK / JavaSDK
     * In some SDKs this is used to rehydrate the stack trace into an exception object.
     *
     * Generated from protobuf field <code>string source = 2;</code>
     */
    protected $source = '';
    /**
     * Generated from protobuf field <code>string stack_trace = 3;</code>
     */
    protected $stack_trace = '';
    /**
     * Alternative way to supply `message` and `stack_trace` and possibly other attributes, used for encryption of
     * errors originating in user code which might contain sensitive information.
     * The `encoded_attributes` Payload could represent any serializable object, e.g. JSON object or a `Failure` proto
     * message.
     * SDK authors: 
     * - The SDK should provide a default `encodeFailureAttributes` and `decodeFailureAttributes` implementation that:
     *   - Uses a JSON object to represent `{ message, stack_trace }`.
     *   - Overwrites the original message with "Encoded failure" to indicate that more information could be extracted.
     *   - Overwrites the original stack_trace with an empty string.
     *   - The resulting JSON object is converted to Payload using the default PayloadConverter and should be processed
     *     by the user-provided PayloadCodec
     * - If there's demand, we could allow overriding the default SDK implementation to encode other opaque Failure attributes.
     * (-- api-linter: core::0203::optional=disabled --)
     *
     * Generated from protobuf field <code>.temporal.api.common.v1.Payload encoded_attributes = 20;</code>
     */
    protected $encoded_attributes = null;
    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.Failure cause = 4;</code>
     */
    protected $cause = null;
    protected $failure_info;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $message
     *     @type string $source
     *           The source this Failure originated in, e.g. TypeScriptSDK / JavaSDK
     *           In some SDKs this is used to rehydrate the stack trace into an exception object.
     *     @type string $stack_trace
     *     @type \Temporal\Api\Common\V1\Payload $encoded_attributes
     *           Alternative way to supply `message` and `stack_trace` and possibly other attributes, used for encryption of
     *           errors originating in user code which might contain sensitive information.
     *           The `encoded_attributes` Payload could represent any serializable object, e.g. JSON object or a `Failure` proto
     *           message.
     *           SDK authors: 
     *           - The SDK should provide a default `encodeFailureAttributes` and `decodeFailureAttributes` implementation that:
     *             - Uses a JSON object to represent `{ message, stack_trace }`.
     *             - Overwrites the original message with "Encoded failure" to indicate that more information could be extracted.
     *             - Overwrites the original stack_trace with an empty string.
     *             - The resulting JSON object is converted to Payload using the default PayloadConverter and should be processed
     *               by the user-provided PayloadCodec
     *           - If there's demand, we could allow overriding the default SDK implementation to encode other opaque Failure attributes.
     *           (-- api-linter: core::0203::optional=disabled --)
     *     @type \Temporal\Api\Failure\V1\Failure $cause
     *     @type \Temporal\Api\Failure\V1\ApplicationFailureInfo $application_failure_info
     *     @type \Temporal\Api\Failure\V1\TimeoutFailureInfo $timeout_failure_info
     *     @type \Temporal\Api\Failure\V1\CanceledFailureInfo $canceled_failure_info
     *     @type \Temporal\Api\Failure\V1\TerminatedFailureInfo $terminated_failure_info
     *     @type \Temporal\Api\Failure\V1\ServerFailureInfo $server_failure_info
     *     @type \Temporal\Api\Failure\V1\ResetWorkflowFailureInfo $reset_workflow_failure_info
     *     @type \Temporal\Api\Failure\V1\ActivityFailureInfo $activity_failure_info
     *     @type \Temporal\Api\Failure\V1\ChildWorkflowExecutionFailureInfo $child_workflow_execution_failure_info
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Temporal\Api\Failure\V1\Message::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string message = 1;</code>
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Generated from protobuf field <code>string message = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setMessage($var)
    {
        GPBUtil::checkString($var, True);
        $this->message = $var;

        return $this;
    }

    /**
     * The source this Failure originated in, e.g. TypeScriptSDK / JavaSDK
     * In some SDKs this is used to rehydrate the stack trace into an exception object.
     *
     * Generated from protobuf field <code>string source = 2;</code>
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * The source this Failure originated in, e.g. TypeScriptSDK / JavaSDK
     * In some SDKs this is used to rehydrate the stack trace into an exception object.
     *
     * Generated from protobuf field <code>string source = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setSource($var)
    {
        GPBUtil::checkString($var, True);
        $this->source = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string stack_trace = 3;</code>
     * @return string
     */
    public function getStackTrace()
    {
        return $this->stack_trace;
    }

    /**
     * Generated from protobuf field <code>string stack_trace = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setStackTrace($var)
    {
        GPBUtil::checkString($var, True);
        $this->stack_trace = $var;

        return $this;
    }

    /**
     * Alternative way to supply `message` and `stack_trace` and possibly other attributes, used for encryption of
     * errors originating in user code which might contain sensitive information.
     * The `encoded_attributes` Payload could represent any serializable object, e.g. JSON object or a `Failure` proto
     * message.
     * SDK authors: 
     * - The SDK should provide a default `encodeFailureAttributes` and `decodeFailureAttributes` implementation that:
     *   - Uses a JSON object to represent `{ message, stack_trace }`.
     *   - Overwrites the original message with "Encoded failure" to indicate that more information could be extracted.
     *   - Overwrites the original stack_trace with an empty string.
     *   - The resulting JSON object is converted to Payload using the default PayloadConverter and should be processed
     *     by the user-provided PayloadCodec
     * - If there's demand, we could allow overriding the default SDK implementation to encode other opaque Failure attributes.
     * (-- api-linter: core::0203::optional=disabled --)
     *
     * Generated from protobuf field <code>.temporal.api.common.v1.Payload encoded_attributes = 20;</code>
     * @return \Temporal\Api\Common\V1\Payload|null
     */
    public function getEncodedAttributes()
    {
        return $this->encoded_attributes;
    }

    public function hasEncodedAttributes()
    {
        return isset($this->encoded_attributes);
    }

    public function clearEncodedAttributes()
    {
        unset($this->encoded_attributes);
    }

    /**
     * Alternative way to supply `message` and `stack_trace` and possibly other attributes, used for encryption of
     * errors originating in user code which might contain sensitive information.
     * The `encoded_attributes` Payload could represent any serializable object, e.g. JSON object or a `Failure` proto
     * message.
     * SDK authors: 
     * - The SDK should provide a default `encodeFailureAttributes` and `decodeFailureAttributes` implementation that:
     *   - Uses a JSON object to represent `{ message, stack_trace }`.
     *   - Overwrites the original message with "Encoded failure" to indicate that more information could be extracted.
     *   - Overwrites the original stack_trace with an empty string.
     *   - The resulting JSON object is converted to Payload using the default PayloadConverter and should be processed
     *     by the user-provided PayloadCodec
     * - If there's demand, we could allow overriding the default SDK implementation to encode other opaque Failure attributes.
     * (-- api-linter: core::0203::optional=disabled --)
     *
     * Generated from protobuf field <code>.temporal.api.common.v1.Payload encoded_attributes = 20;</code>
     * @param \Temporal\Api\Common\V1\Payload $var
     * @return $this
     */
    public function setEncodedAttributes($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Common\V1\Payload::class);
        $this->encoded_attributes = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.Failure cause = 4;</code>
     * @return \Temporal\Api\Failure\V1\Failure|null
     */
    public function getCause()
    {
        return $this->cause;
    }

    public function hasCause()
    {
        return isset($this->cause);
    }

    public function clearCause()
    {
        unset($this->cause);
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.Failure cause = 4;</code>
     * @param \Temporal\Api\Failure\V1\Failure $var
     * @return $this
     */
    public function setCause($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Failure\V1\Failure::class);
        $this->cause = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.ApplicationFailureInfo application_failure_info = 5;</code>
     * @return \Temporal\Api\Failure\V1\ApplicationFailureInfo|null
     */
    public function getApplicationFailureInfo()
    {
        return $this->readOneof(5);
    }

    public function hasApplicationFailureInfo()
    {
        return $this->hasOneof(5);
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.ApplicationFailureInfo application_failure_info = 5;</code>
     * @param \Temporal\Api\Failure\V1\ApplicationFailureInfo $var
     * @return $this
     */
    public function setApplicationFailureInfo($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Failure\V1\ApplicationFailureInfo::class);
        $this->writeOneof(5, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.TimeoutFailureInfo timeout_failure_info = 6;</code>
     * @return \Temporal\Api\Failure\V1\TimeoutFailureInfo|null
     */
    public function getTimeoutFailureInfo()
    {
        return $this->readOneof(6);
    }

    public function hasTimeoutFailureInfo()
    {
        return $this->hasOneof(6);
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.TimeoutFailureInfo timeout_failure_info = 6;</code>
     * @param \Temporal\Api\Failure\V1\TimeoutFailureInfo $var
     * @return $this
     */
    public function setTimeoutFailureInfo($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Failure\V1\TimeoutFailureInfo::class);
        $this->writeOneof(6, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.CanceledFailureInfo canceled_failure_info = 7;</code>
     * @return \Temporal\Api\Failure\V1\CanceledFailureInfo|null
     */
    public function getCanceledFailureInfo()
    {
        return $this->readOneof(7);
    }

    public function hasCanceledFailureInfo()
    {
        return $this->hasOneof(7);
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.CanceledFailureInfo canceled_failure_info = 7;</code>
     * @param \Temporal\Api\Failure\V1\CanceledFailureInfo $var
     * @return $this
     */
    public function setCanceledFailureInfo($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Failure\V1\CanceledFailureInfo::class);
        $this->writeOneof(7, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.TerminatedFailureInfo terminated_failure_info = 8;</code>
     * @return \Temporal\Api\Failure\V1\TerminatedFailureInfo|null
     */
    public function getTerminatedFailureInfo()
    {
        return $this->readOneof(8);
    }

    public function hasTerminatedFailureInfo()
    {
        return $this->hasOneof(8);
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.TerminatedFailureInfo terminated_failure_info = 8;</code>
     * @param \Temporal\Api\Failure\V1\TerminatedFailureInfo $var
     * @return $this
     */
    public function setTerminatedFailureInfo($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Failure\V1\TerminatedFailureInfo::class);
        $this->writeOneof(8, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.ServerFailureInfo server_failure_info = 9;</code>
     * @return \Temporal\Api\Failure\V1\ServerFailureInfo|null
     */
    public function getServerFailureInfo()
    {
        return $this->readOneof(9);
    }

    public function hasServerFailureInfo()
    {
        return $this->hasOneof(9);
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.ServerFailureInfo server_failure_info = 9;</code>
     * @param \Temporal\Api\Failure\V1\ServerFailureInfo $var
     * @return $this
     */
    public function setServerFailureInfo($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Failure\V1\ServerFailureInfo::class);
        $this->writeOneof(9, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.ResetWorkflowFailureInfo reset_workflow_failure_info = 10;</code>
     * @return \Temporal\Api\Failure\V1\ResetWorkflowFailureInfo|null
     */
    public function getResetWorkflowFailureInfo()
    {
        return $this->readOneof(10);
    }

    public function hasResetWorkflowFailureInfo()
    {
        return $this->hasOneof(10);
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.ResetWorkflowFailureInfo reset_workflow_failure_info = 10;</code>
     * @param \Temporal\Api\Failure\V1\ResetWorkflowFailureInfo $var
     * @return $this
     */
    public function setResetWorkflowFailureInfo($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Failure\V1\ResetWorkflowFailureInfo::class);
        $this->writeOneof(10, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.ActivityFailureInfo activity_failure_info = 11;</code>
     * @return \Temporal\Api\Failure\V1\ActivityFailureInfo|null
     */
    public function getActivityFailureInfo()
    {
        return $this->readOneof(11);
    }

    public function hasActivityFailureInfo()
    {
        return $this->hasOneof(11);
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.ActivityFailureInfo activity_failure_info = 11;</code>
     * @param \Temporal\Api\Failure\V1\ActivityFailureInfo $var
     * @return $this
     */
    public function setActivityFailureInfo($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Failure\V1\ActivityFailureInfo::class);
        $this->writeOneof(11, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.ChildWorkflowExecutionFailureInfo child_workflow_execution_failure_info = 12;</code>
     * @return \Temporal\Api\Failure\V1\ChildWorkflowExecutionFailureInfo|null
     */
    public function getChildWorkflowExecutionFailureInfo()
    {
        return $this->readOneof(12);
    }

    public function hasChildWorkflowExecutionFailureInfo()
    {
        return $this->hasOneof(12);
    }

    /**
     * Generated from protobuf field <code>.temporal.api.failure.v1.ChildWorkflowExecutionFailureInfo child_workflow_execution_failure_info = 12;</code>
     * @param \Temporal\Api\Failure\V1\ChildWorkflowExecutionFailureInfo $var
     * @return $this
     */
    public function setChildWorkflowExecutionFailureInfo($var)
    {
        GPBUtil::checkMessage($var, \Temporal\Api\Failure\V1\ChildWorkflowExecutionFailureInfo::class);
        $this->writeOneof(12, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getFailureInfo()
    {
        return $this->whichOneof("failure_info");
    }

}

