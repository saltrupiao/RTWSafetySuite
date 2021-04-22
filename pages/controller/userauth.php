<?php
   session_start();
    //include_once 'connection.php';
    //server database
    //$serverName = "35.223.86.91";
    //local instance
    $serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "test";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        echo '<script> console.log("Connection to db failed");</script>';
    }
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);
      $sql = "SELECT EMP_USERID, EMP_PW, EMP_ISADMIN FROM EMPLOYEE WHERE EMP_USERID = '$myusername'";
      echo "<h1>$sql</h1>";
      $result = mysqli_query($conn,$sql);
       echo "result:$result";
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      $count = mysqli_num_rows($result);
        
      // If result matched $myusername and $mypassword, table row must be 1 row
            if($count == 1) {
                //checking password after unhashing
                if (password_verify($mypassword, $row["EMP_PW"]) == TRUE) {
                    $_SESSION['login_user'] = $myusername;
                    //if isadmin row is 1 then go to admin dashboard
                    if ($row["EMP_ISADMIN"]== "1"){
                        header("location: ../admin.php");
                    }
                    //if regular user go to emp dashboard
                    else {
                        header("location: ../emp.php");
                    }
                } else {
                    $error = "Your Login Name or Password is invalid";
                    $_SESSION["error"] = $error;
                    header("location: ../login.php");
                    //echo "<h1>$error</h1>";
                    //echo "<h1>$sql</h1>";
                }
        }
      echo "$count";
   }
?>