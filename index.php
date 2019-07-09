	<?php
		session_start();
		require_once("config.php");
		require_once("entity/Product.php");
		require_once("entity/User.php");
		require_once("entity/Rating.php");
		$id = $_SESSION['id'];
		$user = User::getUserById($id);
		if(intval($id) === 0 && !$user) {
	        header("Location: login.php?auth=denied");
		}

	?>
	<html>
		<head>
			<title>Products</title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="description" content="" />
			<meta name="keywords" content="" />
			

			<!-- Latest compiled and minified CSS -->
	        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	    </head>
		    <body>
			    <nav class= "navbar navbar-default">
				    <ul>
				        <div style="float: left;">
					        <h1>Our Products</h1>
					    </div>
					    <div class= "navbar-brand" style="float: left; margin-left: 50em; padding-top: 25px"><a href="logout.php">Logout</a>
				        </div>
				    </ul>
			    </nav>
			    <div class="container" >
			    	<h3>Welcome, <?php echo ucwords($user->getUsername()); ?>!</h3>
			    <?php
				$products = Product::getProducts();
			    ?>

			    <div class="alert alert-success">
			    <?php 
				$totalPur=  array_sum(array_column($products, 'total'));

				//$shipcost= $_POST["dropDown"];
	            $prevBalance =$user->getBalance();
				echo "Your balance is: "."$".$prevBalance;
				echo "<br>";
				 ?>
			    </div>
			        <div class="table-responsive" >
			            <table class= "table">
				            <tr class="active">
				            	<td></td>
					            <td ><b>Product</b></td>
					            <td ><b>Price</b></td>
					            <td></td>
					            <td></td>
					            <td></td>
				            </tr>
				        <?php
					    foreach($products as $product){
					    	$productRate = Rating::getByProductIdAndUserId($product->getId(),$user->getId());
					    	$averageRate = Rating::getAverageRating($product->getId());
					    	$isRated = null  !== $productRate ? 1 : 0;
					    	$rate = null !== $productRate ?  $productRate->getRate() : 0;
				        ?>
					        <tr>
					        	<td><img src="<?php echo $product->getImage();?>"></td>
						        <td ><?php echo $product->getName(); ?></td>
						        <td>$<?php echo $product->getPrice(); ?></td>
						        <td><span style="cursor:pointer;" class="addToCart" data-id="<?php echo $product->getId(); ?>">Add to Cart</span></td>
						        <td>
							<div class="col-sm-12">
							    <form id="form-rate-<?php echo $product->getId(); ?>" method="POST" action="rate.php">
							    	<div class="form-group">
									<h4>Rate this product</h4>
									<button type="button" class="btn <?php if (1 == $rate) {?> btn-warning <?php } else { ?> btn-default <?php } ?> btn-sm rateButton" aria-label="Left Align" onclick="rateProduct(1, <?php echo $product->getId(); ?>, <?php echo $isRated; ?>)">
										<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									</button>
									<button type="button" class="btn <?php if (2 == $rate) { ?> btn-warning <?php } else { ?> btn-default <?php } ?> btn-sm rateButton" aria-label="Left Align" onclick="rateProduct(2, <?php echo $product->getId(); ?>, <?php echo $isRated; ?>)">
										<span class="glyphic btn-sm rateButton" aria-label="Left Align">
										<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									</button>
									<button type="button" class="btn <?php if (3 == $rate) {?> btn-warning <?php } else { ?> btn-default <?php } ?> btn-sm rateButton" aria-label="Left Align" onclick="rateProduct(3, <?php echo $product->getId(); ?>, <?php echo $isRated; ?>)">
										<span class="glyphic btn-sm rateButton" aria-label="Left Align">
										<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									</button>
									<button type="button" class="btn <?php if (4 == $rate) {?> btn-warning <?php } else { ?> btn-default <?php } ?> btn-sm rateButton" aria-label="Left Align" onclick="rateProduct(4, <?php echo $product->getId(); ?>, <?php echo $isRated; ?>)">
										<span class="glyphic btn-sm rateButton" aria-label="Left Align">
										<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									</button>
									<button type="button" class="btn <?php if (5 == $rate) {?> btn-warning <?php } else { ?> btn-default <?php } ?> btn-sm rateButton" aria-label="Left Align" onclick="rateProduct(5, <?php echo $product->getId(); ?>, <?php echo $isRated; ?>)">
										<span class="glyphic btn-sm rateButton" aria-label="Left Align">
										<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
										</button>
									<input type="hidden" class="form-control" id="rate-<?php echo $product->getId(); ?>" name="rate" >
									<input type="hidden" class="form-control" name="product" value="<?php echo $product->getId(); ?>">
									<h6><strong>Average Rating: <span><?php echo $averageRate;?></span></strong> </h6>
								</div>
							</form>
						    </td>
					    </tr>
				    <?php 
					    } 
				    ?>
			    </table>
		</div>
			<br /><a href="show-cart.php" title="go to Product"><strong><h4>Go to Cart</h4></strong></a>
		</div>
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
			<script type="text/javascript" src="main.js"></script>
			<script type="text/javascript" src="paymentControl.js"></script>
		</body>
	</html> 