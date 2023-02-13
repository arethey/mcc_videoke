<?php include('header.php'); ?>


<div class="row">
<div class="col-sm-2">
<?php include('sidebar.php'); ?>
</div>

<div class="col-sm-8">
<br />
<h3><marquee behavior="alternate">Welcome back, Admin</marquee></h3>
<br />
<br />
<div class="row">
	<div class="col">
		<div class="card border-danger">
	        <div class="header bg-danger">
	            <h4><i class="fa fa-bullhorn" aria-hidden="true"></i> Advertisement</h4>
	        </div>
	            <div class="container text-center">
					<?php
					$result = mysqli_query($dbconnection,"SELECT count(1) FROM rental");
					$row = mysqli_fetch_array($result);
					$total = $row[0];
					echo "<h3>".$total."</h3>";
					?>
	        </div>
	    </div>
	</div>
	<div class="col">
		<div class="card border-danger">
	        <div class="header bg-danger">
	            <h4><i class="fa fa-money" aria-hidden="true"></i> Earnings</h4>
	        </div>
	            <div class="container text-center">
	            
	            <?php 
$fee = 0;
	$sql_earn = "SELECT * FROM rental";
  $result_earn = mysqli_query($dbconnection,$sql_earn);
  while($row_earn = $result_earn->fetch_assoc()) {
    $fee += number_format($row_earn['fee']);
   }
?>
<h3>₱<?php echo number_format($fee); ?></h3>



	        </div>
	    </div>
	</div>
	<div class="col">
		<div class="card border-danger">
	        <div class="header bg-danger">
	            <h4><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Approved Owner</h4>
	        </div>
	            <div class="container text-center">
	            <?php
					$result = mysqli_query($dbconnection,"SELECT count(1) FROM owner WHERE status='Approved'");
					$row = mysqli_fetch_array($result);
					$total = $row[0];
					echo "<h3>".$total."</h3>";
				?>
	        </div>
	    </div>
	</div>
</div>



</div>
</div>

<?php include('footer.php'); ?>