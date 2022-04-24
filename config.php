<?php
// ob_start(); //Turns on output buffering
// session_start();

$timezone = date_default_timezone_set("America/Vancouver");
//
// $con = mysqli_connect("localhost", "root", "", "social"); //Connection variable
//
// if(mysqli_connect_errno())
// {
// 	echo "Failed to connect: " . mysqli_connect_errno();
// }

$pdo=new PDO('mysql:host=localhost;dbname=carrenter','root','');

?>
