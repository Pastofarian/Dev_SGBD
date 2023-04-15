<?php

class CategoryEntity extends Entity {
    protected $id;
    protected $name;
    protected $recipes;
    protected static $dao = "CategoryDao";
    
    public function __construct($id, $name, $recipes = false) {
        $this->id = $id;
        $this->name = $name;
        $this->recipes = $recipes;
    }
    
    public function __toString() {
        return "{$this->id} : {$this->name}";
    }
    
    public function __get($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "recipes") {
                return $this->recipes();
            }
            return $this->$prop;
        }
    }
    
    public function recipes() {
        return $this->hasMany(Recipe::class, "recipes", "category_id");
    }
}
