<?php
include "isteacher.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["countstudent"]) && isset($_POST["classid"]) && isset($_POST["date"])) {
        $i = $_POST["countstudent"];
        $class_id = $_POST["classid"];
        $date = $_POST["date"];
        $now = date('Y-m-d H:i:s');


        $temp = new DateTime($date);
        $tempnow = new DateTime();
        $tempstart = clone $temp;
        $tempstart->modify('-7 days');

        if ($tempnow >= $tempstart) {
            while ($i > 0) {
                $studentid = $_POST["userid$i"];
                $status = $_POST["status$i"];
                $sql = "SELECT * FROM `attendances` WHERE `user_id`={$studentid} AND `class_id`=$class_id AND `date`='$date'";
                $res = $conn->query($sql);
                if ($res->num_rows == 0) {
                    $sql = "INSERT INTO `attendances` 
                VALUES (NULL, '$studentid', '$class_id', '$date', '$status', '$now');";
                    $res = $conn->query($sql);
                } else {
                    $res = $res->fetch_assoc();
                    $updateid = $res["id"];
                    $sql = "UPDATE `attendances` SET `status` = '$status', `created_at` = '$now' 
                WHERE `attendances`.`id` = $updateid";
                    $res = $conn->query($sql);
                }
                $i--;
            }
            header("Location: attend.php");
            exit();
        } else {
            echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>در تاریخ کلاس ثبت کنید</h2>
                    </body>
                </html>";
            header("Refresh: 2; url=attend.php");
            exit();
        }
    } else {
        header("Location: ../teacher.php");
        exit();
    }
} else {
    header("Location: ../teacher.php");
    exit();
}
