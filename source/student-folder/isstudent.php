<?php
  include 'islogin.php';
  if ($_SESSION['role']=="مدرس") {
    header("Location: ../teacher.php");
  }
?>