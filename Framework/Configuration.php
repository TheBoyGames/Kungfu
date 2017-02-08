<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Configuration.php
 * DATE : 2017/2/7 16:22
 */

namespace TheBoy\Kungfu;

class Configuration
{
    private $configBuffer = [];

    private static $instance;

    public static function init()
    {
        if(null == self::$instance)
        {
            self::$instance = new Configuration();
        }
        return self::$instance;
    }

    public function get($config)
    {
        return $this->configBuffer[$config];
    }

    public function set($name, $value)
    {
        $this->configBuffer[$name] = $value;
    }

    private function __construct()
    {
        $this->configBuffer['DEBUG'] = false;
        $this->setPath();
        $this->loadEnvFile();
        $this->loadConfigFile();
    }

    private function setPath()
    {
        $path = ".." . DIRECTORY_SEPARATOR;
        $realpath = realpath($path);
        $this->configBuffer['rootPath'] = $realpath . DIRECTORY_SEPARATOR;
        $this->configBuffer['applicationPath'] = $realpath . DIRECTORY_SEPARATOR . "application" . DIRECTORY_SEPARATOR;
        $this->configBuffer['frameworkPath'] = $realpath . DIRECTORY_SEPARATOR . "framework" . DIRECTORY_SEPARATOR;
        $this->configBuffer['envFilePath'] = $realpath . DIRECTORY_SEPARATOR . "env.json";
    }

    private function loadEnvFile()
    {
        $envFile = file_get_contents($this->configBuffer['envFilePath']);
        $env = json_decode($envFile, true);
        if($env)
        {
            $this->configBuffer = array_merge($this->configBuffer, $env);
        }
    }

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