<?php include('partials/menu.php') ?>

<!-- Main Content  -->
<div class="main-content">
    <div class="wrapper">
        <h1 class="margin-bottom">Add Admin</h1>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Full Name"></td>
                </tr>
                <tr>
                    <td>User Name: </td>
                    <td><input type="text" name="user_name" placeholder="Enter User Name"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary" style="padding: 2%;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php
// process the value from form & save in db 

// check whether the submit button is clicked or not 
if (isset($_POST['submit'])) {
    // echo "Button Clicked" ;

    // get data from Form 
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']); //password encrypted using md5

    //sql query to save data into db
    $sql = "INSERT INTO tbl_admin SET
    full_name = '$full_name',
    username = '$user_name',
    password = '$password'
    ";

    // // execute query & save in db
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // check query exceuted or not 
    if ($res) {
        // session variable to display message 
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        header("location:" . SITEURL . "/admin/manage-admin.php");
    } else {
        $_SESSION['add'] = "<div class='error'>Failed!! Try Again</div>";
        header("location:" . SITEURL . "/admin/add-admin.php");
    }
}

?>