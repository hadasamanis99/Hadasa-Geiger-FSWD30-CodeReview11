<?php

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "cr11_hadasa_geiger_php_car_rental";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "\n");
}

$sql = "select car.brand brand, car.Type typ, car.Year_production year, car.mileage miles, car.color color, location.street_name street, location.Zip zip from car join location on location.pk_Location_id=car.fk_Car_Location where location.City = 'Wien';"; 

$results = $conn->query($sql);       

$data=array();
while($row=$results->fetch_assoc())
{
    $data[] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Carrental</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous"> 
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/style.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
</head>
<body style="background-image:url(img1/pic2.jpg); height: 100%; background-repeat: no-repeat;background-size: cover;">

    <h1 style="font-size: 60px;color: #303030; font-weight: 600;font-family: 'Anton'; text-align: center;">Car R E N T A L </h1>      

<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item">
         <a class="nav-link" href="cars_list.php">Car List</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="office_list.php">Location List</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="cars_locations.php">Car and Location</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="cars_per_location.php">No.of cars per Location</a>
      </li>
       <li class="nav-item">
         <a class="nav-link" href="gMap.php">Office Locations on Google Map</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Sign up</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="login.php">Log in</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="logout.php">Log out</a>
      </li>
    </ul>
    
  </div>
</nav>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>

 
   
    