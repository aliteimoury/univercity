<?php
include 'Database-connect.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = ($_POST['password']);
    $role = ($_POST['role']);
    $sql = "SELECT * FROM `admin` WHERE Username='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {

        $sql = "SELECT * FROM `users` WHERE email='$email'";
        $res = $conn->query($sql);


        if ($res->num_rows === 0) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`name`, `email`, `password`, `role`,`Status`)
            VALUES ('$name', '$email', '$password', '$role','انتطار')";
            $res = $conn->query($sql);
            if ($res) {
                echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>✅ ثبت نام موفقیت آمیز بود!</h2>
                    <p>در حال انتقال به صفحه اصلی...</p>
                    </body>
                </html>";
                header("Refresh: 3; url=login.html");

                exit();
            } else {
                echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>❌مشکلی در ثبت نام به وجود امده است</h2>
                    <p>در حال انتقال به صفحه ثبت نام...</p>
                    </body>
                </html>";
                header("Refresh: 3; url=sing up.html");
                exit();
            }
        } else {
            echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>❌ایمیل شما قبلا ثبت شده است</h2>
                    <p>در حال انتقال به صفحه ثبت نام...</p>
                    </body>
                </html>";
            header("Refresh: 3; url=sing up.html");
            exit();
        }
    }
    else {
        echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>❌ایمیل شما قبلا ثبت شده است</h2>
                    <p>در حال انتقال به صفحه ثبت نام...</p>
                    </body>
                </html>";
            header("Refresh: 3; url=sing up.html");
            exit();
    }
} else {
    header("Location: sing up.html");
    exit();
}
