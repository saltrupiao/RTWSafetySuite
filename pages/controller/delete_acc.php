<?php
//every page after login will need this php code for session
session_start();
$serverName = "localhost";
$userName = "user";
$password = "oakland";
$dbName = "rtwdb";
// Create connection
$conn = mysqli_connect($serverName, $userName , $password, $dbName);
//using get to grab the value of user id
$userid = mysqli_real_escape_string($conn,$_POST['id']);
//query to delete row of user id
$sql = "DELETE FROM EMPLOYEE WHERE EMP_USERID = '$userid'";
$result = mysqli_query($conn,$sql);
if ($result)
{
    //if deletion query successful it will stay on management page
    $_SESSION['del_message'] = "Employee with username $userid has been deleted" ;
    header("location:../admin_manage.php");
}
else
{
    echo "Error deleting row";
}
echo "<a href=../admin_manage.php>Homepage</a>";

?>