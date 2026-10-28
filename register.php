<?php
session_start();
require_once __DIR__ . "/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
        $error = "نام و ایمیل معتبر وارد کن. رمز باید حداقل ۸ کاراکتر باشد.";
    } else {
        try {
            $check = $pdo->prepare("SELECT id FROM verde_users WHERE email = ? LIMIT 1");
            $check->execute([$email]);

            if ($check->fetch()) {
                $error = "این ایمیل قبلاً ثبت شده است.";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare(
                    "INSERT INTO verde_users (name, email, password_hash) VALUES (?, ?, ?)"
                );
                $stmt->execute([$name, $email, $hash]);

                session_regenerate_id(true);
                $_SESSION["verde_user_id"] = $pdo->lastInsertId();
                $_SESSION["verde_user_name"] = $name;

                header("Location: dashboard.php");
                exit;
            }
        } catch (PDOException $e) {
            $error = "ثبت‌نام انجام نشد؛ ساختار جدول را بررسی کن.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ثبت‌نام | VERDE</title>
<style>
*{box-sizing:border-box}
body{margin:0;background:#f3f5ef;color:#20382a;font-family:Tahoma;min-height:100vh;display:grid;place-items:center;padding:20px}
.card{background:white;width:100%;max-width:440px;padding:32px;border-radius:24px;box-shadow:0 15px 45px #183d2415}
h1{text-align:center;color:#244c35;letter-spacing:4px}
label{display:block;margin:16px 0 8px}

input{width:100%;padding:14px;border:1px solid #d8e0d6;border-radius:12px}

button{width:100%;padding:14px;margin-top:20px;border:0;border-radius:12px;background:#244c35;color:white;font-size:16px;cursor:pointer}
.error{background:#fff0ee;color:#b3261e;padding:12px;border-radius:10px}
a{color:#244c35}
</style>
</head>
<body>
<div class="card">
<h1>VERDE</h1>
<h2>ساخت حساب کاربری</h2>
<?php if ($error): ?>
<p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="post">
<label>نام</label>
<input name="name" required maxlength="100">
<label>ایمیل</label>
<input type="email" name="email" required>
<label>رمز عبور (حداقل ۸ کاراکتر)</label>
<input type="password" name="password" minlength="8" required>
<button type="submit">ثبت‌نام</button>
</form>
<p><a href="index.php">قبلاً حساب ساخته‌ام؛ ورود</a></p>
</div>
</body>
</html>