<?php
   session_start();
   unset($_SESSION['login_user']);
//landing page goes back to the login
   header("Location: ../login.html");
?>