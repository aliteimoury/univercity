<?php
include 'isadmin.php';
$status = "";
$log=new log("../Log/Admin_class_add");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['tabalename']) && isset($_POST['date']) && isset($_POST['description']) && isset($_POST['userid'])) {
        $teacherid = $_POST['userid'];
        $tabalename = $_POST['tabalename'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        $sql = "INSERT INTO `classes` (`id`, `name`, `schedule`, `teacher_id`, `description`) 
        VALUES (NULL, '$tabalename', '$date', '$teacherid', '$description')";
        $result = $conn->query($sql);
        if ($result) {
            $status = "ثبت کلاس با موفقت انجام شد";
            $log->log("Admin for Teacher Add class \r\n{".$tabalename."}\r\n{".$date."}\r\n{".$description."}");
        } else {
            $status = "مشکلی در ثبت کلاس پیش امده است";
        }
    } else if (isset($_POST['userid'])) {
        $teacherid = $_POST["userid"];
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
    <title>ثبت نام کلاس</title>
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
        <h2 class="text-center mb-4">فرم ثبت کلاس</h2>

        <form class="d-flex flex-column gap-3" action="#" method="POST">
            <div>
                <label class="form-label">نام کلاس:</label>
                <input type="text" class="form-control" required name="tabalename" placeholder="مثال: مبتنی بر وب">
            </div>

            <div>
                <label class="form-label">تاریخ:</label>
                <input type="date" class="form-control" required name="date">
            </div>
            <?php
            echo "<input type='hidden' name='userid' value='$teacherid'>";
            ?>
            <div>
                <label class="form-label">توضیحات (اختیاری):</label>
                <input type="text" class="form-control" name="description" placeholder="مثال: کلاس آنلاین">
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