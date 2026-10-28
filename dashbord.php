<?php
session_start();

if (!isset($_SESSION["verde_user_id"])) {
    header("Location: index.php");
    exit;
}
$name = $_SESSION["verde_user_name"] ?? "کاربر VERDE";

if (isset($_GET["logout"])) {
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>حساب کاربری | VERDE</title>
<style>
*{box-sizing:border-box}
body{margin:0;font-family:Tahoma;background:#f4f6ef;color:#20382a}
header{background:white;padding:22px 6%;display:flex;justify-content:space-between;flex-wrap:wrap}
.logo{font-size:28px;font-weight:bold;letter-spacing:4px;color:#244c35}
main{max-width:900px;margin:auto;padding:30px 18px}
.welcome{padding:35px;background:#e2ebdc;border-radius:20px}
.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:22px}
.card{background:white;padding:22px;border-radius:16px}
a{color:inherit;text-decoration:none}
.btn{display:inline-block;background:#244c35;color:white;padding:12px 17px;border-radius:10px;margin-top:10px}
@media(max-width:650px){.grid{grid-template-columns:1fr}}
</style>
</head>
<body>
<header><div class="logo">VERDE</div><a href="home.php">بازگشت به سایت</a></header>
<main>
<div class="welcome">
<h1>سلام، <?= htmlspecialchars($name) ?> 🌿</h1>
<p>به پنل کاربری VERDE خوش آمدی.</p>
<a class="btn" href="products.php">خرید گیاه</a>
</div>
<div class="grid">
<div class="card"><h3>🪴 فروشگاه</h3><p>گیاهان و نهال‌ها را ببین.</p><a href="products.php">مشاهده محصولات ←</a></div>
<div class="card"><h3>🛒 سبد خرید</h3><p>محصولات انتخاب‌شده را بررسی کن.</p><a href="cart.php">مشاهده سبد ←</a></div>
<div class="card"><h3>🚪 خروج</h3><p>از حساب کاربری خارج شو.</p><a href="dashboard.php?logout=1">خروج از حساب ←</a></div>
</div>
</main>
</body>
</html>