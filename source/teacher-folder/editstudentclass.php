<?php
  include 'isteacher.php';
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    if (isset($_POST["delet_id"])){
        $deleteid=$_POST["delet_id"];
    }
    else {
        header("Location: ../teacher.php");
        exit();
    }
  }
  else {
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
        echo "<p class='nameuser'>",$_SESSION['username']," خوش آمدید </p>";
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
                            <th scope="col">نام دانشجو</th>
                            <th scope="col">ایمیل دانشجو</th>
                            <th scope="col">حذف دانشجو</th>
                            <?php 
                        $sql = "SELECT `name` FROM `classes` WHERE `id`=$deleteid";
                        $res = $conn->query($sql);
                        $res= $res->fetch_assoc();
                        echo "<th scope='col'>نام کلاس: ".$res['name']."</th>";
                        ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql="SELECT u.* FROM users u INNER JOIN enrollments e ON u.id = e.user_id WHERE e.class_id = '$deleteid' AND u.role = 'دانشجو';";
                            $res = $conn->query($sql);
                            $i=1;
                            while($user = $res->fetch_assoc()) {
                                $studentid = (int)$user['id'];
                                $studentname = htmlspecialchars($user['name']);
                                $studentemail = htmlspecialchars($user['email']);

                                echo "<tr>";
                                echo "<th scope='row'>{$i}</th>";
                                echo "<td>{$studentname}</td>";
                                echo "<td>{$studentemail}</td>";
                                echo "<td>";
                                echo "<form method='POST' action='deletstudent.php' style='display:inline;'>
                                <input type='hidden' name='classid' value='{$deleteid}'>
                                <input type='hidden' name='studentid' value='{$studentid}'>
                                <button type='submit' class='btn btn-sm btn-outline-danger' name='delete'>حذف</button>
                                </form>";
                                echo "</td>";
                                echo "</tr>"; 
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <span class="line"></span>
            <a class="btn btn-primary" href="manage-class.php" role="button">بازگشت</a>
        </div>

    </div>


</body>

</html>