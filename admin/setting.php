<?php include('header.php'); ?>


<?php 
$sql_fee = "SELECT * FROM admin";
  $result_fee = mysqli_query($dbconnection,$sql_fee);
  while($row_fee = $result_fee->fetch_assoc()) {
    $fee = $row_fee['admin_fee'];
    $gcash = $row_fee['gcash'];
  }

 ?>


<?php
if(isset($_POST["change"])) {

$fee = $_POST['fee'];



$sql_fee = "UPDATE admin SET admin_fee='$fee' WHERE id='1'";


if ($dbconnection->query($sql_fee) === TRUE) {
    echo '<script type="text/javascript">alert("Successfully Changed Admin Fee");</script>';
} else {
  echo '<script type="text/javascript">alert("Error database.");</script>';
}
    
}
?>



<?php
if(isset($_POST["changegcash"])) {

$gcash = $_POST['gcash'];



$sql_fee = "UPDATE admin SET gcash='$gcash' WHERE id='1'";


if ($dbconnection->query($sql_fee) === TRUE) {
    echo '<script type="text/javascript">alert("Successfully Changed Gcash Number");</script>';
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
<h3>Setting</h3>
<br />
<br />

<div class="row">

<div class="col">
<form action="" method="post">
  <h5>Advertisement Fee: <span>₱ <?php echo $fee; ?></span></h5>
  <input class="form-control" type="number" name="fee" placeholder="Enter to change admin fee"> <br />
  <button name="change" class="btn btn-danger form-control">Change</button>
</form>
</div>

<div class="col">
<form action="" method="post">
  <h5>Gcash Number: <span> <?php echo $gcash; ?></span></h5>
  <input class="form-control" type="number" name="gcash" placeholder="Enter to change gcash number"> <br />
  <button name="changegcash" class="btn btn-danger form-control">Change</button>
</form>
</div>


</div>



</div>
</div>

<?php include('footer.php'); ?>