<?php

session_start() ;
// create constants to strore non-repeating values 
// define('LOCALHOST' , 'localhost') ;
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'food_order');

define("SITEURL" , "http://localhost/Food_order/") ;
 

// $conn = mysqli_connect('LOCALHOST','DB_USERNAME','DB_PASSWORD') or die(mysqli_error($conn));
// $db_select = mysqli_select_db($conn,'DB_NAME') or die(mysqli_error($conn));


$conn = mysqli_connect('localhost','root','') or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn,'food_order') or die(mysqli_error($conn));
?>