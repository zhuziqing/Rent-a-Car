<?php
if(isset($_POST['login_button'])) {
  $ldriverlis= $_POST['log_driverlis'];
  $lpassword=$_POST['log_password'];

  $sql = "select driverLiscense from Customer where  driverLiscense = '$ldriverlis'";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  if ($stmt->rowCount() == 0){
  $message = "Driver Liscense Doesn't Exist";
} else {
  $sql = "select password from Customer where  driverLiscense = '$ldriverlis'";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $storedpswd = $stmt->fetch();
  if ($storedpswd['password'] != $lpassword){
    $message = "Wrong Password";
  }else{
    setcookie("Userlis", $ldriverlis, time() + 3600);
    header("Location: cindex.php");
 }

}
}
?>
