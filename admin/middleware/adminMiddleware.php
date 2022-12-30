<?php 
include('../functions/myfunctions.php');

//0 = user; 1 = admin
if(isset($_SESSION['auth'])) //if user logged in
{
    if($_SESSION['role_as'] != 1) //just in case there will be many roles 
    {
        redirect("../index.php", "You are not authorized to access this page"); //function redirect that we created in myfunctions.php
    }
}
else //if the user not logged in
{
    redirect("../login.php", "Login to continue");
}

?>