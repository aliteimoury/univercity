<?php
  include 'isteacher.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bostan</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.rtl.min.css" type="text/css">

</head>

<body>
    <div class="divheader">
        <p class="pheader">سامانه بوستان - اساتید ابن حسام</p>
        <?php
      
        echo "<p class='nameuser'>",$_SESSION['username']," خوش آمدید </p>";
        ?>
        <img class="imgheader" src="logo.jpg">
    </div>

    <div class="div-container">
        <div class="divmenu">
            <ul>
                <li><a class="a-tag" href="#">🏠 صفحه‌ اصلی</a>
                    <ul>
                        <li>اعلان‌ها</li>
                        <li>اخبار سامانه </li>
                    </ul>
                </li>

                <li>📘 امور آموزشی
                    <ul>
                        <li>اطلاع رسانی </li>
                        <li><a href="teacher-folder/log.php" class="a-tag">گزارشات</a></li>
                        <li><a href="teacher-folder/attend.php" class="a-tag">حضور و غیاب دروس</a></li>
                    </ul>
                </li>

                <li>💰 امور مالی
                    <ul>
                        <li>مبلغ هر درس برای مدرس</li>
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
                    <a href="logout.php" style="color:red; text-decoration:none; padding-left:90px;">🔴 خروج</a>
                </li>
            </ul>
        </div>
        <div>
            <iframe class="iframe" src="https://tvu.ac.ir/" frameborder="0"></iframe>
        </div>

    </div>


</body>

</html>