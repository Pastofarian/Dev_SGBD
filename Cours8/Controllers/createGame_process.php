<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $typeId = isset($_POST['type_select']) ? intval($_POST['type_select']) : null;

    if ($name && $typeId) {
        $game = new Game(false, $name, $typeId);
        $result = $game->save();
// echo "<pre>";
// var_dump($game);// object(Game)#1 (4) { ["id":protected]=> bool(false) ["name":protected]=> string(5) "Teken" ["type_id":protected]=> int(4) ["type":protected]=> NULL } 
// echo "</pre>";
// echo $name; 
// echo "<br>";
// echo $typeId; 
// echo "<br>";

        if ($result) {
            // Redirige vers Games si ok
            header('Location: ../Views/Games.php');
            exit;
        } else {
            echo "Un problème est survenu pendant la création du jeu.";
        }
    } else {
        echo "Un nom et un type sont obligatoire.";
    }
} else {
    // redirige vers createGame si la REQUEST_METHOD n'est pas POST
    header('Location: ../Views/createGame.php');
    exit;
}
