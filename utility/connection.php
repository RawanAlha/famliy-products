<?php
session_start();

// تأسيس اتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mwl";

$con = new mysqli($servername, $username, $password, $dbname);

// التحقق من اتصال قاعدة البيانات
if ($con->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

?>
