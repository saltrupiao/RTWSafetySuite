<?php
    session_start();
    $serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);
    //grabs dept selection from dropdown menu in emp table
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $dept = mysqli_real_escape_string($conn,$_POST['newdept']);
    $employee_user = mysqli_real_escape_string($conn,$_POST['emp_user']);
    $sql = "UPDATE employee SET EMP_DEPT = '$dept' WHERE EMP_ID = '$id'";
    $result = mysqli_query($conn,$sql);
if ($result == TRUE)
{
    //if update query successful it will stay on management page
    //also creates a success message 
    $_SESSION['dept_message'] = "Department updated to $dept for $employee_user" ;
    header("location:../admin_manage.php");
}
else
{
    echo "Error updating department. Could be a connection error.";
}
echo "<a href=../admin_manage.php>Return to Account Management</a>";
?>