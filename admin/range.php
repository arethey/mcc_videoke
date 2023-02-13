<?php
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($dbconnection, "SELECT * FROM `rental` WHERE date(`date`) BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		$total = 0;
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
			$total += number_format($fetch['fee']);
?>
	<tr>
		<td><?php echo $fetch['rental_id']?></td>
		<td><?php echo $fetch['date']?></td>
		<td><?php echo $fetch['fee']?></td>
	</tr>
<?php } ?>
	<tr>
		<td></td>
		<td></td>
		<td>Total: <?php echo $total; ?></td>
	</tr>
		<?php }else{
			echo'
			<tr>
				<td colspan = "4"><center>Record Not Found</center></td>
			</tr>';
		}
	}else{
		$query=mysqli_query($dbconnection, "SELECT * FROM `rental`") or die(mysqli_error());
		$total = 0;
		while($fetch=mysqli_fetch_array($query)){
			$total += number_format($fetch['fee']);
?>
	<tr>
		<td><?php echo $fetch['rental_id']?></td>
		<td><?php echo $fetch['date']?></td>
		<td><?php echo $fetch['fee']?></td>
	</tr>
<?php
		} ?>
			<tr>
		<td></td>
		<td></td>
		<td>Total: <?php echo $total; ?></td>
	</tr>
		<?php
	}
?>
