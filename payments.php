<?php
session_start();
// Redirect to login if session is missing
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payments | PowerFit Gym</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="header">
  <div class="container nav">
    <a class="logo" href="home.php"><span class="logo-mark">PF</span> PowerFit</a>
    <nav class="nav-links" id="mainNav"></nav>
    <button class="mobile-toggle" id="mobileToggle">☰</button>
  </div>
</header>

<main>
  <section class="page-title"><div class="container"><span class="badge">Payments Page</span><h1>Complete a simulated membership payment.</h1><p class="lead">This is a safe front-end payment simulation. It does not collect real card data.</p></div></section>
  <section class="section">
    <div class="container grid grid-2">
      <div class="card" id="paymentSummary"></div>
      <div class="card">
        <h2>Payment Details</h2>
        <div id="paymentMsg" class="notice hidden"></div>
        <form id="paymentForm" class="grid">
          <div><label>Cardholder Name</label><input required placeholder="Mohammad Herzalla"></div>
          <div><label>Card Number</label><input required placeholder="4242 4242 4242 4242" maxlength="19"></div>
          <div class="form-grid">
            <div><label>Expiry</label><input required placeholder="12/30"></div>
            <div><label>CVV</label><input required placeholder="123" maxlength="4"></div>
          </div>
          <button class="btn green">Pay Now</button>
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
