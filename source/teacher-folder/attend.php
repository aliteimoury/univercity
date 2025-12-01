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
                        <li><a href="log.php" class="a-tag">گزارشات</a></li>
                        <li><a href="#" class="a-tag">حضور و غیاب دروس</a></li>
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
                            <th scope="col">نام‌کلاس</th>
                            <th scope="col">توضیحات</th>
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
                        $teacherid = $_SESSION['user_id'];
                        $sql = "SELECT * FROM `classes` WHERE teacher_id='$teacherid'";
                        $res = $conn->query($sql);
                        $i = 1;

                        while ($user = $res->fetch_assoc()) {
                            $classId = $user['id'];
                            $className = $user['name'];
                            $classdescription = $user['description'];
                            $classDate = $user['schedule'];
                            echo "<tr>";
                            echo "<th scope='row'>{$i}</th>";
                            echo "<td>{$className}</td>";
                            echo "<td>{$className}</td>";
                            $date = new DateTime($classDate);
                            $today = new DateTime('today');
                            $lastWeek = new DateTime('-8 days');
                            
                            for ($j = 0; $j < 10; $j++) {
                                if ($date >= $lastWeek && $date <= $today) {
                                        $btnstlye = 'ok';
                                        $btnstatus='';
                                    } else {

                                        $btnstlye = 'deniy';
                                        $btnstatus='disabled';
                                    }
                                echo "<td>
                                <form action='attend_sub.php' method='post' style='display:inline; margin-left:5px;'>
                                <input type='hidden' name='date' value='{$date->format('Y-m-d')}'>
                                <input type='hidden' name='class_id' value='$classId'>
                                <button type='submit' class='btn btn-sm btn-outline-primary $btnstlye' btnstatus name='edit'  >ثبت</button>
                                </form>
                                </td>";
                                $date->modify('+7 days');
                            }

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