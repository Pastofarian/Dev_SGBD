<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $gameId = isset($_POST['id']) ? $_POST['id'] : null;
  $gameName = isset($_POST['name']) ? $_POST['name'] : null;
  $gameTypeId = isset($_POST['type_id']) ? $_POST['type_id'] : null;

// echo $_POST['type_id'];
// echo $gameName;

  if ($gameId && $gameName && $gameTypeId) {
    $game = Game::find($gameId);

    $game->name = $gameName;
    $game->type_id = $gameTypeId;

    $game->saveUpdate();

    header('Location: ../Views/Games.php');

    // echo "<pre>";
    // print_r("gameName" . " " . $gameName);
    // echo "</pre>";
    // echo "<br>";
    // echo "<pre>";
    // print_r("game" . " " . $game);
    // echo "</pre>";
    // $result = $game->save();
    // echo "<pre>";
    // print_r("game" . " " . $result);
    // echo "</pre>";
  }
}


  