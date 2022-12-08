<?php 

function redirect($url, $message) //function everytime we want to redirect the user
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