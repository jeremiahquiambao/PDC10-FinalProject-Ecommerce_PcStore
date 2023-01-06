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

        echo $totalPrice;
        // $tracking_no = "techno".rand(1111, 9999).substr($phone, 2); //random number from 1111 to 9999
        // $query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, pincode, total_price, payment_mode, payment_id) VALUES ('$tracking_no', '$user_id', '$name','$email', '$address', '$pincode')";
    }
}
else{
    header('Location: ../index.php');
}
?>