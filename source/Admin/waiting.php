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
                        <li><a href="view_log.php" class="a-tag"> گزارشات سایت </a></li>

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
                            <th scope="col">نام و نام خانوادگی</th>
                            <th scope="col">نقش</th>
                            <th scope="col">ایمیل</th>
                            <th scope="col"> ساخت</th>
                            <th scope="col">فعال سازی</th>
                            <th scope="col">حذف کاربر</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $teacherid = $_SESSION['user_id'];
                        $sql = "SELECT * FROM `users` WHERE `Status`='انتطار'";
                        $res = $conn->query($sql);
                        $i = 1;

                        while ($user = $res->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>{$i}</th>";
                            echo "<td>{$user['name']}</td>";
                            echo "<td>{$user['role']}</td>";
                            echo "<td>{$user['email']}</td>";
                            echo "<td>{$user['created_at']}</td>";
                            echo "<td><form method='POST' action='activeruser.php' style='display:inline; margin-left:5px;' onsubmit=\"return confirm('آیا مطمئن هستید؟');\">
                            <input type='hidden' name='userid' value='{$user['id']}'>
                            <input type='hidden' name='location' value='waiting.php'>
                            <button type='submit' class='btn btn-sm btn-outline-primary' name='edit'>فعال کردن</button>
                            </form></td>";
                            echo "<td><form method='POST' action='deletuser.php' style='display:inline; margin-left:5px;' onsubmit=\"return confirm('آیا مطمئن هستید؟');\">
                            <input type='hidden' name='userid' value='{$user['id']}'>
                            <input type='hidden' name='location' value='waiting.php'>
                            <button type='submit' class='btn btn-sm btn-outline-danger' name='edit'>حذف</button>
                            </form></td>";
                            echo "</tr>";
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <span class="line"></span>
            <a class="btn btn-primary" href="user.php" role="button">بازگشت</a>
        </div>

    </div>


</body>

</html>