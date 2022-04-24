<?php
setcookie("Userlis", $ldriverlis, time()-1);
session_destroy();
header("Location: cregister.php");
?>
