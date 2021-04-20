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
    //if regex isn't working on frontend this code is backup also testing for correct pattern
    $lowercase = preg_match('@[a-z]@', $newpw);
    $uppercase = preg_match('@[A-Z]@', $newpw);
    $number = preg_match('@[0-9]@', $newpw);
    if (strlen($newpw) < 8 || !$number || !$uppercase || !$lowercase) {
            //if password doesn't meet requirements script stops running 
           exit("Password must contain at least one number, one uppercase letter, one lowercase letter, and contain at least 8 characters <a href=../admin_manage.php>Return to Account Management</a>");
       } else {
        //if password meets requirements continue running the script
    }
    //secure password hash
    $hash = password_hash($newpw,PASSWORD_DEFAULT);
    $hashednewpass = $hash;
    //updating based off emp_id number not user id
    $sql = "UPDATE EMPLOYEE SET EMP_PW = '$hashednewpass' WHERE EMP_ID = '$emp_id'";
    $result = mysqli_query($conn,$sql);
if ($result == TRUE)
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