<?php
include('../config/constant.php') ;
// 1. get the id 
$id = $_GET['id'] ;
// 2. sql query to delete
$sql = "DELETE FROM tbl_admin WHERE id = $id" ;
$res = mysqli_query($conn , $sql) ;
if($res){
    $_SESSION['delete'] = "<div class='success'>Admin Deleted</div>";
    header("location:".SITEURL."admin/manage-admin.php") ;
}
else {
    $_SESSION['delete'] = "<div class='error'>Admin Deletion Unsucessful</div>";
    header("location:".SITEURL."admin/manage-admin.php") ;
}
// 3. redirect to manage admin page with sucess & unsucess ;
?>