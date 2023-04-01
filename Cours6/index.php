<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('Models/DAOs/BaseDAO.php');

require_once('Models/DAOs/GameDAO.php');
require_once('Models/Entities/Game.php');
require_once('Models/DAOs/ConsoleDAO.php');
require_once('Models/Entities/Console.php');

//Game tests

$game = new Game(false, "Mario kart", "Souls like");
$marioKart = new Game(3, "Mario kart", "course");


$gameDao = new GameDAO();

//$gameDao->store($game);
echo "fetch_all Game";
echo "<pre>";
print_r($gameDao->fetch_all());
echo "</pre>";

echo "fetch game(2)";
echo "<pre>";
print_r($gameDao->fetch(2));
echo "</pre>";

$destroyGame = new GameDAO();
//$destroyGame->destroy(6);


$whereGame = new GameDAO();
echo "where game(type, Souls like)";
echo "<pre>";
print_r($whereGame->where("type", "Souls like"));
echo "</pre>";

$firstGame = new GameDAO();
echo "First game(type, Souls like)";
echo "<pre>";
print_r($firstGame->first("type", "Souls like"));
echo "</pre>";

//$gameDao->update($marioKart);

//Console tests

$sega = new Console(false, "Sega");
$xbox = new Console(3, "Xbox");



$consoleDao = new ConsoleDao();
//$consoleDao->store($sega);
echo "fetch_all Console";
echo "<pre>";
print_r($consoleDao->fetch_all());
echo "</pre>";

echo "fetch console(2)";
echo "<pre>";
print_r($consoleDao->fetch(1));
echo "</pre>";

$destroyConsole = new ConsoleDAO();
//$destroyConsole->destroy(2);

$whereConsole = new ConsoleDAO();
echo "where console()";
echo "<pre>";
print_r($whereConsole->where("name", "Sega"));
echo "</pre>";

$firstConsole = new ConsoleDAO();
echo "First console(Playstation)";
echo "<pre>";
print_r($firstConsole->first("name", "Playstation"));
echo "</pre>";

//$consoleDao->update($xbox);








