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
    </style>
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
                    <a href="../logout.php" style="color:red; text-decoration:none; padding-left:90px;">🔴 خروج</a>
                </li>
            </ul>
        </div>

        <div class="divmain">
            <div class="d-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col"> شماره</th>
                            <th scope="col">نام کلاس</th>
                            <th scope="col">تاریخ</th>
                            <th scope="col">تعداد غیبت</th>
                            <th scope="col">مشاهده ی جلسات حضور</th>

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
                            $date = $classDate;
                            $days = [
                                'Saturday' => 'شنبه',
                                'Sunday' => 'یکشنبه',
                                'Monday' => 'دوشنبه',
                                'Tuesday' => 'سه‌شنبه',
                                'Wednesday' => 'چهارشنبه',
                                'Thursday' => 'پنجشنبه',
                                'Friday' => 'جمعه'
                            ];
                            $dayEn = date('l', strtotime($date));
                            $dayFa = $days[$dayEn];
                            echo "<td>{$dayFa}</td>";
                            $tempsql="SELECT * FROM `attendances` WHERE `user_id`=$studentid AND `class_id`=$classId AND`status`='غیبت'";
                            $tempres = $conn->query($tempsql);
                            echo "<td>{$tempres->num_rows}</td>";

                            echo "<td><form method='POST' action='attend.php' style='display:inline; margin-left:5px;'>
                            <input type='hidden' name='classid' value='{$classId}'>
                            <button type='submit' class='btn btn-sm btn-outline-primary' name='edit'>نمایش</button>
                            </form></td>";

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