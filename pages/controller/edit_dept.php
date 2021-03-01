<?php
    session_start();
    $serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);
    //grabs dept selection from dropdown menu in emp table
    $userid = mysqli_real_escape_string($conn,$_POST['id']);
    $dept = mysqli_real_escape_string($conn,$_POST['newdept']);
    $sql = "UPDATE EMPLOYEE SET EMP_DEPT = '$dept' WHERE EMP_USERID = '$userid'";
    $result = mysqli_query($conn,$sql);
if ($result)
{
    //if update query successful it will stay on management page
    //also creates a success message 
    $_SESSION['dept_message'] = "Department updated to $dept for $userid" ;
    header("location:../admin_manage.php");
}
else
{
    echo "Error updating department";
}
echo "<a href=../admin_manage.php>Homepage</a>";
?>