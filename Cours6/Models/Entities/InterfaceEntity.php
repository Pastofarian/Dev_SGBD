<?php

interface InterfaceEntity {
    public function __get ($prop);
    public function __set ($prop, $value);
    public static function all();
    public static function find($id);
    public static function where($attr, $value);
    public static function first($attr, $value);
    public static function save();
    public static function delete ($id);
    
}

