<?php include('header.php'); ?>


<?php
if(isset($_POST["delete"])) {

$id = $_POST['rowid'];


$sql = "DELETE FROM rental WHERE id='$id'";

if ($dbconnection->query($sql) === TRUE) {
  echo "<script>alert('Record Deleted Successfully');</script>";
} else {
  echo "Error Deleting record: " . $dbconnection->error;
}

    
}
?>



<?php 
$sql_fee = "SELECT * FROM admin";
  $result_fee = mysqli_query($dbconnection,$sql_fee);
  while($row_fee = $result_fee->fetch_assoc()) {
    $fee = $row_fee['admin_fee'];
  }

 ?>


<?php
if(isset($_POST["approve"])) {

$id = $_POST['rowid'];
$date = date('Y-m-d');


$sql_book = "UPDATE rental SET status='Approved', fee='$fee', date='$date' WHERE id='$id'";


if ($dbconnection->query($sql_book) === TRUE) {
    echo '<script type="text/javascript">alert("Successfully Approved");</script>';
} else {
  echo '<script type="text/javascript">alert("Error database.");</script>';
}
    
}
?>




<div class="row">
<div class="col-sm-2">
<?php include('sidebar.php'); ?>
</div>

<div class="col-sm-8">
<br />
<h3>Advertisement</h3>
<br />
<br />
<br />


  <table class="table table-striped">
    <thead>
      <tr>
        <th>Advertisement ID</th>
        <th>Owner</th>
        <th>Reference No.</th>
        <th>Screenshot</th>
        <th>View</th>
        <th>Delete</th>
        <th>Approve</th>
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

  $total_pages_sql = "SELECT COUNT(*) FROM rental";
  $result_pages = mysqli_query($dbconnection,$total_pages_sql);
  $total_rows = mysqli_fetch_array($result_pages)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);

  $sql = "SELECT * FROM rental ORDER BY id DESC LIMIT $offset, $no_of_records_per_page ";
  $result = mysqli_query($dbconnection,$sql);
  while($row = $result->fetch_assoc()) {
    $rent_id = $row['rental_id'];
    $landlord_id = $row['landlord_id'];
    $status = $row['status'];
?>

      <tr>
        <td><?php echo $row['rental_id']; ?></td>
        <td>
<?php   $sql_ll = "SELECT * FROM owner WHERE id='$landlord_id'";
  $result_ll = mysqli_query($dbconnection,$sql_ll);

  while($row_ll = $result_ll->fetch_assoc()) {
    echo $row_ll['name'];

} ?>
          
        </td>
        <td><?php echo $row['ref']; ?></td>
        <td><a href="../uploads/<?php echo $row['shot']; ?>"><img width="50" src="../uploads/<?php echo $row['shot']; ?>" /></a></td>
        <td class="col-md-1"><a href="view.php?ad_id=<?php echo $rent_id; ?>" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
        <td class="col-md-1">
          <form action="" method="POST">
              <input type="hidden" name="rowid" value="<?php echo $row['id']; ?>">
              <button type="submit" name="delete" id="<?php echo $rent_id; ?>" class="btn btn-danger delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </form>
          
        </td>
        <td>
          <?php if ($status == '') { ?>
            
            <form action="" method="POST">
              <input type="hidden" name="rowid" value="<?php echo $row['id']; ?>">
              <button type="submit" name="approve" class="btn btn-primary"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
            </form>
            
          <?php } else { ?>
            <button class="btn btn-success" disabled><i class="fa fa-check-circle" aria-hidden="true"></i></button>
          <?php } ?>

          
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