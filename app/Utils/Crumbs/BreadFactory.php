<?php

namespace App\Utils\Crumbs;

class BreadFactory
{
    private $crumbs = [];

    public static function init()
    {
        return new self();
    }

    public function __construct() {}

    public function add(Crumb $crumb)
    {
        $this->crumbs[] = $crumb;
        return $this;
    }

    public function toHtml($items = '')
    {
        $i = 1;
        foreach ($this->crumbs as $key => $crumb) {
            $items .= '<li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 '. ($key == count($this->crumbs)-1 ? 'active' : '') .'">
                            '.$crumb->get((count($this->crumbs) == $i) ? true : false).'
                      </li>';
            $i++;
        }

        return $items;
    }
}