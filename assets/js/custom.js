//product-view.php
$(document).ready(function () {
    
    //Increment Button - max of 10 qty only 
    // $('.increment-btn').click(function (e) { //we need to use jqon instead of jqclick. NOTE: Once page is reloaded - the jqclick will not work, the quantity that you increment or decrement would go back to its original when you place the order once its reloaded  
    $(document).on('click','.increment-btn', function (e) {
        e.preventDefault();
        
        //If you have multiple products in the same page, then if we want to increment this, we'll use the closest function 
        var qty =  $(this).closest('.product_data').find('.input-qty').val(); //fetch the value, if we have multiple products then it will fetch the parent class which is the product_data, then append to the nearest value which is the input-qty

        var value = parseInt(qty, 10); //convert that to integer 
        //if the user change the value by inspecting it in the browser then we're going to check if it's a number then we allow that number else we're going to set it to '0'    
        value = isNaN(value) ? 0 : value; //if value is not a number then assign '0' else assign the value 
        if(value < 10) //we're just allowing max of 10 qty each product 
        {
            value++; //increment the value 
            $(this).closest('.product_data').find('.input-qty').val(value); //will append the value back to its place
        }
    });

    //Decrement Button 
    // $('.decrement-btn').click(function (e) { 
    $(document).on('click','.decrement-btn', function (e) {

        e.preventDefault();
        
        //If you have multiple products in the same page, then if we want to increment this, we'll use the closest function 
        var qty =  $(this).closest('.product_data').find('.input-qty').val(); //fetch the value, if we have multiple products then it will fetch the parent class which is the product_data, then append to the nearest value which is the input-qty //it will get the product quantity

        var value = parseInt(qty, 10); //convert that to integer 
        //if the user change the value by inspecting it in the browser then we're going to check if it's a number then we allow that number else we're going to set it to '0'    
        value = isNaN(value) ? 0 : value; //if value is not a number then assign '0' else assign the value 
        if(value > 1) //we're just allowing max of 10 qty each product 
        {
            value--; //increment the value 
            $(this).closest('.product_data').find('.input-qty').val(value); //will append the value back to its place
        }
    });

    //ADD TO CART USING JQUERY
    // $('.addToCartBtn').click(function (e) { //we've switched jqclick to jqon just in case we'll have multiple cart buttons so that it will not error 
    $(document).on('click','.addToCartBtn', function (e) {

        e.preventDefault();
        
        //When the user click the addToCartBtn then we need to fetch the inputted value 
        var qty =  $(this).closest('.product_data').find('.input-qty').val(); //fetch the value, if we have multiple products then it will fetch the parent class which is the product_data, then append to the nearest value which is the input-qty //it will get the product quantity 
        var prod_id = $(this).val(); //will get the product id  

        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id" : prod_id,
                "prod_qty" : qty,
                "scope" : "add" //will be found as case on handlecart.php 
            },
            success: function (response) {
                if(response == 201)    
                {
                    alertify.success("Product added to cart"); 
                }
                else if(response == "existing")    
                {
                    alertify.success("Product already in cart"); 
                }   
                else if(response == 401)    
                {
                    alertify.success("Login to continue"); 
                }
                else if(response == 500)    
                {
                    alertify.success("Something went wrong"); 
                }
            }
        });
    });

    //UPDATING THE QUANTITY OF ITEMS IN cart.php 
    $(document).on('click','.updateQty', function () { //we need to use jqon instead of jqclick. NOTE: Once page is reloaded - the jqclick will not work, the quantity that you increment or decrement would go back to its original when you place the order once its reloaded 
        //Fetch the product id and product quantity  as we had did for the .addToCartBtn 
        var qty =  $(this).closest('.product_data').find('.input-qty').val(); //fetch the value, if we have multiple products then it will fetch the parent class which is the product_data, then append to the nearest value which is the input-qty //it will get the product quantity 
        var prod_id =  $(this).closest('.product_data').find('.prodId').val(); //will find the product id 

        //AJAX that will Update the database when updating the quantity 
        $.ajax({
            method: "POST",
            url: "functions/handlecart.php",
            data: {
                "prod_id" : prod_id,
                "prod_qty" : qty,
                "scope" : "update" 
            },
            success: function (response) {
                // alert(response); //testing purposes 
            }
        });
    });
    
    $(document).on('click','.deleteItem', function () {
        var cart_id = $(this).val();
        // alert(cart_id);
         
        $.ajax({
            method: "POST", 
            url: "functions/handlecart.php",
            data: {
                "cart_id" : cart_id,
                "scope" : "delete" //will be found on handlecart.php
            },
            success: function (response) {
                // alert(response); //testing purposes 
                if(response == 200)    
                {
                    alertify.success("Item deleted successfully"); 
                    $('#mycart').load(location.href + " #mycart"); //to automatically refresh when deleting an item, #mycart should have space after double quote 
                }
                else 
                {
                    alertify.success(response); 
                }
            }
        });
    });

});