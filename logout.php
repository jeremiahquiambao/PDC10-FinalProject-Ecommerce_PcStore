<?php 
session_start();

if(isset($_SESSION['auth'])) //when user is logged in then use unset functions to logout 
{
    unset($_SESSION['auth']); 
    unset($_SESSION['auth_user']); 
    $_SESSION['message'] = "Logged Out Successfully";
}

header('Location: index.php');

?>