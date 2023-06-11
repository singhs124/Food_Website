<?php include("partial_front/menu.php") ?>

<?php
if(isset($_GET['food_id'])){
    $id = $_GET['food_id'] ;
    $sql = "SELECT * from tbl_food where id = $id";
    $res = mysqli_query($conn,$sql) ;
    $count = mysqli_num_rows($res);
    if($count>0){
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'] ;
    }
    else{
        header("location".SITEURL);
    }
}
else{
    header("location:".SITEURL);
}
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if($image_name == ""){
                            echo "<div class = 'error'>Image Not Available</div>";
                        }
                        else{
                            ?>
                            <img src="<?php echo SITEURL?>images/Food/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="food-price"><?php echo $price?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            if(isset($_POST['submit'])){
                $qty = $_POST['qty'] ;
                $name = $_POST['full-name'] ;
                $phone = $_POST['contact'] ;
                $email = $_POST['email'];
                $add = $_POST['address'];
                $food = $_POST['food'];
                $amt = $_POST['price'] ;
                $tot = $qty*$amt ;
                $order_date = date("y-m-d h:i:sa");
                $status = "Ordered" ; //or Delivered or Cancel

                $sql2 = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address)
         VALUES ('$food', '$amt', '$qty', '$tot', '$order_date', '$status', '$name', '$phone', '$email', '$add')";

                $res2 = mysqli_query($conn,$sql2);
                if($res2){
                    $_SESSION['order'] = "<div class = 'success text-center'>Food Ordered SuccessFully!</div>";
                    header("location:".SITEURL) ;
                }
                else{
                    // echo mysqli_error($conn) ;
                    $_SESSION['order'] = "<div class = 'error text-center'>Order Failed! Try Again</div>";
                    header("location:".SITEURL) ;
                }
                  
            }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include("partial_front/footer.php") ?>