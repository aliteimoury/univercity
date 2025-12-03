<?php
  include 'islogin.php';
  if ($_SESSION['role']=="مدرس") {
    header("Location: ../teacher.php");
  }elseif ($_SESSION['role'] == "ADMIN") {
    header("Location: ../ADMIN.php");
    exit();
}
?>