<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Bootstrap.php
 * DATE : 2017/2/7 16:00
 */

namespace Kungfu;

if(!function_exists("includeIfExists"))
{
    function includeIfExists($file)
    {
        return file_exists($file) ? include $file : false;
    }
}


class Bootstrap
{
    public static function init()
    {
        global $application;
        $application = Application::init();
    }
}