

function addShipping(){
    shipping = parseFloat($("#shipcost").val());
    if (shipping > -1) {
        prevBalance = parseFloat($("#prevBalance").html());
        totalPur = parseFloat($("#totalPur").html());
        $("#overallCost").html(totalPur + shipping);
        $("#newBalance").html(prevBalance - (totalPur + shipping));
        $("#newBalanceInput").val(prevBalance - (totalPur + shipping));
        }
    }

function submit(){
    shipping = parseFloat($("#shipcost").val());
    prevBalance = parseFloat($("#prevBalance").text());
    overallCost = parseFloat($("#overallCost").text());
   
    if (overallCost > prevBalance){
        alert("Your balance is insufficient to make this purchase");
        }
    else if (shipping == -1) {
        alert("Please select a shipping method");
    }
    else{
        $("#paymentForm").submit();
    }
    }        
    
function rateProduct(rate, product, isRated){
    if(parseInt(isRated) == 0) {alert("Thanks for rating");
        $("#rate-" + product).val(rate);

        $("#form-rate-" + product).submit();
    }
}

function calculateTotal(id, price) {
            $("#total-"+id).html(parseInt($("#quantity-"+id).val()) * price);
            getAllTotal();
}

        function getAllTotal(){
            var sum = 0;
            $(".total").each(function(index, value){ console.log(parseFloat($(this). html()));
                sum += parseFloat($(this). html());
                sumTodec= sum.toFixed(2);

            });
            $('#totalPur').html(sumTodec);

}

        /*function getTotalAfterShipping(){

            var totalPur= parseFloat($("#totalPur").text());
            var shipping = parseInt($("#shipcost").val());
            //alert (totalPur+shipping);
            parseFloat($("#overallCost").html(totalPur+shipping));
            parseFloat($("#newBalance").html(prevBalance - (totalPur + shipping)));

}*/



