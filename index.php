<?php
session_start();
require_once __DIR__ . "/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($email === "" || $password === "") {
        $error = "ایمیل و رمز عبور را وارد کن.";
    } else {
        $stmt = $pdo->prepare(
            "SELECT id, name, email, password_hash
             FROM verde_users WHERE email = ? LIMIT 1"
        );
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password_hash"])) {
            session_regenerate_id(true);
            $_SESSION["verde_user_id"] = $user["id"];
            $_SESSION["verde_user_name"] = $user["name"];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "ایمیل یا رمز عبور اشتباه است.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ورود | VERDE</title>
<style>
*{box-sizing:border-box}
body{margin:0;font-family:Tahoma,Arial;background:#f3f5ef;color:#20382a;min-height:100vh;display:grid;place-items:center;padding:20px}
.card{width:100%;max-width:420px;background:white;padding:35px;border-radius:24px;box-shadow:0 15px 45px #183d2415}
.logo{font-size:38px;font-weight:bold;letter-spacing:5px;text-align:center;color:#244c35}
p{text-align:center;color:#68756b}
label{display:block;margin:18px 0 8px}
input{width:100%;padding:14px;border:1px solid #d8e0d6;border-radius:12px;font-size:15px}
button,.btn{display:block;width:100%;padding:14px;margin-top:20px;border:0;border-radius:12px;background:#244c35;color:white;text-align:center;text-decoration:none;font-size:16px;cursor:pointer}
.error{color:#b3261e;background:#fff0ee;padding:12px;border-radius:10px}
</style>
</head>
<body>
<div class="card">
<div class="logo">VERDE</div>
<p>ورود به دنیای سبز شما</p>

<?php if ($error): ?>
<div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post">
<label>ایمیل</label>
<input type="email" name="email" required autocomplete="email">
<label>رمز عبور</label>
<input type="password" name="password" required autocomplete="current-password">
<button type="submit">ورود به حساب</button>
</form>

<a class="btn" href="register.php">ساخت حساب کاربری</a>
</div>
</body>
</html>