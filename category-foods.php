<?php include("partial_front/menu.php") ?>

<?php
if (isset($_GET['category_id'])) {
    $id = $_GET['category_id'];
    $sql = "SELECT title FROM tbl_category where id = $id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $title = $row['title'];
} else {
    header("location:" . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white"><?php echo $title; ?></a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        $sql2 = "SELECT * FROM tbl_food where category_id = $id";
        $res2 = mysqli_query($conn, $sql2);
        $cnt = mysqli_num_rows($res2);
        if ($cnt > 0) {
            while ($rows = mysqli_fetch_assoc($res2)) {
                $title = $rows['title'];
                $price = $rows['price'];
                $des = $rows['decription'];
                $image_name = $rows['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image Not Available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?> " alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php

                        }
                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $des; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php

            }
        } else {
            echo "<div class='error'>Food Not Found!!</div>";
        }
        ?>

       


        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("partial_front/footer.php") ?>