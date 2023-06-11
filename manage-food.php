<?php include('partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1 class="margin-bottom">Manage Food</h1>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    if (isset($_SESSION['remove'])) {
      echo $_SESSION['remove'];
      unset($_SESSION['remove']);
    }
    if (isset($_SESSION['del'])) {
      echo $_SESSION['del'];
      unset($_SESSION['del']);
    }
    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    ?>
    <br><br>
    <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
    <table class="tbl-full">
      <tr>
        <th>Sr.No</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
      <?php
      $sql = "SELECT * FROM tbl_food";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      if ($count > 0) {
        $n=1;
        while ($row = mysqli_fetch_assoc($res)) {
          $id = $row['id'] ;
          $title = $row['title'];
          $des = $row['decription'];
          $price = $row['price'];
          $image_name = $row['image_name'];
          $category = $row['category_id'];
          $fr = $row['featured'];
          $act = $row['active'];
      ?>
          <tr class="set-margin">
            <td><?php echo $n++; ?></td>
            <td><?php echo $title; ?></td>
            <td><?php echo "$ ".$price; ?></td>
            <td>
              <?php
              if ($image_name != '') {
              ?>
                <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" width="100px" alt="Rendering...">
              <?php

              } else {
                echo "<div class='error'>Image not Added</div>";
              }
              ?>
            </td>
            <td><?php echo $fr; ?></td>
            <td><?php echo $act; ?></td>
            <td>
              <a href="<?php echo SITEURL?>admin/update-food.php?id=<?php echo $id?>&&image_name=<?php echo $image_name?>" class="btn-secondary">Update Food</a>
              <a href="<?php echo SITEURL?>admin/delete-food.php?id=<?php echo $id?>&&image_name=<?php echo $image_name?>" class="btn-danger">Delete Food</a>
            </td>
          </tr>
      <?php
        }
      }
      ?>
    </table>
  </div>
</div>
<?php include('partials/footer.php') ?>