<?php
session_start();
require_once("config.php");
require_once("entity/User.php");
$id = $_SESSION['id'];
$user = User::getUserById($id);
$newBalance= $_POST['new-balance'];
$user->setBalance($newBalance);
$user->updateUserBalance();
header("location: index.php");
?>