<?php
  include 'isteacher.php';
  unset($_SESSION['delettabale']);
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
                        <li><a href="#" class="a-tag">ثبت نام کلاس ها</a></li>
                        <li><a href="manage-class.php" style="text-decoration:none;color:black;">مدریت کلاس ها</a></li>
                        <li>برنامه هفتگی</li>
                        <li>حضور و غیاب دروس </li>
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
            <div class="d-table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">شماره</th>
                        <th scope="col">نام کلاس</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">ویرایش/حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $teacherid=$_SESSION['user_id'];
                            $sql="SELECT * FROM `classes` WHERE teacher_id='$teacherid'";
                            $res = $conn->query($sql);
                            $user = $res->fetch_assoc();
                            for ($i=1; $i < $res->num_rows+1; $i++) { 
                                $classId = (int)$user['id'];
                                $className = htmlspecialchars($user['name']);
                                $classDate = htmlspecialchars($user['schedule']);

                                echo "<tr>";
                                echo "<th scope='row'>{$i}</th>";
                                echo "<td>{$className}</td>";
                                echo "<td>{$classDate}</td>";
                                echo "<td>";
                                echo "<form method='POST' action='editclass.php' style='display:inline; margin-left:5px;'>
                                <input type='hidden' name='edit_id' value='{$classId}'>
                                <button type='submit' class='btn btn-sm btn-outline-primary' name='edit'>ویرایش</button>
                                </form>";
                                echo "<form method='POST' action='editclass.php' style='display:inline;'>
                                <input type='hidden' name='delete_id' value='{$classId}'>
                                <button type='submit' class='btn btn-sm btn-outline-danger' name='delete'>حذف</button>
                                </form>";
                                echo "</td>";
                                echo "</td>";
                                echo "</tr>"; 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <span class="line"></span>
            <a class="btn btn-primary" href="class_crate.php" role="button">اضافه کردن کلاس</a>
        </div>

    </div>


</body>

</html>