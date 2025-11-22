<?php
    include 'isteacher.php';
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        $updatename=$_POST['tabalename'];
        $updatedate=$_POST['date'];
        $id=$_SESSION['edittabale'];
        $teacherid=$_SESSION['user_id'];
        $description=$_POST['description'];
        $sql="UPDATE `classes` SET `name`='$updatename',`schedule`='$updatedate',`description`='$description' WHERE `id`=$id AND `teacher_id`=$teacherid";
        $res = $conn->query($sql);
        header("Location: class.php");
        exit();
    }
    else {
        header("Location: class.php");
        exit();
    }
?>