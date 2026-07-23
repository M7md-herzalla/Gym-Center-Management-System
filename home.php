<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | PowerFit Gym</title>
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
  <section class="hero">
    <div class="container hero-grid">
      <div>
        <h1>Train harder. Book smarter. Manage everything online.</h1>
        <p class="lead">PowerFit is a full gym website system with memberships, class schedules, trainer booking, payments, member dashboard, shop sales, and member dashboard controls.</p>
        <div class="hero-actions">
          <a class="btn" href="memberships.php">Join Now</a>
          <a class="btn secondary" href="schedule.php">View Classes</a>
        </div>
      </div>

      <div class="hero-card carousel-card">
        <div class="hero-carousel" id="heroCarousel">
          <div class="carousel-track" id="carouselTrack">
            <div class="carousel-slide active">
              <img src="assets/images/gym_slide_1.png" alt="Modern strength training area">
            </div>

            <div class="carousel-slide">
              <img src="assets/images/gym_slide_2.png" alt="Functional training and cardio area">
            </div>
          </div>

          <button class="carousel-btn prev" id="carouselPrev" aria-label="Previous image">❮</button>
          <button class="carousel-btn next" id="carouselNext" aria-label="Next image">❯</button>
          <div class="carousel-dots" id="carouselDots"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-small">
    <div class="container grid grid-4">
      <div class="card"><div class="icon">🏋️</div><h3>Modern Equipment</h3><p class="muted">Strength, cardio, and functional training areas.</p></div>
      <div class="card"><div class="icon">📅</div><h3>Easy Booking</h3><p class="muted">Reserve classes or personal training sessions online.</p></div>
      <div class="card"><div class="icon">💳</div><h3>Payments</h3><p class="muted">Simple membership payment simulation.</p></div>
      <div class="card"><div class="icon">🛡️</div><h3>Member Dashboard</h3><p class="muted">Manage your membership, bookings, payments, and shop orders.</p></div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <span class="badge">Memberships</span>
      <h2>Choose your training plan</h2>
      <p class="lead">Simple membership cards with clear features and direct payment flow.</p>
      <div class="grid grid-3 mt" id="plansGrid"></div>
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
