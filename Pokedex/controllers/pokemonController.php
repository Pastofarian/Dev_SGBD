<?php
// require('../autoload.php');
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

// $action = $_POST['action'];
// $id = $_POST['id'];

// //sanitize

// $dao = new PokemonDAO();

// if($action == 'add') {

//     $pokemon_url = 'https://pokeapi.co/api/v2/pokemon/'.$id;
//     $pokemon_data = json_decode(file_get_contents($pokemon_url), true);

//     $pokemon = new Pokemon($pokemon_data['id'], $pokemon_data['name'], $pokemon_data['sprites']['front_default']);

//     $dao->store($pokemon);
// } elseif($action == 'remove') {
//     $dao->destroy($id);
// }
require('../autoload.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if (($action !== 'add' && $action !== 'remove') || !is_numeric($id)) {
    die("Invalid action or Pokemon ID");
}

$dao = new PokemonDAO();

if($action == 'add') {
    $pokemon_url = 'https://pokeapi.co/api/v2/pokemon/'.$id;
    $pokemon_data = json_decode(file_get_contents($pokemon_url), true);

    $pokemon = new Pokemon($pokemon_data['id'], $pokemon_data['name'], $pokemon_data['sprites']['front_default']);

    $dao->store($pokemon);
    echo $pokemon->name;
} elseif($action == 'remove') {
    $pokemon = $dao->fetch($id);
    $pokemonName = $pokemon->name;
    $dao->destroy($id);
    echo $pokemonName;
} 
?>
