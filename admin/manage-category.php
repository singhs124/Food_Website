<?php include('partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1 class="margin-bottom">Manage Category</h1>
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
    if (isset($_SESSION['no-category-found'])) {
      echo $_SESSION['no-category-found'];
      unset($_SESSION['no-category-found']);
    }
    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    if (isset($_SESSION['failed-remove'])) {
      echo $_SESSION['failed-remove'];
      unset($_SESSION['failed-remove']);
    }

    ?>
    <br><br>
    <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
    <table class="tbl-full">
      <tr>
        <th>Sr.No</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>
      <?php
      $sql = "SELECT * FROM tbl_category";
      $res = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($res);
      if ($count > 0) {
        $n = 1;
        while ($row = mysqli_fetch_assoc($res)) {
          $id = $row['id'];
          $title = $row['title'];
          $image_name = $row['image_name'];
          $featured = $row['featured'];
          $active = $row['active'];


      ?>
          <tr class="set-margin">
            <td><?php echo $n++; ?></td>
            <td><?php echo $title; ?></td>

            <td>
              <?php
              if ($image_name != '') {
              ?>
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" alt="Rendering...">
              <?php

              } else {
                echo "<div class='error'>Image not Added</div>";
              }
              ?>
            </td>

            <td><?php echo $featured; ?></td>
            <td><?php echo $active; ?></td>
            <td>
              <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>" class="btn-secondary">Update Category</a>
              <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>" class="btn-danger">Delete Category</a>
            </td>
          </tr>
        <?php
        }
      } else {
        ?>
        <tr>
          <td colspan="6">
            <div class="error">No Category Added</div>
          </td>
        </tr>
      <?php
      }

      ?>
    </table>
  </div>
</div>
<?php
include('partials/footer.php');
?>