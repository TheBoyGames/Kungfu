<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Application.php
 * DATE : 2017/2/8 14:06
 */

namespace TheBoy\Kungfu;

class Application
{
    /**
     * @var the global Application instance, it is a singleton instance
     */
    private static $instance;

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
        echo("start serving");
        $container = Container::init();
        $view = $container->make("view");
        echo(var_dump($view->tesf()));
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
        $this->configuration = Configuration::init();
    }
}