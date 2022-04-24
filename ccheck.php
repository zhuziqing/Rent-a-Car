<?php
require_once "config.php";
if(!isset ($_COOKIE["Userlis"])){
  header("Location: cregister.php");
}
$userlis = $_COOKIE["Userlis"];
$sql = "select fName from Customer where driverLiscense = '$userlis'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$storefname = $stmt->fetch();


//get current date
$cdate=date('y-m-d h:i:s',time());
// echo strtotime($cdate);

$lc="";
$ctype="";
$fdate="";
$ftime="";
$edate="";
$etime="";
$message="";
$sql1="";
$a="";
$b="";
$warning="";
$error="";

if(isset($_POST['search_buttom'])){
  $lc=$_POST['lc_select'];
  $ctype=$_POST['ct_select'];
  $fdate=$_POST['fdate'];
  $ftime=$_POST['ftime'];
  $edate=$_POST['edate'];
  $etime=$_POST['etime'];
  $a="'". " " .$fdate. " " .$ftime .":00". " " ."'";
  $b="'". " " .$edate. " " .$etime .":00"." " ."'";
  $c=$fdate. " " .$ftime.":00";
  $d=$edate. " " .$etime.":00";
  //  echo strtotime($a);
  // echo $a;


if(($fdate!=""&&($ftime==""||$edate==""||$etime==""))
   ||($ftime!=""&&($fdate==""||$edate==""||$etime==""))
   ||($edate!=""&&($ftime==""||$fdate==""||$etime==""))
   ||($etime!=""&&($ftime==""||$edate==""||$fdate==""))){
     $warning="Please fill out a completed time interval!";
   }
else if($fdate!=""&&$ftime!=""&&$edate!=""&&$etime!=""&&$ctype!=""&&$lc!=""){
$sql1 = "select * from Vehicles where vlicence not in (select r.vlicence from Rentals r,Vehicles v where r.vlicence=v.vlicence and v.vtname='$ctype' and v.lc='$lc' and ((UNIX_TIMESTAMP(r.fdatetime)<UNIX_TIMESTAMP($a) and UNIX_TIMESTAMP($a)<UNIX_TIMESTAMP(r.edatetime)) or (UNIX_TIMESTAMP(r.fdatetime)<
UNIX_TIMESTAMP($b) and UNIX_TIMESTAMP($b)<UNIX_TIMESTAMP(r.edatetime))) and r.odemeter is NULL) and vtname='$ctype' and lc='$lc' and status!='maintenance'";

 if(strtotime($c)<strtotime($cdate)){
  $warning="Start Date Must Happen In The Future!";
 }else if( strtotime($d)<=strtotime($c)){
  $warning="End Date Must Be Late Than Start Date!";
 }else{
  $stmt = $pdo->prepare($sql1);
  $stmt->execute();
  $message=$stmt->rowCount();
  if($message==""){
    $error="1";
  }
}
}else if($fdate==""&&$ftime==""&&$edate==""&&$etime==""&&$ctype==""&&$lc!=""){
  $sql1 = "select * from Vehicles where vlicence not in (select vlicence from Rentals where odemeter is NULL) and lc='$lc'and status!='maintenance'";
  $stmt = $pdo->prepare($sql1);
  $stmt->execute();
  $message=$stmt->rowCount();
  if($message==""){
    $error="1";
  }

}else if($fdate==""&&$ftime==""&&$edate==""&&$etime==""&&$ctype!=""&&$lc==""){
  $sql1 = "select * from Vehicles where vlicence  not in (select vlicence from Rentals where odemeter is NULL) and vtname ='$ctype'and status!='maintenance'";
  $stmt = $pdo->prepare($sql1);
  $stmt->execute();
  $message=$stmt->rowCount();
  if($message==""){
    $error="1";
  }
}
else if($fdate!=""&&$ftime!=""&&$edate!=""&&$etime!=""&&$ctype==""&&$lc==""){
  $sql1 = "select * from Vehicles where vlicence not in (select r.vlicence from Rentals r,Vehicles v where r.vlicence=v.vlicence and ((UNIX_TIMESTAMP(r.fdatetime)<UNIX_TIMESTAMP($a) and UNIX_TIMESTAMP($a)<UNIX_TIMESTAMP(r.edatetime)) or (UNIX_TIMESTAMP(r.fdatetime)<
  UNIX_TIMESTAMP($b) and UNIX_TIMESTAMP($b)<UNIX_TIMESTAMP(r.edatetime))) and r.odemeter is NULL) and status!='maintenance'";
  if(strtotime($c)<strtotime($cdate)){
    $warning="Start Date Must Happen In The Future!";
   }else if( strtotime($d)<=strtotime($c)){
    $warning="End Date Must Be Later Than Start Date!";
   }else{
  $stmt = $pdo->prepare($sql1);
  $stmt->execute();
  $message=$stmt->rowCount();
  if($message==""){
    $error="1";
  }
  }
}  else if($fdate==""&&$ftime==""&&$edate==""&&$etime==""&&$ctype!=""&&$lc!=""){
  $sql1 = "select * from Vehicles where vlicence not in (select vlicence from Rentals where odemeter is NULL) and lc='$lc'and vtname ='$ctype'and status!='maintenance'";
  $stmt = $pdo->prepare($sql1);
  $stmt->execute();
  $message=$stmt->rowCount();
  if($message==""){
    $error="1";
  }
} else if($fdate!=""&&$ftime!=""&&$edate!=""&&$etime!=""&&$ctype!=""&&$lc==""){
  $sql1 = "select * from Vehicles where vlicence not in (select r.vlicence from Rentals r,Vehicles v where r.vlicence=v.vlicence and v.vtname='$ctype' and ((UNIX_TIMESTAMP(r.fdatetime)<UNIX_TIMESTAMP($a) and UNIX_TIMESTAMP($a)<UNIX_TIMESTAMP(r.edatetime)) or (UNIX_TIMESTAMP(r.fdatetime)<
  UNIX_TIMESTAMP($b) and UNIX_TIMESTAMP($b)<UNIX_TIMESTAMP(r.edatetime))) and r.odemeter is NULL) and vtname='$ctype' and status!='maintenance'";
