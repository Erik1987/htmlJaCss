<?php 
echo "Hello";
session_start(); 

if ( ! isset( $_POST['submitted'] ) ) 
header('Location: ' . "./login.php"); 

$credentials = [ 
  'username' => 'alex', 
  'password' => '123' 
]; 

if ( $credentials['username'] !== $_POST['username'] OR $credentials['password'] !== $_POST['password'] ) { 
   header('Location: ' . "./login.php"); 
    exit(); 
} 


// Storing session data 
$_SESSION["isLogged"] = "1"; 

// login successful - redirect user to any page you want // replace 'home.php' with your landing page url 

header('Location:' . './neilikka_bootstrap.php'); 

exit();
?>