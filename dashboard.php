<?php
session_start();
// Protect page from unauthorized access
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require 'db_config.php';
$user_id = $_SESSION['user_id'];

// Create booking
if (isset($_POST['add_booking'])) {
    $class = $_POST['class_name'];
    $date = $_POST['booking_date'];
    $conn->query("INSERT INTO bookings (user_id, class_name, booking_date) VALUES ('$user_id', '$class', '$date')");
}

// Delete booking
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM bookings WHERE id='$id' AND user_id='$user_id'");
}

// Update booking
if (isset($_POST['update_booking'])) {
    $id = $_POST['booking_id'];
    $new_date = $_POST['new_date'];
    $conn->query("UPDATE bookings SET booking_date='$new_date' WHERE id='$id' AND user_id='$user_id'");
}

// Search bookings
$search_query = "";
if (isset($_POST['search'])) {
    $term = $_POST['search_term'];
    $search_query = "AND class_name LIKE '%$term%'";
}

// Read bookings
$bookings = $conn->query("SELECT * FROM bookings WHERE user_id='$user_id' $search_query");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Dashboard | PowerFit Gym</title>
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
  <section class="page-title"><div class="container"><span class="badge">Member Dashboard</span><h1>Welcome, <span id="memberName">Member</span>.</h1><p class="lead">Manage your membership, bookings, and payments.</p></div></section>
  <section class="section">
    <div class="container dashboard-layout">
      <aside class="sidebar card">
        <a class="active" href="dashboard.php">Overview</a>
        <a href="booking.php">Book Session</a>
        <a href="payments.php">Payments</a>
        <a href="memberships.php">Change Plan</a>
      </aside>
      <div id="dashboardContent"></div>
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
