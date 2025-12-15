<?php
    include 'islogin.php';
    $log=new Log('Log/Logout');
    $log->log("User ".$_SESSION['username'] ." logged out of the account.");
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
?>