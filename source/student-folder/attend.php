<?php
include 'isstudent.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["classid"])) {

        $classid = $_POST["classid"];
        $studentid = $_SESSION['user_id'];
        $sql = "SELECT * FROM `classes` WHERE `id`=$classid";
        $res = $conn->query($sql);

        $user = $res->fetch_assoc();
    } else {
        header("Location: ../student.php");
        exit();
    }
} else {
    header("Location: ../student.php");
    exit();
}
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
    <style>
        .divmain {
            background-color: whitesmoke;
            border-radius: 15px;
        }

        .line {
            display: block;
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.4);
            margin: 20px 0;
        }

        .btn,
        input[type="submit"] {
            border-radius: 12px;
            font-weight: 500;
            padding: 8px 18px;
            border: none;
        }

        a.btn-primary {
            background-color: #0dcaf0;
            color: #000;
        }

        .d-table table {
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            color: #000;
        }

        .d-table thead {
            background: #0d6efd;
            color: #fff;
            font-weight: bold;
        }

        .d-table tbody tr:hover {
            background: rgba(49, 92, 92, 0.1);
            transition: 0.2s;
        }

        table td form {
            display: inline-block;
            margin: 0 3px;
        }

        .ok {
            background-color: #28a745;
            color: #fff;
        }

        .deniy {
            background-color: red;
            color: white;
        }

        .ok {
            background-color: #28a745;
            color: #fff;
        }

        .deniy {
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
    <div class="divheader">
        <p class="pheader">سامانه بوستان - دانشجویان ابن حسام</p>
        <?php
        echo "<p class='pheader'>", $_SESSION['username'], " خوش آمدید </p>";
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
                        <li><a href="class.php" class="a-tag">لیست کلاس ها</a></li>
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
                    <a href="../logout.php" style="color:red; text-decoration:none; padding-left:90px;">🔴 خروج</a>
                </li>
            </ul>
        </div>

        <div class="divmain">
            <div class="d-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">نام کلاس</th>
                            <th scope="col">توضیحات</th>
                            <th scope="col">جلسه:</th>
                            <th scope="col">اول</th>
                            <th scope="col">دوم</th>
                            <th scope="col">سوم</th>
                            <th scope="col">چهارم</th>
                            <th scope="col">پنجم</th>
                            <th scope="col">ششم</th>
                            <th scope="col">هفتم</th>
                            <th scope="col">هشتم</th>
                            <th scope="col">نهم</th>
                            <th scope="col">دهم</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        echo "<tr>";
                        echo "<td>{$user['name']}</td>";
                        echo "<td>{$user['description']}</td>";
                        echo "<td></td>";

                        // گرفتن حضور و مرتب کردن طبق تاریخ
                        $tempsql = "SELECT `status` FROM `attendances`WHERE `user_id`=$studentid AND `class_id`=$classid ORDER BY `date` ASC";
                        $tempres = $conn->query($tempsql);

                        // تبدیل نتایج به آرایه وضعیت‌ها
                        $sessions = [];
                        while ($tempuser = $tempres->fetch_assoc()) {
                            switch ($tempuser['status']) {
                                case 'حاضر':
                                    $sessions[] = "✅";
                                    break;
                                case 'غیبت':
                                    $sessions[] = "❌";
                                    break;
                                default:
                                    $sessions[] = "❔";
                                    break;
                            }
                        }

                        // تعداد ستون‌ها (مثلاً 10 جلسه ثابت)
                        $maxSessions = 10;

                        // چاپ ستون‌های جلسات طبق شناسه جلسه
                        for ($i = 0; $i < $maxSessions; $i++) {
                            if (isset($sessions[$i])) {
                                echo "<td>{$sessions[$i]}</td>";
                            } else {
                                echo "<td>-</td>";
                            }
                        }

                        echo "</tr>";


                        ?>

                    </tbody>
                </table>
            </div>
            <span class="line"></span>
            <a class="btn btn-primary" href="class.php" role="button">بازگشت</a>
        </div>

    </div>


</body>

</html>