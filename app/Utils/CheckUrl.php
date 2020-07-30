<?php

namespace App\Utils;

class CheckUrl
{
    private $model;

    private $url;

    private $i;

    public static function init($model, $url, $id) {
        return new self($model, $url, $id);
    }

    public function __construct($model, $url, $id)
    {
        $this->model = $model;
        $this->url   = $url;
        $this->i     = $id;
    }

    public function check()
    {
        if ($this->model->where('url', $this->url)->count()) {
            $this->url = $this->url . '-n-' . $this->getNum();
            $this->check();
        }
    }

    private function getNum()
    {
        $exp = explode($this->url, '-n-');
        return ((@$exp[0] && is_numeric($exp[0])) ?: $this->i) + 1;
    }

    private function getUrl()
    {
        return $this->url;
    }
}