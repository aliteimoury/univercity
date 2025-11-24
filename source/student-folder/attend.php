<?php
include 'isstudent.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["classid"])) {

        $classid = $_POST["classid"];
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
                        $studentid = $_SESSION['user_id'];
                        $sql = "SELECT * FROM `classes` WHERE `id`=$classid";
                        $res = $conn->query($sql);
                        $i = 1;

                        while ($user = $res->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>{$i}</th>";
                            echo "<td>{$user['name']}</td>";
                            echo "<td>{$user['description']}</td>";
                            echo "<td></td>";
                            $date = new DateTime($user["schedule"]);
                            $today = new DateTime('today');
                            $lastWeek = new DateTime('-1 days');
                            for ($j = 0; $j < 10; $j++) {
                                for ($j = 0; $j < 10; $j++) {
                                    if ($date >= $lastWeek && $date <= $today) {
                                        $btnstlye = 'ok';
                                        $btnstatus = '';
                                    } else {

                                        $btnstlye = 'deniy';
                                        $btnstatus = 'disabled';
                                    }
                                    echo "<td>
                                <form action='attend_sub.php' method='post' style='display:inline; margin-left:5px;'>
                                <input type='hidden' name='date' value='{$date->format('Y-m-d')}'>
                                <input type='hidden' name='classid' value='$classid'>
                                <button type='submit' class='btn btn-sm btn-outline-primary $btnstlye' $btnstatus name='edit' >ثبت</button>
                                </form>
                                </td>";
                                    $date->modify('+7 days');
                                }
                            }
                            echo "</tr>";
                            $i++;
                        }
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