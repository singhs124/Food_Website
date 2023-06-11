<?php
include("../config/constant.php") ;

if(isset($_GET['id']) and isset($_GET['image_name'])){
    $id = $_GET['id'];
    $image_name = $_GET['image_name'] ;
    if($image_name !=""){
        $path="../images/Food/".$image_name ;
        $remove = unlink($path) ;
        if($remove == false){
            $_SESSION['remove'] = "<div class='error'>Fail to Delete! Try Again</div>";
            header("location: " . SITEURL . "admin/manage-food.php");
            die();
        }
    }
    $sql = "DELETE FROM tbl_food WHERE id=$id" ;
    $res = mysqli_query($conn,$sql) ;
    if($res){
        $_SESSION['del'] = "<div class='success'>Deleted</div>";
        header("location: " . SITEURL . "admin/manage-food.php");
    }
    else{
        $_SESSION['del'] = mysqli_error($conn)."<div class='error'> Operation Failed!</div>";
        header("location: " . SITEURL . "admin/manage-food.php");
    }
}
else{
    header("location: " . SITEURL . "admin/manage-food.php");
}

?>