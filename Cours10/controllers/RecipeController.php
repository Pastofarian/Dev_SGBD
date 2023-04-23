<?php 

class RecipeController {
    
    public function index () {
        $recipes = Recipe::all();
        return include 'views/recipes/list.php';
    }
    
    public function show ($id) {
        $recipe = Recipe::find($id);
        if ($recipe) {
            return include 'views/recipes/one.php';
        }
        return include 'views/recipes/notfound.php';
    }
    
    public function create () {
        $categories = Category::all();
        $ingredients = Ingredient::all();
        return include 'views/recipes/create.php';
    }
    
    public function store ($data) {
        $category = Category::find($data["category_id"]);
        $recipe = new Recipe(false, $data["name"], $category);
        $recipe->save();
        foreach($data["ingredient_ids"] as $ingredient_id) {
            $recipe->add('ingredients', Ingredient::find($ingredient_id));
        }
        $recipes = Recipe::all();
        return include 'views/recipes/list.php';
    }


    public function edit ($id) {
        $recipe = Recipe::find($id);
        $categories = Category::all();
        $ingredients = Ingredient::all(); 
        //var_dump($ingredients);
        return include 'views/recipes/update.php';
    }
    
    public function update ($data) {
        $recipe = Recipe::find($data["id"]);
        $category = Category::find($data["category_id"]);
        $recipe->name = $data["name"];
        // $recipe->description = $data["description"];
        $recipe->category = $category;
        $recipe->save();
        
        $recipe->remove('ingredients');
        foreach($data["ingredient_ids"] as $ingredient_id) {
            $recipe->add('ingredients', Ingredient::find($ingredient_id));
        }
        $recipes = Recipe::all();
        return include 'views/recipes/list.php';
    }
    
    public function destroy ($id) {
        $recipe = Recipe::find($id);
        $recipe->remove('ingredients');
        $recipe->delete();
        $recipes = Recipe::all();
        return include 'views/recipes/list.php';
        
    }

    public function updateView($id) {
        $recipe = Recipe::find($id);
        $categories = Category::all();
        $ingredients = Ingredient::all();
        include 'views/recipes/update.php';
    }

}