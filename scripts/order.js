$(function() {
    //function to display the total amount for the item (price x quantity)
    let totalPrice = function($qty, $price) {
        return $qty*$price;
    };


    var items = [];

    //function to add new produc to order sumary
    let addOrderSumary = function($qty, $productName, $productPrice){
        // $(".sidebar-main-container table tbody").append('<tr class="order-summary-item"><th class="qty">'+$qty+'x</th><th class="name">'+$productName+'</th><th class="qty">'+$productPrice+'</th></tr>')
        items.push([$qty,$productName,$productPrice]);
        console.log(items);
    };

    let updateOrderSumary = function($qty, $productName, $productPrice){
        // console.log(headerArray);
        for(let i = 0; i < items.length; i++){
            console.log(items[i][1]);
            if(items[i][1] == $productName){
                items[i][0]++; 
            }
        }    
    };

    let deleteOrderSumary = function($qty, $productName, $productPrice){
        for(let i = 0; i < items.length; i++){
            console.log(items[i][1]);
            if(items[i][1] == $productName){
                items[i][0]--;
                if (items[i][0]==0){
                    items.splice($.inArray(items[i],items),1 );
                }
            }
        }
    };

    //displaying items that have been selected to order summary 
    let displayOrderSummary = function(){
        $(".sidebar-main-container table tbody").empty();

        $.each(items, function( index, value ) {
            $(".sidebar-main-container table tbody").append('<tr class="order-summary-item"><th class="qty">'+value[0]+'x</th><th class="name">'+value[1]+'</th><th class="price">R'+value[2]+'</th></tr>')
        });  
        totalOrderSummary();
    };

    let totalOrderSummary = function(){
        let $total = 0;
        $.each(items, function( index, value ) {
            $total += (parseInt(value[2])*value[0]);
        });
        console.log($total);
        $(".sidebar-main-container .order-total .total").empty();
        $(".sidebar-main-container .order-total .total").append("R "+$total+".00");
    };


    //add 1 to quantiy
    $(".add").on('click', function(){
        $(this).prev().val(+$(this).prev().val() + 1);
        //finding the closet class with product item
        //in that div/tr find the area where the total product price is
        //print there
        let $nameProduct = $(this).closest(".product-item").find(".product-title").text();
        let $price = $(this).closest(".product-item").find(".product-price span").text();
        let $qty = $(this).prev().val();
        let $ttlPrice = totalPrice($qty,$price)+".00";
        
        if($qty>1){
            updateOrderSumary($qty, $nameProduct, $price);
        }else if($qty==1){
            addOrderSumary($qty, $nameProduct, $price);
        }
        displayOrderSummary();
        $(this).closest(".product-item").find(".total-product-price span").text("R"+$ttlPrice);
        $(this).closest(".product-item").find(".total-product-price").css('color','green');
    });

    
    //minus 1 to quantiy 
    $('.sub').click(function () {
        if ($(this).next().val() > 0) {
            if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);

            let $nameProduct = $(this).closest(".product-item").find(".product-title").text();
            let $price = $(this).closest(".product-item").find(".product-price span").text();
            let $qty = $(this).next().val();
            let $ttlPrice = totalPrice($qty,$price)+".00";

            deleteOrderSumary($qty,$nameProduct,$price);

            displayOrderSummary();

            $(this).closest(".product-item").find(".total-product-price span").text("R"+$ttlPrice);
            if ($(this).next().val() == 0){
                $(this).closest(".product-item").find(".total-product-price span").text("");
            }
        }
    });

});
