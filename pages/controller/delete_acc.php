<?php
//every page after login will need this php code for session
session_start();
$serverName = "localhost";
$userName = "user";
$password = "oakland";
$dbName = "rtwdb";
// Create connection
$conn = mysqli_connect($serverName, $userName , $password, $dbName);
//grabbing id and username
$id = mysqli_real_escape_string($conn,$_POST['id']);
$employee_user = mysqli_real_escape_string($conn,$_POST['emp_user']);
//query to delete row of user in symptom table to delete the foreign key
$sql = "DELETE FROM EMP_SYMPTOMS WHERE EMP_ID = '$id'";
//query to delete the employee based on primary key
$sql2 = "DELETE FROM EMPLOYEE WHERE EMP_ID = '$id'";
$result = mysqli_query($conn,$sql);
$result2 = mysqli_query($conn,$sql2);
if ($result == TRUE && $result2 == TRUE )
{
    //if deletion query successful it will stay on management page
    $_SESSION['del_message'] = "Employee with username $employee_user has been deleted" ;
    header("location:../admin_manage.php");
}
else
{
    echo "Error deleting row. Could be a connection error.";
}
echo "<a href=../admin_manage.php>Return to Account Management</a>";

?>