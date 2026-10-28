<?php
session_start();

$products = [
    0 => ["name"=>"مونسترا دلیسیوزا","price"=>850000],
    1 => ["name"=>"زاموفیلیا","price"=>650000],
    2 => ["name"=>"ارکیده","price"=>720000],
    3 => ["name"=>"نهال لیمو","price"=>380000],
    4 => ["name"=>"نهال زیتون","price"=>420000],
    5 => ["name"=>"پتوس","price"=>250000]
];

$total = 0;
foreach (($_SESSION["verde_cart"] ?? []) as $id => $qty) {
    if (isset($products[$id])) $total += $products[$id]["price"] * $qty;
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = "این فقط نسخه آزمایشی است. هیچ پرداخت واقعی انجام نشده است.";
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>پرداخت | VERDE</title>
<style>
*{box-sizing:border-box}
body{margin:0;font-family:Tahoma;background:#f3f5ef;color:#20382a;padding:20px}
.card{max-width:560px;margin:35px auto;background:white;padding:30px;border-radius:22px;box-shadow:0 12px 35px #183d2412}
h1{text-align:center;color:#244c35}
label{display:block;margin:18px 0 8px}
input,textarea{width:100%;padding:13px;border:1px solid #d7e0d4;border-radius:10px;font:inherit}
button,.btn{display:block;width:100%;text-align:center;padding:14px;margin-top:18px;background:#244c35;color:white;border:0;border-radius:10px;font:inherit;text-decoration:none;cursor:pointer}
.notice{background:#fff3d6;padding:13px;border-radius:10px;line-height:1.8}
</style>
</head>
<body>
<div class="card">
<h1>VERDE</h1>
<h2>تکمیل سفارش</h2>
<p>مبلغ سبد خرید: <strong><?= number_format($total) ?> تومان</strong></p>
<?php if ($message): ?><p class="notice"><?= htmlspecialchars($message) ?></p><?php endif; ?>

<form method="post">
<label>نام و نام خانوادگی</label>
<input name="customer_name" required maxlength="100">
<label>شماره تماس</label>
<input name="phone" type="tel" required maxlength="20">
<label>نشانی تحویل</label>
<textarea name="address" rows="4" required maxlength="1000"></textarea>
<button type="submit">ثبت آزمایشی سفارش</button>
</form>
<a class="btn" href="cart.php">بازگشت به سبد خرید</a>
</div>
</body>
</html>