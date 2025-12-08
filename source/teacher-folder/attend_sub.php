<?php
include "isteacher.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["date"]) && isset($_POST["class_id"])) {
        $date = $_POST["date"];
        $class_id = $_POST["class_id"];
    } else {
        header("Location: ../teacher.php");
        exit();
    }
} else {
    header("Location: ../teacher.php");
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

    .toggle {
        width: 25px;
        height: 25px;
        border: 2px solid #333;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        cursor: pointer;
        user-select: none;
    }

    .toggle input {
        display: none;
    }

    .toggle span::before {

        content: "✖";
        color: red;
    }

    .toggle input:checked+span::before {

        content: "✔";
        color: green;
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
        background-color: rgb(98, 215, 241);
        color: #fff;
    }
    </style>
    <script>
    let temp2 = false;

    function selectAll2() {
        let checkboxes = document.querySelectorAll('.Check2');
        checkboxes.forEach(ch => ch.checked = !temp2);
        temp2 = !temp2;
    }
    </script>
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
            <form action="finalattend.php" method="post">
                <div class="d-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">شماره</th>
                                <th scope="col">نام‌دانشجو</th>
                                <th scope="col">ایمیل</th>
                                <th scope="col"><button type="button" onclick="selectAll2()">انتخاب همه</button></th>
                                <?php
                                echo "<th scope='col'>";
                                echo "تاریخ:" . $date;
                                echo "</th>";
                                ?>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql = "SELECT u.id AS user_id, u.name, u.email, u.password, u.role, u.created_at, e.id AS enrollment_id, e.class_id 
                            FROM users AS u JOIN enrollments AS e ON u.id = e.user_id 
                            WHERE e.class_id=$class_id;";
                            $res = $conn->query($sql);
                            $i = 1;

                            while ($user = $res->fetch_assoc()) {
                                $name = $user["name"];
                                $email = $user["email"];
                                $userid = $user["user_id"];
                                $sql = "SELECT * FROM `attendances` WHERE
                                `user_id`={$userid} AND `class_id`=$class_id AND `date`='$date'";
                                $hoozor = "";
                                $temp = $conn->query($sql);
                                if ($temp->num_rows == 0) {
                                    $hoozor = " selected";
                                } else {
                                    $temp = $temp->fetch_assoc();
                                    switch ($temp['status']) {
                                        case 'حاضر':
                                            $hoozor = " checked";
                                            break;
                                        default:
                                            $hoozor = "";
                                            break;
                                    }
                                }
                                echo "<tr>";
                                echo "<th scope='row'>{$i}</th>";
                                echo "<td>$name</td>";
                                echo "<td>$email</td>";
                                echo "<input type='hidden' name='id[$i]' value='$userid'>";
                                echo "<td>
                                <label class='toggle'>
                                <input type='hidden' name='status[$i]' value='no'>
                                <input type='checkbox' name='status[$i]' value='yes' $hoozor class='Check2'>
                                <span></span>
                                </label>
                                </td>";

                                echo "</tr>";
                                $i++;
                            }
                            $i--;
                            echo "<input type='hidden' value='$i' name='countstudent'>";
                            echo "<input type='hidden' value='$date' name='date'>";
                            echo "<input type='hidden' value='$class_id' name='classid'>";

                            ?>
                        </tbody>
                    </table>
                </div>
                <span class="line"></span>
                <input class="btn btn-success" type="submit" value="ثبت">
                <a class="btn btn-danger" href="attend.php" role="button">بازگشت</a>
            </form>
        </div>
    </div>


</body>

</html>