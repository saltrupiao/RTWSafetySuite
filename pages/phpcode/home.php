<?php
//every page after login will need this php code for session
session_start();
if($_SESSION['login_user']){
    //we can change welcome to something else 
    echo "Welcome " . $_SESSION["login_user"];
}else{
    //stays at login page if session not created
    header("location:login.html");
}

//html 
echo "<html lang=''>";
echo "<b>Welcome to COVID Safety Suite</b>";
echo "<br><br>";
//design link to look like button later
echo "<a href=logout.php>Logout</a>";
echo "</html>";
?>