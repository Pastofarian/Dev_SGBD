<?php
// require '../autoload.php';

// // error_reporting(E_ALL);
// // ini_set('display_errors', 1);
// // ini_set('display_startup_errors', 1);

// // sanitize action et id
// $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
// $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

// // Vérification de la validité de l'action et de l'ID
// if (($action !== 'add' && $action !== 'remove') || !is_numeric($id)) {
//     die("Action invalide ou ID incorrect");
// }

// $dao = new PokemonDAO();

// if ($action == 'add') {
//     //si add, on récupère les données depuis l'API
//     $pokemon_url = 'https://pokeapi.co/api/v2/pokemon/' . $id;
//     $pokemon_data = json_decode(file_get_contents($pokemon_url), true);

//     // Récupère les compétences et les types
//     $moves = array_map(function ($move) {
//         return $move['move']['name'];
//     }, $pokemon_data['moves']);
//     $types = array_map(function ($type) {
//         return $type['type']['name'];
//     }, $pokemon_data['types']);

//     // Vérifie si le Pokemon est déjà dans la db avec le nom car l'id est auto incremented. J'aurais pu garder l'id de l'API qui est unique j'imagine.
//     $pokemon_name = $pokemon_data['name'];
//     if ($dao->exists($pokemon_name)) {
//         http_response_code(400);
//         echo "Ce Pokemon est déjà dans vos favoris";
//         return;
//     }

//     // Crée un nouvel objet Pokemon et le stocke dans la db
//     $pokemon = new Pokemon($pokemon_data['id'], $pokemon_data['name'], $pokemon_data['sprites']['front_default'], $moves, $types);
//     $dao->store($pokemon);
//     echo $pokemon->name;
// } elseif ($action == 'remove') {
//     // Si remove, supprime le Pokemon de la db
//     $pokemon = $dao->fetch($id);
//     if ($pokemon === null) {
//         http_response_code(400);
//         echo "Ce Pokemon n'est pas dans vos favoris";
//         return;
//     }
//     $pokemonName = $pokemon->name;
//     $dao->destroy($id);
//     echo $pokemonName;
// }
?>
