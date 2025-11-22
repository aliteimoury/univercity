<?php
  include 'isteacher.php';
  $status="";
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    $tabalename=trim($_POST['tabalename']);
    $dateclass=$_POST['date'];
    $teacherid=$_SESSION['user_id'];
    $description=$_POST['description'];
    $sql="INSERT INTO `classes`
    VALUES (NULL, '$tabalename', '$dateclass', '$teacherid','$description')";
    $res=$conn->query($sql);
        
    if ($res) {
      $status="ثبت با موفقیت انجام شد.";
    }else{
      $status="در ثبت مشکلی پیس امده است.";
      }
        
  }
?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>ثبت نام کلاس</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.min.css" type="text/css">
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <style>
    .d-label{
      height: 15px;
      z-index: 2;
      text-align: center;
    }
  </style>
</head>
<body class="bg-success bg-opacity-25 d-flex justify-content-center align-items-center vh-100" dir="rtl">

  <div class="card p-4 shadow" style="width: 22rem;">
    <h2 class="text-center mb-4">فرم ثبت کلاس</h2>

    <!-- فرم ورود -->
    <form class="d-flex flex-column gap-3" action="#" method="POST">
      <div>
        <label class="form-label">نام کلاس:</label>
        <input type="text" class="form-control" required name="tabalename">
      </div>

      <div>
        <label class="form-label">تاریخ:</label>
        <input type="date" class="form-control" required name="date">
      </div>

      <div>
        <label class="form-label">توضیحات(اختیاری):</label>
        <input type="text" class="form-control" name="description">
      </div>

      <button type="submit" class="btn btn-success mt-2">ثبت</button>
    </form>
    <div class="d-label">
      <?php
        echo "<label for='floatingPassword'>$status</label>";
        ?>
    </div>
    <a class="btn btn-primary mt-3" href="class.php" role="button">بازگشت</a>
  </div>
</body>
</html>