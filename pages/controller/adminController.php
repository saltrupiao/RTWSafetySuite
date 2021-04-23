<?php
    session_start();
    $serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);

    $newStatus = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $empID = $_POST['empID'];
        echo "<h1>".$empID."</h1>";

        $sqlGetStatus = "SELECT EMP_STATUS FROM employee WHERE EMP_ID = '$empID'";
        $resultGetStatus = $conn->query($sqlGetStatus);

        while ($rowGetStatus = $resultGetStatus -> fetch_row()) {
            echo "<h1>" . $rowGetStatus[0] . "</h1>";
            if ($rowGetStatus[0] == "NO") {
                $newStatus = "OK";
                echo "<h3>NEW STATUS IS OK</h3>";
            } else {
                $newStatus = "NO";
                echo "<h3>NEW STATUS IS NO</h3>";
            }
            /*
            if ($rowGetStatus[0] = "YES") {
                $newStatus = "NO";
                echo "<h3>NEW STATUS IS NO</h3>";
            }
            */
            echo "<h1>" . $newStatus . "</h1>";
        }

        $sqlSwitchStatus = "UPDATE employee SET EMP_STATUS = '$newStatus' WHERE employee.EMP_ID = $empID";
        echo "<h1>" . $sqlSwitchStatus . "</h1>";

        if ($conn->query($sqlSwitchStatus) === TRUE) {
            echo "New record inserted successfully.";
            header("Location: ../admin.php");
        } else {
            echo "Error: " . $sqlSwitchStatus . "<br>" . $conn->error;
        }

        $conn->close();
    }