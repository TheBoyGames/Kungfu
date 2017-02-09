<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Container.php
 * DATE : 2017/2/7 16:00
 */

namespace Kungfu;

class Container
{
    /**
     * the current globally avaliable container (if any)
     *
     * @var static
     */
    private static $instance;

    /**
     * the array buffered singleton object during the circle
     *
     * @var array
     */
    private $singletonObjectStack;

    /**
     * the container mapping array
     *
     * @var array
     */
    private $config;

    /**
     * call this method to init a object you need
     *
     * @param $name
     * @param array $params
     * @param bool $singleton
     * @return mixed|null
     */
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

    /**
     * this method decide how to create object, singleton or normal or anything else
     *
     * @param $name
     * @param $reflector
     * @param $params
     * @param $singleton
     * @return null
     */
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

    /**
     * Container cant control the creation of itself so you must
     * make it singleton handly
     *
     * @return Container
     */
    public static function init()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new Container();
        }
        return self::$instance;
    }

    /**
     * Container constructor nothing serious.
     */
    private function __construct()
    {
        $configPath = realpath(".." . DIRECTORY_SEPARATOR . "Config" . DIRECTORY_SEPARATOR . "container.php");

        $this->config = include($configPath);

        $this->singletonObjectStack = [];
    }
}