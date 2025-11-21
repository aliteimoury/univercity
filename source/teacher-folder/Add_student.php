<?php
    include 'isteacher.php';
    $status="";
    $sql="SELECT * FROM `users` WHERE `role`='دانشجو'";
    $Tuser=$conn->query($sql);
    $sql="SELECT * FROM `classes` WHERE `teacher_id`=".$_SESSION['user_id'];
    $Tclass=$conn->query($sql);

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        $studentid=$_POST["studentid"];
        $classid=$_POST["classid"];
        $sql="SELECT * FROM `enrollments` WHERE `user_id`='$studentid' AND `class_id`='$classid'";
        $res=$conn->query($sql);
        if ($res->num_rows == 0) {
            $res=$res->fetch_assoc();
            $sql= "INSERT INTO `enrollments` (`user_id`, `class_id`) VALUES ('$studentid', '$classid')";
            $res=$conn->query($sql);
            $status= "ثبت با موفقیت انجام شد!";
        }
        else {
            $status= "دانشجو قبلا در این کلاس ثبت شده است!";
        }
    }
    ?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>ثبت نام دانشجو</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.min.css" type="text/css">
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <style>
    .d-label{
      height: 15px;
      z-index: 2;
      text-align: center;
    }
  </style>
</head>
<body class="bg-success bg-opacity-25 d-flex justify-content-center align-items-center vh-100" dir="rtl">

  <div class="card p-4 shadow" style="width: 22rem;">
    <h2 class="text-center mb-4">فرم ثبت دانشجو</h2>

    <!-- فرم ورود -->
    <form class="d-flex flex-column gap-3" action="#" method="POST">
      <div>
        <label class="form-label">نام دانشجو:</label>
        <select name="studentid" required class="form-select">
            <option value="" selected disabled>انتخاب کنید</option>
            <?php 
                while($user=$Tuser->fetch_assoc()) {
                    echo "<option value='" . $user['id'] . "'>" . $user['name']."----". $user['email']. "</option>";
                }
            ?>
        </select>
      </div>

      <div>
        <label class="form-label">کلاس:</label>
        <select name="classid" required class="form-select">
            <option value="" selected disabled>انتخاب کنید</option>
            <?php
                while($class=$Tclass->fetch_assoc()) {
                    echo "<option value='" . $class['id'] . "'>" . $class['name']."----". $class['schedule']. "</option>";
                }
            ?>
        </select>
      </div>

      <button type="submit" class="btn btn-success mt-2">ثبت</button>
    </form>
    <div class="d-label">
        <?php  
            echo "<label for='floatingPassword'>$status</label>";
        ?>
    </div>
    <a class="btn btn-primary mt-3" href="manage-class.php" role="button">بازگشت</a>
  </div>
</body>
</html>