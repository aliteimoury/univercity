<?php
  include 'isstudent.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bostan</title>
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="class.css">
    <link rel="stylesheet"href="../bootstrap/css/bootstrap.rtl.min.css"type="text/css">
</head>

<body>
    <div class="divheader">
        <p class="pheader">سامانه بوستان - دانشجویان ابن حسام</p>
        <?php
        echo "<p class='pheader'>",$_SESSION['username']," خوش آمدید </p>";
        ?>
        <img class="imgheader" src="../logo.jpg">
    </div>

    <div class="div-container">
        <div class="divmenu">
            <ul>
                <li><a class="a-tag" href="../student.php">🏠 صفحه‌ اصلی</a>
                    <ul>
                        <li>اعلان‌ها</li>
                        <li>اخبار سامانه</li>
                    </ul>
                </li>

                <li>📘 امور آموزشی
                    <ul>
                        <li><a href="#" class="a-tag">لیست کلاس ها</a></li>
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
                    <a href="logout.php" style="color:red; text-decoration:none; padding-left:140px;">🔴 خروج</a>
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
                            <th scope="col">تاریخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $studentid = $_SESSION['user_id'];
                        $sql = "SELECT DISTINCT c.* FROM classes AS c JOIN enrollments e ON c.id = e.class_id WHERE e.user_id = $studentid";
                        $res = $conn->query($sql);
                        $i = 1;

                        while ($user = $res->fetch_assoc()) {
                            $classId = (int)$user['id'];
                            $className = htmlspecialchars($user['name']);
                            $classDate = htmlspecialchars($user['schedule']);

                            echo "<tr>";
                            echo "<th scope='row'>{$i}</th>";
                            echo "<td>{$className}</td>";
                            echo "<td>{$classDate}</td>";
                            echo "</tr>";

                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <span class="line"></span>
            <a class="btn btn-primary" href="class_crate.php" role="button">اضافه کردن کلاس</a>
        </div>

    </div>


</body>

</html>