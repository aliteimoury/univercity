<?php
include 'isadmin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bostan</title>
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.min.css" type="text/css">
    <style>
    .divmain {
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
    }

    .divmain a.btn {
        margin-right: 10px;
        margin-bottom: 5px;
    }

    .btn-primary {
        border-radius: 6px;
        padding: 6px 12px;
        font-weight: 500;
    }
    </style>

</head>

<body>
    <div class="divheader">
        <p class="pheader">سامانه بوستان - مدیریت سامانه</p>
        <?php
        echo "<p class='nameuser'>", $_SESSION['username'], " خوش آمدید </p>";
        ?>
        <img class="imgheader" src="../logo.jpg">
    </div>

    <div class="div-container">
        <div class="divmenu">
            <ul>
                <li><a class="a-tag" href="../ADMIN.php">🏠 صفحه‌ اصلی</a>
                    <ul>
                        <li>اعلان‌ها</li>
                        <li>اخبار سامانه </li>
                    </ul>
                </li>

                <li>📘 امور آموزشی
                    <ul>
                        <li><a href="#" class="a-tag">لیست کاربران</a></li>
                        <li><a href="manage_class.php" class="a-tag">مدیریت کلاس ها</a></li>
                        <li>موقت است این</li>
                    </ul>
                </li>
                <li>
                    <a href="../logout.php" style="color:red; text-decoration:none; padding-left:90px;">🔴 خروج</a>
                </li>
            </ul>
        </div>
        <div class="divmain">
            <a href="activuser.php" class="btn btn-primary mt-3" role="button">کاربران فعال</a>
            <a href="suspended.php" class="btn btn-primary mt-3" role="button">کاربران معلق</a>
            <a href="waiting.php" class="btn btn-primary mt-3" role="button">کاربران در انتظار تایید</a>
        </div>
    </div>
</body>

</html>