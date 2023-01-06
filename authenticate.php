<?php 

if(!isset($_SESSION['auth'])) //if the session is not set, means if the user not logged in then redirect the user to log in 
{
    header('Location: login.php');
    //Used the redirect function of userfunctions.php 
    redirect("login.php", 'Login to continue');
}

?>