if(strtotime($c)<strtotime($cdate)){
  $warning="Start Date Must Happen In The Future!";
 }else if( strtotime($d)<=strtotime($c)){
  $warning="End Date Must Be Later Than Start Date!";
 }else{
  $stmt = $pdo->prepare($sql1);
  $stmt->execute();
  $message=$stmt->rowCount();
  if($message==""){
    $error="1";
  }
  }
} else if($fdate!=""&&$ftime!=""&&$edate!=""&&$etime!=""&&$ctype==""&&$lc!=""){
  $sql1 = "select * from Vehicles where vlicence not in (select r.vlicence from Rentals r,Vehicles v where r.vlicence=v.vlicence and v.lc='$lc' and ((UNIX_TIMESTAMP(r.fdatetime)<UNIX_TIMESTAMP($a) and UNIX_TIMESTAMP($a)<UNIX_TIMESTAMP(r.edatetime)) or (UNIX_TIMESTAMP(r.fdatetime)<
  UNIX_TIMESTAMP($b) and UNIX_TIMESTAMP($b)<UNIX_TIMESTAMP(r.edatetime))) and r.odemeter is NULL) and lc='$lc' and status!='maintenance'";
if(strtotime($c)<strtotime($cdate)){
  $warning="Start Date Must Happen In The Future!";
 }else if( strtotime($d)<=strtotime($c)){
  $warning="End Date Must Be Later Than Start Date!";
 }else{
  $stmt = $pdo->prepare($sql1);
  $stmt->execute();
  $message=$stmt->rowCount();
  if($message==""){
    $error="1";
  }
  }
}else if($fdate==""&&$ftime==""&&$edate==""&&$etime==""&&$ctype==""&&$lc==""){
  $sql1 = "select * from Vehicles where status!='maintenance'";
  $stmt = $pdo->prepare($sql1);
  $stmt->execute();
  $message=$stmt->rowCount();
  if($message==""){
    $error="1";
  }
}
}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Customer Check Page</title>

    <link rel="stylesheet" type="text/css" href="public/css/cindex.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="public/js/cindex.js"></script>

  </head>
  <body>
  <?php


  echo '
  <script>

  $(document).ready(function() {
    $("#second").hide();
    $("#first").show();

  });

  </script>

  ';



