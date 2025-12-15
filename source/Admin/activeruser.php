<?php
include 'isadmin.php';
$log = new Log('../Log/Admin_Activeruser');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["userid"])&&isset($_POST["location"])) {
        $userid = $_POST["userid"];
        $location = $_POST["location"];
        $sql = "UPDATE `users` SET `Status` = 'ok' WHERE `users`.`id` = $userid";
        $res = $conn->query($sql);
        $log->log("admin activ user ");
        header("Location: $location");
        exit();
    } else {
        header("Location: ../admin.php");
        exit();
    }
} else {
    header("Location: ../admin.php");
    exit();
}
 