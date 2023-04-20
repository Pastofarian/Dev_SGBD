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
        $recipes = Recipe::all();   
        // $ingredients = Ingredient::all();
        return include 'views/ingredients/create.php';
    }
    
    public function store ($data) {
        // $category = Category::find($data["category_id"]);
        $ingredient = new Ingredient(false, $data["name"], $recipe);
        $ingredient->save();
        // foreach($data["ingredient_ids"] as $ingredient_id) {
        //     $recipe->add('ingredients', Ingredient::find($ingredient_id));
        // }
        
    }
}