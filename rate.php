<?php
session_start();
require_once("config.php");
require_once("entity/Rating.php");
$userId = $_SESSION['id'];
$rate = intval($_POST['rate']);
$productId = intval($_POST['product']);
$rating = new Rating(null, $productId, $userId, $rate);
$rating->add();
header("location: index.php");
?>