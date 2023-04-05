<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require('models/entities/Entity.php');
require('models/entities/Game.php');
require('models/entities/Console.php');
require('models/entities/Type.php');
require('models/dao/DAOInterface.php');
require('models/dao/DAO.php');
require('models/dao/GameDAO.php');
require('models/dao/ConsoleDAO.php');
require('models/dao/TypeDAO.php');


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

$elden = Game::first('name', 'Elden Ring');




