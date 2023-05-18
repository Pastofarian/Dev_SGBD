<?php

class Bar extends Entity {
    protected $id;
    protected $name;
    protected $address;
    protected $owner;
    protected $beers;
    protected static $dao = "BarDAO";
    
    public function __construct ($id, $name, $address, $owner, $beers = false) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->owner = $owner;
        $this->beers = $beers;
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "beers") {
                return $this->beers();
            }
            return $this->$prop;
        }
    }
    
    public function beers () {
        return $this->belongsToMany(Beer::class, "beers", "bar_beer", "bar_id", "beer_id");
    }
    
    public function remove ($prop, $beer = false) {
        if ($prop == "beers") {
            return $this->unsync("bar_beer", "bar_id", "beer_id", $beer);
        }
    }
    
    public function add ($prop, $beer) {
        if ($prop == "beers") {
            return $this->sync("bar_beer", "bar_id", "beer_id", $beer);
        }
    }
}