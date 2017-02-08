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
    private $singletonObjectStack;
    private $config;

    public function make($name, $params=[], $singleton = false)
    {
        $reflector = null;

        if($singleton)
        {
            if (array_key_exists($name, $this->singletonObjectStack))
            {
                return $this->singletonObjectStack[$name];
            }
        }
        $reflector = new \ReflectionClass($this->config[$name]);

        return $this->build($name, $reflector, $params, $singleton);
    }

    public function build($name, $reflector, $params, $singleton)
    {
        $constructor = $reflector->getConstructor();
        $object = null;

        if(is_null($constructor))
        {
            $object = new $reflector;
        }
        else
        {
            $object = $reflector->newInstanceArgs($params);
        }

        if($singleton)
        {
            $this->singletonObjectStack[$name] = $object;
        }
        return $object;
    }

    public static function init()
    {
        if(is_null(self::$instance))
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

        $this->singletonObjectStack = [];
    }
}