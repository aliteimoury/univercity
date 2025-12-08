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
                        <li><a href="#" class="a-tag">گزارشات</a></li>
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
                            <th scope="col">جمع کل غیبت ها</th>
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