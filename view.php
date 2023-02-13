<?php include('header.php'); ?>


<?php 

$rental_id = $_GET['ad_id'];
  $sql_landlord = "SELECT * FROM rental where rental_id='$rental_id'";
  $result_landlord = mysqli_query($dbconnection,$sql_landlord);
  while($row_landlord = $result_landlord->fetch_assoc()) {
    $landlord_id = $row_landlord['landlord_id'];
  }

if(isset($_POST["booknow"])) {

$name = $_POST['name'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$Address = $_POST['Address'];
$event = $_POST['event'];
$event_date = $_POST['event_date'];


$sql_book = "INSERT INTO book (name, email, contact_number, landlord_id, bhouse_id, Address, event, event_date) VALUES ('$name', '$email', '$contact_number', '$landlord_id', '$rental_id', '$Address', '$event', '$event_date')";


if ($dbconnection->query($sql_book) === TRUE) {
    echo '<script type="text/javascript">alert("Successfully Book, wait for owner to call you.");</script>';
} else {
  echo '<script type="text/javascript">alert("Error database.");</script>';
}
    
}

?>



<div class="container">

<?php
  $sql = "SELECT * FROM rental where rental_id='$rental_id'";
  $result = mysqli_query($dbconnection,$sql);
  while($row = $result->fetch_assoc()) {
    $landlordid = $row['landlord_id'];
?>


<?php 
$query_gallery = "SELECT * FROM gallery";
$result_gallery = mysqli_query($dbconnection,$query_gallery);

$rowcount = mysqli_num_rows($result_gallery);

?>



               <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
   <?php
       for($i=1;$i<=$rowcount;$i++)
       {
           $row_gal = $result_gallery->fetch_assoc();
       
          if($i==1){
      
      
      ?>

    <div class="carousel-item active">
      <img src="uploads/<?php echo $row_gal['file_name'];?>" class="d-block w-100" style="height: 400px;" alt="...">
    </div>
    
    <?php }else{
        ?>
    <div class="carousel-item">
      <img src="uploads/<?php echo $row_gal['file_name'];?>" class="d-block w-100"  style="height: 400px;" alt="...">
    </div><?php } ?>
    <?php }  ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
               











<h1><?php echo $row['title']; ?></h1>
 <h5>₱ <?php echo number_format($row['monthly']); ?> / Per Day</h5>
 <h6><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $row['address']; ?></h6>

<br />
<br />

<div class="row">
  <div class="col-md-8">
    <h3>Description</h3>
    <div class="card mb-4">
          <div class="card-body">
            <?php echo $row['description']; ?>
          </div>
        </div>
    <div class="video">
      <video width="100%" height="300px" controls>
  <source src="uploads/<?php echo $row['video']; ?>" type="video/mp4">
Your browser does not support the video tag.
</video>
    </div>
  </div>
  
  <div class="col-md-4">
    <h3>OWNER INFORMATION</h3>

    <?php

  $sql_ll = "SELECT name, email, contact_number, profile_photo FROM owner where id='$landlordid'";
  $result_ll = mysqli_query($dbconnection,$sql_ll);
  while($row_ll = $result_ll->fetch_assoc()) {
    $name = $row_ll['name'];
    $email = $row_ll['email'];
    $contact_number = $row_ll['contact_number'];
    $profile_photo = $row_ll['profile_photo'];

  }
?>
    <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"><i class="fa fa-user" aria-hidden="true"></i></p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" ><?php echo $name; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"><i class="fa fa-envelope" aria-hidden="true"></i></p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $email; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"><i class="fa fa-phone-square" aria-hidden="true"></i></p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $contact_number; ?></p>
              </div>
            </div>

          </div>
        </div>
        <center>
        <button data-toggle="modal" data-target="#bookNow" class="btn btn-danger btn-lg">RESERVE NOW!</button>
        </center>
  </div>
</div>






<?php } ?>




<!-- The Modal -->
<div class="modal" id="bookNow">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">

      <!-- Modal body -->
      <div class="modal-body">
<form action="" method="post">
  <div class="form-row">
    <div class="form-group col">
      <label>Name</label>
      <input name="name" type="text" class="form-control" placeholder="Full Name">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col">
      <label>Email</label>
      <input name="email" type="text" class="form-control" placeholder="Email address">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col">
      <label>Address</label>
      <input name="Address" type="text" class="form-control" placeholder="Current Address">
    </div>
  </div>
   <div class="form-row">
    <div class="form-group col">
      <label>Contact Number</label>
      <input name="contact_number" type="number" class="form-control" placeholder="Contact Number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col">
      <label>Event</label>
      <select name="event" class="form-control">
        <option value="Birthday">Birthday</option>
        <option value="Wedding">Wedding</option>
        <option value="Fiesta">Fiesta</option>
      </select>
    </div>
  </div>
   <div class="form-row">
    <div class="form-group col">
      <label>Event Date</label>
      <input name="event_date" type="date" id="inputdate" class="form-control" placeholder="">
    </div>
  </div>

  <button type="submit" name="booknow" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Request Reservation</button>
</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</button>
      </div>

    </div>
  </div>
</div>





</div>


<?php include('footer.php'); ?>