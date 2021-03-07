<?php
    session_start();
    $serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);
    //grabs dept selection from dropdown menu in emp table
    $userid = mysqli_real_escape_string($conn,$_POST['uname']);
    $newpw = mysqli_real_escape_string($conn,$_POST['pw']);
    $sql = "UPDATE EMPLOYEE SET EMP_PW = '$newpw' WHERE EMP_USERID = '$userid'";
    $result = mysqli_query($conn,$sql);
if ($result)
{
    
    $_SESSION['pw_message'] = "Password updated for $userid" ;
    header("location:../admin_manage.php");
}
else
{
    echo "Error updating password for $userid";
}
echo "<a href=../admin_manage.php>Homepage</a>";
?>