<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Bootstrap.php
 * DATE : 2017/2/7 16:00
 */

namespace TheBoy\Kungfu;

class Bootstrap
{
    private static $instance;
    private $configuration;

    public static function init()
    {
        global $application;

        if(null == self::$instance)
        {
            self::$instance = new Bootstrap();
            $application = self::$instance;
        }else
        {
            $application = self::$instance;
        }
    }

    public function start()
    {
        echo("serving now ");
    }

    private function __construct()
    {
        $this->configuration = new Configuration();
    }

}