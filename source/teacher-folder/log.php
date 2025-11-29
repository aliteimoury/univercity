<?php
include 'isteacher.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bostan</title>
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="class.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.min.css" type="text/css">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="divheader">
        <p class="pheader">سامانه بوستان - اساتید ابن حسام</p>
        <?php
        echo "<p class='nameuser'>", $_SESSION['username'], " خوش آمدید </p>";
        ?>
        <img class="imgheader" src="../logo.jpg">

    </div>

    <div class="div-container">
        <div class="divmenu">
            <ul>
                <li><a class="a-tag" href="../teacher.php">🏠 صفحه‌ اصلی</a>
                    <ul>
                        <li>اعلان‌ها</li>
                        <li>اخبار سامانه </li>
                    </ul>
                </li>

                <li>📘 امور آموزشی
                    <ul>
                        <li>اطلاع رسانی </li>
                        <li><a href="class.php" class="a-tag">ثبت نام کلاس ها</a></li>
                        <li><a href="manage-class.php" class="a-tag">مدریت کلاس ها</a></li>
                        <li><a href="#.php" class="a-tag">گزارشات</a></li>
                        <li><a href="attend.php" class="a-tag">حضور و غیاب دروس</a></li>
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
                    <a href="../logout.php" style="color:red; text-decoration:none; padding-left:140px;">🔴 خروج</a>
                </li>
            </ul>
        </div>

        <div class="divmain">
            <div class="d-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">شماره</th>
                            <th scope="col">نام کلاس</th>
                            <th scope="col">جمع کل غیبت ها</th>
                            <th scope="col">جمع کل تاخیر ها</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $teacherid = $_SESSION['user_id'];
                        $sql = "SELECT * FROM `classes` WHERE teacher_id = '$teacherid'";
                        $res = $conn->query($sql);
                        $i = 1;
                        while ($user = $res->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>{$i}</th>";
                            echo "<td>{$user['name']}</td>";
                            $classId = $user["id"];
                            $sql = "SELECT * FROM `attendances` WHERE `class_id` =$classId AND `status`='غیبت'";
                            $temp = $conn->query($sql);
                            echo "<td>$temp->num_rows</td>";
                            $sql = "SELECT * FROM `attendances` WHERE `class_id` =$classId  AND `status`='تاخیر'";
                            $temp = $conn->query($sql);
                            echo "<td>$temp->num_rows</td>";
                            echo "</tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <span class="line"></span>
        </div>

    </div>


</body>

</html>