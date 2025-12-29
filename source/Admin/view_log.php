<?php
include 'isadmin.php';

// مسیر پوشه لاگ‌ها
$logDir = realpath(__DIR__ . '/../Log/');
$logFiles = [];

if ($logDir && is_dir($logDir)) {
    $logFiles = glob($logDir . '/*.txt');
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>سامانه بوستان | مدیریت</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.rtl.min.css" type="text/css">

    <style>
    .divmain {
        background-color: #ffffff;
        border-radius: 15px;
        padding: 20px;
        margin: 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        flex: 1;
    }

    .line {
        display: block;
        width: 100%;
        height: 4px;
        background: rgba(0, 123, 255, 0.2);
        margin: 20px 0;
    }

    .d-table table {
        background: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        color: #000;
    }

    .d-table thead {
        background-color: #0d6efd;
        color: #fff;
        font-weight: bold;
    }

    .d-table tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.1);
        transition: 0.2s;
    }

    .btn {
        border-radius: 12px;
        font-weight: 500;
        padding: 6px 14px;
        border: none;
    }

    .log-container {
        max-height: 70vh;
        overflow-y: auto;
        margin-top: 20px;
    }

    .log-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
        padding: 15px;
        border: 1px solid #e5e7eb;
    }

    .log-title {
        font-weight: bold;
        color: #1e40af;
        margin-bottom: 10px;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 8px;
    }

    .log-content {
        background: #f9fafb;
        padding: 12px;
        border-radius: 6px;
        font-size: 14px;
        white-space: pre-wrap;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #e5e7eb;
    }

    .empty {
        background: #fff3cd;
        padding: 15px;
        border-radius: 8px;
        color: #856404;
        text-align: center;
        border: 1px solid #ffeaa7;
    }

    h4.mb-3 {
        color: #0d6efd;
        padding-bottom: 10px;
        border-bottom: 2px solid #0d6efd;
    }
    </style>
</head>

<body>

    <div class="divheader">
        <p class="pheader">سامانه بوستان - مدیریت سامانه</p>
        <?php
        echo "<p class='nameuser'>", $_SESSION['username'], " خوش آمدید </p>";
        ?>
        <img class="imgheader" src="../logo.jpg">
    </div>

    <div class="div-container">
        <div class="divmenu">
            <ul>
                <li><a class="a-tag" href="../ADMIN.php">🏠 صفحه‌ اصلی</a>
                    <ul>
                        <li>اعلان‌ها</li>
                        <li>اخبار سامانه </li>
                    </ul>
                </li>

                <li>📘 امور آموزشی
                    <ul>
                        <li><a href="user.php" class="a-tag">لیست کاربران</a></li>
                        <li><a href="manage_class.php" class="a-tag">مدیریت کلاس ها</a></li>
                        <li><a href="view_log.php" class="a-tag"> گزارشات سایت </a></li>
                    </ul>
                </li>
                <li>
                    <a href="../logout.php" style="color:red; text-decoration:none; padding-left:90px;">🔴 خروج</a>
                </li>
            </ul>
        </div>
        
        <div class="divmain">
            <h4 class="mb-3">📄 گزارش‌ها (فایل‌های لاگ)</h4>
            
            <div class="log-container">
                <?php if (empty($logFiles)): ?>
                    <div class="empty">
                        هیچ فایل لاگی پیدا نشد.
                    </div>
                <?php else: ?>
                    <?php foreach ($logFiles as $file): ?>
                        <?php
                        $fileName = basename($file);
                        $content = file_get_contents($file);
                        ?>
                        <div class="log-card">
                            <div class="log-title">
                                📁 <?php echo htmlspecialchars($fileName); ?>
                            </div>
                            <div class="log-content">
                                <?php echo nl2br(htmlspecialchars($content)); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <span class="line"></span>
            <a class="btn btn-primary" href="../ADMIN.php" role="button">بازگشت</a>
        </div>
    </div>
</body>

</html>