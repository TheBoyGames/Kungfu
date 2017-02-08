<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : Container.php
 * DATE : 2017/2/8 14:24
 */

class Container
{

}

class Person
{
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}

$person = $application->make('Person');