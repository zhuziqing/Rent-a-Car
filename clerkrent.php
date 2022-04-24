<?php
require_once "config.php";
$confNum="";
$error="";
$flag="";
$sql="";
//variable for rent
$edate="";
$etime="";
$ct="";
$lc="";
$warning="";
$message="";
$c="";
$d="";
$cdate=date('Y-m-d h:i:s',time());
$a="'". " ".$cdate. " "."'";


//variables for comfirm
$card="";
$expyear="";
$expmonth="";
$cvv="";
$expdate="";
$type="";
$warning2="";
$result="";
$driverlis="";
//rent information
$rid="";
$message="";

if(isset($_POST['search_buttom'])){
   $confNum=$_POST['confNum'];
   $sql4="select * from Rentals where confNum='$confNum'";
   $stmt4 = $pdo->prepare($sql4);
   $stmt4->execute();
   if($stmt4->rowCount()!=0){
    $error="This reservation has been processed.";
    $flag="1";
  }else{
   $sql="select * from Reservation where confNum='$confNum'";
   $stmt = $pdo->prepare($sql);
   $stmt->execute();
   if($stmt->rowCount()==0){
    $error="There is no such reservation.";
    $flag="1";
  } else{
      $all = $stmt->fetch(PDO::FETCH_ASSOC);
      $ct = $all["vtname"];
      $lc=$all["lc"];
      $driverlis=$all["driverLiscense"];
      $cardType=$all["cardType"];
      $card=$all["cardNo"];
      $expDate=$all["ExpDate"];
      $cvv=$all["cvv"];
      $fd=$all["fdatetime"];
      $ed=$all["edatetime"];


      $sql1 = "select vlicence from Vehicles where vtname = '$ct' and status='available' and lc='$lc'";
      $stmt1 = $pdo->prepare($sql1);
      $stmt1->execute();
      $res=$stmt1->fetch(PDO::FETCH_ASSOC);
      $vid=$res["vlicence"];
      $sql2="insert into Rentals values(null,'$vid','$driverlis','$fd','$ed','$cardType','$card','$expDate','$cvv','$confNum',NULL,NULL,NULL,NULL)";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->execute();
      $error="The reservation is processed successfully!";
      $flag="1";
      $sql5="update  Vehicles set status='rented' where vlicence = '$vid'";
      $stmt5 = $pdo->prepare($sql5);
      $stmt5->execute();

  }
}
}
if(isset($_POST['rent_buttom'])){
  $driverlis=$_POST['driverLiscense'];
  $edate=$_POST['edate'];
  $etime=$_POST['etime'];
  $ct=$_POST['ct_select'];
  $lc=$_POST['lc_select'];
  $d=$edate. " " .$etime.":00";
  //card information
  $card=$_POST['card'];
  $expyear=$_POST['expyear'];
  $expmonth=$_POST['expmonth'];
  $cvv=$_POST['cvv'];
  $expDate = $expyear."-".$expmonth;

  $b="'". " " .$edate. " " .$etime .":00". " " ."'";
  $a="'". " ".$cdate. " "."'";


  if($driverlis==""||$edate==""||$etime==""||$ct==""||$lc==""){
    $warning ="Please fill all the fields";
  }else if( strtotime($d)<=strtotime($cdate)){
    $warning="End Date Must Be Later Than Now!";
  }
  else {
    $sql1 = "select * from Vehicles where vlicence not in (select r.vlicence from Rentals r,Vehicles v where r.vlicence=v.vlicence and v.vtname='$ct' and v.lc='$lc' and ((UNIX_TIMESTAMP(r.fdatetime)<UNIX_TIMESTAMP($a) and UNIX_TIMESTAMP($a)<UNIX_TIMESTAMP(r.edatetime)) or (UNIX_TIMESTAMP(r.fdatetime)<
    UNIX_TIMESTAMP($b) and UNIX_TIMESTAMP($b)<UNIX_TIMESTAMP(r.edatetime))) and r.odemeter is NULL) and vtname='$ct' and lc='$lc' and status!='maintenance'";
    $stmt = $pdo->prepare($sql1);
    $stmt->execute();
    if($stmt->rowCount()==0){
      $warning ="Sorry, there is no available vehicles";
    }else{
      if(strlen($card)!=16){
        $warning = "Invlid Card Number!";

      }

      if(substr($card, 0,1) == "4"){
        $type = "VISA";
      }else if(substr($card,0,1) == "5"){
        $type = "MSTR";
      }else if(substr($card,0,1) == "3"){
        $type = "AMEX";
      }else{
        $warning2 = "Unaccepted Payment Method, Credit Card Only";
      }
      if($warning==""&&$warning2==""){
        $sql2 = "select vlicence from Vehicles where vtname = '$ct' and status='available' and lc='$lc'";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute();
        $res=$stmt2->fetch(PDO::FETCH_ASSOC);
        $vid=$res["vlicence"];

        $sql3="insert into Rentals values(NULL,'$vid', '$driverlis','$cdate','$d','$type','$card','$expDate','$cvv',NULL,NULL,NULL,NULL,NULL)";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->execute();
        $sql4="update Vehicles set status='rented' where vlicence = '$vid'";
        $stmt4 = $pdo->prepare($sql4);
        $stmt4->execute();
        $message="Vehicle is rented successfully!";
        $sql5="select max(rid) from Rentals";
        $stmt5 = $pdo->prepare($sql5);
        $stmt5->execute();
        $r=$stmt5->fetch();
        $rid=$r[0];


      }
    }
  }

}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Clerk Rent Page</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="public/css/clerk.css">

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
          <a class="nav-item nav-link active" href="clerkrent.php">Rent Vehicle</a>
          <a class="nav-item nav-link active" href="clerkreturn.php">Return Vehicle</a>
          <a class="nav-item nav-link active" href="clerkreport.php">Generte Report</a>
          <a class="nav-item nav-link active" href="cregister.php">Log Out</a>
        </div>
      </div>
    </nav>
    </section>
    <section id="first">
      <form class=""  method="post">
        <h3> Comfirmation Number: </h3>
        <input type="text" name="confNum" value="">
        <input type="submit" name="search_buttom" value="Search and Process">
      </form>
    </section>
      <?php
      if($flag="1"){?>
      <h4><?php echo "$error";?></h4> <?php }?>
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
          <table style="width:100%">
        <?php
          $sql="select * from Reservation where confNum='$confNum'";
          $stmt = $pdo->prepare($sql);
          $stmt->execute();
          while($all = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
             <th>
              <h3 class="recipe">Recipe:</h3>
            <p>Comfirmation Number: <?php echo $all["confNum"] ?> </p>
            <p>Location and City: <?php echo $all["lc"] ?> </p>
            <p>Vehicle Type: <?php echo $all["vtname"] ?> </p>
            <p>Start Date and Time: <?php echo $all["fdatetime"] ?> </p>
            <p>End Date and Time: <?php echo $all["edatetime"] ?> </p>
            <p>Reservation Made Date: <?php echo $all["rdate"] ?> </p>

             </th>

            <?php } ?>
        </table>
        </section>
        <section id="first">
        <form class="" method="post">
          <?php if($message!=""){?>
            <p style="color: red; font-weight: bold; text-align:left; "><?php echo"$message" ?></p>
            <p style="color: red; font-weight: bold; text-align:left; ">Your rental number is R<?php echo "$rid" ?></p>
          <?php } ?>
          <div class="">
            <h6>Customer Driver Liscense Number:</h6>
            <input type="text" name="driverLiscense" value="" required>
          </div>
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
              <h6>Please select an End Date:</h6>
              <input type="date" name="edate" value="">
            </div>
           <div class="">
             <h6>Please select an End Time:</h6>
            <input type="time" name="etime" value="">
           </div>
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
              <?php  if($warning!=""){?>
               <p style="color: red; font-weight: bold; text-align:left; "><?php echo $warning;?></p>
             <?php } else if($warning2!=""){?>
             <p style="color: red; font-weight: bold; text-align:left;"><?php echo $warning2;?></p>
            <?php  }  ?>
            <br>
          <input type="submit" name="rent_buttom" value="Rent and Process">
        </form>
          </section>

  </body>
</html>
