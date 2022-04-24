<?php
if(isset($_POST['clogin_button'])) {
  $cusername= $_POST['clerkuser'];
  $cpassword=$_POST['clog_password'];

  $sql = "select Cusername from Clerk where Cusername = '$cusername'";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  if ($stmt->rowCount() == 0){
  $message = "UserName Doesn't Exist";
} else {
  $sql = "select password from Clerk where password = '$cpassword'";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $storedpswd = $stmt->fetch();
  if ($storedpswd['password'] != $cpassword){
    $message = "Wrong Password";
  }else{
    header("Location: clerkrent.php");
 }

}
}
?>
