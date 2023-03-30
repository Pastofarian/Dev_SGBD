<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('Models/DAO/Game_DAO.php');
require('Models/Entities/Game.php');


$game = new Game(false, "Elden Ring", "Souls like");
$game2 = new Game(false, "Elden Ring2", "Souls like");


$dao = new GameDAO();
//$dao->store($game);
//var_dump($dao->fetch_all());

$destroy = new GameDAO();
//$destroy->destroy(4);

// var_dump($dao->fetch(2));

$whereDao = new GameDAO();
var_dump($whereDao->where("type", "shot"));



