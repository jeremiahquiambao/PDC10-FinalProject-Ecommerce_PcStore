<?php 

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "comp_store";

    // Creating database connection
    $con = mysqli_connect($host, $username, $password, $database);

    // Check database connection 
    if(!$con)
    {
        die("Connection Failed: ".mysqli_connect_error());
    } 
    // else 
    // {
    //     echo "Connected Succesfully!";  
    // }


?>