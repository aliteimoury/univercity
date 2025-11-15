<?php
  include 'islogin.php';
  if ($_SESSION['role']=="مدرس") {
    header("Location: teacher.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bostan</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="divheader">
        <p class="pheader">سامانه بوستان  - دانشجویان ابن حسام</p>
        <?php
        echo "<p class='pheader'>خوش آمدید ",$_SESSION['username'],"</p>";
        ?>
        <img class="imgheader" src="logo.jpg" >
      </div>
    
    <div class="div-container">
      <div class="divmenu">
        <ul>
          <li>🏠 صفحه‌ نخست
            <ul>
              <li>اعلان‌ها</li>
              <li>اخبار سامانه</li>
            </ul>
          </li>
      
          <li>📘 امور آموزشی
            <ul>
              <li>ثبت‌نام دروس</li>
              <li>کارنامه آموزشی</li>
              <li>برنامه هفتگی</li>
            </ul>
          </li>
    
          <li>💰 امور مالی
            <ul>
              <li>پرداخت شهریه</li>
              <li>سوابق پرداخت</li>
            </ul>
          </li>
      
          <li>👤 پروفایل کاربر
            <ul>
              <li>ویرایش اطلاعات</li>
              <li>تغییر رمز عبور</li>
            </ul>
          </li>
          <li>
            <a href="logout.php" style="color:red; text-decoration:none;">🔴 خروج</a>
          </li>
        </ul>
      </div>

      <div class="divmain">
        <iframe class="iframe" src="https://tvu.ac.ir/" frameborder="0"></iframe>
      </div>
    
    </div>


</body>
</html>