<?php 
include("../config/constant.php");
?>
<html>
    <head>
        <title>Login- Food Order Page</title>
        <link rel="stylesheet" href="../css/sectionAdmin.css">
        <style>
            .home{
                padding: 5px 20px;
            }
        </style>
    </head>
    <body>
        <div class="login text-center">
            <h1>Login</h1>
            <?php
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'] ;
                unset($_SESSION['no-login-message']) ;
            }
            ?>
            <br><br>
            <form action="" method="post">
                UserName:
                <input type="text" name="username" placeholder="Enter username"> <br><br>
                Password:
                <input type="password" name="password" placeholder="Enter Password"> <br> <br>
                <input type="submit" value="Login" name="submit" class="btn-primary home">
            </form>
            <p>Copyright 2023 Made by Sushant Singh</p>
            <br>
            <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'] ;
                unset($_SESSION['login']) ;
            }
            ?>
        </div>

    </body>
</html>

<?php
if(isset($_POST['submit'])) {
    $user = $_POST['username'] ;
    $pass = md5($_POST['password']) ;

    //exist in db or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$user' AND password='$pass'" ;
    $res = mysqli_query($conn,$sql) ;
    
    $count = mysqli_num_rows($res) ;
    if($count==1){
        $_SESSION['login'] = "<div class='success text-center main-content'>Successfully Logged in</div></div>" ;
        $_SESSION['user'] = $user ; //user is logged in or not & on logout unsets it
        // code for same is added into login-check.php 
        header("location: ".SITEURL."admin" );
    }
    else{
        $_SESSION['login'] = "<div class='error'>UserName & PassWord Doesn't Match. Please Try Again!</div></div>" ;
        header("location: ".SITEURL."admin/login.php");
    }
}
?>