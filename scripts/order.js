$(function() {
    //function to display the total amount for the item (price x quantity)
    let totalPrice = function($qty, $price) {
        return $qty*$price;
    };

    var items = [];

    //function to add new produc to order sumary
    let addOrderSumary = function($id, $qty, $productName, $productPrice){
        // $(".sidebar-main-container table tbody").append('<tr class="order-summary-item"><th class="qty">'+$qty+'x</th><th class="name">'+$productName+'</th><th class="qty">'+$productPrice+'</th></tr>')
        items.push([$id,$qty,$productName,$productPrice,$productPrice]);
        // console.log(items);
    };

    let updateOrderSumary = function($id, $qty, $productName, $productPrice){
        // console.log(headerArray);
        for(let i = 0; i < items.length; i++){
            // console.log(items[i][1]);
            if(items[i][0] == $id){
                items[i][1]++;
                items[i][4] = items[i][1]*items[i][3]; 
            }
        }    
    };

    let deleteOrderSumary = function($qty, $productName, $productPrice){
        for(let i = 0; i < items.length; i++){
            // console.log(items[i][2]);
            if(items[i][2] == $productName){
                items[i][1]--;
                items[i][4] = items[i][1]*items[i][3]; 
                if (items[i][1]==0){
                    items.splice($.inArray(items[i],items),1 );
                }
            }
        }
    };

    let numItemsOrderSum = 0;

    let setNumItemsInOrder = function(){
        // numItemsOrderSummary
        $(".sidebar-main-container .numItemsOrderSummary").val(numItemsOrderSum);
        // $(".sidebar-main-container .numItemsOrderSummary").append(numItemsOrderSum);
    }
    //displaying items that have been selected to order summary 
    let displayOrderSummary = function(){
        $(".sidebar-main-container table tbody").empty();

        $.each(items, function( index, value ) {
            $(".sidebar-main-container table tbody").append('<tr class="order-summary-item">'
                    +'<td style="display: none;"><input type="text"  name="id_'+index+'" value='+value[0]+'></input></td>'
                    +'<td class="qty"><input style="display: none;" type="text"  name="qty_'+index+'" value='+value[1]+'>'+value[1]+'</input>x</td>'
                    +'<td class="name"><input style="display: none;" type="text"  name="name_'+index+'" value='+value[2]+'>'+value[2]+'</td>'
                    +'<td class="price" style="color: green;"><input style="display: none;" type="text"  name="price_'+index+'" value='+value[4]+'>R'+parseInt(value[4])+'.00</td>'
                +'</tr>')
            numItemsOrderSum = index+1;
        });  
        // console.log(numItemsOrderSum);
        totalOrderSummary();
        setNumItemsInOrder();
    };

    

    let totalOrderSummary = function(){
        let $total = 0;
        $.each(items, function( index, value ) {
            $total += (parseInt(value[3])*value[1]);
        });
        // console.log($total);
        $(".sidebar-main-container .order-total.total").val(0);
        $(".sidebar-main-container .order-total .total").val("R "+$total+".00");
    };

    //add 1 to quantiy
    $(".add").on('click', function(){
        $(this).prev().val(+$(this).prev().val() + 1);
        //finding the closet class with product item
        //in that div/tr find the area where the total product price is
        //print there
        let $id = $(this).closest(".product-item").find(".product-id").text();
        let $nameProduct = $(this).closest(".product-item").find(".product-title").text();
        let $price = $(this).closest(".product-item").find(".product-price span").text();
        let $qty = $(this).prev().val();
        let $ttlPrice = totalPrice($qty,$price)+".00";
        
        if($qty>1){
            updateOrderSumary($id,$qty, $nameProduct, $price);
        }else if($qty==1){
            addOrderSumary($id,$qty, $nameProduct, $price);
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
