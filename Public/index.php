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
