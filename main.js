$( document ).ready(function(){
	$("span.addToCart").on("click",function(){
		var id = $(this).attr("data-id");
		$.ajax({
			type: "GET",
			url: "ajax.php?id="+ id +"&action=add"
		})
		.done(function()
		{
			alert ("Product have been added.");
		});
	});
	$("span.removeFromCart").on("click",function(){
		var id = $(this).attr("data-id");
		$.ajax({
			type: "GET",
			url: "ajax.php?id="+id+"&action=remove"
		})
		.done(function()
		{
			$("#product-row-"+id).remove();
			alert("Product have been removed.");
            getAllTotal();
            //getTotalAfterShipping();
            addShipping();
            
		});
	});
	$("a.emptyCart").on("click",function(){
		$.ajax({
			type: "GET",
			url: "ajax.php?action=empty"
		})
		.done(function()
		{
			alert("Cart been emptied.");
			location.reload();
		});
	});

});