<?php include('header.php'); ?>





<?php 

if(isset($_POST["submit"])) {

$rate = $_POST['rating'];
$comment = $_POST['comment'];


$sql = "INSERT INTO review (owner_id, rating, comment) VALUES ('$login_session', '$rate', '$comment')";

if ($dbconnection->query($sql) === TRUE) {
    echo '<script type="text/javascript">alert("Successfully Rate");</script>';

}
    
}

?>


<?php 
//overall rating
$query = "SELECT ROUND(AVG(rating), 1) as numRating FROM review";
        $avgresult = mysqli_query($dbconnection, $query);
        $fetchAverage = mysqli_fetch_array($avgresult);
        $numRating = $fetchAverage['numRating'];
        if($numRating <= 0){
            $numRating = "0";
        }
?>



<div class="container">


<?php 

$sql = "SELECT * FROM review WHERE owner_id='$login_session'";
    $result = mysqli_query($dbconnection,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $yourrating = $row['rating'];
    $count = mysqli_num_rows($result);
   
      
      // If result matched $myusername and $mypassword, table row must be 1 row

if (!empty($login_session)) {

if($count == 1) { //echo "show his review"; ?>




<div class="reviewbox bg-white p-3">
  <h3>Your review</h3>
  <div class="float-right">
  <select id="yourrating">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
  </div>

  <div class="alert">
    <?php echo $row['comment']; ?>
  </div>
</div>




<?php } else { //echo "show the rating textbox"; ?>

<form action="" method="POST">
<select name="rating" class="choose" required>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>
<textarea name="comment" class="form-control" required></textarea>
<button class="btn btn-primary" name="submit">SUBMIT MY RATING</button>
</form>

<?php } ?>

<?php } else { ?> 

<center>
<h3>OVERALL RATING</h3>
<select id="overall">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>
<h1><?php echo $numRating; ?></h1>
</center>

<hr />


<h3>Owner Review</h3>

<?php 
  $sql_customer = "SELECT * FROM review";
  $result_customer = mysqli_query($dbconnection,$sql_customer);
  while($row_customer = $result_customer->fetch_assoc()) {
  $customerid=$row_customer['owner_id'];
?>

<div class="reviewbox bg-white p-3">
  <div class="float-right">
    <h1 class="text-warning"><?php echo $row_customer['rating']; ?>.0</h1>
  </div>

  <?php 
  $sql_owner = "SELECT * FROM owner WHERE id='$customerid'";
  $result_owner = mysqli_query($dbconnection,$sql_owner);
  while($row_owner = $result_owner->fetch_assoc()) {
  ?>
    <img width="80" height="80" src="uploads/<?php echo $row_owner['profile_photo']; ?>" />
    <br />
    Name: <b><?php echo $row_owner['name']; ?></b>
    <br />
    <br />

<?php } ?>

    <i class="fa fa-quote-left" aria-hidden="true"></i> &nbsp
    <?php echo $row_customer['comment']; ?>
     &nbsp<i class="fa fa-quote-right" aria-hidden="true"></i>

</div>
<br />



<?php } } ?>





</div>





<?php include('footer.php'); ?>