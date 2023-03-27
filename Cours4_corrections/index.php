<?php
require('Game.php');

//exemple de code
$game = new Game(false, "Elden Ring", "Souls like");
$game->store();

//mon objet a bien son ID maintenant suite au store
echo $game;

var_dump($game->fetch_all());

$game->destroy();

