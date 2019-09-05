<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: cls.proto

namespace Cls\Protobuf\Cls;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>cls.LogGroup</code>
 */
class LogGroup extends \Google\Protobuf\Internal\Message
{
    /**
     * 多条日志合成的日志数组
     *
     * Generated from protobuf field <code>repeated .cls.Log logs = 1;</code>
     */
    private $logs;
    /**
     * 目前暂无效用
     *
     * Generated from protobuf field <code>string contextFlow = 2;</code>
     */
    private $contextFlow = '';
    /**
     * 日志文件名
     *
     * Generated from protobuf field <code>string filename = 3;</code>
     */
    private $filename = '';
    /**
     * 日志来源，一般使用机器IP
     *
     * Generated from protobuf field <code>string source = 4;</code>
     */
    private $source = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Cls\Log[]|\Google\Protobuf\Internal\RepeatedField $logs
     *           多条日志合成的日志数组
     *     @type string $contextFlow
     *           目前暂无效用
     *     @type string $filename
     *           日志文件名
     *     @type string $source
     *           日志来源，一般使用机器IP
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Cls::initOnce();
        parent::__construct($data);
    }

    /**
     * 多条日志合成的日志数组
     *
     * Generated from protobuf field <code>repeated .cls.Log logs = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * 多条日志合成的日志数组
     *
     * Generated from protobuf field <code>repeated .cls.Log logs = 1;</code>
     * @param \Cls\Log[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setLogs($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Cls\Log::class);
        $this->logs = $arr;

        return $this;
    }

    /**
     * 目前暂无效用
     *
     * Generated from protobuf field <code>string contextFlow = 2;</code>
     * @return string
     */
    public function getContextFlow()
    {
        return $this->contextFlow;
    }

    /**
     * 目前暂无效用
     *
     * Generated from protobuf field <code>string contextFlow = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setContextFlow($var)
    {
        GPBUtil::checkString($var, True);
        $this->contextFlow = $var;

        return $this;
    }

    /**
     * 日志文件名
     *
     * Generated from protobuf field <code>string filename = 3;</code>
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * 日志文件名
     *
     * Generated from protobuf field <code>string filename = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setFilename($var)
    {
        GPBUtil::checkString($var, True);
        $this->filename = $var;

        return $this;
    }

    /**
     * 日志来源，一般使用机器IP
     *
     * Generated from protobuf field <code>string source = 4;</code>
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * 日志来源，一般使用机器IP
     *
     * Generated from protobuf field <code>string source = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setSource($var)
    {
        GPBUtil::checkString($var, True);
        $this->source = $var;

        return $this;
    }

}
