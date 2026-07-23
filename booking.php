<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require 'db_config.php';

$user_id = $_SESSION['user_id'];

// ============================================================
// BOOKING HANDLER  ← هذا هو الجزء المفقود
// ============================================================
if (isset($_POST['add_booking'])) {
    $class_name   = $conn->real_escape_string(trim($_POST['class_name']));
    $booking_date = $conn->real_escape_string(trim($_POST['booking_date']));
    $note         = $conn->real_escape_string(trim($_POST['note'] ?? ''));

    if (empty($class_name) || empty($booking_date)) {
        $book_error = "اسم الكلاس والتاريخ مطلوبان.";
    } else {
        // تحقق من عدم الحجز المكرر
        $dup = $conn->query(
            "SELECT id FROM bookings
             WHERE user_id='$user_id' AND class_name='$class_name' AND booking_date='$booking_date'"
        );
        if ($dup && $dup->num_rows > 0) {
            $book_error = "لقد قمت بحجز هذه الكلاس في نفس التاريخ مسبقاً.";
        } else {
            $insert = $conn->query(
                "INSERT INTO bookings (user_id, class_name, booking_date)
                 VALUES ('$user_id', '$class_name', '$booking_date')"
            );
            if ($insert) {
                $book_success = "تم تأكيد الحجز بنجاح!";
            } else {
                $book_error = "فشل الحجز: " . $conn->error;
            }
        }
    }
}

// قراءة حجوزات المستخدم الحالي
$my_bookings = $conn->query(
    "SELECT * FROM bookings WHERE user_id='$user_id' ORDER BY booking_date DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking | PowerFit Gym</title>
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
  <section class="page-title">
    <div class="container">
      <span class="badge">Booking Page</span>
      <h1>Confirm a class or PT session.</h1>
      <p class="lead">This page handles the transactional part of booking.</p>
    </div>
  </section>

  <section class="section">
    <div class="container grid grid-2">

      <!-- ===== BOOKING FORM ===== -->
      <div class="card">
        <h2>Booking Form</h2>

        <?php if (!empty($book_error)): ?>
          <div class="notice error"><?= htmlspecialchars($book_error) ?></div>
        <?php endif; ?>
        <?php if (!empty($book_success)): ?>
          <div class="notice success"><?= htmlspecialchars($book_success) ?></div>
        <?php endif; ?>

        <!-- method="POST" و name على كل حقل هو الإصلاح الرئيسي -->
        <form class="grid" method="POST" action="">
          <div>
            <label>Class / Session</label>
            <select name="class_name" required>
              <option value="">-- Select --</option>
              <option>Strength Training</option>
              <option>Cardio & HIIT</option>
              <option>Yoga & Mobility</option>
              <option>Boxing</option>
              <option>PT Session</option>
            </select>
          </div>
          <div>
            <label>Preferred Date</label>
            <input type="date" name="booking_date" required>
          </div>
          <div>
            <label>Note (Optional)</label>
            <textarea name="note" rows="3" placeholder="Any special request..."></textarea>
          </div>
          <button type="submit" name="add_booking" class="btn">Confirm Booking</button>
        </form>
      </div>

      <!-- ===== MY BOOKINGS TABLE ===== -->
      <div class="card">
        <h2>My Bookings</h2>
        <?php if ($my_bookings && $my_bookings->num_rows > 0): ?>
          <table style="width:100%;border-collapse:collapse;font-size:0.9rem">
            <thead>
              <tr style="background:var(--surface-alt,#f3f4f6)">
                <th style="padding:8px;text-align:left">Class</th>
                <th style="padding:8px;text-align:left">Date</th>
                <th style="padding:8px;text-align:left">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($b = $my_bookings->fetch_assoc()): ?>
              <tr style="border-top:1px solid #e5e7eb">
                <td style="padding:8px"><?= htmlspecialchars($b['class_name']) ?></td>
                <td style="padding:8px"><?= htmlspecialchars($b['booking_date']) ?></td>
                <td style="padding:8px">
                  <a href="dashboard.php?delete=<?= $b['id'] ?>"
                     style="color:red;text-decoration:none"
                     onclick="return confirm('Cancel this booking?')">Cancel</a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        <?php else: ?>
          <p class="muted">No bookings yet.</p>
        <?php endif; ?>

        <div class="divider"></div>
        <h3>Booking Rules</h3>
        <ul class="list">
          <li>You must have an active membership.</li>
          <li>You cannot book the same class twice on the same day.</li>
          <li>Full classes are blocked.</li>
          <li>Cancelled bookings remain visible in dashboard history.</li>
        </ul>
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