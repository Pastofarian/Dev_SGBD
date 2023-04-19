<?php

class Recipe extends Entity {
    protected $id;
    protected $name;
    protected $category;
    protected $ingredients;
    protected static $dao = "RecipeDAO";

    public function __construct ($id, $name, $category, $ingredients = false) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->ingredients = $ingredients;
    }
    
    public function __toString () {
        return "{$this->id} : {$this->name}";
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "category") {
                return $this->category();
            }
            if ($prop == "ingredients") {
                return $this->ingredients();
            }
            return $this->$prop;
        }
    }
    
    public function ingredients () {
        return $this->belongsToMany(Ingredient::class, "ingredients", "ingredientRecipe", "recipe_id", "ingredient_id");
    }
    
    public function category () {
        return $this->belongsTo(Category::class, "category");
    }
    
    public function remove ($prop, $ingredient = false) {
        if ($prop == "ingredients") {
            return $this->unsync("ingredientRecipe", "recipe_id", "ingredient_id", $ingredient);
        }
    }
    
    public function add ($prop, $ingredient) {
        if ($prop == "ingredients") {
            return $this->sync("ingredientRecipe", "recipe_id", "ingredient_id", $ingredient);
        }
    }
    
    
}