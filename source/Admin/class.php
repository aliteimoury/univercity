<?php
include 'isadmin.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["userid"])) {
        $teacherid = $_POST["userid"];
    } else {
        header("Location: ../admin.php");
        exit();
    }
} else {
    header("Location: ../admin.php");
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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.min.css" type="text/css">
    <style>
    .btnmanage {

        color: rgb(69, 255, 6);
        border: rgb(69, 255, 6) 1px solid;
    }

    .btnmanage:hover {
        background-color: rgb(69, 255, 6);
        border: rgb(69, 255, 6) 1px solid;
    }

    .divmain {
        background-color: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .line {
        display: block;
        width: 100%;
        height: 4px;
        background: rgba(0, 123, 255, 0.2);
        margin: 20px 0;
    }

    .d-table table {
        background: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        color: #000;
    }

    .d-table thead {
        background-color: #0d6efd;
        color: #fff;
        font-weight: bold;
    }

    .d-table tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.1);
        transition: 0.2s;
    }

    table td form {
        display: inline-block;
        margin: 0 3px;
    }

    .btn {
        border-radius: 12px;
        font-weight: 500;
        padding: 6px 14px;
        border: none;
    }

    .btnmanage {
        color: #1fa400;
        border: 1px solid #1fa400;
    }

    .btnmanage:hover {
        background-color: #1fa400;
        border: 1px solid #1fa400;
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
                        <li><a href="user.php" class="a-tag">لیست کاربران</a></li>
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
            <div class="d-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">شماره</th>
                            <th scope="col">نام کلاس</th>
                            <th scope="col">تاریخ</th>
                            <th scope="col">روز</th>
                            <th scope="col">توضیحات</th>
                            <th scope="col">تعداد دانشجویان</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `classes` WHERE `teacher_id`=$teacherid";
                        $res = $conn->query($sql);
                        $i = 1;

                        while ($user = $res->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>{$i}</th>";
                            echo "<td>{$user['name']}</td>";
                            echo "<td>{$user['schedule']}</td>";
                            $date = $user['schedule'];
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
                            echo "<td>{$user['description']}</td>";

                            $tempsql = "SELECT * FROM `enrollments` WHERE `class_id`={$user['id']}";
                            $tempres = $conn->query($tempsql);
                            echo "<td>$tempres->num_rows</td>";
                            echo "<td><form method='POST' action='studentlist.php' style='display:inline; margin-left:5px;'>
                            <input type='hidden' name='class_id' value='{$user['id']}'>
                            <input type='hidden' name='userid' value='{$teacherid}'>
                            <button type='submit' class='btn btn-sm btn-outline-primary btnmanage' name='edit'>دانشجویان</button>
                            </form></td>";
                            echo "<td><form method='POST' action='editclass.php' style='display:inline; margin-left:5px;'>
                            <input type='hidden' name='class_id' value='{$user['id']}'>
                            <input type='hidden' name='userid' value='{$teacherid}'>
                            <button type='submit' class='btn btn-sm btn-outline-primary ' name='edit'>ویرایش</button>
                            </form></td>";
                            echo "<td><form method='POST' action='deletclass.php' style='display:inline; margin-left:5px;' onsubmit=\"return confirm('آیا مطمئن هستید؟');\">
                            <input type='hidden' name='class_id' value='{$user['id']}'>
                            <input type='hidden' name='userid' value='{$teacherid}'>
                            <button type='submit' class='btn btn-sm btn-outline-danger' name='delete'>حذف</button>
                            </form></td>";
                            echo "</tr>";
                            $i++;
                        }
                        echo "<input type='hidden' name='userid' value='$teacherid'>";
                        ?>
                    </tbody>
                </table>
            </div>
            <span class="line"></span>
            <form method='POST' action='createclass.php' style='display:inline; margin-left:5px;'
                onsubmit="return confirm('آیا مطمئن هستید؟');">
                <?php 
                    echo "<input type='hidden' name='userid' value='$teacherid'>";
                ?>
                <button type='submit' class='btn btn-primary' name='delete'>اضافه کردن کلاس</button>
            </form>
            <a class="btn btn-primary" href="manage_class.php" role="button">بازگشت</a>
        </div>

    </div>


</body>

</html>