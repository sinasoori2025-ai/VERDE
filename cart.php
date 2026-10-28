<?php
session_start();

$products = [
    0 => ["name" => "مونسترا دلیسیوزا", "price" => 850000, "emoji" => "🌿"],
    1 => ["name" => "زاموفیلیا", "price" => 650000, "emoji" => "🪴"],
    2 => ["name" => "ارکیده", "price" => 720000, "emoji" => "🌸"],
    3 => ["name" => "نهال لیمو", "price" => 380000, "emoji" => "🍋"],
    4 => ["name" => "نهال زیتون", "price" => 420000, "emoji" => "🌳"],
    5 => ["name" => "پتوس", "price" => 250000, "emoji" => "🍃"]
];

if (!isset($_SESSION["verde_cart"]) || !is_array($_SESSION["verde_cart"])) {
    $_SESSION["verde_cart"] = [];
}

$cart = &$_SESSION["verde_cart"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    // افزودن محصول
    if (isset($_POST["add_to_cart"])) {
        $id = filter_var($_POST["product_id"] ?? null, FILTER_VALIDATE_INT);

        if ($id !== false && $id !== null && isset($products[$id])) {
            $cart[$id] = min(99, ($cart[$id] ?? 0) + 1);
        }

        header("Location: cart.php");
        exit;
    }

    // حذف محصول
    if ($action === "remove") {
        $id = filter_var($_POST["product_id"] ?? null, FILTER_VALIDATE_INT);

        if ($id !== false && $id !== null) {
            unset($cart[$id]);
        }
    }

    // خالی کردن سبد
    if ($action === "clear") {
        $cart = [];
    }

    // تغییر تعداد
    if ($action === "update") {
        $quantities = $_POST["quantities"] ?? [];

        foreach ($quantities as $id => $quantity) {
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $quantity = filter_var($quantity, FILTER_VALIDATE_INT);

            if ($id === false || !isset($products[$id])) {
                continue;
            }

            if ($quantity === false || $quantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id] = min(99, $quantity);
            }
        }
    }

    header("Location: cart.php");
    exit;
}

$total = 0;
foreach ($cart as $id => $quantity) {
    if (isset($products[$id]) && is_numeric($quantity)) {
        $total += $products[$id]["price"] * (int)$quantity;
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>سبد خرید | VERDE</title>

<style>
*{box-sizing:border-box}
body{margin:0;font-family:Tahoma,Arial;background:#f5f7f1;color:#20382a}
header{padding:22px 6%;background:white;display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap}
.logo{font-size:28px;font-weight:bold;letter-spacing:4px;color:#244c35}
a{color:inherit;text-decoration:none}
main{max-width:1000px;margin:auto;padding:30px 18px}
.item{background:white;padding:20px;border-radius:16px;margin:15px 0;display:flex;align-items:center;justify-content:space-between;gap:15px;flex-wrap:wrap;box-shadow:0 6px 20px #183d240a}
.product-info{display:flex;align-items:center;gap:14px}
.emoji{font-size:42px;background:#eaf0e4;padding:12px;border-radius:12px}
input[type=number]{width:85px;padding:10px;border:1px solid #d4ded0;border-radius:8px}
button,.btn{display:inline-block;padding:12px 16px;border:0;border-radius:10px;background:#244c35;color:white;cursor:pointer;font:inherit;text-align:center}
.remove{background:#a63b32}
.total{background:#e5eddf;padding:24px;border-radius:16px;margin-top:25px}
.actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:18px}
.empty{padding:40px 20px;background:white;border-radius:16px;text-align:center}
.price{color:#244c35;font-weight:bold}
@media(max-width:550px){.item{align-items:flex-start}.product-info{width:100%}.actions>*{width:100%}}
</style>
</head>

<body>
<header>
    <div class="logo">VERDE</div>
    <nav>
        <a href="home.php">خانه</a>　
        <a href="products.php">فروشگاه</a>　
        <a href="dashboard.php">حساب من</a>
    </nav>
</header>

<main>
<h1>سبد خرید شما 🛒</h1>

<?php if (empty($cart)): ?>
    <div class="empty">
        <h2>سبد خرید خالی است 🌱</h2>
        <p>هنوز محصولی انتخاب نکرده‌ای.</p>
        <a class="btn" href="products.php">