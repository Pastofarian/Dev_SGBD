<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class PokemonController {
    
    public function index () {
        $favPokemons = Pokemon::all();
        return include 'views/pokemonView.php';
    }
    
    public function show ($id) {
        $pokemon = Pokemon::find($id);
        if ($pokemon) { // Si le Pokemon existe
            return include 'views/pokemonView.php';
        } else { // Si le Pokemon n'existe pas
            http_response_code(404);
            echo "Ce Pokemon n'existe pas";
            return;
        }
    }

    public function store($data) {
        
        $pokemon = new Pokemon(
            false, 
            $data['name'],
            $data['sprite'],
            $data['moves'],
            $data['types']
        );

        $pokemon->save();
        $favPokemons = Pokemon::all();
        return include 'views/pokemonView.php';
    }
    public function list() {
        $favPokemons = Pokemon::all();
        return include 'views/pokemonList.php';
    }

    public function destroy ($id) {
        $pokemon = Pokemon::find($id);
        $pokemonName = $pokemon->name;
        $pokemon->delete();
        echo $pokemonName;  
        return;
    }
    
    // public function search ($name) {
    //     $pokemon_url = 'https://pokeapi.co/api/v2/pokemon/' . $name;
    //     $pokemon_data = @file_get_contents($pokemon_url);
    
    //     if ($pokemon_data === false) { // If the Pokemon does not exist
    //         http_response_code(404);
    //         echo "This Pokemon does not exist";
    //         return;
    //     }
    
    //     $pokemon_data = json_decode($pokemon_data, true);
    
    //     // Extract the moves and types
    //     $moves = array_map(function ($move) {
    //         return $move['move']['name'];
    //     }, $pokemon_data['moves']);
    //     $types = array_map(function ($type) {
    //         return $type['type']['name'];
    //     }, $pokemon_data['types']);
    
    //     // Create a new Pokemon object
    //     $pokemon = new Pokemon($pokemon_data['id'], $pokemon_data['name'], $pokemon_data['sprites']['front_default'], $moves, $types);
    
    //     // Pass the Pokemon object to the view
    //     return include 'views/pokemonSearch.php';
    // }
    
    
}

// public function store($id) {
//     // Fetch the data from the API
//     $pokemon_url = 'https://pokeapi.co/api/v2/pokemon/' . $id;
//     $pokemon_data = json_decode(file_get_contents($pokemon_url), true);

//     // Extract the moves and types
//     $moves = array_map(function ($move) {
//         return $move['move']['name'];
//     }, $pokemon_data['moves']);
//     $types = array_map(function ($type) {
//         return $type['type']['name'];
//     }, $pokemon_data['types']);

//     // Check if the Pokemon already exists in the database
//     $pokemon_name = $pokemon_data['name'];
//     if ((new Pokemon(null, null, null, null, null))->exists($pokemon_name)) {
//         http_response_code(400);
//         echo "Ce Pokemon est déjà dans vos favoris";
//         return;
//     }

//     // Create a new Pokemon object and store it in the database
//     $pokemon = new Pokemon($pokemon_data['id'], $pokemon_data['name'], $pokemon_data['sprites']['front_default'], $moves, $types);
//     $pokemon->save();

//     echo $pokemon->name;

//     $pokemons = Pokemon::all();
//     return include 'views/pokemonList.php';
// }


