<?php
   session_start();
   include_once 'connection.php';
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($conn,$_POST['Username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['Password']); 
      $sql = "SELECT EMP_USERID, EMP_PW FROM employee WHERE EMP_USERID = '$myusername' and EMP_PW = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      $count = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
          //will landing page be home or go straight to dashboards?
         header("location: home.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>