<?php
include('../config/constant.php') ;
// destroy the session & redirect to login page 
session_destroy() ;
header("location: ".SITEURL."admin/login.php");
?>