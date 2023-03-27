<?php
require('User.php');
require('UserLogin.php');

$user = new User($_POST["email"], $_POST["password"]);
var_dump(UserLogin::verify($user));