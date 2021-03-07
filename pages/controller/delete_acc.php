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
$id = mysqli_real_escape_string($conn,$_POST['id']);
$employee_user = mysqli_real_escape_string($conn,$_POST['emp_user']);
//query to delete row of user id
$sql = "DELETE FROM EMPLOYEE WHERE EMP_ID = '$id'";
$result = mysqli_query($conn,$sql);
if ($result)
{
    //if deletion query successful it will stay on management page
    $_SESSION['del_message'] = "Employee with username $employee_user has been deleted" ;
    header("location:../admin_manage.php");
}
else
{
    echo "Error deleting row";
}
echo "<a href=../admin_manage.php>Homepage</a>";

?>