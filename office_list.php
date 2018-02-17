<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cr11_hadasa_geiger_php_car_rental";
?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>
<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "select street_name, Zip from location where City = 'Wien'"; 
$result = $conn->query($sql);
echo "<H1>List of offices</H1>";
if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead class='table table-striped'>";
    echo "<td> Street Name </td><td>Zip Code</td>";
    echo "</thead>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr class='table table-striped'>";
        echo "<td> " . $row["street_name"] . "</td><td>" . $row["Zip"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
  