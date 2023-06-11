<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- enctype will allow us to upload file -->
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Food Title">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="desc" cols="30" rows="5" placeholder="Tell Something About it"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="Enter Price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='YES'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $category_name = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $category_name ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            ?>
                        </select>
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
                        <input type="submit" value="Add Food" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php

        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            if (isset($_POST['featured'])) {
                $fr = $_POST['featured'];
            } else $fr = "No";
            if (isset($_POST['active'])) {
                $act = $_POST['active'];
            } else $act = "No";

            // 1. Check if select image is clicked 
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    $ext = end(explode('.', $image_name));
                    $image_name = "Food_Name_" . rand(999, 1999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/Food/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        header("location: " . SITEURL . "admin/add-food.php");
                        // stop the process bcz if image is not uploaded then i don't want to insert anything in my db 
                        die();
                    }
                }
            } else $image_name = "";

            $sql2 = "INSERT INTO tbl_food SET
            title = '$title',
            decription = '$desc',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$fr' ,
            active = '$act'
            ";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2) {
                $_SESSION['add'] = "<div class='success'>Done</div>";
                header("location: " . SITEURL . "admin/manage-food.php");
            } else {
                $_SESSION['add'] = mysqli_error($conn)."<div class='error'> Fail</div>";
                header("location: " . SITEURL . "admin/manage-food.php");
            }
        }

        ?>
    </div>
</div>


<?php
include('partials/footer.php');
?>