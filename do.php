<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "sirri";
    $conn = new mysqli($servername, $username, $password, $dbname);
	
   $query ="select * FROM agri WHERE ID=1";
   $res=mysqli_query($conn,$query);
   $data=mysqli_fetch_array($res);
   echo json_encode($data, JSON_PRETTY_PRINT); 
   ?>






