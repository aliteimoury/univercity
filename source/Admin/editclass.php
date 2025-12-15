<?php
include 'isadmin.php';
$log=new Log("../Log/Admin_Edit_class");
$status = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['tabalename']) && isset($_POST['date']) && isset($_POST['description']) && isset($_POST['userid']) && isset($_POST['class_id'])) {
        $teacherid = $_POST['userid'];
        $tabalename = $_POST['tabalename'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        $class_id = $_POST['class_id'];
        $sql = "UPDATE `classes` SET `name` ='$tabalename' , `schedule`='$date' , `description`='$description'
        WHERE `id` = '$class_id'";
        $result = $conn->query($sql);
        $log->log("Admin edit class");
        echo '<form id="redirectForm" action="class.php" method="POST">
        <input type="hidden" name="userid" value="' . $teacherid . '">
        </form>
        <script>
        document.getElementById("redirectForm").submit();
        </script>';
        exit;
    } else if (isset($_POST['userid']) && isset($_POST['class_id'])) {
        $teacherid = $_POST["userid"];
        $class = $_POST["class_id"];
        $sql = "SELECT * FROM `classes` WHERE `id`=$class";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
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
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>ویرایش کلاس</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.min.css" type="text/css">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        background-color: #d4edda;
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
    }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100" dir="rtl">

    <div class="card p-4">
        <h2 class="text-center mb-4">فرم ویرایش کلاس</h2>

        <form class="d-flex flex-column gap-3" action="#" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟');">
            <div>
                <label class="form-label">نام کلاس:</label>
                <?php
                echo "<input type='text' class='form-control' required name='tabalename' value='{$user['name']}' >";
                ?>
            </div>

            <div>
                <label class="form-label">تاریخ:</label>
                <?php
                echo "<input type='date' class='form-control' required name='date' value='{$user['schedule']}'>";
                ?>
            </div>
            <?php
            echo "<input type='hidden' name='userid' value='$teacherid'>";
            echo "<input type='hidden' name='class_id' value='$class'>";
            ?>
            <div>
                <label class="form-label">توضیحات (اختیاری):</label>
                <?php
                echo "<input type='text' class='form-control' name='description' value='{$user['description']}'>";
                ?>
            </div>

            <button type="submit" class="btn btn-success mt-2">ثبت</button>
        </form>
        <div class="status-message">
            <?php echo $status; ?>
        </div>

        <form method='POST' action='class.php' style='display:inline; margin-left:5px;' class='mt-3'>
            <?php
            echo "<input type='hidden' name='userid' value='$teacherid'>";
            ?>
            <button type='submit' class='btn btn-primary' name='delete'>بازگشت</button>
        </form>
    </div>

</body>

</html>