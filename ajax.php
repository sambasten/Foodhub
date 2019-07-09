<?php
	session_start();
	require_once("config.php");
	require_once("entity/Cart.php");
	$id = intval($_GET['id']);
	
	$productIdsstring = $_SESSION['cart'];


    $productsIdArray = Cart::toArray($productIdsstring);
    
    $cart = new Cart($id, $productsIdArray);
    
	$action = $_GET["action"];
	if ($action=='add'){
		$_SESSION['cart'] = $cart->add();
	}
	elseif($action=='remove')  {
		$_SESSION['cart'] = $cart->remove();
		 //javascript:location.reload();
	}
	else {
		$_SESSION['cart'] = "";
	}
?>