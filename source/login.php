<?php
    include 'Database-connect.php';
    session_start();

    if ($_SERVER['REQUEST_METHOD']=="POST") {
        $email=trim($_POST['email']);
        $password=($_POST['password']);

        $sql="SELECT id, password,role,name FROM `users` WHERE email='$email'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();
            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username']=$user['name'];
                $_SESSION['user_email'] = $email;
                $_SESSION['loggedin'] = true;
                $_SESSION['role'] = $user['role'];

                echo"<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2> ✅ {$user['name']} خوش آمدید </h2>
                    <p>در حال انتقال به صفحه اصلی...</p>
                    </body>
                </html>";
                header("Refresh: 3; url=Role.php");
            }
            else {
                echo"<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>❌رمز وارد شده اشتباه است</h2>
                    <p>در حال انتقال به صفحه ورود...</p>
                    </body>
                </html>";
                header("Refresh: 3; url=login.html");

            }
        }
        else {
            echo"<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>❌اکانت وجود ندارد</h2>
                    <p>در حال انتقال به صفحه ورود...</p>
                    </body>
                </html>";
                header("Refresh: 3; url=login.html");
        }
    }
    else {
        header("Location: login.html");
        exit();
    }
?>