<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class PokemonController
{
    public function index()
    {
        $favPokemons = Pokemon::all();
        return include 'views/pokemonView.php';
    }

    public function show($id)
    {
        $pokemon = Pokemon::find($id);
        if ($pokemon) {
            // Si le Pokemon existe
            return include 'views/pokemonView.php';
        } else {
            // Si le Pokemon n'existe pas
            http_response_code(404);
            echo "Ce Pokemon n'existe pas";
            return;
        }
    }

    public function store($data)
    {
        $types = json_decode(stripslashes($data['types']));
        $moves = json_decode(stripslashes($data['moves']));

        $pokemon = new Pokemon(false, $data['name'], $data['sprite'], $moves, $types);

        $pokemon->save();
        echo $pokemon->name;
        return;
    }
    public function list()
    {
        $favPokemons = Pokemon::all();
        return include 'views/pokemonList.php';
    }

    public function destroy($id)
    {
        $pokemon = Pokemon::find($id);
        $pokemonName = $pokemon->name;
        $pokemon->delete();
        echo $pokemonName;
        return;
    }
}