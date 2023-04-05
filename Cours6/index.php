<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require_once('Models/Entities/BaseEntity.php');
require_once('Models/Entities/Game.php');
require_once('Models/Entities/Console.php');
require_once('Models/Entities/Type.php');
// require_once('Models/Entities/InterfaceEntity.php');
require_once('Models/DAOs/InterfaceDAO.php');
require_once('Models/DAOs/BaseDAO.php');
require_once('Models/DAOs/GameDAO.php');
require_once('Models/DAOs/ConsoleDAO.php');
require_once('Models/DAOs/TypeDAO.php');



//Game tests

$game = new Game(false, "Mario kart", "Souls like");
$marioKart = new Game(3, "Mario kart", "course");


$gameDao = new GameDAO();

//$gameDao->store($game);
echo "<h3>fetch_all Game</h3>";
echo "<pre>";
print_r($gameDao->fetch_all());
echo "</pre>";

echo "<h3>fetch game(12)</h3>";
echo "<pre>";
print_r($gameDao->fetch(12));
echo "</pre>";

$destroyGame = new GameDAO();
//$destroyGame->destroy(6);


$whereGame = new GameDAO();
echo "<h3>where game(type_id, 3)</h3>";
echo "<pre>";
print_r($whereGame->where("type_id", "3"));
echo "</pre>";

$firstGame = new GameDAO();
echo "<h3>First game(type_id, 4)</h3>";
echo "<pre>";
print_r($firstGame->first("type_id", "4"));
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

//Type tests
$typeDAO = new TypeDAO();

echo "<h3>fetch_all Type</h3>";
echo "<pre>";
print_r($typeDAO->fetch_all());
echo "</pre>";


/************************************************************************************ */
echo "<h1>Exercices</h1>";
/*
A rendre pour le mercredi 5 avril 23:59 en m'envoyant votre code en message privé sur discord

Ce qu'il faut faire : 
1)
 - Notre code tombe dans une boucle infinie ou notre Game récupère son Type qui récupère ses Games à l'infini
 - Faites en sorte de gérer notre relation one 2 many / many 2 one sans que cela génère une boucle infinie
 - Vous disposez d'un exemple de ce que j'attends ci-dessous
 
 2)
 - Une fois que cela fonctionne, simplifier la gestion des relations one2many / many2one en ajoutant une couche d'abstraction dans vos classes abstraites
*/

//Exemple de ce que j'attends
$elden = Game::first('name', 'Elden Ring');

// $elden->type->name //Souls like
// $elden->type->games //[Obj Game : Dark Souls 3, Obj Game : Elden Ring]
// $elden->type->games[0]->name //Dark Souls 3
// $elden->type->games[0]->type->name //Souls like

echo "<h3>elden->type->name //Souls like</h3>";
$type_name = $elden->getType()->name;
echo $type_name; 

echo "<h3>elden->type->games //[Obj Game : Dark Souls 3, Obj Game : Elden Ring]</h3>";
$type_games = $elden->getType()->getGames();
echo "<pre>";
print_r($type_games); 
echo "<pre>";

echo "<h3>elden->type->games[0]->name //Dark Souls 3</h3>";
$first_game_name = $type_games[0]->name;
echo $first_game_name; 

echo "<h3>elden->type->games[0]->type->name //Souls like</h3>";
$first_game_type_name = $type_games[0]->getType()->name;
echo $first_game_type_name; 


// $gameDAO = new GameDAO();
// $games = $gameDAO->where('type_id', 1); 
// echo '<pre>';
// print_r($games);
// echo '</pre>';

// $typeDAO = new TypeDAO();
// $types = $typeDAO->where('id', 1); 
// echo '<pre>';
// print_r($types);
// echo '</pre>';
