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

        $sqlGetStatus = "SELECT EMP_STATUS FROM EMPLOYEE WHERE EMP_ID = '$empID'";
        $resultGetStatus = $conn->query($sqlGetStatus);

        while ($rowGetStatus = $resultGetStatus -> fetch_row()) {
            echo "<h1>" . $rowGetStatus[0] . "</h1>";
        }


        //$sqlSwitchStatus = "UPDATE EMPLOYEE SET EMP_STATUS = '$status' WHERE EMPLOYEE.EMP_ID = $currentEmpID";
        //$resultFLName = $conn->query($sqlSwitchStatus);
    }