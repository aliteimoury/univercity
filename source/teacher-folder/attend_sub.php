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
                        <li><a href="log.php"  class="a-tag">گزارشات</a></li>
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
                    <a href="../logout.php" style="color:red; text-decoration:none; padding-left:140px;">🔴 خروج</a>
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
                                <th scope="col">وضعیت</th>
                                <?php
                                    echo "<th scope='col'>";
                                    echo "تاریخ:".$date;
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
                                $hoozor="";
                                $takhir="";
                                $qeybat="";
                                $temp = $conn->query($sql);
                                if ($temp->num_rows == 0) {
                                    $hoozor=" selected";
                                }
                                else {
                                    $temp = $temp->fetch_assoc();
                                    switch ($temp['status']) {
                                    case 'حاضر':
                                        $hoozor=" selected";
                                        break;
                                    case 'تاخیر':
                                        $takhir= " selected";
                                        break;
                                    case 'غیبت':
                                        $qeybat=" selected";
                                        break;
                                    default:
                                        $hoozor=" selected";
                                        break;
                                }
                                }
                                echo "<tr>";
                                echo "<th scope='row'>{$i}</th>";
                                echo "<td>$name</td>";
                                echo "<td>$email</td>";
                                echo "<td>
                                <select name='status$i'>
                                <option value='حاضر' $hoozor>حضور</option>
                                <option value='غیبت' $qeybat>غایب</option>
                                <option value='تاخیر' $takhir>تاخیر</option>
                                </select>
                                </td>";
                                echo "<input type='hidden' value='$userid' name='userid$i'>";
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
                <input type="submit" value="ثبت">
                <a class="btn btn-primary" href="attend.php" role="button">بازگشت</a>
            </form>
        </div>
    </div>


</body>

</html>