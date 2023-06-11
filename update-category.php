<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
<br><br>
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE id = $id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $curr = $row['image_name'];
                $fr = $row['featured'];
                $act = $row['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='error'>No Category Found</div>";
                header("location: " . SITEURL . "admin/manage-category.php");
            }
        } else {
            header("location: " . SITEURL . "admin/manage-category.php");
        }

        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <!-- enctype will allow us to upload file -->
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>

                        <?php
                        if ($curr != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $curr; ?>" width="100px" alt="Rendering...">
                        <?php
                        } else {
                            echo "<div class='error'>Image is not added</div>";
                        }
                        ?>


                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php
                                if ($fr == "Yes") echo "checked";
                                ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php
                                if ($fr == "No") echo "checked";
                                ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php
                                if ($act == "Yes") echo "checked";
                                ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php
                                if ($act == "No") echo "checked";
                                ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="curr_image" value="<?php echo $curr; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" value="Update Category" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $idi = $_POST['id'];
            $titlei = $_POST['title'];
            $curri = $_POST['curr_image'];
            $fri = $_POST['featured'];
            $acti = $_POST['active'];

            // updating image 

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                //check if image is available or not
                if ($image_name != '') {
                    // $upload new image & remove existing one 

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
                        header("location: " . SITEURL . "admin/manage-category.php");
                        // stop the process bcz if image is not uploaded then i don't want to insert anything in my db 
                        die();
                    }


                    //Section---------> Remove the Image if available
                    if ($curri != "") {
                        $remove_path = "../images/category/" . $curri;
                        $remove = unlink($remove_path);
                        if ($remove_path == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Fail to remove Current Image</div>";
                            header("location: " . SITEURL . "admin/manage-category.php");
                            die();
                        }
                    }
                }
                else{
                    $image_name = $curri ;
                }
            }
            
            else{
                $image_name = $curri ;
            }
            $sql2 = "UPDATE tbl_category SET
            title = '$titlei',
            image_name = '$image_name', 
            featured = '$fri',
            active = '$acti'
            WHERE id = $idi
            ";
            $res2 = mysqli_query($conn, $sql2);
            if ($res) {
                $_SESSION['update'] = "<div class='success'>Updated Successfully</div>";
                header("location: " . SITEURL . "admin/manage-category.php");
            } else {
                $_SESSION['update'] = "<div class='error'>Failed</div>";
                header("location: " . SITEURL . "admin/update-category.php");
            }
        }
        ?>



    </div>
</div>

<?php include('partials/footer.php'); ?>