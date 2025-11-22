<?php
  include 'isteacher.php';
  $teacherid=$_SESSION['user_id'];
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    if (isset($_POST['delete_id'])) {
        $id = intval($_POST['delete_id']);
        $_SESSION['delettabale'] = $id;
        header("Location: delet.php");
        exit();
    }
    elseif (isset($_POST['edit_id'])) {
        $id = intval($_POST['edit_id']);
        $sql="SELECT * FROM `classes` WHERE `teacher_id`=$teacherid AND `id`=$id";
        $res = $conn->query($sql);
        $user = $res->fetch_assoc();
        $nametabale=$user['name'];
        $datetable=$user['schedule'];
        $_SESSION['edittabale'] = $id;
        $description=$user['description'];
    }
    else{
        header("Location: ../teacher.php");
        exit();
    }  
  }
  else {
    header("Location: ../teacher.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>ویرایش</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.min.css" type="text/css">
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-success bg-opacity-25 d-flex justify-content-center align-items-center vh-100" dir="rtl">

  <div class="card p-4 shadow" style="width: 22rem;">
    <h2 class="text-center mb-4">فرم ویرایش کلاس</h2>

    <!-- فرم ورود -->
    <form class="d-flex flex-column gap-3" action="edit-cop.php" method="POST">
      <div>
        <label class="form-label">نام کلاس:</label>
        <?php
            echo"<input type='text' class='form-control' required name='tabalename' value='$nametabale'>";
        ?>
      </div>

      <div>
        <label class="form-label">تاریخ:</label>
        <?php
            echo "<input type='date' class='form-control' required name='date' value='$datetable'>";
        ?>
      </div>
      
      <div>
        <label class="form-label">توضیحات(اختیاری):</label>
        <?php 
          echo "<input type='text' class='form-control' name='description' value='$description'>";
        ?>
      </div>
      <button type="submit" class="btn btn-success mt-2">ثبت ویرایش</button>
    </form>
    <a class="btn btn-primary " href="class.php" role="button">بازگشت</a>
  </div>
</body>
</html>