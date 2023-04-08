<?php

class BaseEntity {

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

    public function save() {
        $dao = new static::$dao();
        if ($this->id === null) {
            return $dao->store($this);
        } else {
            return $dao->update($this);
        }
    }
    
    

    public function delete ($id) { 
        $dao = new static::$dao();
        return $dao->destroy($this->id);
    }

}