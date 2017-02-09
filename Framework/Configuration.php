<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Configuration.php
 * DATE : 2017/2/7 16:22
 */

namespace Kungfu;

interface ConfigurationInterface
{
    public function set($name, $value);

    public function get($name);
}

class Configuration implements ConfigurationInterface
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
        $this->configBuffer['DEBUG'] = false;
        $this->setPath();
        $this->loadEnvFile();
        $this->loadConfigFile();
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
        $this->configBuffer['rootPath'] = $realpath . DIRECTORY_SEPARATOR;
        $this->configBuffer['applicationPath'] = $realpath . DIRECTORY_SEPARATOR . "application" . DIRECTORY_SEPARATOR;
        $this->configBuffer['frameworkPath'] = $realpath . DIRECTORY_SEPARATOR . "framework" . DIRECTORY_SEPARATOR;
        $this->configBuffer['envFilePath'] = $realpath . DIRECTORY_SEPARATOR . "env.json";
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
        if($env)
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
        if($this->configBuffer['CONFIG'])
        {
            $config = $this->configBuffer['CONFIG'];
        }
        $config = include($this->configBuffer["rootPath"] . "config" . DIRECTORY_SEPARATOR . $config . ".php");
        if($config)
        {
            $this->configBuffer = array_merge($this->configBuffer, $config);
        }
    }
}