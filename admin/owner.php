<?php include('header.php'); ?>



<?php
if(isset($_POST["approve"])) {

$id = $_POST['rowid'];



$sql_book = "UPDATE owner SET status='Approved' WHERE id='$id'";


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
<h3>Owner List</h3>
<br />
<br />
<br />

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Contact Number</th>
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

  $sql = "SELECT * FROM owner LIMIT $offset, $no_of_records_per_page";
  $result = mysqli_query($dbconnection,$sql);

  while($row = $result->fetch_assoc()) {
    $status = $row['status'];
?>

      <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['Address']; ?></td>
        <td><?php echo $row['contact_number']; ?></td>
        
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