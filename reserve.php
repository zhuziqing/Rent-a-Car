<?php
require_once "config.php";
session_start();
if(!isset ($_COOKIE["Userlis"])){
  header("Location: cregister.php");
}
$userlis = $_COOKIE["Userlis"];
$fdate="";
$ftime ="";
$edate="";
$etime="";
$ct="";
$lc="";
$warning="";
$message="";
$c="";
$d="";
$cdate=date('Y-m-d h:i:s',time());

//variables for comfirm
$card="";
$expyear="";
$expmonth="";
$cvv="";
$expdate="";
$type="";
$warning2="";
$result="";

if(isset($_POST['reserve_button'])){
  $fdate=$_POST['fdate'];
  $ftime =$_POST['ftime'];
  $edate=$_POST['edate'];
  $etime=$_POST['etime'];
  $ct=$_POST['ct_select'];
  $lc=$_POST['lc_select'];
  $c=$fdate. " " .$ftime.":00";
  $d=$edate. " " .$etime.":00";


  $_SESSION['c']=$c;
  $_SESSION['d']=$d;
  $_SESSION['ct']=$ct;
  $_SESSION['lc']=$lc;
  $a="'". " " .$fdate. " " .$ftime .":00". " " ."'";
  $b="'". " " .$edate. " " .$etime .":00". " " ."'";

  if($fdate==""||$ftime==""||$edate==""||$etime==""||$ct==""||$lc==""){
    $warning ="Please fill all the fields";
  }else if(strtotime($c)<strtotime($cdate)){
    $warning="Start Date Must Happen In The Future!";
   }else if( strtotime($d)<=strtotime($c)){
    $warning="End Date Must Be Later Than Start Date!";
  }
  else {
    $sql1 = "select * from Vehicles where vlicence not in (select r.vlicence from Rentals r,Vehicles v where r.vlicence=v.vlicence and v.vtname='$ct' and v.lc='$lc' and ((UNIX_TIMESTAMP(r.fdatetime)<UNIX_TIMESTAMP($a) and UNIX_TIMESTAMP($a)<UNIX_TIMESTAMP(r.edatetime)) or (UNIX_TIMESTAMP(r.fdatetime)<
    UNIX_TIMESTAMP($b) and UNIX_TIMESTAMP($b)<UNIX_TIMESTAMP(r.edatetime))) and r.odemeter is NULL) and vtname='$ct' and lc='$lc' and status!='maintenance'";

    $stmt = $pdo->prepare($sql1);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $warning ="There are availavle vehicles, please fill the following fields.";
    }
    else{
      $warning ="Sorry, there is no available vehicles";
      $warning ="There are availavle vehicles, please fill the following fields.";
    }
  }
}
  if(isset($_POST['confirm_button'])){
  $card=$_POST['card'];
  $expyear=$_POST['expyear'];
  $expmonth=$_POST['expmonth'];
  $cvv=$_POST['cvv'];
  $expDate = $expyear."-".$expmonth;
    if(strlen($card)!=16){
      $warning2 = "Invlid Card Number!";
      $warning ="There are availavle vehicles, please fill the following fields.";
    }

    if(substr($card, 0,1) == "4"){
      $type = "VISA";
    }else if(substr($card,0,1) == "5"){
      $type = "MSTR";
    }else if(substr($card,0,1) == "3"){
      $type = "AMEX";
    }else{
      $warning2 = "Unaccepted Payment Method, Credit Card Only";
      $warning ="There are availavle vehicles, please fill the following fields.";
    }
    $e= $_SESSION['c'];
    $f=$_SESSION['d'];
    $ct1=$_SESSION['ct'];
    $lc1=$_SESSION['lc'];
    if($warning2==""){

    //insert new query to reservation
    $sql="insert into Reservation values(NULL,'$userlis','$e','$f','$lc1','$ct1','$cdate','$type','$card','$expDate','$cvv')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();



    //find confirmation number
    $sql1="select max(confNum) from Reservation";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();
    $m=$stmt1->fetch();
    $result=$m[0];

  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Customer Reserve Page</title>
    <link rel="stylesheet" type="text/css" href="public/css/cindex.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>
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
    <h3> Please make a reservation here:</h3>
    <?php
    if($result!=""){?>
     <p style="color: red; font-weight: bold;">Reservation Complete Successfully! Your Comfirmation Number is: <?php echo $result?></p>
     <?php }
    ?>
    </section>
      <section id="first">
      <form class="" method="post">
      <div class="">
        <h6>Please select location:</h6>
         <select class="" name="lc_select">
           <option value="">---</option>
        <?php
        $sql = "select * from Location";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while($allcity = $stmt->fetch(PDO::FETCH_ASSOC)){
         ?>
          <option value="<?php echo $allcity["lc"] ?>"><?php echo $allcity["lc"] ?></option>
         <?php } ?>>
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
      <input type="submit" name="reserve_button" value="submit">
      </form>
      <?php
      if($warning==""){

      }
      else if($warning =="Please fill all the fields"|| $warning=="Sorry, there is no available vehicles"
      || $warning=="Start Date Must Happen In The Future!"|| $warning=="End Date Must Be Later Than Start Date!")
      {?>
       <p style="color: red; font-weight: bold;"><?php echo $warning?></p>

       <?php } else if($warning =="There are availavle vehicles, please fill the following fields."){?>
          <p style="color: blue; font-weight: bold;"><?php echo $warning?></p>
      </section>
          <section id="first">
           <form method="post">
             <div class="">
             <h6>Credit Card Number:</h6>
             <input type="text" name="card"  placeholder="_ _ _ _ / _ _ _ _ / _ _ _ _" required>
             </div>
             <div class="">
             <h6>Expire Year:</h6>
             <input type="text" name="expyear" required>
             </div>
             <div class="">
             <h6>Expire Month:</h6>
             <input type="text" name="expmonth"  required>
             </div>
             <div class="">
             <h6>CVV/CVC:</h6>
             <input type="text" name="cvv"  required>
             </div>

             <?php  if($warning2=="Invlid Card Number!"||$warning2=="Unaccepted Payment Method, Credit Card Only"){?>
              <p style="color: red; font-weight: bold;"><?php echo $warning2?></p>
              <?php  }?>
            <input type="submit" name="confirm_button" value="Comfirm">
           </form>

           <?php  }
       ?>
          </section>
  </body>
</html>
