<?php

// Exercice
// 1. Créer une db avec la table users (id, email, password)
// 2. Créer votre classe User correspondante (constructeurs, getters & setters)
// 3. Créer une classe UserLogin.php
// 4. Créer la méthode statique dans la classe UserLogin verify qui se connecte à la DB et utilise
// password_verify() et vérifie si un password donné équivaut au password de l’objet User

// //user dans la DB : email => ben@ben.be , mdp => azerty
// $user1 = new User('b@b.be', 'azerty');
// $user2 = new User('ben@ben.be', 'azertyuiop');
// $user3 = new User('ben@ben.be', 'azerty');
// var_dump(UserLogin::verify($user1, 'azerty')); //false
// var_dump(UserLogin::verify($user2, 'azerty')); //false
// var_dump(UserLogin::verify($user3, 'azerty')); //true
// Hash de "azerty"
// $2y$10$5/QOOyOnfFp7fhxzCgm5BuLqihng/RbMOVC3dIzJRf7OL/AMIQ6IS

error_reporting(E_ALL);
ini_set('display_errors', 1);


require('User.php');

class UserLogin {
  public static function verify ($user, $password) {
      $db_con = new PDO('mysql:host=localhost;dbname=phpHashExo', 'root', 'toto');
      $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $statement = $db_con->prepare("SELECT * FROM users WHERE email = ? ");
      
      try {
          $statement->execute([$user->email]);
          $result = $statement->fetch(PDO::FETCH_ASSOC);

          if ($result) {
              if (password_verify($user->password, $result["password"])) {
                  return true;
              } 
              return false;
          }
          return false;
      } catch (PDOException $exception) {
          var_dump($exception);
      }
  }
}

$user1 = new User('b@b.be', 'azerty');
$user2 = new User('ben@ben.be', 'azertyuiop');
$user3 = new User('ben@ben.be', 'azerty');
var_dump(UserLogin::verify($user1, 'azerty')); //false
var_dump(UserLogin::verify($user2, 'azerty')); //false
var_dump(UserLogin::verify($user3, 'azerty')); //true
