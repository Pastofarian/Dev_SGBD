<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require('Models/DAO/Game_DAO.php');
require('Models/Entities/Game.php');
require('Models/DAO/Console_Dao.php');
require('Models/Entities/Console.php');


$game = new Game(false, "Elden Ring", "Souls like");
$game2 = new Game(6, "Elden Ring2", "Souls like");


$gameDao = new GameDAO();
// //$gameDao->store($game);
// //var_dump($gameDao->fetch_all());

// $destroy = new GameDAO();
// //$destroy->destroy(4);

// // var_dump($gameDao->fetch(2));

// $whereDao = new GameDAO();
// var_dump($whereDao->where("type", "shot"));

$consoleDao = new Console_Dao();
var_dump($consoleDao->fetch_all());

// $gameDao->update($game2);





