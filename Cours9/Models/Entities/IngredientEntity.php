<?php

class IngredientEntity extends Entity {
    protected $id;
    protected $name;
    protected $recipes;
    protected static $dao = "IngredientDao";
    
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
        if ($this->recipes === false) {
            // Replace with the actual method used in your application to fetch the related Recipe objects
            $this->recipes = $this->belongsToMany(Recipe::class, "recipes", "IngredientRecipe", "ingredient_id", "recipe_id");
        }
        return $this->recipes;
    }
}
