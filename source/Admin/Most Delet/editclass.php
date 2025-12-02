<?php
  include 'isteacher.php';
  $teacherid=$_SESSION['user_id'];
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    if (isset($_POST['delete_id'])) {
        $id = intval($_POST['delete_id']);
        $_SESSION['delettabale'] = $id;
        header("Location: delet.php");
        exit();
    }
    elseif (isset($_POST['edit_id'])) {
        $id = intval($_POST['edit_id']);
        $sql="SELECT * FROM `classes` WHERE `teacher_id`=$teacherid AND `id`=$id";
        $res = $conn->query($sql);
        $user = $res->fetch_assoc();
        $nametabale=$user['name'];
        $datetable=$user['schedule'];
        $_SESSION['edittabale'] = $id;
        $description=$user['description'];
    }
    else{
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
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>ویرایش کلاس</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.min.css" type="text/css">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        background-color: #d4edda;
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

    form .form-control {
        border-radius: 6px;
    }
    </style>
</head>

<body dir="rtl">

    <div class="card p-4">
        <h2 class="text-center mb-4">فرم ویرایش کلاس</h2>

        <form class="d-flex flex-column gap-3" action="edit-cop.php" method="POST">
            <div>
                <label class="form-label">نام کلاس:</label>
                <?php
                    echo "<input type='text' class='form-control' required name='tabalename' value='$nametabale'>";
                ?>
            </div>

            <div>
                <label class="form-label">تاریخ:</label>
                <?php
                    echo "<input type='date' class='form-control' required name='date' value='$datetable'>";
                ?>
            </div>

            <div>
                <label class="form-label">توضیحات (اختیاری):</label>
                <?php
                    echo "<input type='text' class='form-control' name='description' value='$description'>";
                ?>
            </div>

            <button type="submit" class="btn btn-success mt-2">ثبت ویرایش</button>
        </form>

        <a class="btn btn-primary mt-3" href="class.php" role="button">بازگشت</a>
    </div>

</body>

</html>