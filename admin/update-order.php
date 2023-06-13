<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="margin-bottom">Update Order</h1>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * from tbl_order Where id = $id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $qty = $row['qty'];
                $name = $row['customer_name'];
                $phone = $row['customer_contact'];
                $email = $row['customer_email'];
                $add = $row['customer_address'];
                $food = $row['food'];
                $amt = $row['price'];
                $tot = $row['total'];
                $status = $row['status'];
                $order_date = $row['order_date'];
            }
        } else {
            header("location:" . SITEURL . "admin/manager-order.php");
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name: </td>
                    <td>
                        <b><?php echo $food; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <b><?php echo "$ " . $amt; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Quantity: </td>
                    <td><input type="text" name="qty" value="<?php echo $qty;
                                                                ?>"></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Ordered") echo "selected"; ?> value="ordered">Ordered</option>
                            <option <?php if ($status == "On Delivery") echo "selected"; ?> value="On Delivery">On Shipping</option>
                            <option <?php if ($status == "delivered") echo "selected"; ?> value="Delivered">Delivered</option>
                            <option <?php if ($status == "cancel") echo "selected"; ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td><input type="text" name="customer_name" value="<?php echo $name;
                                                                        ?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact: </td>
                    <td><input type="text" name="customer_contact" value="<?php echo $phone;
                                                                            ?>"></td>
                </tr>
                <tr>
                    <td>Customer Mail: </td>
                    <td><input type="text" name="customer_mail" value="<?php echo $email;
                                                                        ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address: </td>
                    <td> <textarea name="customer_address" cols="30" rows="10"><?php echo $add;
                                                                                ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $amt; ?>">
                        <input type="submit" name="submit" value="Update Details" class="btn-primary" style="padding: 2%;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    // get all values from form to update 
    $id = $_POST['id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $tot = $qty * $price;
    $status = $_POST['status'];
    $name = $_POST['customer_name'];
    $phone = $_POST['customer_contact'];
    $email = $_POST['customer_mail'];
    $add = $_POST['customer_address'];

    $sql2 = "UPDATE tbl_order SET
        qty = $qty,
        customer_name = '$name',
        customer_contact = $phone,
        customer_email = '$email',
        customer_address = '$add',
        total = $tot,
        status = '$status' 
        where id = $id;
    ";

    $res2 = mysqli_query($conn, $sql2);
    if ($res2) {
        $_SESSION['update'] = "<div class='success'>Updated Successfully!</div>";
        header("location:" . SITEURL . "admin/manage-order.php");
    } else {
        echo mysqli_error($conn);
        // $_SESSION['update'] = "<div class='error'>Not Updated!</div>";
        // header("location:" . SITEURL . "admin/manage-order.php");
    }
}
?>

<?php include("partials/footer.php"); ?>