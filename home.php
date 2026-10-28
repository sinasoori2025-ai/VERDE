<?php
session_start();
$name = $_SESSION["verde_user_name"] ?? "";
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>VERDE | خانهٔ سبز شما</title>
<style>
*{box-sizing:border-box}
body{margin:0;font-family:Tahoma;background:#f7f8f3;color:#20382a}
header{display:flex;justify-content:space-between;align-items:center;gap:15px;padding:22px 7%;background:white}
.logo{font-size:29px;letter-spacing:4px;font-weight:bold;color:#244c35}
nav{display:flex;gap:18px;flex-wrap:wrap}
a{color:inherit;text-decoration:none}
.hero{padding:85px 8%;background:linear-gradient(120deg,#e3ebdc,#f7f8f3);display:grid;grid-template-columns:1.3fr 1fr;align-items:center;gap:30px}
.hero h1{font-size:clamp(32px,5vw,60px);line-height:1.6;margin:0}
.hero p{line-height:2;color:#657267}
.btn{display:inline-block;background:#244c35;color:white;padding:15px 25px;border-radius:12px;margin-top:15px}
.plant{font-size:150px;text-align:center;background:#d6e2ce;border-radius:45% 45% 20% 20%;padding:30px}
section{padding:45px 8%}
.features{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
.feature{background:white;padding:25px;border-radius:18px}
footer{text-align:center;padding:30px;background:#20382a;color:white}
@media(max-width:700px){.hero{grid-template-columns:1fr;padding:45px 7%}.features{grid-template-columns:1fr}.plant{font-size:100px}header{flex-wrap:wrap}}
</style>
</head>
<body>
<header>
<div class="logo">VERDE</div>
<nav>
<a href="home.php">خانه</a>
<a href="products.php">فروشگاه</a>
<a href="cart.php">سبد خرید</a>
<a href="about.php">درباره ما</a>
<a href="dashboard.php">حساب من</a>
</nav>
</header>

<main>
<section class="hero">
<div>
<h1>طبیعت را به خانه‌ات بیاور</h1>
<p>مجموعه‌ای منتخب از گل‌های آپارتمانی، گیاهان خاص و نهال‌های باکیفیت برای ساختن فضایی زنده و دلنشین.</p>
<a class="btn" href="products.php">مشاهدهٔ محصولات</a>
</div>
<div class="plant">🪴</div>
</section>

<section>
<h2>چرا VERDE؟</h2>
<div class="features">
<div class="feature"><h3>🌱 انتخاب خاص</h3><p>محصولاتی برای سلیقه‌های متفاوت.</p></div>
<div class="feature"><h3>🪴 راهنمای نگهداری</h3><p>کمک به انتخاب گیاه متناسب با فضای شما.</p></div>
<div class="feature"><h3>🌿 خرید آسان</h3><p>محصولات را ببینید و به سبد خرید اضافه کنید.</p></div>
</div>
</section>
</main>
<footer>VERDE — خانه‌ای سبزتر، زندگی‌ای زیباتر</footer>
</body>
</html>