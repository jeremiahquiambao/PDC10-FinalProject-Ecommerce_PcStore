<?php 

session_start(); //to use session in redirecting message 
include('../config/dbcon.php');

//To check if user is log in
if(isset($_SESSION['auth']))
{
    //If the user tries to access this handlecart.php from the url which he's not login, that the $scope is not set, this might throw an error. Only when the scope is set then that's the only time that we proceed to switch. Incase the user changes the product_id through inspect element in the browser, it will give exception - something went wrong message
    if(isset($_POST['scope']))
    {
        //scope will be found in ajax of custom.js
        $scope = $_POST['scope'];
        switch ($scope) 
        {
            // Add Product in the Cart
            case "add": //Will be found at .addToCartBtn ajax scope in custom.js
                //prod_id, prod_qty will be found on data of ajax scope add 
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                $user_id = $_SESSION['auth_user']['user_id']; //for authentication of user 

                //This will check if product already existing in cart to avoid duplicates and also making sure that only authenticated user can access the cart 
                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                //echo messages will be found on ajax success: function (response) in custom.js
                if(mysqli_num_rows($chk_existing_cart_run) > 0) //if the product already existing in the cart, it will echo existing
                {
                    echo "existing";
                }
                else //if there's no existing same product in the cart, then it will be added to cart and to database
                {
                    $insert_query = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES ('$user_id','$prod_id','$prod_qty')";
                    $insert_query_run = mysqli_query($con, $insert_query); //mysqli_query function is used to execute SQL queries. $con comes from dbcon.php

                    if($insert_query_run)
                    {
                        echo 201; //status is ok and new record has been created 
                    }
                    else 
                    {
                        echo 500; //something went wrong message
                    }
                }

                break;

            //Update Product Quantity in Cart 
            case "update": //Will be found at .updateQty ajax scope in custom.js 
                //prod_id, prod_qty will be found on data of ajax scope update
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                $user_id = $_SESSION['auth_user']['user_id']; //for authentication of user 

                //This will check if product already existing in cart to avoid duplicates
                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                //echo messages will be found on custom.js
                if(mysqli_num_rows($chk_existing_cart_run) > 0) //if the product is in the user's cart, then product quantity can be updated 
                {       
                    //Making sure that only authenticated user can update the product quantity in the cart 
                    $update_query = "UPDATE carts SET prod_qty='$prod_qty' WHERE prod_id='$prod_id' AND user_id='$user_id' "; 
                    $update_query_run = mysqli_query($con, $update_query);

                    //echo messages will be found on ajax success: function (response) in custom.js
                    if($update_query_run){
                        echo 200;
                    }else{
                        echo 500;
                    }
                }
                else //if there's no existing same product in the cart
                {
                    echo "Something went wrong";
                } 
                
                break;

            case "delete": 
                $cart_id = $_POST['cart_id'];
                

                $user_id = $_SESSION['auth_user']['user_id']; //for authentication of user, to make sure that the cart belongs to login user itself  

                //This will check if product existing in cart, if true delete else something went wrong 
                $chk_existing_cart = "SELECT * FROM carts WHERE id='$cart_id' AND user_id='$user_id' ";
                $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

                //echo messages will be found on custom.js
                if(mysqli_num_rows($chk_existing_cart_run) > 0) //if the product is in the user's cart, then we'll delete the record 
                {       
                    //Making sure that only authenticated user can delete the product in the cart 
                    $delete_query = "DELETE FROM carts WHERE id='$cart_id' "; 
                    $delete_query_run = mysqli_query($con, $delete_query);

                    //echo messages will be found on ajax success: function (response) in custom.js
                    if($delete_query_run){
                        echo 200;
                    }else{
                        echo "Something went wrong";
                    }
                }
                else //if there's no existing product in the cart
                {
                    echo "Something went wrong";
                } 

                break;
            default:
                echo 500; //something went wrong message
        }
    }
}
else 
{
    echo 401; //login to continue message
}
