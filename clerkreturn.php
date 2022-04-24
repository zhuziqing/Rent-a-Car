<?php
require_once "config.php";
$vid="";
$error="";
$flag="";
$vid2="";
$odemeter="";
$cost="";
$fulltank="";
$flag2="";
$days="";
$dayRate="";
$kiloRate="";


if(isset($_POST['search_buttom'])){
   $vid=$_POST['vid'];
   $sql="select * from Rentals where vlicence='$vid'";
   $stmt = $pdo->prepare($sql);
   $stmt->execute();
   if($stmt->rowCount()==0){
     $error="This vehicle isn't rented!";
     $flag="1";
  }else{
    $sql4="select cost from Rentals where vlicence='$vid'";
    $stmt4 = $pdo->prepare($sql4);
    $stmt4->execute();
    $t=$stmt4->fetch();
    $cos=$t[0];
    if($cos!=NULL){
      $error="This vehicle has been returned!";
      $flag="1";
    }else{
   $error="The vehicle is rented!";
   $flag="1";

 }
 }
 }

 if(isset($_POST['return_buttom'])){
    $vid2=$_POST['vid2'];

    $odemeter=$_POST['odemeter'];
    $fulltank=$_POST['fulltank'];
    $sql2="select edatetime from Rentals where vlicence ='$vid2'";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute();
    $r=$stmt2->fetch();
    $ed=$r[0];

    //calculate cost
    $sql="select * from Rentals where vlicence='$vid2'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $all = $stmt->fetch(PDO::FETCH_ASSOC);
    $fd1=$all["fdatetime"];
    $ed1=$all["edatetime"];
    $fd2=new DateTime($fd1);
    $ed2=new DateTime($ed1);
    $days = $fd2->diff($ed2)->days;

    $sql4="select dayRate,kiloRate from Vtype a, Vehicles b where a.vtname =b.vtname and b.vlicence='$vid2'";
    $stmt4 = $pdo->prepare($sql4);
    $stmt4->execute();

    $all4 = $stmt4->fetch(PDO::FETCH_ASSOC);
    $dayRate = $all4["dayRate"];
    $kiloRate = $all4["kiloRate"];
    $cost=$days * $dayRate+ $kiloRate * $odemeter;
    echo "$cost";

    //update query from Rentals
    $sql1="update Rentals set odemeter='$odemeter',fulltank='$fulltank',cost='$cost',rdatetime='$ed'where vlicence='$vid2'";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();
    $sql3="update Vehicles set status='available' where vlicence='$vid2'";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute();
    $flag2="1";
  }
 ?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Clerk Return Page</title>

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
        <h3> Vehicle Number: </h3>
        <input type="text" name="vid" value="">
        <input type="submit" name="search_buttom" value="Search">
        </form>
    </section>
    <?php
    if($flag="1"){?>
    <h4><?php echo "$error";?></h4> <?php }?>
    <?php if($error=="The vehicle is rented!"){ ?>
     <section id="first">
       <form class="" method="post">
      <div class="">
        <h6>Vehicle Number</h6>
        <input type="text" name="vid2" value="" required>
      </div>
      <div class="">
        <h6>odemeter</h6>
        <input type="text" name="odemeter" value="" required>
      </div>
      <div class="">
          <h6>fulltank</h6>
          <input type="text" name="fulltank" value="" required>
      </div>
      <!-- <div class="">
        <h6>total cost</h6>
        <input type="text" name="cost" value=""required>
      </div> -->
      <br>
    <input type="submit" name="return_buttom" value=" Return">
    </form>
    </section>
  <?php } ?>
  <?php if ($flag2="1"){ ?>
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
  $sql="select * from Rentals where vlicence='$vid2'";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  while($all = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
     <th>
      <h3 class="recipe">Recipe:</h3>
      <?php if ($all["confNum"]!=NULL){?>
    <p>Comfirmation Number: <?php echo $all["confNum"] ?> </p>
  <?php }else {?>
    <p>Rental Number: R<?php echo $all["rid"]?> </p>
  <?php } ?>
    <p>Vehicle Number: <?php echo $all["vlicence"] ?> </p>
    <p>Start Date and Time: <?php echo $all["fdatetime"] ?> </p>
    <p>End Date and Time: <?php echo $all["edatetime"] ?> </p>
    <p>Odemeter: <?php echo $all["odemeter"]?>km </p>
    <p>Fulltank: <?php echo $all["fulltank"] ?> </p>
    <p>cost: <?php echo $all["cost"]?>$ (<?php echo$days?>days * dayRate +<?php echo $odemeter?>km * kiloRate)</p>
    </th>

    <?php } ?>
</table>
</section>
<?php } ?>
  </body>
</html>
