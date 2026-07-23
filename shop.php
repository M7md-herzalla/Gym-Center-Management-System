<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop Sales | PowerFit Gym</title>
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
      <span class="badge">Shop Sales</span>
      <h1>Supplements & gym accessories store.</h1>
      <p class="lead">A supplement shop page with realistic product images, prices, and cart simulation for whey protein, creatine, pre-workout, and gym accessories.</p>
    </div>
  </section>

  <section class="section-small">
    
      <div class="search-row">
        <input id="shopSearch" placeholder="Search products">
        <select id="shopCategory">
          <option value="">All Categories</option>
          <option>Whey Protein</option>
          <option>Creatine</option>
          <option>Pre-Workout</option>
          <option>Accessories</option>
        </select>
        <a class="btn secondary" href="#cartPanel">View Cart</a>
        <button class="btn danger" id="clearCartBtn">Clear Cart</button>
      </div>

      <div class="grid grid-3" id="shopGrid"></div>
    </div>
  </section>

  <section class="section-small" id="cartPanel">
    <div class="container grid grid-2">
      <div class="card">
        <h2>Shopping Cart</h2>
        <p class="muted">Add products, adjust quantity, then create a demo order.</p>
        <div id="cartBox"></div>
        <div class="cart-total">
          <span>Total</span>
          <strong id="cartTotal">0 JOD</strong>
        </div>
        <button class="btn green block mt" id="checkoutBtn">Create Demo Order</button>
      </div>

      <div class="card">
        <h2>Shop Features</h2>
        <ul class="list">
          <li>Product cards with price, stock, rating, and category.</li>
          <li>Search and category filter.</li>
          <li>Cart saved using localStorage.</li>
          <li>Demo checkout requires login.</li>
          <li>Admin dashboard can view shop orders.</li>
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
    <div><h3>Pages</h3><p><a href="memberships.php">Memberships</a></p><p><a href="schedule.php">Classes</a></p><p><a href="shop.php">Shop Sales</a></p></div>
    <div><h3>Contact</h3><p class="muted">Amman, Jordan</p><p class="muted">079 622 9090</p></div>
  </div>
  <div class="container"><p class="muted">© <span id="year"></span> PowerFit Gym Center System.</p></div>
</footer>
<script src="assets/js/app.js"></script>
</body>
</html>
