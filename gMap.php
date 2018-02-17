<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cr11_hadasa_geiger_php_car_rental";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
<?php
$sql = "select street_name, Zip from location where City = 'Wien'"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<script>";
    echo "var officeArray = [];";
  
    while($row = $result->fetch_assoc()) {
        echo "var office = { ";
        echo "address: '" . $row["street_name"] . "', zip: '" . $row["Zip"] . "' };";
        echo "officeArray.push(office); console.log(office);";
    }
    echo "</script>";
}
?>




<script>
  var geocoder;
  var map;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(48.21, 16.36);
    var mapOptions = {
      zoom: 14,
      center: latlng
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
  }

  function codeAddress() {
    for (var office in officeArray) {
        var address = office.address + ", " + office.zip;
        geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == 'OK') {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                icon: "img1/BLUE-ICON.png",
                position: results[0].geometry.location
            });
        } //else {
        //alert('Geocode was not successful for the following reason: ' + status);
      //}
    });
    }
  }
  </script>
</head>
<body onload="initialize()">
<h1>Location Map</h1>

<div id="map" style="width: 320px; height: 480px;"></div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2D9v2hT3-ZvelPdmIJ05Rmv9BEfw_hGw&libraries=geocoding&callback=codeAddress"
    async defer></script>


</body>
</html>