<?php
//every page after login will need this php code for session
session_start();
//user session variable stored in emp 
$emp = $_SESSION['login_user'];
$serverName = "localhost";//always stays the same between local and main server
$userName = "user";
$password = "oakland";
$dbName = "rtwdb";
// Create connection
$conn = mysqli_connect($serverName, $userName , $password, $dbName);
//selecting the is admin 
$sql = "SELECT EMP_ISADMIN FROM EMPLOYEE WHERE EMP_USERID = '$emp'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
if($row["EMP_ISADMIN"] == "0"){
    //ensuring regular user session
    echo "Welcome " . " " . $emp;
}else{
    //if not a regular user, resets back to login
    unset($emp);
    header("location: login.html");
}

//html 
echo "<br>Welcome to COVID Safety Suite";
echo "<br>";
echo "<a href=controller/logout.php>Logout</a>";
?>