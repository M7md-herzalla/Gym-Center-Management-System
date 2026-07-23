<?php
session_start();
require 'db_config.php';

// ============================================================
// LOGIN HANDLER
// ============================================================
if (isset($_POST['login'])) {
    $email = $conn->real_escape_string(trim($_POST['email']));
    $pass  = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($pass, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['first_name'];
            header("Location: dashboard.php");
            exit();
        } else {
            $login_error = "كلمة المرور غير صحيحة.";
        }
    } else {
        $login_error = "البريد الإلكتروني غير موجود.";
    }
}

// ============================================================
// REGISTER HANDLER  ← هذا هو الجزء المفقود
// ============================================================
if (isset($_POST['register'])) {
    $first_name = $conn->real_escape_string(trim($_POST['first_name']));
    $last_name  = $conn->real_escape_string(trim($_POST['last_name']));
    $email      = $conn->real_escape_string(trim($_POST['reg_email']));
    $password   = $_POST['reg_password'];
    $confirm    = $_POST['confirm_password'];

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $reg_error = "جميع الحقول مطلوبة.";
    } elseif ($password !== $confirm) {
        $reg_error = "كلمتا المرور غير متطابقتين.";
    } elseif (strlen($password) < 6) {
        $reg_error = "كلمة المرور يجب أن تكون 6 أحرف على الأقل.";
    } else {
        // تحقق من عدم تكرار البريد الإلكتروني
        $check = $conn->query("SELECT id FROM users WHERE email='$email'");
        if ($check && $check->num_rows > 0) {
            $reg_error = "البريد الإلكتروني مستخدم مسبقاً.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->query(
                "INSERT INTO users (first_name, last_name, email, password)
                 VALUES ('$first_name', '$last_name', '$email', '$hashed')"
            );
            if ($insert) {
                $reg_success = "تم إنشاء الحساب بنجاح! يمكنك تسجيل الدخول الآن.";
            } else {
                $reg_error = "فشل إنشاء الحساب: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login / Register | PowerFit Gym</title>
<link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<header class="header">
  <div class="container nav">
    <a class="logo" href="index.php"><span class="logo-mark">PF</span> PowerFit</a>
    <nav class="nav-links" id="mainNav"></nav>
    <button class="mobile-toggle" id="mobileToggle">☰</button>
  </div>
</header>

<main>
  <section class="page-title">
    <div class="container">
      <span class="badge">Account Access</span>
      <h1>Login or create a member account.</h1>
      <p class="lead">Demo member: member@gym.com / member123.</p>
    </div>
  </section>

  <section class="section">
    <div class="container auth-layout">

      <!-- ===== LOGIN FORM ===== -->
      <div class="card">
        <h2>Login</h2>
        <?php if (!empty($login_error)): ?>
          <div class="notice error"><?= htmlspecialchars($login_error) ?></div>
        <?php endif; ?>
        <form class="grid" method="POST" action="">
          <div>
            <label>Email</label>
            <input type="email" name="email" required placeholder="member@gym.com">
          </div>
          <div>
            <label>Password</label>
            <input type="password" name="password" required placeholder="member123">
          </div>
          <button type="submit" name="login" class="btn">Login</button>
        </form>
      </div>

      <!-- ===== REGISTER FORM ===== -->
      <div class="card">
        <h2>Register</h2>
        <?php if (!empty($reg_error)): ?>
          <div class="notice error"><?= htmlspecialchars($reg_error) ?></div>
        <?php endif; ?>
        <?php if (!empty($reg_success)): ?>
          <div class="notice success"><?= htmlspecialchars($reg_success) ?></div>
        <?php endif; ?>
        <!-- method="POST" و name على كل حقل هو الإصلاح الرئيسي -->
        <form class="form-grid" method="POST" action="">
          <div><label>First Name</label><input type="text" name="first_name" required></div>
          <div><label>Last Name</label><input type="text" name="last_name" required></div>
          <div><label>Email</label><input type="email" name="reg_email" required></div>
          <div><label>Phone</label><input type="text" name="phone"></div>
          <div><label>Password</label><input type="password" name="reg_password" minlength="6" required></div>
          <div><label>Confirm Password</label><input type="password" name="confirm_password" minlength="6" required></div>
          <div class="full"><button type="submit" name="register" class="btn block">Create Account</button></div>
        </form>
      </div>

    </div>
  </section>
</main>

<footer class="footer">
  <div class="container footer-grid">
    <div>
      <div class="logo"><span class="logo-mark">PF</span> PowerFit</div>
      <p class="muted">A complete Gym Center System for membership, classes, trainers, booking, payments, shop sales, and member management.</p>
    </div>
    <div><h3>Pages</h3><p><a href="memberships.php">Memberships</a></p><p><a href="schedule.php">Classes</a></p><p><a href="services.php">Trainers</a></p><p><a href="shop.php">Shop Sales</a></p></div>
    <div><h3>Contact</h3><p class="muted">Amman, Jordan</p><p class="muted">079 622 9090</p></div>
  </div>
  <div class="container"><p class="muted">© <span id="year"></span> PowerFit Gym Center System.</p></div>
</footer>
<script src="assets/js/app.js"></script>
</body>
</html>