<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Classes Schedule | PowerFit Gym</title>
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
  <section class="page-title"><div class="container"><span class="badge">Classes Schedule</span><h1>Browse classes before booking.</h1><p class="lead">The schedule page is for discovery. Actual confirmation happens on the booking page.</p></div></section>
  <section class="section-small">
    <div class="container">
      <div class="search-row">
        <input id="classSearch" placeholder="Search class, category, or trainer">
        <select id="categoryFilter"><option value="">All Categories</option><option>Strength</option><option>Cardio</option><option>Yoga</option><option>Boxing</option></select>
        <select id="levelFilter"><option value="">All Levels</option><option>Beginner</option><option>Intermediate</option><option>Advanced</option><option>All Levels</option></select>
        <select id="dayFilter"><option value="">All Days</option><option>Sunday</option><option>Monday</option><option>Tuesday</option><option>Wednesday</option><option>Thursday</option><option>Friday</option><option>Saturday</option></select>
      </div>
      <div class="grid grid-3" id="classesGrid"></div>
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
