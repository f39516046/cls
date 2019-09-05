<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: cls.proto

namespace Cls\Protobuf\Cls;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>cls.LogGroupList</code>
 */
class LogGroupList extends \Google\Protobuf\Internal\Message
{
    /**
     * 日志组列表
     *
     * Generated from protobuf field <code>repeated .cls.LogGroup logGroupList = 1;</code>
     */
    private $logGroupList;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Cls\LogGroup[]|\Google\Protobuf\Internal\RepeatedField $logGroupList
     *           日志组列表
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Cls::initOnce();
        parent::__construct($data);
    }

    /**
     * 日志组列表
     *
     * Generated from protobuf field <code>repeated .cls.LogGroup logGroupList = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getLogGroupList()
    {
        return $this->logGroupList;
    }

    /**
     * 日志组列表
     *
     * Generated from protobuf field <code>repeated .cls.LogGroup logGroupList = 1;</code>
     * @param \Cls\LogGroup[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setLogGroupList($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Cls\LogGroup::class);
        $this->logGroupList = $arr;

        return $this;
    }

}

