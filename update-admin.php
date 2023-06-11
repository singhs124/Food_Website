<?php
include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="margin-bottom">Update Admin</h1>
        <?php
        // 1. Get id 
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_admin WHERE id = $id" ;
        $res = mysqli_query($conn,$sql) ;
        if($res){
            $count = mysqli_num_rows($res) ;
            if($count==1){
                $row = mysqli_fetch_assoc($res) ;
                $id = $row['id'] ;
                $fullname = $row['full_name'] ;
                $username = $row['username'];
            }
            else{
                header("location:".SITEURL."admin/manage-admin.php") ;
            }
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $fullname;?>"></td>
                </tr>
                <tr>
                    <td>User Name: </td>
                    <td><input type="text" name="user_name" value="<?php echo $username;?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Details" class="btn-primary" style="padding: 2%;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
    // get all values from form to update 
    $id = $_POST['id'];
    $fullname = $_POST['full_name'];
    $username = $_POST['user_name'];
    echo $id. ",". $fullname.",". $username;
    $sql = "UPDATE tbl_admin SET
    full_name = '$fullname',
    username = '$username' WHERE id = $id
    ";

    $res = mysqli_query($conn,$sql) ;
    if($res){
        $_SESSION['update'] = "<div class='success'>Updated Successfully!</div>";
        header("location:".SITEURL."admin/manage-admin.php") ;
    }
    else{
        $_SESSION['update'] = "<div class='error'> Not Updated!</div>" ;
        header("location:".SITEURL."admin/manage-admin.php") ;
    }
}
?>
<?php
include('partials/footer.php');
?>