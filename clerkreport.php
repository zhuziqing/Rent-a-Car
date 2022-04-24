<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Clerk Report Page</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="public/css/clerk.css">
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
<section id=first>
<?php
    require_once "config.php";
    $cdate=date('y-m-d',time());

    $sql = "select Vehicles.lc AS lc, Vehicles.vtname AS vtname, Count(vtname) AS countv from Vehicles, Rentals where Vehicles.vlicence=Rentals.vlicence and date(Rentals.fdatetime)=date(NOW()) group by lc, vtname";
?>
<h3>Daily Rentals In SuperRent</h3>
<br>
<?php
    echo "<br>Vehicles in Each Branch:<br>";
    echo "<table>";
    echo "<tr><th>Branch</th><th>Vehicle Name </th><th>Sum Of Vehicles</th></tr>";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["lc"] . "</td><td>" . $row["vtname"] . "</td><td>" . $row["countv"] ."</td></tr>";
    }
    echo "</table>";



    $sql = "select Vehicles.lc AS lc, Count(Rentals.vlicence) AS countr from Vehicles, Rentals where Vehicles.vlicence=Rentals.vlicence and date(Rentals.fdatetime)=date(NOW()) group by lc";

    echo "<br>Rentals in the Whole Company:<br>";
    echo "<table>";
    echo "<tr><th>Branch</th><th>Total Rental</th></tr>";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["lc"] . "</td><td>" . $row["countr"] ."</td></tr>";
    }
    echo "</table>";



    $sql = "select Count(Rentals.vlicence) AS countAll from Vehicles, Rentals where Vehicles.vlicence=Rentals.vlicence and date(Rentals.fdatetime)=date(NOW())";
    echo "<br>In the Whole Company<br>";
    echo "<tr><th>Total Rental: </th></tr>";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["countAll"] ."</td></tr>";
    }
    echo "</table>";

    ?>
    </section>
<section id=first>


<br>
<br>
<form class="" method="post">
<h6>Please select the specific branch</h6>
<select class="" name="br_select">
<option value="">---</option>
<?php
    $sql = "select DISTINCT lc from Vehicles";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while($allcity = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
<option value="<?php echo $allcity["lc"] ?>"><?php echo $allcity["lc"] ?></option>
<?php } ?>>
</select>
<input type="submit" name="rental_button" value="submit">
</form>

<br>


<?php
    require_once "config.php";
    if(isset($_POST['rental_button'])){
        $branch=$_POST['br_select'];

        $sql = "select Vehicles.vtname AS vtname, Count(vtname) AS countv from Vehicles, Rentals where Vehicles.vlicence=Rentals.vlicence and date(Rentals.fdatetime)=date(NOW()) and Vehicles.lc='$branch' group by lc, vtname";
?>
    <h3>Daily Rentals in <?php echo $branch ?></h3>
    <br>
    <br>
    <?php

        echo "<table>";
        echo "<tr><th>Vehicle Name </th><th>Sum Of Vehicles</th></tr>";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . $row["vtname"] . "</td><td>" . $row["countv"] ."</td></tr>";
        }
        echo "</table>";
    }
    ?>
<br>
</section>

<!-- return Report -->
<section id=first>

<?php
$sql = "select Vehicles.lc AS lc, Vehicles.vtname AS vtname, Count(vtname) AS countv, SUM(Rentals.cost) AS revenue from Vehicles, Rentals where Vehicles.vlicence=Rentals.vlicence and date(Rentals.edatetime)=date(NOW()) group by lc, vtname"; // string interpolation php date
  ?>
  <h3>Daily Returns in SuperRent</h3>
  <br>
<?php
    echo "<br>Vehicles and Revenue in Each Branch:<br>";
    echo "<table>";
    echo "<tr><th>Branch</th><th>Vehicle Name</th><th>Sum Of Vehicles</th><th>Revenue</th></tr>";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["lc"] . "</td><td>" . $row["vtname"] . "</td><td>" . $row["countv"]. "</td><td>" . $row["revenue"]. "</td></tr>";
    }
    echo "</table>";



    $sql = "select Vehicles.lc AS lc, Count(Rentals.vlicence) AS countr,SUM(Rentals.cost) AS revenue from Vehicles, Rentals where date(Rentals.edatetime)=date(NOW()) and Vehicles.vlicence=Rentals.vlicence group by lc";

    echo "<br>Total Returns in Each Branch:<br>";
    echo "<table>";
    echo "<tr><th>Branch</th><th>Total Returns</th><th>Total Revenue</th></tr>";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["lc"] . "</td><td>" . $row["countr"] ."</td><td>" . $row["revenue"] ."</td></tr>";
    }
    echo "</table>";



    $sql = "select Count(Rentals.vlicence) AS countAll, SUM(Rentals.cost) As countcost from Vehicles, Rentals where date(Rentals.edatetime)=date(NOW()) and Vehicles.vlicence=Rentals.vlicence";
    echo "<br>Returns in the Whole Company<br>";

    echo "<table>";
    echo "<tr><th>Total Number of Vehicles</th><th>Total Revenue</th></tr>";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . $row["countAll"] ."</td><td>" . $row["countcost"] ."</td></tr>";
    }
    echo "</table>";

    ?>

<br\> <br>

<form class="" method="POST">
<h6>Please select the specific branch</h6>
<select class="" name="br_select">
<option value="">---</option>
<?php
    $sql = "select DISTINCT  lc from Vehicles";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while($allcity = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
    <option value="<?php echo $allcity["lc"] ?>"><?php echo $allcity["lc"] ?></option>
<?php } ?>>
</select>
<input type="submit" name="return_button" value="submit">
</form>

<br>


<?php
    require_once "config.php";
    if(isset($_POST['return_button'])){
        $branch=$_POST['br_select'];

        $sql = "select Vehicles.vtname AS vtname, Count(vtname) AS countv, SUM(Rentals.cost) AS revenue from Vehicles, Rentals where Vehicles.vlicence=Rentals.vlicence and date(Rentals.edatetime)=date(NOW()) and Vehicles.lc='$branch' group by vtname";
     ?>
          <h3>Daily Returns in <?php echo $branch?></h3>
    <?php
        echo "<table>";
        echo "<tr><th>Vehicle Name</th><th>Sum Of Vehicles</th><th>Revenue</th></tr>";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . $row["vtname"] . "</td><td>" . $row["countv"]. "</td><td>" . $row["revenue"]. "</td></tr>";
        }
        echo "</table>";
    }
    ?>
    </section>
</body>
</html>
