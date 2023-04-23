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

    public function edit($id) {
        $ingredient = Ingredient::find($id);
        $recipes = Recipe::all();
        return include 'views/ingredients/update.php';
    }
    
    public function update($data) {
        $ingredient = Ingredient::find($data["id"]);
        $ingredient->name = $data["name"];
        $ingredient->save();
    
        $recipes = Recipe::all();
        if (!empty($data["recipes"])) {
            foreach ($recipes as $recipe) {
                if (in_array($recipe->id, $data["recipes"])) {
                    $recipe->add('ingredients', $ingredient);
                } else {
                    $recipe->remove('ingredients', $ingredient);
                }
                $recipe->save();
            }
        } else {
            foreach ($recipes as $recipe) {
                $recipe->remove('ingredients', $ingredient);
                $recipe->save();
            }
        }
    
        $ingredients = Ingredient::all();
        include 'views/ingredients/list.php';
    }
    
    
    
    public function destroy($id) {
        $ingredient = Ingredient::find($id);
        $ingredient->remove('recipes');
        $ingredient->delete();
        $ingredients = Ingredient::all();
        return include 'views/ingredients/list.php';
    }
    
    public function updateView($id) {
        $ingredient = Ingredient::find($id);
        $recipes = Recipe::all();
        include 'views/ingredients/update.php';
    }
    
    
}