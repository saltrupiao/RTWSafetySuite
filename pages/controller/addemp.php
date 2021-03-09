<?php
//every page after login will need this php code for session
session_start();
$serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      //grabbing values from form
      $fname = mysqli_real_escape_string($conn,$_POST['fname']);
      $lname = mysqli_real_escape_string($conn,$_POST['lname']);
       $uname= mysqli_real_escape_string($conn,$_POST['uname']);
       $dept = mysqli_real_escape_string($conn,$_POST['dept']);
       $pass = mysqli_real_escape_string($conn,$_POST['pw']);
       $usertype = mysqli_real_escape_string($conn,$_POST['usertype']);
       //varaiable to store 0 or 1 for admin accounts
       $type = "";
       //assigning 0 or 1 for admin variable
       if ($usertype == "Administrator")
       {
          $type = '1'; 
       } else
       {
           $type = '0';
       }
      //query to add an employee
      $sql = "INSERT INTO EMPLOYEE (EMP_FNAME, EMP_LNAME, EMP_USERID, EMP_DEPT, EMP_PW, EMP_ISADMIN) VALUES ('$fname', '$lname', '$uname', '$dept', '$pass', '$type')";
       if ($conn->query ($sql) == TRUE) {
            //if successful new employee shows up in table 
           header("location:../admin_manage.php");
           $_SESSION['add_message'] = "New Employee Added: $fname $lname in department $dept" ;
        }
        else
        {
            //if not successful link to return to management page
            echo "Could not add record: " . $conn->connect_error . "<br>";
            echo "<a href=../admin_manage.php>Return to Account Management</a>";
        }
   }
echo "<a href=../admin_manage.php>Return to Account Management</a>";
?>