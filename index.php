<?php include('header.php'); ?>



<?php 


if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
  $no_of_records_per_page = 6;
  $offset = ($pageno-1) * $no_of_records_per_page;

  $total_pages_sql = "SELECT COUNT(*) FROM owner";
  $result_pages = mysqli_query($dbconnection,$total_pages_sql);
  $total_rows = mysqli_fetch_array($result_pages)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);

$sql_show="SELECT * FROM rental WHERE status='Approved' LIMIT $offset, $no_of_records_per_page";



if(isset($_POST["search"])) {

  $query = $_POST['query'];
  $sql_show="SELECT * FROM rental WHERE (`address` LIKE '%".$query."%')";

}

?>

<br />
<div class="container">

<div class="row mx-auto">

<?php


  $sql = $sql_show;
  $result = mysqli_query($dbconnection,$sql);
  while($row = $result->fetch_assoc()) {
    $rent_id = $row['rental_id'];
    $reserve = $row['reserve'];
?>

  <div class="col-lg-4 col-md-6 col-sm-12">
<div class="card">
  <img src="uploads/<?php echo $row['photo']; ?>" style="height: 300px;object-fit: cover;"/>
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['title']; ?></h5>
    <!--<p class="card-text">₱  <?php echo number_format($row['monthly']); ?> / Per Day</p>!-->
    <span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $row['address']; ?></span>
  </div>
  <div class="card-body">
    <?php if ($reserve == 'yes') { ?>
    <button href="#" onclick="alert('Already Reserve');" class="card-link btn btn-danger" disabled>More Information</button>
    <?php } else { ?>
    <a href="view.php?ad_id=<?php echo $rent_id; ?>" class="card-link btn btn-danger">More Information</a>
    <?php } ?>
  </div>
</div>
</div>

<?php
  }

?>






</div>

<br />
<br />
<br />
<br />

<ul class="pagination">
        <!-- <li><a href="?pageno=1"><i class="fa fa-fast-backward" aria-hidden="true"></i> First</a></li> -->
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </li>
        <!-- <li><a href="?pageno=<?php //echo $total_pages; ?>">Last <i class="fa fa-fast-forward" aria-hidden="true"></i></a></li> -->
    </ul>


</div>





</div>





<?php include('footer.php'); ?>