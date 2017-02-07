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
        $this->setPath();
        $this->loadEnvFile();
    }

    private function setPath()
    {
        $path = ".." . DIRECTORY_SEPARATOR;
        $realpath = realpath($path);
        $this->configBuffer['rootPath'] = $realpath;
        $this->configBuffer['applicationPath'] = $realpath . DIRECTORY_SEPARATOR . "application/";
        $this->configBuffer['frameworkPath'] = $realpath . DIRECTORY_SEPARATOR . "framework";
    }

    private function loadEnvFile()
    {

    }
}