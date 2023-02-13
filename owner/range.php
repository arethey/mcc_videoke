<?php
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));


		$query=mysqli_query($dbconnection, "SELECT * FROM `book` WHERE date(`event_date`) BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
$total = 0;
		$sql_earn = "SELECT * FROM book WHERE date(`event_date`) BETWEEN '$date1' AND '$date2' AND landlord_id='$login_session' AND finish='yes'";
  $result_earn = mysqli_query($dbconnection,$sql_earn);
  while($row_earn = $result_earn->fetch_assoc()) {

			$result_count_finish = mysqli_query($dbconnection,"SELECT * FROM rental WHERE landlord_id='$login_session'");
    $row_count_finish = mysqli_fetch_array($result_count_finish);
    $total += $row_count_finish['monthly'];
?>
	<tr>
		<td><?php echo $row_count_finish['rental_id']?></td>
		<td><?php echo $row_earn['event_date']?></td>
		<td><?php echo $row_count_finish['monthly']?></td>
	</tr>
<?php } ?>
	<tr>
		<td></td>
		<td></td>
		<td>Total: <?php echo $total; ?></td>
	</tr>

	<?php }else{
$total = 0;


  $sql_earn = "SELECT * FROM book WHERE landlord_id='$login_session' AND finish='yes'";
  $result_earn = mysqli_query($dbconnection,$sql_earn);
  while($row_earn = $result_earn->fetch_assoc()) {

			$result_count_finish = mysqli_query($dbconnection,"SELECT * FROM rental WHERE landlord_id='$login_session'");
    $row_count_finish = mysqli_fetch_array($result_count_finish);
    $total += $row_count_finish['monthly'];

?>
	<tr>
		<td><?php echo $row_count_finish['rental_id']?></td>
		<td><?php echo $row_earn['event_date']?></td>
		<td><?php echo $row_count_finish['monthly']?></td>
	</tr>
<?php } ?>
			<tr>
		<td></td>
		<td></td>
		<td>Total: <?php echo $total; ?></td>
	</tr>
		<?php
	}
?>
