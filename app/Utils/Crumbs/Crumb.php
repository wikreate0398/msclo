<?php

namespace App\Utils\Crumbs;

class Crumb
{
    private $name;

    private $link;

    public static function name($name)
    {
        return new self($name);
    }

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function link($link)
    {
        $this->link = $link;
        return $this;
    }

    public function get($isLast = false)
    {
        if ($this->link && !$isLast) {
            return '<a href="'.$this->link.'">'.$this->name.'</a>';
        } else {
            return $this->name;
        }
    }
}