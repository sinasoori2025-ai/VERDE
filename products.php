<?php
session_start();

$products = [
    ["name"=>"مونسترا دلیسیوزا","price"=>850000,"category"=>"indoor","emoji"=>"🌿","desc"=>"گیاه آپارتمانی برگ‌درشت"],
    ["name"=>"زاموفیلیا","price"=>650000,"category"=>"indoor","emoji"=>"🪴","desc"=>"مناسب نگهداری آسان"],
    ["name"=>"ارکیده","price"=>720000,"category"=>"flower","emoji"=>"🌸","desc"=>"گل زیبا برای هدیه"],
    ["name"=>"نهال لیمو","price"=>380000,"category"=>"tree","emoji"=>"🍋","desc"=>"نهال مرکبات"],
    ["name"=>"نهال زیتون","price"=>420000,"category"=>"tree","emoji"=>"🌳","desc"=>"انتخابی برای باغچه"],
    ["name"=>"پتوس","price"=>250000,"category"=>"indoor","emoji"=>"🍃","desc"=>"گیاه رونده و سبز"]
];

$added = isset($_GET["added"]);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>فروشگاه | VERDE</title>
<style>
*{box-sizing:border-box}
body{margin:0;font-family:Tahoma;background:#f7f8f3;color:#20382a}
header{background:white;padding:22px 6%;display:flex;justify-content:space-between;gap:15px;flex-wrap:wrap}
.logo{font-size:28px;letter-spacing:4px;color:#244c35;font-weight:bold}
a{color:inherit;text-decoration:none}
main{padding:35px 6%}
h1{font-size:32px}
.filters{display:flex;gap:10px;flex-wrap:wrap;margin:25px 0}
.filters button{border:1px solid #d6dfd2;background:white;padding:11px 17px;border-radius:20px;cursor:pointer}
.filters button.active{background:#244c35;color:white}
.products{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.card{background:white;border-radius:18px;padding:20px;box-shadow:0 8px 25px #183d240a}
.emoji{font-size:75px;text-align:center;background:#eaf0e4;border-radius:14px;padding:25px}
.desc{color:#6a766b;line-height:1.8}
.price{font-weight:bold;color:#244c35}
.add{background:#244c35;color:white;border:0;padding:12px;border-radius:10px;width:100%;cursor:pointer}
.notice{background:#e4f1df;padding:12px;border-radius:10px}
@media(max-width:800px){.products{grid-template-columns:repeat(2,1fr)}}
@media(max-width:520px){.products{grid-template-columns:1fr}}
</style>
</head>
<body>
<header>
<div class="logo">VERDE</div>
<nav>
<a href="home.php">خانه</a>　<a href="cart.php">سبد خرید</a>　<a href="dashboard.php">حساب من</a>
</nav>
</header>
<main>
<h1>فروشگاه VERDE</h1>
<p>گیاه موردعلاقه‌ات را انتخاب کن.</p>
<?php if ($added): ?><p class="notice">محصول به سبد خرید اضافه شد.</p><?php endif; ?>

<div class="filters">
<button class="active" data-filter="all">همه</button>
<button data-filter="indoor">گیاه آپارتمانی</button>
<button data-filter="flower">گل‌ها</button>
<button data-filter="tree">نهال‌ها</button>
</div>

<div class="products">
<?php foreach ($products as $index => $p): ?>
<article class="card" data-category="<?= htmlspecialchars($p["category"]) ?>">
<div class="emoji"><?= $p["emoji"] ?></div>
<h3><?= htmlspecialchars($p["name"]) ?></h3>
<p class="desc"><?= htmlspecialchars($p["desc"]) ?></p>
<p class="price"><?= number_format($p["price"]) ?> تومان</p>
<form action="cart.php" method="post">
<input type="hidden" name="product_id" value="<?= $index ?>">
<button class="add" type="submit" name="add_to_cart" value="1">افزودن به سبد خرید</button>
</form>
</article>
<?php endforeach; ?>
</div>
</main>
<script>
const filterButtons = document.querySelectorAll("[data-filter]");
const cards = document.querySelectorAll(".card[data-category]");

filterButtons.forEach(button => {
  button.addEventListener("click", () => {
    filterButtons.forEach(b => b.classList.remove("active"));
    button.classList.add("active");

    const filter = button.dataset.filter;
    cards.forEach(card => {
      card.hidden = filter !== "all" && card.dataset.category !== filter;
    });
  });
});
</script>
</body>
</html>