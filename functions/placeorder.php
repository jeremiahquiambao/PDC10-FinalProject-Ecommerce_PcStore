<?php 

session_start(); //to use session in redirecting message
include('../config/dbcon.php');

//To check if user is log in
if(isset($_SESSION['auth']))
{

    if(isset($_POST['placeOrderBtn']))
    {
        //used mysqli_real_escape_string to prevent sql injection 
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

        //Redirect the user to checkout page if the value is null for any of these
        if($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == "")
        {
            $_SESSION['message'] = "Please complete all fields"; 
            header('Location: ../checkout.php');
            exit(0);
        }

        $userId = $_SESSION['auth_user']['user_id']; //To make sure that it's also authenticated user 
        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price 
                FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC ";
        $query_run = mysqli_query($con, $query); //we pass the connection which is the $con and the query which is the $query

        $totalPrice = 0;
        foreach ($query_run as $c_item)
        {
            $totalPrice += $c_item['selling_price'] * $c_item['prod_qty'];
        }
        // echo $totalPrice; //Testing purposes

        $tracking_no = "techno".rand(1111, 9999).substr($phone, 2); //random number from 1111 to 9999
        $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, pincode, total_price, payment_mode, payment_id) VALUES ('$tracking_no', '$userId', '$name','$email', '$phone', '$address', '$pincode', '$totalPrice', '$payment_mode', '$payment_id') ";
        $insert_query_run = mysqli_query($con, $insert_query);

        if($insert_query_run)
        {
            $order_id = mysqli_insert_id($con); //this will give the last inserted id.  We're going to use this to insert order items   
            
            foreach ($query_run as $c_item)
            {
                $prod_id = $c_item['prod_id'];
                $prod_qty = $c_item['prod_qty'];
                $price = $c_item['selling_price'];

                //insert the id in order items table. We're getting the prod_id from the cart
                $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price) VALUES('$order_id', '$prod_id', '$prod_qty', '$price')"; 
                $insert_items_query_run = mysqli_query($con, $insert_items_query);

                //we'll decrease the product quantity when buy product
                $product_query = "SELECT * FROM products WHERE id='$prod_id' LIMIT 1 "; //query for 1 product
                $product_query_run = mysqli_query($con, $product_query);

                $productData = mysqli_fetch_array($product_query_run); //will now get a single record
                $current_qty = $productData['qty'];

                $new_qty = $current_qty - $prod_qty;
                
                //Update qty on database 
                $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id' ";
                $updateQty_query_run = mysqli_query($con, $updateQty_query);
            }

            //Delete cart items after placing the order 
            $deleteCartQuery = "DELETE FROM carts WHERE user_id='$userId' ";
            $deleteCartQuery_run = mysqli_query($con, $deleteCartQuery);

            //Once order is place, we're going to redirect the user to my-orders.php page 
            $_SESSION['message'] = "Order placed successfully";
            header('Location: ../my-orders.php');
            die();
        }
    }
}
else{
    header('Location: ../index.php');
}
?>