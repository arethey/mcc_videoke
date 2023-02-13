
<br />
<br />
<br />

<footer class="page-footer font-small blue bg-dark text-white">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© VideOke MacHinE / DiscO SounD SystEm
  </div>
  <!-- Copyright -->

</footer>


<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="src/jquery.barrating.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(function(){
    var dtToday = new Date();
 
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    //alert(maxDate);
    $('#inputdate').attr('min', maxDate);
});
</script>



<script type='text/javascript'>
    $(function () {
        $('.choose').barrating({
            theme: 'fontawesome-stars',
        });
    });
</script>


<script type="text/javascript">
$(document).ready(function(){
        $('#yourrating').barrating({
            theme: 'fontawesome-stars',
            readonly: true,
            initialRating: <?php echo $yourrating; ?>
        });
    });
</script>


<script type="text/javascript">
$(document).ready(function(){
        $('#overall').barrating({
            theme: 'fontawesome-stars',
            readonly: true,
            initialRating: <?php echo $numRating; ?>
        });
    });
</script>



</body>
</html>