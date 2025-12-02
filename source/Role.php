<?php
include 'islogin.php';

if ($_SESSION['role'] == "مدرس") {
  header("Location: teacher.php");
  exit();
} elseif ($_SESSION['role'] == "دانشجو") {
  header("Location: student.php");
  exit();
} elseif ($_SESSION["role"] == "ADMIN") {
  header("Location: ADMIN.php");
  exit();
} else {
  header("Location: Lo-Si.html");
  exit();
}