?>
    <section>
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #e3f2fd">
      <a class="navbar-brand" href="cindex.php">SuperRent</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link active" href="cindex.php">Home Page</a>
          <a class="nav-item nav-link active" href="ccheck.php">Check Vehicle</a>
          <a class="nav-item nav-link active" href="reserve.php">Reserve Vehicle</a>
          <a class="nav-item nav-link active" href="clogout.php">Log Out</a>
        </div>
      </div>
    </nav>
    </section>
    <h3>Please check available vehicles here:</h3>
    <section id="first">
      <form class=""  method="post">
     <div class="">
        <h6>Please select loctaion:</h6>
        <select class="" name="lc_select">
        <option value="">---</option>
       <?php
       $sql = "select * from Location";
       $stmt = $pdo->prepare($sql);
       $stmt->execute();

       while($allcity = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
         <option value="<?php echo $allcity["lc"] ?>"><?php echo $allcity["lc"] ?></option>
        <?php } ?>
        </select>
        </div>
        <div class="">
        <h6>Please select a car type:</h6>
        <select class="" name="ct_select">
        <option value="">---</option>
       <?php
       $sql = "select * from Vtype";
       $stmt = $pdo->prepare($sql);
       $stmt->execute();

       while($alltype = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
         <option value="<?php echo $alltype["vtname"] ?>"><?php echo $alltype["vtname"] ?></option>
        <?php } ?>
        </select>
      </div>
      <div class="">
        <h6>Please select a Start Date:</h6>
         <input type="date" name="fdate" value="">
      </div>
      <div class="">
        <h6>Please select a Start Time:</h6>
         <input type="time" name="ftime" value="">
      </div>
        <div class="">
          <h6>Please select an End Date:</h6>
          <input type="date" name="edate" value="">
        </div>
       <div class="">
         <h6>Please select an End Time:</h6>
        <input type="time" name="etime" value="">
       </div>
       <?php if ($warning!="" ){?>
      <p style="color: red; font-weight: bold;"><?php echo $warning?></p>
      <?php } ?>
      <input type="submit" class="submit" name="search_buttom" value="Search">
      <br>
      <?php if ($error=="1" ){?>
        <?php echo "There's no available car";}
        else if($message!=""){?>
         <a href="#" id="detail">There are <?php echo $message ?> car available</a>
        <?php }?>
      <br>
      </form>
      </section>

      <section id="second">
        <style>
        table, th{
        border: 1px solid black;
        border-collapse: collapse;
        }
        th {
        padding: 5px;
        text-align: left;
        }</style>
      <h4>Available vehicles details:</h4>
      <table style="width:100%">
    <tr>
    <th> Vlicence </th>
    <th>Make</th>
    <th>Model</th>
    <th>Year</th>
    <th>Odemeter</th>
    <th>Status</th>
    <th>Color</th>
    <th>Location and City</th>
    <th>Vehicle Type</th>
    </tr>
    <?php
      $stmt = $pdo->prepare($sql1);
      $stmt->execute();
      while($all = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
        <th> <?php echo $all["vlicence"] ?></th>
        <th> <?php echo $all["make"] ?></th>
        <th> <?php echo $all["model"] ?></th>
        <th> <?php echo $all["year"] ?></th>
        <th> <?php echo $all["odemeter"] ?></th>
        <th> <?php echo $all["status"] ?></th>
        <th> <?php echo $all["color"] ?></th>
        <th> <?php echo $all["lc"] ?></th>
        <th> <?php echo $all["vtname"] ?></th>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="#" id="back"> Go Back</a>
      </section>

  </body>
</html>
