<?php
    session_start();
    $serverName = "localhost";
    $userName = "user";
    $password = "oakland";
    $dbName = "rtwdb";
    // Create connection
    $conn = mysqli_connect($serverName, $userName , $password, $dbName);
    //grabs dept selection from dropdown menu in emp table
    $dept = mysqli_real_escape_string($conn,$_POST['adddept']);
    $sql = "INSERT INTO DEPARTMENTS (DEPARTMENT_NAME) VALUES ('$dept') ";
    $result = mysqli_query($conn,$sql);
if ($result == TRUE)
{
    //if insert query successful it will stay on management page
    //also creates a success message 
    $_SESSION['newdept_message'] = "New Department added to system: $dept" ;
    header("location:../admin_manage.php");
}
else
{
    echo "Error adding department. Could be a connection error.";
}
echo "<a href=../admin_manage.php>Return to Account Management</a>";
?>