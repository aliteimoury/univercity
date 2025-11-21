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
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ایا مطمعنی؟</title>
        <style>

        </style>
    </head>
    <body>
        <h1>ایا مطمعنید؟</h1>
        <form action="#" method="POST">
            <input type="hidden" value="yes" name="yes">
            <button type="submit">تایید</button>
        </form>
        <form action="#" method="POST">
            <input type="hidden" value="no" name="no">
            <button type="submit">منصرف شدن</button>
        </form>
    </body>
</html>