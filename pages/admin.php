<?php
//every page after login will need this php code for session
session_start();
//user session stored in variable 
$adminuser = $_SESSION['login_user'];
$serverName = "localhost";//always stays the same between local and main server
$userName = "user";
$password = "oakland";
$dbName = "rtwdb";
// Create connection
$conn = mysqli_connect($serverName, $userName , $password, $dbName);
//selecting the is admin 
$sql = "SELECT EMP_ISADMIN FROM EMPLOYEE WHERE EMP_USERID = '$adminuser'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
if($row["EMP_ISADMIN"] == "1"){
    //ensuring admin session 
    echo "Welcome" . " " . $adminuser;
}else{
    //if not an admin, resets back to login
    unset($adminuser);
    header("location: login.html");
}

//html
echo "<br>Hello Admin";
echo "<br>";
echo "<a href=controller/logout.php>Logout</a>";
?>