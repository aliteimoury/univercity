<?php
include 'isteacher.php';
unset($_SESSION['studentid']);
unset($_SESSION['classid']);
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


    <style>
    .divmain {
        background-color: whitesmoke;
        border-radius: 15px;
    }

    /* خط جداکننده */
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
                        <li><a href="#" class="a-tag">مدریت کلاس ها</a></li>
                        <li><a href="log.php" class="a-tag">گزارشات</a></li>
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
                    <a href="../logout.php" style="color:red; text-decoration:none; padding-left:90px;">🔴 خروج</a>
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
                            <th scope="col">تعداد دانشجو ها</th>
                            <th scope="col">ویرایش دانشجو ها</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $teacherid = $_SESSION['user_id'];
                        $sql = "SELECT * FROM `classes` WHERE teacher_id='$teacherid'";
                        $res = $conn->query($sql);
                        $i = 1;

                        while ($user = $res->fetch_assoc()) {
                            $classId = (int)$user['id'];
                            $className = htmlspecialchars($user['name']);
                            $classDate = htmlspecialchars($user['schedule']);

                            $temp = "SELECT * FROM `enrollments` WHERE `class_id`=$classId";
                            $result = $conn->query($temp);
                            $studentCount = $result->num_rows;

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
                            echo "<td>{$studentCount}</td>";
                            echo "<td>";

                            echo "<form method='POST' action='editstudentclass.php' style='display:inline; margin-left:5px;'>
                            <input type='hidden' name='delet_id' value='{$classId}'>
                            <button type='submit' class='btn btn-sm btn-outline-primary' name='edit'>ویرایش</button>
                            </form>";

                            echo "</td>";
                            echo "</tr>";

                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <span class="line"></span>
            <a class="btn btn-primary" href="Add_student.php" role="button">اضافه کردن دانشجو</a>
        </div>

    </div>


</body>

</html>