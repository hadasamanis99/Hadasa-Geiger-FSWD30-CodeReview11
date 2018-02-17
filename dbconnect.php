<?php

 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 define('DBHOST', 'localhost');
 define('DBUSER', 'root');
 define('DBPASS', '');
 define('DBNAME', 'cr11_hadasa_geiger_php_car_rental');
 $conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
 if ( !$conn ) {
  die("Connection failed : " . mysqli_error());
 }
 ?>
