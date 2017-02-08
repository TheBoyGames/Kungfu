<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Container.php
 * DATE : 2017/2/7 16:00
 */

namespace TheBoy\Kungfu;

class Container
{
    private static $instance;
    private $objectStack;
    private $config;

    public function make($name, $singleton = false)
    {
        $reflector = null;

        if($singleton)
        {
            if (array_key_exists($name, $this->objectStack))
            {
                return $this->objectStack[$name];
            }
        }
        $reflector = new \ReflectionClass($this->config[$name]);

        return $this->build($reflector);
    }

    public function build($reflector)
    {
        $constructor = $reflector->getConstructor();

        if(is_null($constructor))
        {

        }

        return $reflector->newInstance();
    }

    public static function init()
    {
        if(null == self::$instance)
        {
            self::$instance = new Container();
        }
        return self::$instance;
    }

    /**
     * Container constructor.
     */
    private function __construct()
    {
        $configPath = realpath(".." . DIRECTORY_SEPARATOR . "Config" . DIRECTORY_SEPARATOR . "container.php");

        $this->config = include($configPath);

        $this->objectStack = [];
    }
}