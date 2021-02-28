<?php
    session_start();
    $currentUser = $_SESSION['login_user'];

    $serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);



    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // get results from form
        $currentDate = date("Y-m-d");
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
        echo "<h1>Currently Logged-In User ID: $currentUser</h1>";
        echo "<h2>Date of Recorded Response: $currentDate</h2>";
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

        $sqlGetID = "SELECT EMP_ID FROM EMPLOYEE WHERE EMP_USERID = '$currentUser'";
        $resultGetID = mysqli_query($conn,$sqlGetID);
        $row = mysqli_fetch_array($resultGetID,MYSQLI_ASSOC);
        $currentEmpID = $row['EMP_ID'];
        echo "<h1>Current Employee ID: $currentEmpID</h1>";

        $sqlInsert = "INSERT INTO `EMP_SYMPTOMS` (`EMP_SYMP_ID`, `EMP_ID`, `EMP_DATE_INSERT`, `SYMP_COUGH`, `SYMP_BREATH`, `SYMP_FEAVER`, `SYMP_FATIGUE`, `SYMP_ACHES`, `SYMP_HEADACHE`, `SYMP_TS`, `SYMP_STHROAT`, `SYMP_CONGEST`, `SYMP_NAUS`, `SYMP_DIARRHEA`, `SYMP_COVIDPOS`, `SYMP_COVIDEXPOS`, `SYMP_WTEST`) 
                                              VALUES (NULL, '$currentEmpID', '$currentDate', '$cough', '$breath', '$fever', NULL, '$aches', '$headache', '$tasteSmell', '$soreThroat', '$congest', '$nausea', '$d', '$covidPositive', '$exposure', NULL)";

        //Source: https://www.w3schools.com/php/php_mysql_insert.asp
        if ($conn->query($sqlInsert) === TRUE) {
            echo "New record inserted successfully.";
        } else {
            echo "Error: " . $sqlInsert . "<br>" . $conn->error;
        }


        $count1 = 0;
        if ($fever == "yes")  {
            $count1 = $count1 + 1;
        }
        if ($cough == "yes")  {
            $count1 = $count1 + 1;
        }
        if ($breath == "yes")  {
            $count1 = $count1 + 1;
        }
        if ($covidPositive == "yes")  {
            $count1 = $count1 + 1;
        }
        if ($exposure == "yes")  {
            $count1 = $count1 + 1;
        }
        $count = 0;
        if ($soreThroat == "yes")  {
            $count = $count + 1;
        }
        if ($congest == "yes")  {
            $count = $count + 1;
        }
        if ($aches == 'yes') {
            $count = $count + 1;
        }
        if ($tasteSmell == 'yes') {
            $count = $count + 1;
        }
        if ($headache == 'yes') {
            $count = $count + 1;
        }
        if ($d == 'yes') {
            $count = $count + 1;
        }
        if ($nausea == 'yes') {
            $count = $count + 1;
        }
        if ($count1 >= 1) {
            $status =  'NO';
            echo 'You are not permitted into this dojo!';
        }
        elseif ($count >= 2) {
            $status = 'NO';
            echo 'You are not permitted into this dojo!';
        }
        else {
            $status = 'OK';
            echo 'You are safe to enter!';
        }
        $sqlInsertStatus = "UPDATE `EMPLOYEE` SET `EMP_STATUS` = '$status' WHERE `EMPLOYEE`.`EMP_ID` = $currentEmpID";
        //Source: https://www.w3schools.com/php/php_mysql_insert.asp
        if ($conn->query($sqlInsertStatus) === TRUE) {
            echo "New record inserted successfully.";
        } else {
            echo "Error: " . $sqlInsertStatus . "<br>" . $conn->error;
        }
        $conn->close();
    }