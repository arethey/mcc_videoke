<?php include('header.php'); ?>


<div class="row">
<div class="col-sm-2">
<?php include('sidebar.php'); ?>
</div>

<div class="col-sm-8">
<br />
<h3 style="color:white;">Generate Income</h3>
<br />
<br />
<div class="row">


		<hr style="border-top:1px dotted #000;"/>
		<form class="form-inline" method="POST" action="">
			<label>Date:</label>
			<input type="date" class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
			<label>To</label>
			<input type="date" class="form-control" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
			&nbsp <button class="btn btn-primary" name="search">Search</button>
		</form>
		<br /><br />
		<div class="table-responsive" style="position:relative;">	
			<table id="printable" class="table table-bordered bg-white">
				<thead>
					<tr>
						<th>Advertisement ID</th>
						<th>Date</th>
						<th>Income</th>
					</tr>
				</thead>
				<tbody>
					<?php include'range.php'?>	
				</tbody>
			</table>
			<button class="btn btn-danger print" onclick="printDiv();"><i class="fa fa-print" aria-hidden="true"></i> PRINT</button>
		</div>	




</div>



</div>
</div>

<?php include('footer.php'); ?>