<?php
require_once __DIR__ . "/db.php";

echo "اتصال دیتابیس VERDE موفق بود!";

$stmt = $pdo->query("SELECT COUNT(*) FROM verde_products");
echo "<br>تعداد محصولات: " . $stmt->fetchColumn();
?>