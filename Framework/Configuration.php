<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Configuration.php
 * DATE : 2017/2/7 16:22
 */

namespace Kungfu;

class Configuration
{

    /**
     * save the configuration key=>value
     *
     * @var array
     */
    private $configBuffer = [];

    public function get($config)
    {
        return $this->configBuffer[$config];
    }

    public function set($name, $value)
    {
        $this->configBuffer[$name] = $value;
    }

    public function __construct()
    {
        $this->configBuffer["DEBUG"] = false;
        $this->setPath();
        $this->loadEnvFile();
        $this->loadConfigFile();
        $this->laodRouterFile();
    }

    /**
     * set the proper path for app root and framework root
     *
     * @return null
     */
    private function setPath()
    {
        $path = ".." . DIRECTORY_SEPARATOR;
        $realpath = realpath($path);
        $this->configBuffer["rootPath"] = $realpath . DIRECTORY_SEPARATOR;
        $this->configBuffer["applicationPath"] = $realpath . DIRECTORY_SEPARATOR . "application" . DIRECTORY_SEPARATOR;
        $this->configBuffer["frameworkPath"] = $realpath . DIRECTORY_SEPARATOR . "framework" . DIRECTORY_SEPARATOR;
        $this->configBuffer["envFilePath"] = $realpath . DIRECTORY_SEPARATOR . "env.json";
        $this->configBuffer["configPath"] = $this->configBuffer["rootPath"] . "config" . DIRECTORY_SEPARATOR;
    }

    /**
     * read json env file from env.json
     *
     * @return null
     */
    private function loadEnvFile()
    {
        $envFile = file_get_contents($this->configBuffer['envFilePath']);
        $env = json_decode($envFile, true);
        if(is_null($env))
        {
            $this->configBuffer = array_merge($this->configBuffer, $env);
        }
    }

    /**
     * depends on how you define the config in env.json, default this function will load default.
     * php in config directory to configBuffer variable
     *
     * @return null
     */
    private function loadConfigFile()
    {
        $config = "default";
        if(array_key_exists('CONFIG', $this->configBuffer))
        {
            $config = $this->configBuffer["CONFIG"];
        }
        $configArray = includeIfExists($this->configBuffer["configPath"] . $config . ".php");

        if(!is_null($configArray))
        {
            $this->configBuffer = array_merge($this->configBuffer, $configArray);
        }
    }

    private function laodRouterFile()
    {
        $router = 'router';

        if(array_key_exists('ROUTER', $this->configBuffer))
        {
            $router = $this->configBuffer["ROUTER"];
        }
        $routerArray = includeIfExists($this->configBuffer["configPath"] . $router . ".php");

        if(!is_null($routerArray))
        {
            $this->configBuffer["router"] = $routerArray;
        }
    }
}