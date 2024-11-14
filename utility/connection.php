<?php
session_start();

// تأسيس اتصال بقاعدة البيانات
$servername = "localhost:3306";
$username = "onlinepa_onlinepa";
$password = "hsome370";
$dbname = "onlinepa_hayaakumsit";

$con = new mysqli($servername, $username, $password, $dbname);

// التحقق من اتصال قاعدة البيانات
if ($con->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

?>