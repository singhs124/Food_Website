<?php
if(!isset($_SESSION['user'])){ //user session not set
    // User is not Logged in 
    $_SESSION['no-login-message'] = "<div class='error'>Please login to Access Admin Panel</div>" ;
    header("location: ".SITEURL."admin/login.php");
}
?>