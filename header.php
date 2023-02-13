<?php include('connection.php'); ?>
<?php error_reporting(0); ?>
<?php include('owner/session.php'); ?>





<?php 
if(isset($_POST["register"])) {

$name = $_POST['name'];
$Address = $_POST['Address'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$password = $_POST['password'];
$profile_photo = $_FILES['profile_photo']['name'];
$target = "uploads/".basename($profile_photo);


$sql = "INSERT INTO owner (name, email, password, Address, contact_number, profile_photo) VALUES ('$name', '$email', '$password', '$Address', '$contact_number', '$profile_photo')";

if ($dbconnection->query($sql) === TRUE) {
    echo '<script type="text/javascript">alert("Successfully Register");</script>';
    move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target);

}
    
}




if(isset($_POST["login"])) {
session_start();
    $myusername = $_POST['myemail'];
    $mypassword = $_POST['mypassword']; 
      
    $sql = "SELECT id FROM owner WHERE email = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($dbconnection,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
   
      
      // If result matched $myusername and $mypassword, table row must be 1 row
        
    if($count == 1) {
        $_SESSION['login_user'] = $myusername;
         
        header("location: owner/dashboard.php");
    }else {
        echo '<script type="text/javascript">alert("Username or Password is Incorrect");</script>';
    }


}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='src/fontawesome-stars.css' rel='stylesheet' type='text/css'>
<style type="text/css">

* {box-sizing: border-box;}

body {
  margin: 0;
  background: #dddddd;
}
nav {
  font-family: "Audiowide", sans-serif;
}
.card {
    margin-bottom: 20px;
}
a.nav-link.scroll-link {
    color: #fff !important;
}
.carousel-item img {
    object-fit: cover;
    object-position: center;
    height: 500px;
    overflow: hidden;
}

.course_card {
  margin: 25px 10px;
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  transition: 0.25s ease-in-out;
  border: thin solid #ff920a;
    box-shadow: 5px 4px 10px #9f9f9f;
}
.course_card_img {
  max-height: 100%;
  max-width: 100%;
}
.course_card_img img {
  height: 250px;
  width: 100%;
  transition: 0.25s all;
}
.course_card_img img:hover {
  transform: translateY(-3%);
}
.course_card_content {
  padding: 16px;
}
.course_card_content h3 {
  font-family: nunito sans;
  font-family: 18px;
}
.course_card_content p {
  font-family: nunito sans;
  text-align: justify;
}
.course_card_footer {
  padding: 10px 0px;
  margin: 16px;
}
.course_card_footer a {
  text-decoration: none;
  font-family: nunito sans;
  margin: 0 10px 0 0;
  text-transform: uppercase;
  color: #f96332;
  padding: 10px;
  font-size: 14px;
}
.course_card:hover {
  transform: scale(1.025);
  border-radius: 0.375rem;
  box-shadow: 0 0 2rem rgba(0, 0, 0, 0.25);
}
.course_card:hover .course_card_img img {
  border-top-left-radius: 0.375rem;
  border-top-right-radius: 0.375rem;
}


/*gallery*/

.wrap {
    overflow-x: scroll;
}
.gallery {
    white-space: nowrap;
}

.gallery img {
	display: inline-block;
	width: 500px;
    height: auto;
}


.main {
    width: 50%;
    margin: 50px auto;
}

/* Bootstrap 4 text input with search icon */

.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}

div#searchbox {
    position: absolute;
    top: 32vh;
    width: 80%;
    right:110px;
}
ul.pagination li {
    background: #ed3737;
    padding: 10px;
    margin: 5px;
    border: thin solid silver;
    border-radius: 20px;
}
ul.pagination li a {
  color: #fff;
}
ul.pagination li.disabled {
  background: #adadad;
}
ul.pagination li:last-child {
  float: right;
}
</style>
</head>




<body>

<nav class="navbar navbar-dark fixed-top navbar-expand-md bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="fa fa-bullhorn" aria-hidden="true"></i><marquee behavior="alternate"> BAMASA Booking Portal</marquee></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link scroll-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link scroll-link" href="#section-2"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create Advertisement</a>
                </li> -->
                <!--<li class="nav-item">
                    <a class="nav-link scroll-link" href="#section-3">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll-link" href="#section-1">Contact</a>
                </li>!-->
                <li class="nav-item">
                    <a class="nav-link scroll-link" href="review.php"><i class="fa fa-star" aria-hidden="true"></i> Reviews </a>
                </li>
                <?php if ($login_session == '') { ?>
                  <li class="nav-item">
                    <a class="nav-link scroll-link" href="#section-4" data-toggle="modal" data-target="#myModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Publish Ad </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll-link" href="#section-4" data-toggle="modal" data-target="#myLogin"><i class="fa fa-key" aria-hidden="true"></i> My Page </a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link scroll-link" href="owner/dashboard.php"><i class="fa fa-user" aria-hidden="true"></i> Dashboard </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll-link" href="owner/logout.php"><i class="fa fa-user" aria-hidden="true"></i> Logout </a>
                </li>
                <?php } ?>


                
                


            </ul>
        </div>
    </div>
</nav>

<br />
<br />
<br />


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content bg-dark text-white">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
  <form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name">Profile Picture</label>
    <input type="file" name="profile_photo" class="form-control" placeholder="Enter name">
  </div>    
   <div class="form-group">
    <label for="name">Full Name:</label>
    <input type="text" name="name" class="form-control" placeholder="Enter name">
  </div>
  <div class="form-group">
    <label for="email">Address:</label>
    <input type="text" name="Address" class="form-control" placeholder="Enter Address">
  </div>
  <div class="form-group">
    <label for="email">Contact Number:</label>
    <input type="number" name="contact_number" class="form-control" placeholder="Enter Contact Number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" />
  </div>

  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" name="email" class="form-control" placeholder="Enter email">
  </div>
  
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" name="password" class="form-control" placeholder="Enter password">
  </div>

  <button type="submit" name="register" class="btn btn-primary">Register</button>
</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>







  <!-- The Modal -->
<div class="modal" id="myLogin">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">


<form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input name="myemail" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="mypassword" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>

  <button type="submit" name="login" class="btn btn-primary">Login</button>
</form>


  </div>
      </div>

      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>







</div>