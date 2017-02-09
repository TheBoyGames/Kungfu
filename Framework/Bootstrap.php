<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Bootstrap.php
 * DATE : 2017/2/7 16:00
 */

namespace Kungfu;

class Bootstrap
{
    public static function init()
    {
        global $application;
        $application = Application::init();
    }
}