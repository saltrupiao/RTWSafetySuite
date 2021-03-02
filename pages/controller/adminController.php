<?php

    $serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);

    $newStatus = "";

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $empID = $_GET['empID'];
        echo "<h1>".$empID."</h1>";

        $sqlGetStatus = "SELECT EMP_STATUS FROM EMPLOYEE WHERE EMP_ID = '$empID'";
        $resultGetStatus = $conn->query($sqlGetStatus);

        while ($rowGetStatus = $resultGetStatus -> fetch_row()) {
            echo "<h1>" . $rowGetStatus[0] . "</h1>";
            if ($rowGetStatus[0] = "NO") {
                $newStatus = "YES";
            } else {
                $newStatus = "NO";
            }
            echo "<h1>" . $newStatus . "</h1>";
        }

        $sqlSwitchStatus = "UPDATE EMPLOYEE SET EMP_STATUS = '$newStatus' WHERE EMPLOYEE.EMP_ID = $empID";
        if ($conn->query($sqlSwitchStatus) === TRUE) {
            echo "New record inserted successfully.";
        } else {
            echo "Error: " . $sqlSwitchStatus . "<br>" . $conn->error;
        }

        $conn->close();
    }