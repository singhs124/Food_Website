<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <!-- enctype will allow us to upload file -->
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Category" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            // for radio types we have to check whether the options is selected or not 
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            // checking image is selected or not 
            // print_r($_FILES['image']); 
            // print_r is used bcz $_FILES is an array & echo can't print array 

            if (isset($_FILES['image']['name'])) {
                // if name attribute has some value in array only then we are gonna upload image 
                //TO upload image we need image name, source path, destination path
                $image_name = $_FILES['image']['name'];

                
                // if image name is there only then upload else no 
                if ($image_name != "") {

                    // auto rename image as if i again upload same image with same name then existing one doen't replace but new will be added 

                    // get extensions of our images (jpg,gif,png etc.) 

                    $ext = end(explode('.', $image_name));
                    // it will cut the image name where there is . & end will return last part 

                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    // upload image 
                    $upload = move_uploaded_file($source_path, $destination_path);
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        header("location: " . SITEURL . "admin/add-category.php");
                        // stop the process bcz if image is not uploaded then i don't want to insert anything in my db 
                        die();
                    }
                }
            } else {
                $image_name = "";
            }


            $sql = "INSERT INTO tbl_category SET
            title = '$title' ,
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            ";

            $res = mysqli_query($conn, $sql);
            if ($res) {
                $_SESSION['add'] = "<div class='success'>Successfully Added!</div>";
                header("location:" . SITEURL . "admin/manage-category.php");
            } else {
                $_SESSION['add'] = "<div class='error'>Failed! Try Again</div>";
                header("location:" . SITEURL . "admin/add-category.php");
            }
        }
        ?>



    </div>
</div>

<?php include('partials/footer.php') ?>