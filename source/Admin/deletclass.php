<?php
include 'isadmin.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["class_id"])&&isset($_POST['userid'])) {
        $class_id = $_POST["class_id"];
        $id = $_POST["userid"];
        $sql = "DELETE FROM classes WHERE `id`=$class_id";
        $result = $conn->query($sql);
        
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
