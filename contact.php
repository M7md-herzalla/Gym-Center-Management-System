<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us | PowerFit Gym</title>
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
  <section class="page-title"><div class="container"><span class="badge">Contact Us</span><h1>Get in touch with the gym.</h1><p class="lead">Send a message to the administration team.</p></div></section>
  <section class="section">
    <div class="container grid grid-2">
      <div class="card">
        <h2>Send Message</h2>
        <div id="contactMsg" class="notice hidden"></div>
        <form id="contactForm" class="grid">
          <div><label>Name</label><input id="contactName" required></div>
          <div><label>Email</label><input id="contactEmail" type="email" required></div>
          <div><label>Phone</label><input id="contactPhone"></div>
          <div><label>Subject</label><input id="contactSubject" required></div>
          <div><label>Message</label><textarea id="contactMessage" rows="5" required></textarea></div>
          <button class="btn">Send Message</button>
        </form>
      </div>
      <div class="card">
        <h2>Gym Information</h2>
        <p><strong>Location:</strong> Amman, Jordan</p>
        <p><strong>Phone:</strong> 079 622 9090</p>
        <p><strong>Email:</strong> info@powerfit.test</p>
        <div class="divider"></div>
        <h3>Opening Hours</h3>
        <p class="muted">Sunday - Thursday: 6:00 AM - 11:00 PM</p>
        <p class="muted">Friday - Saturday: 8:00 AM - 10:00 PM</p>
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
