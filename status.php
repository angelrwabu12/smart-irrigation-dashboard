<?php 
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "sirri";

    //creat connection
    $conn = new mysqli($serverName,$userName, $password, $dbName);

    $query = "Select * FROM agri WHERE id=1";
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($res);
    $i_status = $data['led'];
    echo $i_status;
	//$json= json_encode($i_status, JSON_PRETTY_PRINT);
    //header('Content-Type: application/json');
    //echo $json;
?>