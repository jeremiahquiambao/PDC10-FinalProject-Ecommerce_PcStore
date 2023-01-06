<?php 

session_start(); //to use session in redirecting message, since userfunctions.php will be included in the categories.php and other pages 

include('config/dbcon.php');

//Function to fetch categories. Query along with the status that has to be active. All the records which are active in this table
function getAllActive($table) 
{
    global $con; // $con is now defined as global so that this variable will not search inside the function and will understand that the variable is from the outside this function or else it will throw an error that it is undefined even we already include the dbcon.php
    $query = "SELECT * FROM $table WHERE status='0' "; //when status=0 --it will show as active, status=1 --it will not be visible to user
    return $query_run = mysqli_query($con, $query); //$con is the dbcon.php
} 

//Function to get the single row which is active - used in products.php
function getIDActive($table, $id) // When we pass on the table name and id, then we will get the query from the database
{
    global $con; // $con is now defined as global so that this variable will not search inside the function and will understand that the variable is from the outside this function, or else it will throw an error that it is undefined even we already include the dbcon.php
    $query = "SELECT * FROM $table WHERE id = '$id' AND status='0' ";
    return $query_run = mysqli_query($con, $query); //$con is the dbcon.php
}

//Function that will use slug to fetch single record - used in products.php
function getSlugActive($table, $slug) //When we pass on the table name and id, then we will get the query from the database
{
    global $con; // $con is now defined as global so that this variable will not search inside the function and will understand that the variable is from the outside this function, or else it will throw an error that it is undefined even we already include the dbcon.php
    $query = "SELECT * FROM $table WHERE slug = '$slug' AND status='0' LIMIT 1"; //LIMIT 1 because we're only fetching 1 record
    return $query_run = mysqli_query($con, $query); //$con is the dbcon.php
}

function getProdByCategory($category_id)
{
    global $con; // $con is now defined as global so that this variable will not search inside the function and will understand that the variable is from the outside this function, or else it will throw an error that it is undefined even we already include the dbcon.php
    $query = "SELECT * FROM products WHERE category_id = '$category_id' AND status='0' ";
    return $query_run = mysqli_query($con, $query); //$con is from the dbcon.php
}

//Function to gell all the items in the cart 
function getCartItems()
{
    global $con;    
    $userId = $_SESSION['auth_user']['user_id']; //To make sure that it's also authenticated user 
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price 
                FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC ";
    return $query_run = mysqli_query($con, $query); //we pass the connection which is the $con and the query which is the $query

}

//Function to fetch myorders page 
function getOrders()
{
    global $con;    
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE user_id='$userId' ORDER BY id DESC";
    return $query_run = mysqli_query($con, $query); 
}

function redirect($url, $message) //function if everytime we want to redirect the user
{ 
    $_SESSION['message'] = $message; 
    header('Location: '.$url);
    exit();

    
    /*
    this is the same as like this, but we made it as function to avoid repeating and static messages:

    $_SESSION['message'] = "Welcome to Dashboard";
    header('Location: ../admin/index.php');
    
    */
}

?>