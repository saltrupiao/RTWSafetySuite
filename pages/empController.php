<?php

    $serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // get results from form
        $fever = mysqli_real_escape_string($conn,$_POST['fever']);
        $cough = mysqli_real_escape_string($conn,$_POST['cough']);
        $breath = mysqli_real_escape_string($conn,$_POST['breath']);
        $soreThroat = mysqli_real_escape_string($conn,$_POST['soreThroat']);
        $congest = mysqli_real_escape_string($conn,$_POST['congest']);
        $aches = mysqli_real_escape_string($conn,$_POST['aches']);
        $tasteSmell = mysqli_real_escape_string($conn,$_POST['tasteSmell']);
        $headache = mysqli_real_escape_string($conn,$_POST['headache']);
        $d = mysqli_real_escape_string($conn,$_POST['d']);
        $nausea = mysqli_real_escape_string($conn,$_POST['nausea']);
        $covidPositive = mysqli_real_escape_string($conn,$_POST['covidPositive']);
        $exposure = mysqli_real_escape_string($conn,$_POST['exposure']);
        $signatureBox = mysqli_real_escape_string($conn,$_POST['signatureBox']);

        // debug statements - values from form
        echo "<h2>Fever: $fever</h2>";
        echo "<h2>Cough: $cough</h2>";
        echo "<h2>Breath: $breath</h2>";
        echo "<h2>Sore Throat: $soreThroat</h2>";
        echo "<h2>Congest: $congest</h2>";
        echo "<h2>Aches: $aches</h2>";
        echo "<h2>Taste/Smell Loss: $tasteSmell</h2>";
        echo "<h2>Headache: $headache</h2>";
        echo "<h2>Dih: $d</h2>";
        echo "<h2>Nausea: $nausea</h2>";
        echo "<h2>COVID Positive in last 14 days: $covidPositive</h2>";
        echo "<h2>Exposed to COVID: $exposure</h2>";
        echo "<h2>Employee Electronic Signature: $signatureBox</h2>";


        /*
        $sql = "SELECT EMP_USERID, EMP_PW, EMP_ISADMIN FROM EMPLOYEE WHERE EMP_USERID = '$myusername' and EMP_PW = '$mypassword'";
        echo "<h1>$sql</h1>";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
        $count = mysqli_num_rows($result);
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count == 1) {
            $_SESSION['login_user'] = $myusername;
            //if isadmin row is 1 then go to admin dashboard
            if ($row["EMP_ISADMIN"]== "1"){
                header("location: ../admin.php");
            }
            //if regular user go to emp dashboard
            else {
                header("location: ../home.php");
            }
        }else {
            $error = "Your Login Name or Password is invalid";
            echo "<h1>$error</h1>";
            echo "<h1>$sql</h1>";
        }
        */
    }