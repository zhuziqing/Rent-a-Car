<?php
require_once "config.php";
$userlis = $_COOKIE["Userlis"];
if(!isset ($_COOKIE["Userlis"])){
  header("Location: cregister.php");
}
$sql = "select fName from Customer where driverLiscense = '$userlis'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$storefname = $stmt->fetch();
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Customer Home Page</title>

    <link rel="stylesheet" type="text/css" href="public/css/cindex.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="public/js/cindex.js"></script>

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
    </section>
    <h3>Welcome!
    <?php
    $userfName=$storefname['fName'];
    echo "$userfName";
    ?>
    </h3>
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
          <h4>Here are all your reservations:</h4>
          <table style="width:100%">
        <tr>
        <th>Comfirm Number</th>
        <th>Start Date and Time</th>
        <th>End Date and Time</th>
        <th>City and Location</th>
        <th>Vehicle Type</th>
        <th>Reservation Made Date</th>
        </tr>
        <?php
          $sql1 = "select * from Reservation where driverLiscense = '$userlis'";
          $stmt1 = $pdo->prepare($sql1);
          $stmt1->execute();
          while($all = $stmt1->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
            <th> <?php echo $all["confNum"] ?></th>
            <th> <?php echo $all["fdatetime"] ?></th>
            <th> <?php echo $all["edatetime"] ?></th>
            <th> <?php echo $all["lc"] ?></th>
            <th> <?php echo $all["vtname"] ?></th>
            <th> <?php echo $all["rdate"] ?></th>
            </tr>
            <?php } ?>
        </table>
        <br>
          </section>
  </body>
</html>
