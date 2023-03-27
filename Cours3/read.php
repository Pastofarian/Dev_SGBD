<?php
function recupPassword($email){
  include('connection.php');
  $query = "SELECT 'password' FROM users WHERE email = :email";
  $query_params = array(':email' => $email);
  try
  {
      $stmt = $db->prepare($query);
      $result = $stmt->execute($query_params);
  }
  catch(PDOException $ex){
      die("Failed query : " . $ex->getMessage());
  }
  $result = $stmt->fetchAll();
  return (!empty($result)) ? $result: 'NULL';
}

//var_dump(recupAllInfoDB("ben@ben.be"));


// echo "password : " . recupAllInfoDB($user->password);
// echo "<br>";
// echo "user : " . recupAllInfoDB($user->email);