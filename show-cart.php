<?php
	session_start();
	require_once("config.php");
	require_once("entity/Cart.php");
	require_once("entity/Product.php");
	require_once("entity/User.php");
	$id = $_SESSION['id'];
	$user = User::getUserById($id);
	if(intval($id) === 0 && !$user) {
        header("Location: login.php?auth=denied");
	}

?>
<html>
	<head>
		<title>Cart</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />

		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="main.js"></script>
		<script type="text/javascript" src="paymentControl.js"></script>
		
		<!-- Latest compiled and minified CSS -->
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
		    <h3><?php echo ucwords($user->getUsername()); ?>'s Shopping Cart</h3>
		    <?php
			    $productsIdsArray = Cart::toArray($_SESSION['cart']);
		    ?>
		    <div class="table-responsive">
		    <table class="table"  id="res">
			    <tr>
			    	<td></td>
				    <td class="active"><b>Product</b></td>
				    <td class="active"><b>Quantity</b></td>
				    <td class="active"><b>Total</b></td>
			    </tr>
			    <?php
				for($i = 0; $i < count($productsIdsArray); $i++) {
					if(intval($productsIdsArray[$i]) > 0) {
                        $product = Product::getById($productsIdsArray[$i]);
                        if ($product) {
			     ?>
					<tr id="product-row-<?php echo $product->getId(); ?>">
					<td><img src="<?php echo $product->getImage();?>"></td>
					<td><?php print $product->getName(); ?></td>
					<td><input type="text" id="quantity-<?php print $product->getId(); ?>" onkeyup="calculateTotal(<?php print $product->getId(); ?>, <?php print $product->getPrice(); ?>)"/></td>
					<td id="total-<?php print $product->getId(); ?>" class="total"><?php print $product->getPrice(); ?></td>
					<td><span style="cursor:pointer;" class="removeFromCart" data-id="<?php print $product->getId(); ?>"><strong>remove product</strong></span></td>
				</tr>
			<?php 
		} }
				}
			?>
		    </table>
            </div>
		    <div class="alert alert-success">
		    <?php 
			//$user = new User();
			
            $prevBalance = $user->getBalance();
            ?> 
                Your previous balance is: $<span id="prevBalance"><?php  echo $prevBalance ?> </span><br/>
                Your purchase price is:	$<span id="totalPur"></span><br/>		
                Your total purchase cost is: $<span id="overallCost"></span><br/>	
                Your remaining balance will be: $<span id="newBalance"></span><br/>	
		    </div>
	
    
	        <div>
                <select name="dropDown" onchange="addShipping()" id="shipcost">
        	        <option value="-1">None</option>
                    <option value="0">Free Shipping ($0)</option>
                    <option value="5">Paid Shipping ($5)</option>
                </select>
            </div>
		
		    <br /><a href="index.php" title="go back to products"><strong>Go back to products</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="emptyCart" title="empty cart"><strong>Empty cart</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    <form id="paymentForm" method="post" action="pay.php">
			    <input type="hidden" class="form-control" name="new-balance" id="newBalanceInput" value="<?php echo $newBalance; ?>"/>
			    <br/>
			    <a type= "button" onclick="submit()" id= "payNow" class="btn btn-success">Pay Now</a>
		    </form>
        </div>
        <script type="text/javascript">
        	function calculateTotal(id, price) {
            $("#total-"+id).html(parseInt($("#quantity-"+id).val()) * price);
            getAllTotal();
}

            function getAllTotal(){
            var sum = 0;
            $(".total").each(function(index, value){ console.log(parseFloat($(this). html()));
                sum += parseFloat($(this). html());

            });
            $('#totalPur').html(sum);
}

            function getTotalandShipping(){
            var totalPur= $('#totalPur').html(sum);
            var shipping = parseFloat($("#shipcost").val());
            alert (totalPur);
}
        </script>
	</body>
</html>