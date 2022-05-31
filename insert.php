<?php
if(isset($_GET["temp"]) && isset($_GET["hum"])&& isset($_GET["water"])) {
   $temp = $_GET["temp"]; // get temperature value from HTTP GET
   $hum = $_GET["hum"]; // get humidity value from HTTP GET
   $water = $_GET["water"]; // get water value from HTTP GET
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "sirri";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
    $sql ="update agri SET hum='$hum',temp='$temp',water='$water' WHERE ID=1";
   if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
   } else {
      echo "Error: " . $sql . " => " . $conn->error;
   }
   $conn->close();
} else {
   echo "Humidity,Temperature and water are not set";
}
?>