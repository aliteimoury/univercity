<?php
include 'isadmin.php';
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
        <p class="pheader">سامانه بوستان - مدیریت سامانه</p>
        <?php
        echo "<p class='nameuser'>", $_SESSION['username'], " خوش آمدید </p>";
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
                        <li><a href="Admin/user.php" class="a-tag">لیست کاربران</a></li>
                        <li><a href="Admin/manage_class.php">مدیریت کلاس ها</a></li>
                        <li>موقت است این</li>

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