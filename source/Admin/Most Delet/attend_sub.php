<?php
include 'isstudent.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["classid"]) && isset($_POST["date"])) {
        $classid = $_POST["classid"];
        $classDate = $_POST["date"];
        $userid = $_SESSION["user_id"];
        $now = date('Y-m-d H:i:s');
        $temp = new DateTime($classDate);
        $tempnow = new DateTime('today');
        $templastweek = new DateTime('-1 days');
        if ($temp >= $templastweek && $temp <= $tempnow) {
            $sql = "SELECT * FROM `attendances` WHERE `user_id`=$userid AND `class_id`=$classid AND `date`='$classDate' ";
            $result = $conn->query($sql);

            if ($result->num_rows == 0) {
                $sql = "INSERT INTO `attendances` 
            VALUES (NULL, '$userid', '$classid', '$classDate', 'حاضر', '$now');";
                $res = $conn->query($sql);
            } else {
                $user = $result->fetch_assoc();
                $sql = "UPDATE `attendances` SET `status` = 'حاضر',`created_at` ='$now' WHERE `attendances`.`id` = {$user['id']}";
                $res = $conn->query($sql);
            }
            echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>حضورتان با موفقیت ثبت شد</h2>
                    </body>
                </html>";
            header("Refresh: 2; url=class.php");
            exit();
        } else {
            echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>در تاریخ کلاس ثبت کنید</h2>
                    </body>
                </html>";
            header("Refresh: 2; url=class.php");
            exit();
        }
    } else {
        header("Location: ../student.php");
        exit();
    }
} else {
    header("Location: ../student.php");
    exit();
}
