<?php

class Pokemon extends Entity {

    public $id;
    public $name;
    public $sprite;
    protected static $dao = 'PokemonDAO';

    public function __construct($id, $name, $sprite) {
        $this->id = $id;
        $this->name = $name;
        $this->sprite = $sprite;
    }

    public function __get($prop) {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }
    
    public function __set($prop, $value) {
        if (property_exists($this, $prop)) {
            $this->$prop = $value;
        }
    }
}
