<?php
session_start();
require_once("config.php");
require_once("entity/User.php");
$username = $_POST["username"];
$password = $_POST["password"];
 
if (trim($username)  == "" || trim($password) == "") {
    // Could not get the data that should have been sent.
    header('Location: login.php?auth=empty');
}
else if (!$user){
    header("Location: login.php?auth=incorrect");
}

$user = User::getUserByUsernameANDPassword($username, $password);
if($user) {
    $_SESSION["loggedIn"] = TRUE;
    $_SESSION["id"] = $user->getId();
    $_SESSION['cart'] = ' ';
    //"Welcome " . $_SESSION["username"] . "!";
    header('Location: index.php');
    exit;
}
?>