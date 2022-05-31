<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "sirri";
    $conn = new mysqli($servername, $username, $password, $dbname);

   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
   
   $sql ="update agri SET led=1 WHERE ID=1";
   
   if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
   } 
   else {
      echo "Error: " . $sql . " => " . $conn->error;
   }
   $conn->close();
?>


