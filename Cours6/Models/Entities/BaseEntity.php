<?php

class BaseEntity {
    // private $id;
    // private $name;

    // public function __construct($id, $name){
    //     $this->id = $id;
    //     $this->name = $name;
    // }

    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }
    
    public function __set ($prop, $value) {
        if (property_exists($this, $prop)) {
            $this->$prop = $value;
        }
    }

    public static function all () {
        $dao = new static::$dao();
        return $dao->fetch_all();
    }

    public static function find ($id) {
        $dao = new static::$dao();
        return $dao->fetch($id);
    }

    public static function where ($attr, $value) {
        $dao = new static::$dao();
        return $dao->where($attr, $value);
    }

    public static function first ($attr, $value) {
        $dao = new static::$dao();
        return $dao->first($attr, $value);
    }

    public function save () {
        $dao = new static::$dao();
        return $dao->store($this);
    }

    public function delete ($id) { 
        $dao = new static::$dao();
        return $dao->destroy($this->id);
    }

    public function belongsTo ($class, $prop) {
        if (!$this->$prop instanceof $class) {
            $this->$prop = $class::first('id', $this->$prop);
        }
        return $this->$prop;
    }
    
    public function hasMany ($class, $prop, $name) {
        if (!$this->$prop) {
            $this->$prop = $class::where($name, $this->id);
        }
        return $this->$prop;
    }
    
    public function belongsToMany($class, $prop, $table, $key, $foreign) {
        if (!$this->$prop) {
            $this->$prop = $class::intermediate($table, $key, $this->id, $foreign);
        }
        return $this->$prop;
    }
    
    public static function intermediate($table, $key, $value, $foreign) {
        return (new static::$dao)->intermediate($table, $key, $value, $foreign);
    }

}