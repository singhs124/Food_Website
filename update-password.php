<?php include('partials/menu.php') ;
if(isset($_GET['id'])){
    $id = $_GET['id'] ;
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Enter Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="Enter New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Enter Password Again">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
</div>

<?php
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $curr = md5($_POST['current_password']);
    $pass = md5($_POST['new_password']) ;
    $confirm = md5($_POST['confirm_password']);

    //current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$curr'" ;
    $res = mysqli_query($conn,$sql);
    if($res){
        $count = mysqli_num_rows($res);
        if($count == 1){
            // new pass & confirm pass matches 
            if($pass == $confirm){
                $sql2 = "UPDATE tbl_admin SET
                password = '$pass'
                WHERE id = $id";
                $res2 = mysqli_query($conn,$sql2) ;
                if($res2){
                    $_SESSION['change']="<div class='success'>Password Changed Successfully!!</div>" ;
                    header("location:".SITEURL."admin/manage-admin.php");
                }
                else{
                    // echo mysqli_error($conn) ;
                    $_SESSION['change']="<div class='error'>Failed! Try Again</div>" ;
                    header("location:".SITEURL."admin/manage-admin.php"); 
                }
            }
            else{
                $_SESSION['not-match']="<div class='error'>Password Didn't Match!!</div>" ;
                header("location:".SITEURL."admin/manage-admin.php");
            }
        }
        else{
            $_SESSION['user-not-found']="<div class='error'>User Not Found!!</div>" ;
            header("location:".SITEURL."admin/manage-admin.php");
        }
    }
}
?>

<?php include('partials/footer.php') ?>