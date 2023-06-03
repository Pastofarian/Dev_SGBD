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
        $types = json_decode(stripslashes($data['types'])); // retire les backslashes de la chaîne JSON 'types' et la transforme variable PHP
        $moves = json_decode(stripslashes($data['moves'])); // retire les backslashes de la chaîne JSON 'moves' et et la transforme variable PHP

        $pokemon = new Pokemon(false, $data['name'], $data['sprite'], $moves, $types); //false car AUTO_INCREMENT

        $pokemon->save();
        echo $pokemon->name; // pour afficher le nom du pokemon ajouté dans la modale
        return;
    }
    public function list() //pour afficher la liste complète des pokemons dans pokemonList.php
    {
        $favPokemons = Pokemon::all();
        return include 'views/pokemonList.php';
    }

    public function destroy($id)
    {
        $pokemon = Pokemon::find($id); //pour trouver le pokemon à supprimer
        $pokemonName = $pokemon->name;
        $pokemon->delete();
        echo $pokemonName; //pour afficher le nom du pokemon supprimé dans la modale
        return;
    }
}