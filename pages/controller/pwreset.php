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
    $emp_id = mysqli_real_escape_string($conn,$_POST['id']);
    //if somehow wrong username is entered in reset form the password will still be updated 
    //because it's updating based off emp_id number not user id
    $sql = "UPDATE EMPLOYEE SET EMP_PW = '$newpw' WHERE EMP_ID = '$emp_id'";
    $result = mysqli_query($conn,$sql);
if ($conn->query ($sql) == TRUE)
{
    //if successful it stays on emp management and creates temp success message
    $_SESSION['pw_message'] = "Password updated for $userid" ;
    header("location:../admin_manage.php");
}
else
{
    echo "Error updating password for $userid. Could be connection error.";
}
echo "<a href=../admin_manage.php>Return to Account Management</a>";
?>