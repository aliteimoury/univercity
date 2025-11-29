<?php
    include 'isteacher.php';

    if (isset($_SESSION['delettabale'])) {
        $id=$_SESSION['delettabale'];
        $teacherid=$_SESSION['user_id'];
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            if (isset($_POST['yes'])){
                $sql="DELETE FROM `classes` WHERE `id` = $id AND `teacher_id`=$teacherid";
                $res = $conn->query($sql);
                unset($_SESSION['delettabale']);
                header("Location: class.php");
                exit();
            }
            if (isset($_POST['no'])){
                header("Location: class.php");
                exit();
            }
        }
    }
    else {
        header("Location: class.php");
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