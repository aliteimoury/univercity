<?php

include 'isteacher.php';
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        if (isset($_POST["studentid"]) && isset($_POST["classid"])){
            $_SESSION["studentid"] = $_POST["studentid"];
            $_SESSION["classid"] = $_POST["classid"];
        }
        else if (isset($_POST["yes"])) {
            $temp1=$_SESSION['studentid'];
            $temp2=$_SESSION['classid'];
            $sql = "DELETE FROM enrollments WHERE `class_id` = $temp2 AND `user_id`=$temp1";
            $result = $conn->query($sql);
            unset($_SESSION['studentid']);
            unset($_SESSION['classid']);
            header("Location: manage-class.php");
            exit();
        }else if (isset($_POST["no"])) {
            header("Location: manage-class.php");
            exit();
        }else{
            header("Location: ../teacher.php");
            exit();
        }
    }else{
        header("Location: ../teacher.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>آیا مطمئن هستید؟</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.min.css" type="text/css">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .confirm-card {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 20rem;
    }

    .confirm-card h1 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 25px;
        color: #dc3545;
    }

    .confirm-card form {
        display: inline-block;
        margin: 5px;
    }

    .btn-confirm {
        width: 120px;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-yes {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-no {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-yes:hover {
        background-color: #c82333;
    }

    .btn-no:hover {
        background-color: #5c636a;
    }
    </style>
</head>

<body>

    <div class="confirm-card">
        <h1>آیا مطمئن هستید؟</h1>

        <form action="#" method="POST">
            <input type="hidden" value="yes" name="yes">
            <button type="submit" class="btn btn-confirm btn-yes">تایید</button>
        </form>

        <form action="#" method="POST">
            <input type="hidden" value="no" name="no">
            <button type="submit" class="btn btn-confirm btn-no">منصرف شدن</button>
        </form>
    </div>

</body>

</html>