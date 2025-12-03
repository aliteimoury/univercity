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
        .btnmanage {

            color: rgb(69, 255, 6);
            border: rgb(69, 255, 6) 1px solid;
        }

        .btnmanage:hover {
            background-color: rgb(69, 255, 6);
            border: rgb(69, 255, 6) 1px solid;
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
                        <li><a href="#" class="a-tag">مدیریت کلاس ها</a></li>
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
                            <th scope="col">نام</th>
                            <th scope="col">ایمیل</th>
                            <th scope="col">تعداد کلاس</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `users` WHERE `Status`='ok' AND `role`='مدرس';";
                        $res = $conn->query($sql);
                        $i = 1;

                        while ($user = $res->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>{$i}</th>";
                            echo "<td>{$user['name']}</td>";
                            echo "<td>{$user['email']}</td>";

                            $tempsql = "SELECT * FROM `classes` WHERE `teacher_id`='{$user['id']}'";
                            $tempres = $conn->query($tempsql);

                            echo "<td>{$tempres->num_rows}</td>";

                            echo "<td><form method='POST' action='class.php' style='display:inline; margin-left:5px;'>
                            <input type='hidden' name='userid' value='{$user['id']}'>
                            <button type='submit' class='btn btn-sm btn-outline-primary btnmanage' name='edit'>مدیریت</button>
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