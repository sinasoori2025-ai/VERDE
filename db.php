<?php
$host = "localhost";
$dbname = "VERDE";
$username = "root";
$password = ""; // رمز MySQL در WampServer

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit("اتصال به دیتابیس VERDE برقرار نشد. تنظیمات MySQL را بررسی کن.");
}
?>