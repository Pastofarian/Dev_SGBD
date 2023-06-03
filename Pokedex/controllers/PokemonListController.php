<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class PokemonListController {
    
    public function index () {
        $favPokemons = Pokemon::all();
        return include 'views/pokemonList.php';
    }
}