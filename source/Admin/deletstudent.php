<?php
include 'isadmin.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["userid"]) && isset($_POST["class_id"]) && isset($_POST["Deletid"])) {
        $teacherid = $_POST["userid"];
        $class_id = $_POST["class_id"];
        $Deletid = $_POST["Deletid"];
        foreach ($Deletid as $id) {
            $sql = "DELETE FROM `enrollments` WHERE `user_id`=$id AND `class_id`=$class_id";
            $result = $conn->query($sql);
        }
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
