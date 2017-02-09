<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : index.php
 * DATE : 2017/2/7 13:11
 */

include "../vendor/autoload.php";

use Kungfu\Bootstrap;

Bootstrap::init();

$application->start();


class TestC implements Kungfu\ConfigurationInterface
{

    public function set($name, $value)
    {
        // TODO: Implement set() method.
    }

    public function get($name)
    {
        // TODO: Implement get() method.
    }

}