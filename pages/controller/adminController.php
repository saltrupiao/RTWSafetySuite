<?php

    $serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $empID = $_GET['empID'];
        echo "<h1>".$empID."</h1>";
    }