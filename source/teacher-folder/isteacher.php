<?php
  include 'islogin.php';
  if ($_SESSION['role']=="دانشجو") {
    header("Location: ../student.php");
  }
?>