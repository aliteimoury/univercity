<?php
include 'isadmin.php';
$log = new Log('../Log/Admin_delet_class');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["class_id"])&&isset($_POST['userid'])) {
        $class_id = $_POST["class_id"];
        $id = $_POST["userid"];
        $sql = "DELETE FROM classes WHERE `id`=$class_id";
        $result = $conn->query($sql);
        $log->log("admmin delet class");
        echo '<form id="redirectForm" action="class.php" method="POST">
        <input type="hidden" name="userid" value="' . $id . '">
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
