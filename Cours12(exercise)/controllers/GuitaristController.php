<?php 

class GuitaristController {
    
    public function index () {
        $guitarists = Guitarist::all();
        return include 'views/guitarists/list.php';
    }
    
    public function show ($id) {
        $guitar = Guitarist::find($id);
        if ($guitar) {
            return include 'views/guitarists/one.php';
        }
        return include 'views/guitarists/notfound.php';
    }
    
    public function create () {
        $categories = Category::all();
        $guitars = Guitar::all();
        return include 'views/guitarists/create.php';
    }
    
    public function store ($data) {
        $category = Category::find($data["category_id"]);
        $guitar = new Guitarist(false, $data["name"], $category);
        $guitar->save();
        foreach($data["ingredient_ids"] as $ingredient_id) {
            $guitar->add('guitars', Guitar::find($ingredient_id));
        }
        $guitarists = Guitarist::all();
        return include 'views/guitarists/list.php';
    }


    public function edit ($id) {
        $guitar = Guitarist::find($id);
        $guitars = Guitar::all(); 
        return include 'views/guitarists/update.php';
    }
    
    public function update ($data) {
        $guitar = Guitarist::find($data["id"]);
        $guitar->name = $data["name"];
        $guitar->save();
        $guitar->remove('guitars');
        foreach($data["ingredient_ids"] as $ingredient_id) {
            $guitar->add('guitars', Guitar::find($ingredient_id));
        }
        $guitarists = Guitarist::all();
        return include 'views/guitarists/list.php';
    }
    
    public function destroy ($id) {
        $guitar = Guitarist::find($id);
        $guitar->remove('guitars');
        $guitar->delete();
        $guitarists = Guitarist::all();
        return include 'views/guitarists/list.php';
        
    }

    public function updateView($id) {
        $guitar = Guitarist::find($id);
        $guitars = Guitar::all();
        include 'views/guitarists/update.php';
    }

}