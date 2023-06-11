<?php
include("../config/constant.php");

if (isset($_GET['id']) and isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    if ($id != '') {
        // if image is available then remove it 
        if ($image_name != "") {
            $path = "../images/category/" . $image_name;
            // remove image 
            $remove = unlink($path);
            if ($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Fail to Delete! Try Again</div>";
                header("location: " . SITEURL . "admin/manage-category.php");
                die();
            }
        }
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $_SESSION['del'] = "<div class='success'>Deleted</div>";
            header("location: " . SITEURL . "admin/manage-category.php");
        } else {
            $_SESSION['del'] = "<div class='error'>Failed</div>";
            header("location: " . SITEURL . "admin/manage-category.php");
        }
    } else {
        header("location: " . SITEURL . "admin/manage-category.php");
    }
} else {
    header("location: " . SITEURL . "admin/manage-category.php");
}
