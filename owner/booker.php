<?php include('header.php'); ?>



<?php
if(isset($_POST["approve"])) {

$id = $_POST['rowid'];
$rental_id = $_POST['rental_id'];
// $email = $_POST['email'];


$sql_book = "UPDATE book SET status='Approved', reserve='yes' WHERE id='$id'";


if ($dbconnection->query($sql_book) === TRUE) {
  
  mysqli_query($dbconnection, "UPDATE rental SET reserve = 'yes' WHERE rental_id = '$rental_id'");

  if(isset($_POST['email']) && !empty($_POST['email'])){
    $to_email = $_POST['email'];
    $subject = "Confirmed Booking";
    $body = "Awesome! Your booking has been confirmed.";
    $headers = "From: sender email";
    
    if (mail($to_email, $subject, $body, $headers)) {
        // echo "Email successfully sent to $to_email...";
        echo '<script type="text/javascript">alert("Successfully Reserved");</script>';
    } else {
        echo "Email sending failed...";
    }
  }else{
    echo '<script type="text/javascript">alert("Successfully Reserved");</script>';
  }

  

} else {
  echo '<script type="text/javascript">alert("Error database.");</script>';
}
    
}
?>


<?php
if(isset($_POST["unreserve"])) {

$id = $_POST['rowid'];
$rental_id = $_POST['rental_id'];


$sql_book = "UPDATE book SET status='', reserve='' WHERE id='$id'";
if ($dbconnection->query($sql_book) === TRUE) {
  mysqli_query($dbconnection, "UPDATE rental SET reserve='' WHERE rental_id = '$rental_id'");
  mysqli_query($dbconnection, "UPDATE book SET finish='yes' WHERE id='$id'");
  // mysqli_query($dbconnection, "DELETE FROM book WHERE id='$id'");
    echo '<script type="text/javascript">alert("Successfully Mark as Available");</script>';
    // echo '<script type="text/javascript">alert("Book has been end and deleted");</script>';
} else {
  echo '<script type="text/javascript">alert("Error database.");</script>';
}
    
}
?>



<div class="row">
<div class="col-sm-2">
<?php include('sidebar.php'); ?>
</div>

<div class="col-sm-9 text-white">
<br />
<h3>Requesting Reservation</h3>
<br />
<br />

  <table class="table table-dark table-bordered">
    <thead>
      <tr>
        <th>Advertisement ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Contact Number</th>
        <th>Event</th>
        <th>Event Date</th>
        <th>Action</th>
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

  $sql = "SELECT * FROM book where landlord_id='$login_session' LIMIT $offset, $no_of_records_per_page";
  $result = mysqli_query($dbconnection,$sql);
  while($row = $result->fetch_assoc()) {
    $bhouse_id = $row['bhouse_id'];
    $status = $row['status'];
    $finish = $row['finish'];
?>

      <tr>
        <td><?php echo $bhouse_id; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['Address']; ?></td>  
        <td><?php echo $row['contact_number']; ?></td>
        <td><?php echo $row['event']; ?></td>
        <td><?php echo $row['event_date']; ?></td>
        <td>

          <?php 
  $sql_check = "SELECT * FROM rental where rental_id='$bhouse_id'";
  $result_check = mysqli_query($dbconnection,$sql_check);
  while($row_check = $result_check->fetch_assoc()) {
    $reserve = $row_check['reserve'];
  }
  if ($reserve == 'yes') {
    $disable = 'disabled';
  } else if ($reserve == '') {
    $disable = '';
  }
?>
<?php if ($finish == '') { ?>
        	<?php if ($status == '') { ?>
        		
        		<form action="" method="POST">
        			<input type="hidden" name="rowid" value="<?php echo $row['id']; ?>">
              <input type="hidden" name="rental_id" value="<?php echo $bhouse_id; ?>">
              <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
        			<button type="submit" name="approve" class="btn btn-primary" <?php echo $disable; ?>>Approve</button>
        		</form>
        		
        	<?php } else { ?>
        		<form action="" method="POST">
              <input type="hidden" name="rowid" value="<?php echo $row['id']; ?>">
              <input type="hidden" name="rental_id" value="<?php echo $bhouse_id; ?>">
              <button type="submit" name="unreserve" class="btn btn-success">Cancel</button>
            </form>
        	<?php } ?>
<?php } else { ?>
  <button class="btn btn-default text-white" disabled>Finish</button>
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




