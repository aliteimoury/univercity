<?php
include 'isadmin.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["userid"]) && isset($_POST["class_id"])) {
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

    button[type="button"] {
        border-radius: 12px;
        padding: 5px 10px;
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
    </style>

    <script>
    document.addEventListener("DOMContentLoaded", function() {

        document.getElementById("form1").addEventListener("submit", function(e) {

            let selected = document.querySelectorAll('input[name="Deletid[]"]:checked');

            if (selected.length === 0) {
                e.preventDefault();
                alert("لطفاً حداقل یک گزینه را انتخاب کنید.");
                return;
            }

            let confirmDelete = confirm("آیا از حذف موارد انتخاب شده مطمئن هستید؟");

            if (!confirmDelete) {
                e.preventDefault();
            }
        });
    });
    let temp = false;

    function selectAll() {
        let checkboxes = document.querySelectorAll('.Check1');
        checkboxes.forEach(ch => ch.checked = !temp);
        temp = !temp;
    }
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
            <div class="d-table">
                <form action="deletstudent.php" method="post" id="form1">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">شماره</th>
                                <th scope="col">نام و نام خانوادگی</th>
                                <th scope="col">ایمیل</th>
                                <th scope="col"><button type="button" onclick="selectAll()">انتخاب همه</button></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql = "SELECT *, e.id as e_id, u.id as u_id 
                            FROM enrollments e JOIN users u ON u.id = e.user_id
                            WHERE class_id='$class_id';";
                            $res = $conn->query($sql);
                            $i = 1;

                            while ($user = $res->fetch_assoc()) {
                                echo "<tr>";
                                echo "<th scope='row'>{$i}</th>";
                                echo "<td>{$user['name']}</td>";
                                echo "<td>{$user['email']}</td>";
                                echo "<td><input type='checkbox' value='{$user['u_id']}' name='Deletid[]' class='Check1'></td>";
                                echo "</tr>";
                                $i++;
                            }
                            echo "<input type='hidden' name='userid' value='$teacherid'>";
                            echo "<input type='hidden' name='class_id' value='$class_id'>";
                            ?>
                        </tbody>
                    </table>
                    <button type='submit' class='btn btn-primary mb-1' name='delete'>حذف</button>
                </form>
            </div>
            <span class="line"></span>
            <form method='POST' action='class.php' style='display:inline; margin-left:5px;' class='mt-3'>
                <?php
                echo "<input type='hidden' name='userid' value='$teacherid'>";
                ?>
                <button type='submit' class='btn btn-primary' name='delete'>بازگشت</button>
            </form>
            <form method='POST' action='addstudent.php' style='display:inline; margin-left:5px;' class='mt-3'>
                <?php
                echo "<input type='hidden' name='userid' value='$teacherid'>";
                echo "<input type='hidden' name='class_id' value='$class_id'>";
                ?>
                <button type='submit' class='btn btn-primary' name='delete'>اضافه کردن دانشجو</button>
            </form>
        </div>

    </div>


</body>

</html>