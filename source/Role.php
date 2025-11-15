<?php
  include 'islogin.php';
    
  if ($_SESSION['role']=="مدرس") {
    header("Location: teacher.php");
  }elseif($_SESSION['role']=="دانشجو"){
    header("Location: student.php");
  }else{
    header("Location: Lo-Si.html");
  }
?>