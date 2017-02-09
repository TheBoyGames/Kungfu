<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Application.php
 * DATE : 2017/2/8 14:06
 */

namespace Kungfu;

class Application
{
    /**
     * @var the global Application instance, it is a singleton instance
     */
    private static $instance;

    private $container;
    /**
     * @var Configuration instance to get access to config value
     */
    private $configuration;

    /**
     * @return Application instance
     */
    public static function init()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new Application();
        }

        return self::$instance;
    }

    /**
     * Start to serve the request
     * @return void
     */
    public function start()
    {
//        $request = $this->make('request');
//
//        $response = $this->make('response', [$request]);
//
//        echo($response);
    }

    public function make($name, $params = [], $singleton = false)
    {
        return $this->container->make($name, $params, $singleton);
    }

    public function get($name)
    {
        return $this->configuration->get($name);
    }

    /**
     * Application constructor.
     */
    private function __construct()
    {
        $this->container = Container::init();
        $this->configuration = $this->container->make('configuration', [], true);
    }
}