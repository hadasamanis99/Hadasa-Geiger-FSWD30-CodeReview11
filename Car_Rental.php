
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="Car_Rental.css">
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>CAR RENTAL</title>
  <script>

function showTable(index) { 
  for(var i = 0; i < 8; i++) document.getElementById("table"+i).style.visibility="hidden";
  document.getElementById("table"+index).style.visibility="visible";
}
</script>  
</head>
<body>
	 <div class="container">
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CAR Rental</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="javascript:showTable(0)">Car</a></li>
      <li><a href="javascript:showTable(1)">Management</a></li>
      <li><a href="javascript:showTable(2)">Location</a></li>
      <li><a href="javascript:showTable(3)">Insurance</a></li>
      <li><a href="javascript:showTable(4)">Customer</a></li>

    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="jumbotron" style="background-image: url('img1/pic1.jpg');" href= "";"filter: opacity:30%">
  	<!--<img src="img1/pic1.jpg" alt="">-->

  	<h1 style="color: Brown;padding:20px;"> Find Great Deals for Car Rental</h1>
  
</div>
</div>
</div>

<?php
class TableRows extends RecursiveIteratorIterator {
     function __construct($it) {
         parent::__construct($it, self::LEAVES_ONLY);
     }

     function current() {
         return "<td style='width:150px;border:1px solid black;'>" . 
parent::current(). "</td>";
     }

     function beginChildren() {
         echo "<tr>";
     }

     function endChildren() {
         echo "</tr>" . "\n";
     }
}

class TableHeaders extends RecursiveIteratorIterator {
     function __construct($it) {
         parent::__construct($it, self::LEAVES_ONLY);
     }

     function current() {
         return "<th>" . parent::current(). "</th>";
     }

     function beginChildren() {
         echo "";
     }

     function endChildren() {
         echo "" . "\n";
     }
}


$servername = "localhost";
$username = "root";
$password = "";

try {
     $conn = new 
PDO("mysql:host=$servername;dbname=car_rental", 
$username, $password);
     // set the PDO error mode to exception
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $tables = array("car", "management", "location", "insurance", "customer","invoice", "rental_insurance", "reservation");


     $arrlength = count($tables);
 
     for($x = 0; $x < $arrlength; $x++) {
         echo  "<div style='visibility: hidden' id='table" . $x . "'>";
         echo "<table style='border: solid 1px black;'>";
         echo "<tr>";
         $stmt = $conn->prepare("SELECT COLUMN_NAME FROM 
INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 
'car_rental' AND TABLE_NAME = '" . $tables[$x] . "';");
         $stmt->execute();
         $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
         foreach(new TableHeaders(new 
RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
             echo "{$v}";
         }
         echo "</tr>";
         $stmt = $conn->prepare("SELECT * FROM ". $tables[$x] . ";");
         $stmt->execute();
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
         foreach(new TableRows(new 
RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
             echo $v;
         }
         echo "</table>";
          echo  "<div>";
         echo "<br>";
     }
     $conn = null;

} catch(PDOException $e)     {
     echo "Connection failed: " . $e->getMessage();
}
?>



<!--
Management
      <li><a href="javascript:showTable(2)">Location</a></li>
      <li><a href="javascript:showTable(3)">Insurance</a></li>
      <li><a href="javascript:showTable(4)">Customer</a></li>
-->

</body>


