<?php
/**
 * PROJECT: Kungfu
 * AUTHOR :　TheBoy <theboy5140@gmail.com>
 * FILE : View.php
 * DATE : 2017/2/7 15:49
 */

namespace TheBoy\Kungfu;

class View
{
    private $name;

    public function te()
    {

    }

    public function tesf()
    {
        echo($this->name);
    }

    public function __construct($name)
    {
        $this->name = $name;
    }
}