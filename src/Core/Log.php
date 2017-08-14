<?php

/**
 * 日志驱动类
 *
 * @create 2017-8-7 16:41:44
 * @author hao
 */

namespace Haosblog\WikiSDK\Core;

use Monolog\Logger;
use Monolog\Handler\NullHandler;
use Monolog\Handler\ErrorLogHandler;

class Log
{
    /**
     * 日志记录实例
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected static $logger;
    
    public static function __callStatic($name, $arguments)
    {
        return forward_static_call_array([self::getLogger(), $name], $arguments);
    }
    
    /**
     * 获取日志记录实例
     * 
     * @return \Psr\Log\LoggerInterface
     */
    public static function getLogger(){
        if(!self::$logger){
            $log = new Logger('WikiSDKSdk');

            if (defined('PHPUNIT_RUNNING')) {
                $log->pushHandler(new NullHandler());
            } else {
                $log->pushHandler(new ErrorLogHandler());
            }

            self::$logger = $log;
        }
        
        return self::$logger;
    }
}
