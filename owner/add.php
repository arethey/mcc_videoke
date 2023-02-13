<?php include('header.php'); ?>



<?php 

if(isset($_POST["create"])) {

$rental_id = $_POST['rental_id'];
$title = $_POST['title'];;
$address = $_POST['address'];
$monthly = $_POST['monthly'];
$type = $_POST['type'];
$description = $_POST['description'];
$ref = $_POST['ref'];
$photo = $_FILES['photo']['name'];
$target = "../uploads/".basename($photo);

$gcash_shot = $_FILES['gcash_shot']['name'];
$target_shot = "../uploads/".basename($gcash_shot);

$video = $_FILES['video']['name'];
$target_video = "../uploads/".basename($video);


$sql = "INSERT INTO rental (rental_id, title, address, photo, description, landlord_id, monthly, video, type, ref, shot, fee) VALUES ('$rental_id','$title', '$address', '$photo', '$description', '$login_session', '$monthly', '$video', '$type', '$ref', '$gcash_shot', '0')";


if ($dbconnection->query($sql) === TRUE) {
	echo '<script type="text/javascript">alert("Successfully Created Advertisement, Wait the admin to approve your advertisement");</script>';
	move_uploaded_file($_FILES['photo']['tmp_name'], $target);
  move_uploaded_file($_FILES['gcash_shot']['tmp_name'], $target_shot);
  move_uploaded_file($_FILES['video']['tmp_name'], $target_video);

		//gallery 
	$totalfiles = count($_FILES['gallery']['name']);

	// Looping over all files
	for($i=0;$i<$totalfiles;$i++){
	$filename = $_FILES['gallery']['name'][$i];
	 
		// Upload files and store in database
		if(move_uploaded_file($_FILES["gallery"]["tmp_name"][$i],'../uploads/'.$filename)){
		        // Image db insert sql
		        $insert = "INSERT into gallery (file_name,rental_id) values('$filename','$rental_id')";
		        mysqli_query($dbconnection, $insert);
		 }
    
	}

    
}
    
}
 ?>


<div class="row text-white">
<div class="col-sm-2">
<?php include('sidebar.php'); ?>
</div>

<div class="col-sm-9">


<br />
<h3>ADD NEW ADVERTISEMENT</h3>  
<br />
<br />
<form action="" method="POST" enctype="multipart/form-data">
	<?php $number =  random_int(100, 100000); ?>
	
<div class="form-group" hidden>
    <label >ID</label>
    <input class="form-control" type="text" name="rental_id" value="<?php echo $number; ?>" readonly>
  </div>

<div class="row">
  <div class="col">
     <div class="form-group">
    <label>Thumbnail</label>
    <input type="file" name="photo" >
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
    <input type="file" name="video" accept="video/mp4,video/x-m4v,video/*">
  </div>
  </div>
</div>


  <div class="form-group">
    <label>Advertisement Title</label>
    <input name="title" type="text" class="form-control" required>
  </div>



	<div class="form-group">
    <label>Description</label>
    
	<textarea class="form-control" rows="6" name="description" required></textarea>
	
</div>



 <!--  <div class="form-group">
    <label>Contact Number</label>
    <input name="number" type="number" class="form-control">
  </div> -->

  <div class="form-group">
    <label>Address</label>
    <input name="address" type="address" class="form-control" required>
  </div>
<!--    <div class="form-group">
    <label>Number of Bedspacer</label>
    <input name="slots" type="number" class="form-control" required>
  </div> -->
  <div class="row">
    <div class="col">
      <div class="form-group">
    <label>Price Daily</label>
    <input class="form-control" type="number" name="monthly" required>
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


      <h3>Advertisement Fee</h3>
      <?php 
$sql_fee = "SELECT * FROM admin";
  $result_fee = mysqli_query($dbconnection,$sql_fee);
  while($row_fee = $result_fee->fetch_assoc()) {
    $fee = $row_fee['admin_fee'];
    $gcash = $row_fee['gcash'];
  }

 ?>
<h6>GCASH: <?php echo $gcash; ?></h6>
<h6>FEE: <?php echo $fee; ?></h6>






<div class="row">
  <div class="col">
     <div class="form-group">
    <label>Reference Number</label>
    <input class="" type="text" name="ref">
  </div>
  </div>
  <div class="col">
      <div class="form-group">
    <label>Screenshot</label>
    <input type="file" name="gcash_shot" >
  </div>
  </div>
</div>


<br />

 




<!--   <div class="col">
 <center>
<?php // include('map.php'); ?>
</center>
</div> -->





  

  <button type="submit" name="create" class="btn btn-danger"><i class="fa fa-plus-circle" aria-hidden="true"></i> ADD ADVERTISEMENT</button>
</form>


</div>




</div>

<br />
<br />
<br />





<?php include('footer.php'); ?>