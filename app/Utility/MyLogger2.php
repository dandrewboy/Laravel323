<?php
namespace App\Utility;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class MyLogger2 implements ILogger
{
    private static $logger = null;

    static function getLogger()
    {
        if(self::$logger == null) 
        {
            self::$logger = new \Monolog\Logger('MyApp'); 
            self::$logger->pushHandler(new \Monolog\Handler\LogglyHandler('2e6d8e9b-be11-4c50-9c06-66d22bd6fe26/tag/laravel323'));
        }
        return self::$logger;
    }
    
    public static function debug($message, $data=array())
    {
        self::getLogger()->debug($message, $data);
    }
    
    public static function warning($message, $data=array())
    {
        self::getLogger()->warning($message, $data);
    }

    public static function error($message, $data=array())
    {
        self::getLogger()->error($message, $data);
    }

    public static function info($message, $data=array())
    {
        self::getLogger()->info($message, $data);
    }
}

