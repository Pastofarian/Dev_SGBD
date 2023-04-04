<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



require_once('Models/DAOs/InterfaceDAO.php');
require_once('Models/Entities/InterfaceEntity.php');
require_once('Models/DAOs/BaseDAO.php');

require_once('Models/DAOs/GameDAO.php');
require_once('Models/Entities/Game.php');
require_once('Models/DAOs/ConsoleDAO.php');
require_once('Models/Entities/Console.php');
require_once('Models/DAOs/TypeDAO.php');
require_once('Models/Entities/Type.php');



//Game tests

$game = new Game(false, "Mario kart", "Souls like");
$marioKart = new Game(3, "Mario kart", "course");


$gameDao = new GameDAO();

//$gameDao->store($game);
echo "<h3>fetch_all Game</h3>";
echo "<pre>";
print_r($gameDao->fetch_all());
echo "</pre>";

echo "<h3>fetch game(2)</h3>";
echo "<pre>";
print_r($gameDao->fetch(2));
echo "</pre>";

$destroyGame = new GameDAO();
//$destroyGame->destroy(6);


$whereGame = new GameDAO();
echo "<h3>where game(type, 2)</h3>";
echo "<pre>";
print_r($whereGame->where("type_id", "2"));
echo "</pre>";

$firstGame = new GameDAO();
echo "<h3>First game(type, Souls like)</h3>";
echo "<pre>";
print_r($firstGame->first("type", "Souls like"));
echo "</pre>";

//$gameDao->update($marioKart);

//Console tests

$sega = new Console(false, "Sega");
$xbox = new Console(3, "Xbox");



$consoleDao = new ConsoleDao();
//$consoleDao->store($sega);
echo "<h3>fetch_all Console</h3>";
echo "<pre>";
print_r($consoleDao->fetch_all());
echo "</pre>";

echo "<h3>fetch console(2)</h3>";
echo "<pre>";
print_r($consoleDao->fetch(1));
echo "</pre>";

$destroyConsole = new ConsoleDAO();
//$destroyConsole->destroy(2);

$whereConsole = new ConsoleDAO();
echo "<h3>where console()</h3>";
echo "<pre>";
print_r($whereConsole->where("name", "Xbox"));
echo "</pre>";

$firstConsole = new ConsoleDAO();
echo "<h3>First console(Playstation)</h3>";
echo "<pre>";
print_r($firstConsole->first("name", "Playstation"));
echo "</pre>";

//$consoleDao->update($xbox);



//Type
$typeDAO = new TypeDAO();

echo "<h3>fetch_all Type</h3>";
echo "<pre>";
print_r($typeDAO->fetch_all());
echo "</pre>";

//Static
echo "<h3>fetch_all static </h3>";
echo "<pre>";
print_r(Game::all());
echo "</pre>";

$marioWorld = new Game(false, "Mario World", "2");
echo "<h3>store static </h3>";
echo "<pre>";
print_r($marioWorld->save());
echo "</pre>";




