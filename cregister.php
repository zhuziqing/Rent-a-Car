<?php

require_once "config.php";
//Declaring variables to prevent errors
$fname = ""; //First name
$lname = ""; //Last name
$password = ""; //password
$address="";//address
$driverlis="";//driverliscense
$message = false;
$reg=0;

//customer login variables
$ldriverlis="";
$lpassword="";
require "clogin.php";

//clerk login variables
$cusername="";
$cpassword="";
require "clerklogin.php";


if(isset($_POST['register_button'])){

	//First name
	$fname = $_POST['reg_fname']; //Remove html tags
	//Last name
	$lname = $_POST['reg_lname']; //Remove html tags
	//Password
	$password = $_POST['reg_password']; //Remove html tags
  //address
  $address = $_POST['address']; //Remove html tags
  //driver_lis
  $driverlis=$_POST['driver_lis'];
  $success =1;
  //check driverlicense uniqueness
  $sql = "select driverLiscense from Customer where  driverLiscense = '$driverlis'";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  if ($stmt->rowCount() > 0){
  $message = "Driver Lisense Already Exist";
  $success = 0;
  }


 //create new tuple
  if($success==1){
	$reg=1;
	$sql = "insert into Customer values ('$driverlis','$fname','$lname','$password','$address')";
	$stmt = $pdo->prepare($sql);
  $stmt->execute();
	}
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>	SuperRent</title>
		<link rel="stylesheet" href="public/css/register.css">
		<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="public/js/register.js"></script>

  </head>
  <body>
    <?php

  	if(isset($_POST['register_button'])) {
  		echo '
  		<script>

  		$(document).ready(function() {
  			$("#first").hide();
				$("#third").hide();
  			$("#second").show();
  		});

  		</script>

  		';
  	}
  	?>

  	<div class="wrapper">

  		<div class="login_box">

  			<div class="login_header">
  				<h1>Welcome to SuperRent!</h1>
  			</div>
  			<br>
  			<div id="first">

  				<form  method="POST">
  					<input type="number" name="log_driverlis" placeholder="Driver Liscense ID" value="" required>
  					<br>
  					<input type="password" name="log_password" placeholder="Password">
           <br>
           <?php if ($message != false) {
                    echo "<p style='color: red; font-weight: bold;'>$message</p>";
                }
           ?>
  					<input type="submit" name="login_button" value="Login">
  					<br>

  					<a href="#" id="signup" class="signup">Need an account? Register here!</a>
						<br>
            <a href="#" id="clerklogin" class="clerklogin"> Clerk Log In Here! </a>
						<br>
  				</form>

  			</div>

  			<div id="second">

  				<form method="POST">
  					<input type="text" name="reg_fname" placeholder="First Name" value="" required>
  					<br>
  					<input type="text" name="reg_lname" placeholder="Last Name" value="" required>
  					<br>
						<input type="number" name="driver_lis" placeholder="Driver Liscense" required>
  					<br>
  					<input type="password" name="reg_password" placeholder="Password" required>
  					<br>
            <input type="text" name="address" placeholder="Address" required>
  					<br>
            <?php if ($message != false) {
                     echo "<p style='color: red; font-weight: bold;'>$message</p>";
                 }
            ?>
  					<input type="submit" name="register_button" value="Register">
  					<br>

  					<?php if($reg==1) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
  					<a href="#" id="signin" class="signin">Already have an account? Log in here!</a>
						<br>
  				</form>
  			</div>

				<div id="third">
           <form action="cregister.php#third" method="POST">
						<input type="text" name="clerkuser" placeholder="User Name" value="" required>
						<br>
						<input type="password" name="clog_password" placeholder="Password" required>
					 <br>
					 <?php if ($message != false) {
										echo "<p style='color: red; font-weight: bold;'>$message</p>";
								}
					 ?>
						<input type="submit" name="clogin_button" value="Login">
						<br>
						<a href="cregister.php" id="signin" class="signin">Already have an account? Log in here!</a>
						<br>
					</form>

				</div>

  		</div>

  	</div>

  </body>
</html>
