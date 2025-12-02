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
    body {
        background-color: #d4edda;
        /* سبز روشن مشابه bg-success bg-opacity-25 */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        width: 24rem;
    }

    .card h2 {
        font-weight: 600;
        color: #0d6efd;
    }

    .form-label {
        font-weight: 500;
    }

    form .form-control,
    form .form-select {
        border-radius: 6px;
    }

    .btn-success {
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-primary {
        border-radius: 8px;
        width: 100%;
    }

    .status-message {
        text-align: center;
        margin-top: 10px;
        font-weight: 500;
        color: #198754;
        /* رنگ سبز Bootstrap برای موفقیت */
    }
    </style>
</head>

<body dir="rtl">

    <div class="card p-4">
        <h2 class="text-center mb-4">فرم ثبت دانشجو</h2>

        <!-- فرم ثبت دانشجو -->
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
                            echo "<option value='" . $class['id'] . "'>" . $class['name']."----". $class['schedule']."----". $class['description']."</option>";
                        }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-2">ثبت</button>
        </form>

        <div class="status-message">
            <?php echo $status; ?>
        </div>

        <a class="btn btn-primary mt-3" href="manage-class.php" role="button">بازگشت</a>
    </div>

</body>

</html>