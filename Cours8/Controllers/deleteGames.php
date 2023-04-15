<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once('../autoload.php');

$gameId = isset($_GET['id']) ? $_GET['id'] : null;
echo $gameId;
// echo "test";

if ($gameId) {
    $game = Game::find($gameId);
    if ($game) {
        $game->delete($gameId);
    }
}


header('Location: ../Views/Games.php');
exit;
