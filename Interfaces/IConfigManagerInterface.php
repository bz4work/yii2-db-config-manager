<?php

namespace bz4work\Interfaces;


interface IConfigManagerInterface
{
    public function get($name);

    public function set($name, $value);

    public function getParams();

    public function transformToType($value, $type);

    //public function checkType($type);
}