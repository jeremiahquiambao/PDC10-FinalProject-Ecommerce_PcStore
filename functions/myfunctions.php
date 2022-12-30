<?php 

include('../config/dbcon.php');

function getAll($table) //function to fetch data from database 
{
    global $con; // $con is now defined as global so that this variable will not search inside the function and will understand that the variable is from the outside this function or else it will throw an error that it is undefined even we already include the dbcon.php
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query); //$con is the dbcon.php
}

//Function to fetch ID from database when editing the category, products
function getByID($table, $id) //When we pass on the table name and id, then we will get the query from the database
{
    global $con; // $con is now defined as global so that this variable will not search inside the function and will understand that the variable is from the outside this function, or else it will throw an error that it is undefined even we already include the dbcon.php
    $query = "SELECT * FROM $table WHERE id = '$id' ";
    return $query_run = mysqli_query($con, $query); //$con is the dbcon.php
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