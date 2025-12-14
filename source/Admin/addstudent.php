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
    .divmain {
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .line {
        display: block;
        width: 100%;
        height: 2px;
        background-color: #dee2e6;
        margin: 15px 0;
    }

    .two-panel-container {
        display: flex;
        gap: 15px;
        width: 100%;
        align-items: flex-start;
    }

    .panel {
        flex: 0 0 50%;
        max-width: 50%;
        background: #f8f9fa;
        border-radius: 8px;
        padding: 12px;
    }

    .panel h5 {
        margin-top: 0;
        margin-bottom: 10px;
        font-weight: 600;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 5px;
    }

    .panel .table {
        width: 100%;
        margin-bottom: 10px;
    }

    button[type="button"] {
        border-radius: 6px;
        padding: 4px 10px;
        font-weight: 500;
        border: 1px solid #0d6efd;
        background-color: #fff;
        color: #0d6efd;
        cursor: pointer;
    }

    button[type="button"]:hover {
        background-color: #0d6efd;
        color: #fff;
    }

    .btnmanage {
        color: rgb(50, 180, 0);
        border: 1px solid rgb(50, 180, 0);
    }

    .btnmanage:hover {
        background-color: rgb(50, 180, 0);
        color: #fff;
        border: 1px solid rgb(50, 180, 0);
    }

    .btn-primary {
        border-radius: 6px;
        padding: 6px 12px;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .two-panel-container {
            flex-direction: column;
        }

        .panel {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    </style>

    <script>
    let temp = false;

    function selectAll() {
        let checkboxes = document.querySelectorAll('.Check1');
        checkboxes.forEach(ch => ch.checked = !temp);
        temp = !temp;
    }

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
                                    <th>نام و نام خانوادگی</th>
                                    <th>ایمیل</th>
                                    <th scope="col"><button type="button" onclick="selectAll()">انتخاب همه</button></th>
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
                                    echo "<td>{$user['name']}</td>";
                                    echo "<td>{$user['email']}</td>";
                                    echo "<td><input type='checkbox' value='{$user['id']}' name='addid[]' class='Check1'></td>";
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
                                    </th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>ایمیل</th>
                                    <th scope="col"><button type="button" onclick="selectAll2()">انتخاب همه</button>
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
                                        echo "<td>{$user['name']}</td>";
                                        echo "<td>{$user['email']}</td>";
                                        echo "<td><input type='checkbox' value='{$user['id']}' name='addid[]' class='Check2'></td>";
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
        </div>
    </div>
</body>

</html>