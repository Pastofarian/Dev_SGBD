<?php

class Ingredient extends Entity {
    protected $id;
    protected $name;
    protected $recipes;
    protected static $dao = "IngredientDAO";

    public function __construct ($id, $name, $recipes = false) {
        $this->id = $id;
        $this->name = $name;
        $this->recipes = $recipes;
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "recipes") {
                return $this->recipes();
            }
            return $this->$prop;
        }
    }
    
    public function __toString () {
        return "{$this->id} : {$this->name}";
    }
    
    
    public function recipes () {
        return $this->belongsToMany(Recipe::class, "recipes", "ingredientRecipe", "ingredient_id", "recipe_id");
    }
    
    public function remove ($prop, $recipe = false) {
        if ($prop == "recipes") {
            return $this->unsync("ingredientRecipe", "ingredient_id", "recipe_id", $recipe);
        }
    }
    
    public function add ($prop, $recipe) {
        if ($prop == "recipes") {
            return $this->sync("ingredientRecipe", "ingredient_id", "recipe_id", $recipe);
        }
    }
    
}