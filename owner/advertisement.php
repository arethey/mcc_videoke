<?php include('header.php'); ?>


<?php
if(isset($_POST["delete"])) {

$id = $_POST['rowid'];
$rent_id = $_POST['rent_id'];

$sql = "DELETE FROM rental WHERE id='$id'";

if ($dbconnection->query($sql) === TRUE) {
  echo "<script>alert('Record Deleted Successfully');</script>";
  mysqli_query($dbconnection, "DELETE FROM book WHERE id='$rent_id'");
} else {
  echo "Error Deleting record: " . $dbconnection->error;
}

    
}
?>


<div class="row">
<div class="col-sm-2">
<?php include('sidebar.php'); ?>
</div>

<div class="col-sm-8 text-white">
<br />
<h3>Your Advertisement List</h3>
<br />
<br />

  <table class="table table-dark table-bordered">
    <thead>
      <tr>
        <th>Title</th>
        <th>Status</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>

      <?php

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
  $no_of_records_per_page = 8;
  $offset = ($pageno-1) * $no_of_records_per_page;

  $total_pages_sql = "SELECT COUNT(*) FROM owner";
  $result_pages = mysqli_query($dbconnection,$total_pages_sql);
  $total_rows = mysqli_fetch_array($result_pages)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);

  $sql = "SELECT * FROM rental where landlord_id='$login_session' LIMIT $offset, $no_of_records_per_page";
  $result = mysqli_query($dbconnection,$sql);
  while($row = $result->fetch_assoc()) {
    $rent_id = $row['rental_id'];
    $status = $row['status'];
?>

      <tr>
        <td><?php echo $row['title']; ?></td>
        <td>
          <?php 
            if ($status == '') {
              echo "Pending";
            } else {
              echo "Approved";
            }
          ?>
        </td>
        <td><a href="../view.php?ad_id=<?php echo $rent_id; ?>" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
        <td class="col-md-1"><a href="edit.php?bh_id=<?php echo $rent_id; ?>" class="btn btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
        <td>
          <form action="" method="POST">
              <input type="hidden" name="rowid" value="<?php echo $row['id']; ?>">
              <input type="hidden" name="rent_id" value="<?php echo $rent_id; ?>">
              <button type="submit" name="delete" id="<?php echo $rent_id; ?>" class="btn btn-danger delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </form>
        </td>
      </tr>

<?php } ?>

    </tbody>
  </table>
<ul class="pagination">
        <li><a href="?pageno=1"><i class="fa fa-fast-backward" aria-hidden="true"></i> First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last <i class="fa fa-fast-forward" aria-hidden="true"></i></a></li>
    </ul>

</div>
</div>

<?php include('footer.php'); ?>