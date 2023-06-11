<?php include('partials/menu.php') ?>
<?php
if (isset($_SESSION['login'])) {
  echo $_SESSION['login'];
  unset($_SESSION['login']);
}
?>
<div class="main-content">
  <div class="wrapper">
    <h1>Dashboard</h1>
    <div class="col-4 text-center">
      <?php
      $sql = "SELECT * FROM tbl_category";
      $res = mysqli_query($conn,$sql) ;
      $count = mysqli_num_rows($res);
      ?>
      <h1><?php echo $count?></h1>
      Category
    </div>
    <div class="col-4 text-center">
    <?php
      $sql = "SELECT * FROM tbl_food";
      $res = mysqli_query($conn,$sql) ;
      $count = mysqli_num_rows($res);
      ?>
      <h1><?php echo $count?></h1>
      Foods
    </div>
    <div class="col-4 text-center">
    <?php
      $sql = "SELECT * FROM tbl_order";
      $res = mysqli_query($conn,$sql) ;
      $count = mysqli_num_rows($res);
      ?>
      <h1><?php echo $count?></h1>
      Active Orders
    </div>
    <div class="col-4 text-center">
      <?php
      $sql = "SELECT SUM(total) AS Total From tbl_order where status='Delivered'";
      $res = mysqli_query($conn,$sql) ;
      $row = mysqli_fetch_assoc($res);
      $tot = $row['Total'];
      ?>
      <h1><?php echo "$".$tot?></h1>
      Estimated Revenue
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<?php include('partials/footer.php') ?>
</body>

</html>