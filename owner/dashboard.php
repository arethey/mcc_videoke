<?php include('header.php'); ?>
<div class="row">
<div class="col-sm-2">
<?php include('sidebar.php'); ?>
</div>

<div class="col-sm-9">
<br />
<br />
<div class="row">
  <div class="col">
    <div class="card border-primary">
          <div class="header bg-primary">
              <h4><i class="fa fa-bullhorn" aria-hidden="true"></i> Advertisement</h4>
          </div>
              <div class="container text-center">
          <?php
          $result = mysqli_query($dbconnection,"SELECT count(1) FROM rental WHERE landlord_id='$login_session'");
          $row = mysqli_fetch_array($result);
          $total = $row[0];
          echo "<h3>".$total."</h3>";
          ?>
          </div>
      </div>
  </div>
  <div class="col">
    <div class="card border-primary">
          <div class="header bg-primary">
              <h4><i class="fa fa-money" aria-hidden="true"></i> Income </h4>
          </div>
              <div class="container text-center">
              
              <?php 

$totalmonthly = 0;


  $sql_earn = "SELECT * FROM book WHERE landlord_id='$login_session' AND finish='yes'";
  $result_earn = mysqli_query($dbconnection,$sql_earn);
  while($row_earn = $result_earn->fetch_assoc()) {
    $finishrental = $row_earn['bhouse_id'];

    //echo $finishrental;

    $result_count_finish = mysqli_query($dbconnection,"SELECT * FROM rental WHERE landlord_id='$login_session' AND rental_id='$finishrental'");
    $row_count_finish = mysqli_fetch_array($result_count_finish);
    $totalmonthly += $row_count_finish['monthly'];
   }
?>
<h3>₱<?php echo number_format($totalmonthly); ?></h3>



          </div>
      </div>
  </div>
  <div class="col">
    <div class="card border-primary">
          <div class="header bg-primary">
              <h4><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Booker List</h4>
          </div>
              <div class="container text-center">
              <?php
          $result = mysqli_query($dbconnection,"SELECT count(1) FROM book WHERE landlord_id='$login_session'");
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

<div class="container mt-5 bg-white p-3">
  <?php
  $myArray = [];

  $rental_sql = "SELECT title, rental_id FROM rental WHERE landlord_id='$login_session'";
  if($rental_result = mysqli_query($dbconnection, $rental_sql)){
    if(mysqli_num_rows($rental_result) > 0){
      while($rental_row = mysqli_fetch_array($rental_result)){
        $myArray_2 = [];
        $rental_id = $rental_row['rental_id'];

        $curr_year = date("Y");
        $book_sql = "SELECT MONTH(event_date) months, COUNT(*) book_count FROM book WHERE YEAR(event_date)='$curr_year' AND bhouse_id = '$rental_id' AND finish = 'yes' GROUP BY MONTH(event_date)";
        if($book_result = mysqli_query($dbconnection, $book_sql)){
          if(mysqli_num_rows($book_result) > 0){
            while($book_row = mysqli_fetch_array($book_result)){
              for ($x = 1; $x <= 12; $x++) {
                if($x == $book_row['months']){
                  array_push($myArray_2, (int)$book_row['book_count']);
                }else{
                  array_push($myArray_2, 0);
                }
              }
            }
          }else{
            for ($x = 1; $x <= 12; $x++) {
              array_push($myArray_2, 0);
            }
          }
        }

        array_push($myArray, (object)[
          'label' => $rental_row['title'],
          'data' => $myArray_2
        ]);
      }
    }
  }
  
  $json_arr = json_encode( $myArray );
?>
  <canvas id="myChart"></canvas>
</div>


<script src="chart.js"></script>

<script>
  const colors = ['#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6', '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D', '#80B300', '#809900'];
  const data_months = <?php echo $json_arr; ?>;
  const datasets = data_months.map((el, i) => {
    return {
      ...el,
      fill: false,
      borderColor: colors[i],
      tension: 0.1
    }
  })

  const ctx = document.getElementById('myChart');
const data = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  datasets
};

const config = {
  type: 'line',
  data: data,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Monthly total bookings per Advertisement'
      }
    }
  },
};

  new Chart(ctx, config);
</script>

<?php include('footer.php'); ?>