<?php
include('partials/menu.php');
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * from tbl_food WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $title = $row['title'];
        $des = $row['decription'];
        $price = $row['price'];
        $image_name = $row['image_name'];
        $curr_category = $row['category_id'];
        $fr = $row['featured'];
        $act = $row['active'];
    } else {
        $_SESSION['no-food-found'] = "<div class='error'>No Food Found</div>";
        header("location: " . SITEURL . "admin/manage-food.php");
    }
} else {
    header("location: " . SITEURL . "admin/manage-food.php");
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- enctype will allow us to upload file -->
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="desc" cols="30" rows="5" ><?php echo $des ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price ?>">
                    </td>
                </tr>
                <tr>
                    <td>Curr Image: </td>
                    <td>
                    <?php
                        if ($image_name != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" width="100px">
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
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='YES'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id2 = $row['id'];
                                    $category_name = $row['title'];
                            ?>
                                    <option <?php 
                                    if($curr_category == $id2)echo "selected" ;?> 
                                    value="<?php echo $id2; ?>"><?php echo $category_name ?></option>
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
                                ?>type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ;?>">
                        <input type="hidden" name="curr" value="<?php echo $image_name ;?>">
                        <input type="submit" value="Update Food" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['submit'])){
            $id = $_POST['id'] ;
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $price = $_POST['price'];
            $curr = $_POST['curr'] ;
            $category = $_POST['category'];

            if (isset($_POST['featured'])) {
                $fr = $_POST['featured'];
            } else $fr = "No";
            if (isset($_POST['active'])) {
                $act = $_POST['active'];
            } else $act = "No";
            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'] ;
                if($image_name != ''){
                    $ext = end(explode('.' , $image_name)) ;
                    $image_name = "Food_Name_" . rand(999, 1999) . '.' . $ext;
                    $source = $_FILES['image']['tmp_name'] ;
                    $dest = "../images/Food/".$image_name;
                    $upload = move_uploaded_file($source,$dest) ;
                    if ($upload == false) {
                        echo mysqli_error($conn) ;
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image! Try Again</div>";
                        header("location: " . SITEURL . "admin/manage-food.php");
                        // stop the process bcz if image is not uploaded then i don't want to insert anything in my db 
                        die();
                    }

                    if($curr != ""){
                        $remove_path = "../images/Food/".$curr;
                        $remove = unlink($remove_path);
                        if ($remove_path == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Fail to remove Current Image</div>";
                            header("location: " . SITEURL . "admin/manage-food.php");
                            die();
                        }
                    }
                }
                else{
                    $image_name = $curr ;
                }

                
            }
            else{
                $image_name = $curr ;
            }

            $sql3 = "UPDATE tbl_food SET
            title = '$title',
            decription = '$desc',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$fr' ,
            active = '$act'
            WHERE id=$id";
            $res3 = mysqli_query($conn, $sql3);
            if ($res3) {
                $_SESSION['update'] = "<div class='success'>Updated Successfully</div>";
                header("location: " . SITEURL . "admin/manage-food.php");
            } else {
                $_SESSION['update'] = "<div class='error'>Failed</div>";
                header("location: " . SITEURL . "admin/update-food.php");
            }
        }
        ?>
    </div>
</div>


<?php
include('partials/footer.php');
?>