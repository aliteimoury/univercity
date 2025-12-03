<?php
include 'islogin.php';
if ($_SESSION['role'] == "دانشجو") {
    header("Location: ../student.php");
    exit();
} elseif ($_SESSION['role'] == "ADMIN") {
    header("Location: ../ADMIN.php");
    exit();
}
