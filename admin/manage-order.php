<?php include('partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1 class="margin-bottom">Manage Order</h1>
    <?php
    if(isset($_SESSION['update'])){
      echo $_SESSION['update'] ;
      unset($_SESSION['update']) ;
    }
    ?>
    <br><br>
    <table class="tbl-full">
      <tr>
        <th>Sr.No</th>
        <th>Food</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Date&Time</th>
        <th>Status</th>
        <th>Name</th>
        <th>Contact</th>
        <th>Mail</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>
      <?php
      $sql = "SELECT * from tbl_order ORDER BY id DESC" ;
      $res = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($res) ;
      if($count>0){
        $n = 1;
        while($row = mysqli_fetch_assoc($res)){
          $qty = $row['qty'] ;
          $name = $row['customer_name'] ;
          $phone = $row['customer_contact'] ;
          $email = $row['customer_email'];
          $add = $row['customer_address'];
          $food = $row['food'];
          $amt = $row['price'] ;
          $tot = $row['total'] ;
          $status = $row['status'];
          $order_date = $row['order_date'];
          $id = $row['id'] ;

          ?>
          <tr class="set-margin">
        <td><?php echo $n++?></td>
        <td><?php echo $food?></td>
        <td><?php echo $amt?></td>
        <td><?php echo $qty?></td>
        <td><?php echo $tot?></td>
        <td><?php echo $order_date?></td>
        <td><?php echo $status?></td>
        <td><?php echo $name?></td>
        <td><?php echo $phone?></td>
        <td><?php echo $email?></td>
        <td><?php echo $add?></td>
        <td>
          <a href="<?php echo SITEURL?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
        </td>
      </tr>
          <?php


        }
      }
      else{
        echo "<div class='error'>Nothing to Show</div>";
      }
      ?>
      
    </table>
  </div>
</div>
<?php include('partials/footer.php') ?>