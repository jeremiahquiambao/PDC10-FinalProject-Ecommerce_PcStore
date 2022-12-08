<?php 

session_start(); //always add this if you're going to use session 

include('../config/dbcon.php');

if(isset($_POST['register_btn'])) //when register button clicked 
{
    $fname = mysqli_real_escape_string($con, $_POST['fname']); //we added mysql_real_escape_string function to prevent sql injection, $con variable will be found in config/dbcon.php
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    //Check if email already registered
    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run = mysqli_query($con, $check_email_query);  // paramaters inside are database connection and query 

    if(mysqli_num_rows($check_email_query_run) > 0) // if the email already registered then the $check_email_query will greater than 0
    {
        $_SESSION['message'] = "Email already registered";
        header('Location: ../register.php');
    }
    else // If the email not registered yet then proceed 
    {  
        if($password==$cpassword) //Check if password and confirm password matched
        {
            //Insert user data when password matched
            $insert_query = "INSERT INTO users(firstName, lastName, email, phone, password) VALUES('$fname', '$lname', '$email', '$phone', '$password')";
            $insert_query_run = mysqli_query($con, $insert_query); // paramaters inside are database connection and query 

            //Message alert & redirection if password & confirm password matched
            if($insert_query_run)
            {
                $_SESSION['message'] = "Registered Succesfully"; 
                header('Location: ../login.php'); 
            }
            //Message alert & redirection if pasword & confirm password didn't matched
            else {
                $_SESSION['message'] = "Something went wrong"; 
                header('Location: ../register.php');
            }
        }
        else 
        {
            $_SESSION['message'] = "Passwords not do not match"; //used session to display the message to the user on the register page 
            header('Location: ../register.php'); //give space between location and register.php or else it will error 
        }
    }
}

else if(isset($_POST['login_btn'])) //when login button clicked
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $email = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' "; //checking user details in  database 
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) < 0)
    {
        $_SESSION['auth'] = true;

        $userdata = mysqli_fetch_array($login_query_run); //login_query_run will bring the data and put it in the $userdata variable
        $username = $userdata['firstName']; //from firstName is from database then storing to $username variable
        $useremail = $userdata['email'];
        

        $_SESSION['auth_user'] = [
            'firstName' => $username, //fetch from login_query
            'email' => $useremail
        ];   

        $_SESSION['message'] = "Logged In Successfully";
        header('Location: ../index.php');
    }
    else
    {
        $_SESSION['message'] = "Invalid Credentials";
        header('Location: ../login.php');
    }
}

?>