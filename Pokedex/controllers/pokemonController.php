<?php

require('PokemonDAO.php');

$action = $_POST['action'];
$id = $_POST['id'];

//sanitize

$dao = new PokemonDAO();

if($action == 'add') {

    $pokemon_url = 'https://pokeapi.co/api/v2/pokemon/'.$id;
    $pokemon_data = json_decode(file_get_contents($pokemon_url), true);

    $pokemon = new Pokemon($pokemon_data['id'], $pokemon_data['name'], $pokemon_data['sprites']['front_default']);

    $dao->store($pokemon);
} elseif($action == 'remove') {
    $dao->destroy($id);
}
?>
