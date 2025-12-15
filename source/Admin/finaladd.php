<?php
include 'isadmin.php';
$log = new Log('../Log/Admin_Class_Add_Stu');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["userid"]) && isset($_POST["class_id"]) && isset($_POST["addid"])) {
        $teacherid = $_POST["userid"];
        $class_id = $_POST["class_id"];
        $addid = $_POST["addid"];
        foreach ($addid as $id) {
            $sql = "INSERT INTO `enrollments` (`id`, `user_id`, `class_id`) VALUES (NULL, '$id', '$class_id')";
            $result = $conn->query($sql);
        }
        $log->log("Teacher added user to class");
        echo '<form id="redirectForm" action="studentlist.php" method="POST">
        <input type="hidden" name="userid" value="' . $teacherid . '">
        <input type="hidden" name="class_id" value="' . $class_id . '">
        </form>
        <script>
        document.getElementById("redirectForm").submit();
        </script>';
        exit;
    } else {
        header("Location: ../admin.php");
        exit();
    }
} else {
    header("Location: ../admin.php");
    exit();
}