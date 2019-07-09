<?php
require_once("config.php");
require_once("cart.php");

if(!empty($_POST['rating']) && !empty($_POST['itemId'])){
$id = $_POST['itemId'];
$user_id = 1234567;
$insertRating = "INSERT INTO product_rating (id, user_id, rating_number) VALUES ('".$id."', '".$user_id."', '".$_POST['rating']."')";

mysqli_query($dbConnection, $insertRating) or die("database error: ". mysqli_error($dbConnection));
echo "rating saved!";
}
?>