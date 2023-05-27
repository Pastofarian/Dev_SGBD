<?php
require('../autoload.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if (($action !== 'add' && $action !== 'remove') || !is_numeric($id)) {
    die("Action invalide ou Pokemon ID");
}

$dao = new PokemonDAO();

if($action == 'add') {
    $pokemon_url = 'https://pokeapi.co/api/v2/pokemon/'.$id;
    $pokemon_data = json_decode(file_get_contents($pokemon_url), true);

    $moves = array_map(function($move) {
        return $move['move']['name'];
    }, $pokemon_data['moves']);
    
    $types = array_map(function($type) {
        return $type['type']['name'];
    }, $pokemon_data['types']);

    // Check si le Pokemon est déjà dans la DB
    if ($dao->exists($id)) {
        http_response_code(400);
        echo "Ce Pokemon est déjà dans les favoris";
        return;
    }

    $pokemon = new Pokemon($pokemon_data['id'], $pokemon_data['name'], $pokemon_data['sprites']['front_default'], $moves, $types);
    $dao->store($pokemon);
    echo $pokemon->name;
} elseif($action == 'remove') {
    if (!$dao->exists($id)) {
        http_response_code(400);
        echo "Ce Pokemon n'est pas dans les favoris";
        return;
    }
    $pokemon = $dao->fetch($id);
    $pokemonName = $pokemon->name;
    $dao->destroy($id);
    echo $pokemonName;
}

?>
