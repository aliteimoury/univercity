<?php
include 'Database-connect.php';
$log = new Log('Log/login');

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email']);
    $password = ($_POST['password']);

    $sql = "SELECT * FROM `admin` WHERE Username='$email'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['username'] = "ADMIN";
            $_SESSION['user_email'] = $email;
            $_SESSION['loggedin'] = true;
            $_SESSION['role'] = $user['role'];
            echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2> ✅ {$_SESSION['username']} خوش آمدید </h2>
                    <p>در حال انتقال به صفحه اصلی...</p>
                    </body>
                </html>";
            $log->log("Successful login" . $email);
            header("Refresh: 2; url=Role.php");
            exit();
        } else {
            echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>❌رمز وارد شده اشتباه است</h2>
                    <p>در حال انتقال به صفحه ورود...</p>
                    </body>
                </html>";
            $log->log("Enter wrong password:" . $email);
            header("Refresh: 2; url=login.html");
            exit();
        }
    } else {
        $sql = "SELECT * FROM `users` WHERE email='$email'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();
            if (password_verify($password, $user['password'])) {

                if ($user['Status'] == 'ok') {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['name'];
                    $_SESSION['user_email'] = $email;
                    $_SESSION['loggedin'] = true;
                    $_SESSION['role'] = $user['role'];

                    echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2> ✅ {$user['name']} خوش آمدید </h2>
                    <p>در حال انتقال به صفحه اصلی...</p>
                    </body>
                </html>";
                    $log->log("Successful login" . $email);

                    header("Refresh: 2; url=Role.php");
                    exit();
                } elseif ($user['Status'] == 'انتطار') {
                    echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>❌ورود ناموفق </h2>
                    <h3>کاربر محترم لطفا تا تایید توسط مدیر صبور باشد</h3>
                    <p>در حال انتقال به صفحه ورود...</p>
                    </body>
                </html>";
                    $log->log("Attempt to log " . $email . " in with the mode: " . $user['Status']);
                    header("Refresh: 2; url=login.html");
                    exit();
                } elseif ($user['Status'] == 'معلق') {
                    echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>❌ورود ناموفق </h2>
                    <h3>کاربر محترم اکانت شما توسط مدیر به حالت معلق درامده است</h3>
                    <p>در حال انتقال به صفحه ورود...</p>
                    </body>
                </html>";
                    $log->log("Attempt to log " . $email . " in with the mode: " . $user['Status']);
                    header("Refresh: 2; url=login.html");
                    exit();
                }
            } else {
                echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>❌رمز وارد شده اشتباه است</h2>
                    <p>در حال انتقال به صفحه ورود...</p>
                    </body>
                </html>";
                $log->log("Enter wrong password:" . $email);
                header("Refresh: 2; url=login.html");
                exit();
            }
        } else {
            echo "<html>
                    <body style='text-align: center; direction: rtl;'>
                    <h2>❌اکانت وجود ندارد</h2>
                    <p>در حال انتقال به صفحه ورود...</p>
                    </body>
                </html>";
            $log->log("There is no account:" . $email);
            header("Refresh: 2; url=login.html");
            exit();
        }
    }
} else {
    header("Location: login.html");
    exit();
}
