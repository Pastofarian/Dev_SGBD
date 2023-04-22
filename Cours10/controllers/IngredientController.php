<?php 

class IngredientController {
    
    public function index () {
        $ingredients = Ingredient::all();
        return include 'views/ingredients/list.php';
    }
    
    public function show ($id) {
        $ingredient = Ingredient::find($id);
        if ($ingredient) {
            return include 'views/ingredients/one.php';
        }
        return include 'views/ingredients/notfound.php';
    }
    
    public function create () {
        $categories = Category::all();
        $recipes = Recipe::all();   
        // $ingredients = Ingredient::all();
        return include 'views/ingredients/create.php';
    }
    
    public function store($data) {
        $ingredient = new Ingredient(false, $data["name"]);
        $ingredient->save();
        if (!empty($data["recipes"])) {
            foreach ($data["recipes"] as $recipe_id) {
                $ingredient->add('recipes', Recipe::find($recipe_id));
            }
        }
        $ingredients = Ingredient::all();
        return include 'views/ingredients/list.php';
    }
    
}