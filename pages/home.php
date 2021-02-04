<?php
//every page after login will need this php code for session
session_start();
if($_SESSION['login_user']){
    //we can change welcome to something else 
    echo "Welcome " . $_SESSION["login_user"];
}else{
    //stays at login page if session not created
    header("location: login.html");
}

//html 
echo "Hello World";
echo "<br>";
echo "<a href=phpcode/logout.php>Logout</a>";
?>