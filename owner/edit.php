<?php include('header.php'); ?>




<?php 

$rental_id = $_GET['bh_id'];
$sql_edit = "SELECT * FROM rental WHERE rental_id='$rental_id'";
$result_edit = mysqli_query($dbconnection,$sql_edit);

while($row_edit = $result_edit->fetch_assoc()) {
    $title = $row_edit['title'];
    $address = $row_edit['address'];
    $monthly = $row_edit['monthly'];
    $description = $row_edit['description'];
    $photo = $row_edit['photo'];
}

?>





<?php 

if(isset($_POST["update"])) {

$rental_id = $_POST['rental_id'];
$title = $_POST['title'];;
$address = $_POST['address'];
$monthly = $_POST['monthly'];
$type = $_POST['type'];
$description = $_POST['description'];


$sql = "UPDATE rental SET title='$title', address='$address', description='$description', monthly='$monthly', type='$type' WHERE rental_id='$rental_id'";


if ($dbconnection->query($sql) === TRUE) {
  echo '<script type="text/javascript">alert("Successfully Created Advertisement, Wait the admin to approve your advertisement");</script>';
} else {
  echo 'Error Database';
}
    
}
 ?>






<div class="row text-white">
<div class="col-sm-2">
<?php include('sidebar.php'); ?>
</div>

<div class="col-sm-9">
<br />
<a href="advertisement.php" class="btn btn-danger"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</a>
<br />
<br />
<h3>EDIT ADVERTISEMENT</h3>  
<br />
<br />
<form action="" method="POST" enctype="multipart/form-data">
  
<div class="form-group" hidden>
    <label >ID</label>
    <input class="form-control" type="text" name="rental_id" value="<?php echo $rental_id; ?>" readonly>
  </div>

<!-- <div class="row">
  <div class="col">
     <div class="form-group">
    <label>Thumbnail</label>
    <input type="file" name="photo" value="<?php //echo $photo; ?>">
  </div>
  </div>
  <div class="col">
      <div class="form-group">
    <label>Gallery</label>
    <input type="file" name="gallery[]" multiple >
  </div>
  </div>
    <div class="col">
      <div class="form-group">
    <label>Video</label>
    <input type="file" name="video" accept="video/mp4,video/x-m4v,video/*" value="<?php //echo $video; ?>">
  </div>
  </div>
</div> -->


  <div class="form-group">
    <label>Advertisement Title</label>
    <input name="title" type="text" class="form-control" value="<?php echo $title; ?>" required>
  </div>



  <div class="form-group">
    <label>Description</label>
    
  <textarea class="form-control" rows="6" name="description" required><?php echo $description; ?></textarea>
  
</div>



 <!--  <div class="form-group">
    <label>Contact Number</label>
    <input name="number" type="number" class="form-control">
  </div> -->

  <div class="form-group">
    <label>Address</label>
    <input name="address" type="text" value="<?php echo $address; ?>" class="form-control" required>
  </div>
<!--    <div class="form-group">
    <label>Number of Bedspacer</label>
    <input name="slots" type="number" class="form-control" required>
  </div> -->
  <div class="row">
    <div class="col">
      <div class="form-group">
    <label>Price Daily</label>
    <input class="form-control" type="number" value="<?php echo $monthly; ?>" name="monthly" required>
    <!-- <input type="range" class="form-control" min="500" max="5000" value="500" step="100"> -->
  </div>
    </div>
    <div class="col">
      <div class="form-group">
    <label>Type</label>
   <select name="type" class="form-control" required>
    <option value="Videoke">...</option>
     <option value="Videoke">Videoke</option>
     <option value="Sound System">Sound System</option>
   </select>
    <!-- <input type="range" class="form-control" min="500" max="5000" value="500" step="100"> -->
  </div>
    </div>
  </div>
  

<br />

<!--   <div class="form-group">
    <div class="form-row">
      <div class="col">
        <input type="checkbox" name="free_wifi">

        <label>Free Wifi</label><br>
      </div>
      <div class="col">
        <input type="checkbox" name="free_water">
        <label>Free Water</label><br>
      </div>
      <div class="col">
        <input type="checkbox" name="free_kuryente">
        <label>Free Kuryente</label><br>
      </div>
  </div>
</div> -->

<br />

 




<!--   <div class="col">
 <center>
<?php // include('map.php'); ?>
</center>
</div> -->





  

  <button type="submit" name="update" class="btn btn-danger"><i class="fa fa-plus-circle" aria-hidden="true"></i> UPDATE ADVERTISEMENT</button>
</form>




</div>
</div>

<br />
<br />
<br />


<script type="text/javascript">
  $('input[type=range]').on('input', function () {
    var price = $(this).val();
    $('#price').val(parseInt(price).toLocaleString());
    $('#pricechanger').html(parseInt(price).toLocaleString());
});
</script>

<?php include('footer.php'); ?>