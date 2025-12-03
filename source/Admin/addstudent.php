<?php
include 'isadmin.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["userid"]) && isset($_POST["class_id"]) && isset($_POST["addid"])) {
        $teacherid = $_POST["userid"];
        $class_id = $_POST["class_id"];
        $addid = $_POST["addid"];
    } elseif (isset($_POST["userid"]) && isset($_POST["class_id"])) {
        $teacherid = $_POST["userid"];
        $class_id = $_POST["class_id"];
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

        /* کانتینر والد */
        .two-panel-container {
            display: flex;
            gap: 20px;
            /* فاصله بین پنل‌ها */
            width: 100%;
            box-sizing: border-box;
            align-items: flex-start;
        }

        /* هر پنل دقیقا نصف عرض را می‌گیرد */
        .panel {
            flex: 0 0 50%;
            /* ثابت: پایه‌ی 50%، رشد/کوچک شدن غیرفعال */
            max-width: 50%;
            box-sizing: border-box;
            /* تضمین محاسبه درست padding/border */
            background: #fff;
            border-radius: 10px;
            padding: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        /* اگر خواستی کارت عنوان داشته باشد */
        .panel h5 {
            margin-top: 0;
            margin-bottom: 12px;
            font-weight: 600;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }

        /* ریسپانسیو: زیر 768px پنل‌ها ستونی شوند */
        @media (max-width: 768px) {
            .two-panel-container {
                flex-direction: column;
            }

            .panel {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* اگر جدول‌ها فضای داخلی دارند، عرض کامل */
        .panel .table {
            margin-bottom: 12px;
            width: 100%;
        }
    </style>
    <script>
        let temp = false;

        function selectAll() {
            let checkboxes = document.querySelectorAll('.Check1');
            checkboxes.forEach(ch => ch.checked = !temp);
            temp = !temp;
        }

        // وقتی DOM کامل لود شد
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById("form1").addEventListener("submit", function(e) {

                let selected = document.querySelectorAll('.Check1:checked');

                if (selected.length === 0) {
                    e.preventDefault();
                    alert("لطفاً حداقل یک گزینه را انتخاب کنید.");
                }

            });

        });
        let temp2 = false;

        function selectAll2() {
            let checkboxes = document.querySelectorAll('.Check2');
            checkboxes.forEach(ch => ch.checked = !temp2);
            temp2 = !temp2;
        }

        // وقتی DOM کامل لود شد
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById("form2").addEventListener("submit", function(e) {

                let selected = document.querySelectorAll('.Check2:checked');

                if (selected.length === 0) {
                    e.preventDefault();
                    alert("لطفاً حداقل یک گزینه را انتخاب کنید.");
                }

            });

        });
    </script>

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
            <div class="two-panel-container">
                <div class="panel">
                    <h5>لیست دانشجو جدید</h5>
                    <form action="#" method="post" id="form1">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>شماره</th>
                                    <th scope="col"><button type="button" onclick="selectAll()">انتخاب همه</button></th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>ایمیل</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT *
                                FROM users
                                WHERE role = 'دانشجو'
                                AND id NOT IN (SELECT user_id FROM enrollments WHERE class_id = $class_id)
                                AND users.Status='ok'";
                                $res = $conn->query($sql);
                                $i = 1;

                                while ($user = $res->fetch_assoc()) {
                                    if (isset($addid)) {
                                        if (in_array($user['id'], $addid)) {
                                            continue;
                                        }
                                    }
                                    echo "<tr>";
                                    echo "<th scope='row'>{$i}</th>";
                                    echo "<td><input type='checkbox' value='{$user['id']}' name='addid[]' class='Check1'></td>";
                                    echo "<td>{$user['name']}</td>";
                                    echo "<td>{$user['email']}</td>";
                                    echo "</tr>";
                                    $i++;
                                }
                                echo "<input type='hidden' name='userid' value='$teacherid'>";
                                echo "<input type='hidden' name='class_id' value='$class_id'>";
                                ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-danger w-100">انتخاب دانشجو</button>
                    </form>
                </div>

                <div class="panel">
                    <h5>لیست دانشجو تاییدی</h5>
                    <form action="finaladd.php" method="post" id="form2">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>شماره</th>
                                    <th scope="col"><button type="button" onclick="selectAll2()">انتخاب همه</button></th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>ایمیل</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($addid)) {
                                    $i=1;
                                    foreach ($addid as $id) {
                                        $sql = "SELECT * FROM `users` WHERE `id`='$id'";
                                        $res = $conn->query($sql);
                                        $user = $res->fetch_assoc();
                                        echo "<tr>";
                                        echo "<th scope='row'>{$i}</th>";
                                        echo "<td><input type='checkbox' value='{$user['id']}' name='addid[]' class='Check2'></td>";
                                        echo "<td>{$user['name']}</td>";
                                        echo "<td>{$user['email']}</td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                    echo "<input type='hidden' name='userid' value='$teacherid'>";
                                    echo "<input type='hidden' name='class_id' value='$class_id'>";
                                } else {
                                }
                                ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary w-100">ثبت نهایی</button>
                    </form>
                </div>
            </div>
            <span class="line"></span>
            <form method='POST' action='studentlist.php' style='display:inline; margin-left:5px;' class='mt-3'>
                <?php
                echo "<input type='hidden' name='userid' value='$teacherid'>";
                echo "<input type='hidden' name='class_id' value='$class_id'>";
                ?>
                <button type='submit' class='btn btn-primary' name='delete'>بازگشت</button>
            </form>
            <!-- <form method='POST' action='addstudent.php' style='display:inline; margin-left:5px;' class='mt-3'>
                <?php
                // echo "<input type='hidden' name='classid' value='$class_id'>";
                // echo "<input type='hidden' name='userid' value='$teacherid'>";
                ?>
                <button type='submit' class='btn btn-primary' name='delete'>اضافه کردن دانشجو</button>
            </form> -->
        </div>

    </div>


</body>

</html>