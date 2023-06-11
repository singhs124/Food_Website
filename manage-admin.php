<?php include('partials/menu.php') ?>
<div class="main-content">
  <div class="wrapper">
    <h1 class="margin-bottom">Manage Admin</h1>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }
    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    if (isset($_SESSION['user-not-found'])) {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }
    if (isset($_SESSION['not-match'])) {
      echo $_SESSION['not-match'];
      unset($_SESSION['not-match']);
    }
    if (isset($_SESSION['change'])) {
      echo $_SESSION['change'];
      unset($_SESSION['change']);
    }
    ?>
    <br><br>
    <a href="add-admin.php" class="btn-primary">Add Admin</a>
    <table class="tbl-full">
      <tr>
        <th>Sr.No</th>
        <th>Full Name</th>
        <th>UserName</th>
        <th>Actions</th>
      </tr>

      <?php
      $sql = "SELECT* from tbl_admin";
      $res = mysqli_query($conn, $sql);
      if ($res) {
        $count = mysqli_num_rows($res);
        $n = 1;
        if ($count > 0) {
          while ($rows = mysqli_fetch_assoc($res)) {
            $id = $rows['id'];
            $fullname = $rows['full_name'];
            $username = $rows['username'];
            // display message 
      ?>
            <tr class="set-margin">
              <td><?php echo $n++ ;?></td>
              <td><?php echo $fullname ;?></td>
              <td><?php echo $username ;?></td>
              <td>
                <a href="<?php echo SITEURL ;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                <a href="<?php echo SITEURL ;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                <a href="<?php echo SITEURL ;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
              </td>
            </tr>
      <?php

          }
        }
      }
      ?>
    </table>
  </div>
</div>

<?php
include('partials/footer.php')
?>