<?php

namespace App\Utils;

class ArraySess
{
    public static function init($name) {
        return new self($name);
    }

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function attach($value)
    {
        $sessData = $this->_getData();
        if (!in_array($value, $sessData)) {
            $sessData[$value] = $value;
            session()->put($this->name, $sessData);
        }
    }

    public function detach($value)
    {
        $sessData = $this->_getData();
        if (in_array($value, $sessData)) {
            unset($sessData[$value]);
            session()->put($this->name, $sessData);
        }
    }

    public function exist($value)
    {
        if (session()->has($this->name) && $this->isArray()) {
            if (!empty(session()->get($this->name)[$value])) {
                return true;
            }
        }
    }

    private function isArray()
    {
        return is_array(session()->get($this->name));
    }

    public function count()
    {
        return $this->isArray() ? count(session()->get($this->name)) : 0;
    }

    private function _getData()
    {
        return session($this->name) ?: [];
    }
}