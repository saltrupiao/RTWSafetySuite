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
       //if regex isn't working on frontend this code is backup also testing for correct pattern
    $lowercase = preg_match('@[a-z]@', $pass);
    $uppercase = preg_match('@[A-Z]@', $pass);
    $number = preg_match('@[0-9]@', $pass);
    if (strlen($pass) < 8 || !$number || !$uppercase || !$lowercase) {
            //if password doesn't meet requirments the script stops running
           exit("Password must contain at least one number, one uppercase letter, one lowercase letter, and contain at least 8 characters <a href=../admin_manage.php>Return to Account Management</a>");
       } else {
        //if password meets requirements continue on with script
    }
       //secure password hash
       $hash = password_hash($pass,PASSWORD_DEFAULT);
       $hashpass = $hash;
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
      $sql = "INSERT INTO employee (EMP_FNAME, EMP_LNAME, EMP_USERID, EMP_DEPT, EMP_PW, EMP_ISADMIN) VALUES ('$fname', '$lname', '$uname', '$dept', '$hashpass', '$type')";
       if ($conn->query ($sql) == TRUE) {
            //if successful new employee shows up in table 
           header("location:../admin_manage.php");
           $_SESSION['add_message'] = "New Employee Added: $fname $lname in department $dept" ;
        }
        else
        {
            //if not successful link to return to management page
            echo "Could not add record: " . $conn->connect_error . "<br>Possible the username entered already exists.<br>";
            //echo "<a href=../admin_manage.php>Return to Account Management</a>";
        }
   }
echo "<a href=../admin_manage.php>Return to Account Management</a>";
?>