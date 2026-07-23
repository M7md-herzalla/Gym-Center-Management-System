const GYM = {
  dbKey: "gym_center_system_v1",
  currentKey: "gym_current_user_v1"
};

function $(selector){ return document.querySelector(selector); }
function $all(selector){ return [...document.querySelectorAll(selector)]; }

const seed = {
  users: [
    {
      id: 1,
      role: "member",
      firstName: "Mohammad",
      lastName: "Herzalla",
      email: "member@gym.com",
      phone: "0791111111",
      password: "member123",
      planId: 2,
      createdAt: "2026-06-01"
    }
  ],

  plans: [
    {id:1, name:"Basic", price:25, cycle:"Monthly", features:["Gym access", "Locker room", "2 group classes", "Basic support"], active:true},
    {id:2, name:"Standard", price:40, cycle:"Monthly", features:["Gym access", "Unlimited group classes", "1 PT session", "Nutrition tips"], active:true},
    {id:3, name:"Premium", price:75, cycle:"Monthly", features:["All access", "Unlimited classes", "4 PT sessions", "Priority booking","1 Free Creatine Supplement"], active:true}
  ],

  trainers: [
    {id:1, name:"Ahmad Khaled", specialty:"Strength Training", exp:"6 Years", cert:"Certified Fitness Coach", bio:"Focused on safe strength progress and muscle building.", active:true},
    {id:2, name:"Sara Nasser", specialty:"Cardio & HIIT", exp:"5 Years", cert:"HIIT Specialist", bio:"Builds energetic fat-burning and endurance classes.", active:true},
    {id:3, name:"Omar Saleh", specialty:"Personal Training", exp:"8 Years", cert:"Personal Trainer", bio:"Creates custom programs for beginners and advanced members.", active:true},
    {id:4, name:"Lina Hamdan", specialty:"Mobility & Yoga", exp:"4 Years", cert:"Yoga Coach", bio:"Improves mobility, balance, recovery and flexibility.", active:true}
  ],

  classes: [
    {id:1, title:"Morning Strength", category:"Strength", level:"Beginner", trainerId:1, day:"Sunday", time:"08:00", duration:60, capacity:18, status:"Open"},
    {id:2, title:"HIIT Burn", category:"Cardio", level:"Intermediate", trainerId:2, day:"Monday", time:"18:00", duration:45, capacity:20, status:"Open"},
    {id:3, title:"Full Body Power", category:"Strength", level:"Advanced", trainerId:3, day:"Tuesday", time:"19:00", duration:60, capacity:16, status:"Open"},
    {id:4, title:"Mobility Flow", category:"Yoga", level:"Beginner", trainerId:4, day:"Wednesday", time:"17:00", duration:50, capacity:22, status:"Open"},
    {id:5, title:"Boxing Conditioning", category:"Boxing", level:"Intermediate", trainerId:2, day:"Thursday", time:"20:00", duration:55, capacity:14, status:"Open"},
    {id:6, title:"Weekend Strength", category:"Strength", level:"All Levels", trainerId:1, day:"Saturday", time:"11:00", duration:60, capacity:18, status:"Open"}
  ],

  bookings: [
    {id:1, userId:1, type:"Class", classId:2, trainerId:null, date:"2026-06-08", status:"Confirmed", note:"Demo booking"}
  ],

  payments: [
    {id:1, userId:1, planId:2, amount:40, status:"Paid", date:"2026-06-01", ref:"PAY-DEMO-1001"}
  ],

  products: [
    {id:1, name:"Whey Protein Vanilla", category:"Whey Protein", price:55, stock:18, rating:4.8, desc:"Premium vanilla whey with 24g protein per serving. Great after training.", tag:"Best Seller", image:"assets/images/whey_vanilla.png"},
    {id:2, name:"Whey Protein Chocolate", category:"Whey Protein", price:60, stock:15, rating:4.7, desc:"Rich chocolate whey protein for recovery and daily protein support.", tag:"Popular", image:"assets/images/whey_chocolate.png"},
    {id:3, name:"Creatine Monohydrate", category:"Creatine", price:19, stock:25, rating:4.9, desc:"Classic creatine monohydrate formula to support strength and training performance.", tag:"Value", image:"assets/images/creatine_monohydrate.png"},
    {id:4, name:"Micronized Creatine", category:"Creatine", price:24, stock:14, rating:4.8, desc:"Micronized creatine for easy mixing and clean daily supplementation.", tag:"Clean", image:"assets/images/micronized_creatine.png"},
    {id:5, name:"Pre-Workout Energy", category:"Pre-Workout", price:33, stock:10, rating:4.5, desc:"Energy-focused pre-workout for intense gym sessions. Demo item only.", tag:"Energy", image:"assets/images/preworkout_energy.png"},
    {id:6, name:"Caffeine-Free Pre-Workout", category:"Pre-Workout", price:35, stock:9, rating:4.4, desc:"Pump-focused pre-workout without caffeine for evening training.", tag:"No Caffeine", image:"assets/images/preworkout_caffeine_free.png"},
    {id:7, name:"Shaker Bottle", category:"Accessories", price:4.5, stock:40, rating:4.6, desc:"Durable 700ml shaker bottle with mixing spring and easy-flip lid.", tag:"Accessory", image:"assets/images/shaker_bottle.png"},
    {id:8, name:"Gym Towel", category:"Accessories", price:3, stock:35, rating:4.3, desc:"Soft gym towel for training, cardio, and daily fitness sessions.", tag:"Accessory", image:"assets/images/gym_towel.png"}
  ],

  shopOrders: [],
  messages: []
};

function getDB(){
  const raw = localStorage.getItem(GYM.dbKey);

  if(!raw){
    localStorage.setItem(GYM.dbKey, JSON.stringify(seed));
    return structuredClone(seed);
  }

  const parsed = JSON.parse(raw);

  parsed.users = parsed.users || seed.users;
  parsed.plans = seed.plans;
  parsed.trainers = parsed.trainers || seed.trainers;
  parsed.classes = parsed.classes || seed.classes;
  parsed.bookings = parsed.bookings || seed.bookings;
  parsed.payments = parsed.payments || seed.payments;
  parsed.messages = parsed.messages || [];
  parsed.shopOrders = parsed.shopOrders || [];

  parsed.products = seed.products;

  return parsed;
}

function saveDB(db){
  localStorage.setItem(GYM.dbKey, JSON.stringify(db));
}

function currentUser(){
  const id = localStorage.getItem(GYM.currentKey);
  if(!id) return null;

  return getDB().users.find(u => String(u.id) === String(id)) || null;
}

function setCurrentUser(id){
  localStorage.setItem(GYM.currentKey, id);
}

function logout(){
  localStorage.removeItem(GYM.currentKey);
  location.href = "index.php";
}

function nextId(list){
  return list.length ? Math.max(...list.map(x => Number(x.id) || 0)) + 1 : 1;
}

function trainerName(id){
  const t = getDB().trainers.find(x => x.id == id);
  return t ? t.name : "Unknown";
}

function planName(id){
  const p = getDB().plans.find(x => x.id == id);
  return p ? p.name : "No plan";
}

function initLayout(){
  const nav = $("#mainNav");

  if(nav){
    const user = currentUser();
    const path = location.pathname.split("/").pop() || "index.php";

    nav.innerHTML = `
      <a href="home.php">Home</a>
      <a href="about.php">About</a>
      <a href="services.php">Services & Trainers</a>
      <a href="memberships.php">Memberships</a>
      <a href="schedule.php">Classes</a>
      <a href="shop.php">Shop Sales</a>
      <a href="contact.php">Contact</a>
      ${
        user
          ? `<a href="dashboard.php">Dashboard</a>
             <a href="#" id="logoutLink">Logout</a>`
          : `<a href="index.php">Login/Register</a>`
      }
    `;

    $all("#mainNav a").forEach(a => {
      if(a.getAttribute("href") === path){
        a.classList.add("active");
      }
    });

    const logoutLink = $("#logoutLink");
    if(logoutLink){
      logoutLink.addEventListener("click", e => {
        e.preventDefault();
        logout();
      });
    }
  }

  const mobile = $("#mobileToggle");
  if(mobile){
    mobile.addEventListener("click", () => $("#mainNav").classList.toggle("show"));
  }

  const year = $("#year");
  if(year){
    year.textContent = new Date().getFullYear();
  }
}

function renderPlans(target="#plansGrid", selectable=true){
  const el = $(target);
  if(!el) return;

  const db = getDB();

  el.innerHTML = db.plans.filter(p => p.active).map((p, i) => `
    <article class="card hover">
      <span class="badge">${i === 1 ? "Most Popular" : p.cycle}</span>
      <h3>${p.name}</h3>
      <div class="price">${p.price} JOD</div>
      <p class="muted">Per ${p.cycle.toLowerCase()} membership.</p>
      <ul class="list">${p.features.map(f => `<li>${f}</li>`).join("")}</ul>
      ${selectable ? `<a class="btn block" href="payments.php?plan=${p.id}">Choose ${p.name}</a>` : ""}
    </article>
  `).join("");
}

function renderTrainers(target="#trainersGrid"){
  const el = $(target);
  if(!el) return;

  const db = getDB();

  el.innerHTML = db.trainers.filter(t => t.active).map((t, i) => `
    <article class="card hover">
      <div class="icon">${["🏋️","🔥","💪","🧘"][i % 4]}</div>
      <h3>${t.name}</h3>
      <p><strong>${t.specialty}</strong></p>
      <p class="muted">${t.exp} • ${t.cert}</p>
      <p>${t.bio}</p>
      <a class="btn small secondary" href="booking.php?trainer=${t.id}">Book Session</a>
    </article>
  `).join("");
}

function renderClasses(target="#classesGrid"){
  const el = $(target);
  if(!el) return;

  const db = getDB();
  const q = ($("#classSearch")?.value || "").toLowerCase();
  const category = $("#categoryFilter")?.value || "";
  const level = $("#levelFilter")?.value || "";
  const day = $("#dayFilter")?.value || "";

  let list = db.classes.filter(c => c.status !== "Closed");

  if(q){
    list = list.filter(c => `${c.title} ${c.category} ${trainerName(c.trainerId)}`.toLowerCase().includes(q));
  }

  if(category) list = list.filter(c => c.category === category);
  if(level) list = list.filter(c => c.level === level);
  if(day) list = list.filter(c => c.day === day);

  el.innerHTML = list.map(c => {
    const booked = db.bookings.filter(b => b.classId == c.id && b.status === "Confirmed").length;
    const left = Math.max(c.capacity - booked, 0);

    return `
      <article class="card hover">
        <span class="badge">${c.day} • ${c.time}</span>
        <h3>${c.title}</h3>
        <p class="muted">${c.category} • ${c.level} • ${c.duration} min</p>
        <p>Trainer: <strong>${trainerName(c.trainerId)}</strong></p>
        <p>Available slots: <strong>${left}/${c.capacity}</strong></p>
        <a class="btn small ${left === 0 ? "secondary" : ""}" href="${left === 0 ? "#" : "booking.php?class=" + c.id}">
          ${left === 0 ? "Full" : "Book Class"}
        </a>
      </article>
    `;
  }).join("") || `<div class="notice warning">No classes match your filters.</div>`;
}

function setupLogin(){
  const loginForm = $("#loginForm");
  const registerForm = $("#registerForm");

  if(loginForm){
    loginForm.addEventListener("submit", e => {
      e.preventDefault();

      const db = getDB();
      const email = $("#loginEmail").value.trim().toLowerCase();
      const pass = $("#loginPassword").value;

      const user = db.users.find(u => u.email.toLowerCase() === email && u.password === pass);

      if(!user){
        return showMsg("#loginMsg", "Invalid email or password. Try member@gym.com / member123", "error");
      }

      setCurrentUser(user.id);
      location.href = "home.php";
    });
  }

  if(registerForm){
    registerForm.addEventListener("submit", e => {
      e.preventDefault();

      const db = getDB();
      const first = $("#firstName").value.trim();
      const last = $("#lastName").value.trim();
      const email = $("#registerEmail").value.trim().toLowerCase();
      const phone = $("#registerPhone").value.trim();
      const password = $("#registerPassword").value;
      const confirm = $("#confirmPassword").value;

      if(password.length < 6){
        return showMsg("#registerMsg", "Password must be at least 6 characters.", "error");
      }

      if(password !== confirm){
        return showMsg("#registerMsg", "Passwords do not match.", "error");
      }

      if(db.users.some(u => u.email.toLowerCase() === email)){
        return showMsg("#registerMsg", "This email is already registered.", "error");
      }

      const user = {
        id: nextId(db.users),
        role: "member",
        firstName: first,
        lastName: last,
        email,
        phone,
        password,
        planId: null,
        createdAt: new Date().toISOString().slice(0,10)
      };

      db.users.push(user);
      saveDB(db);
      setCurrentUser(user.id);

      location.href = "home.php";
    });
  }
}

function showMsg(selector, msg, type="success"){
  const el = $(selector);

  if(!el){
    return alert(msg);
  }

  el.className = `notice ${type}`;
  el.textContent = msg;
  el.classList.remove("hidden");
}

function requireAuth(){
  const user = currentUser();

  if(!user){
    location.href = "index.php";
    return null;
  }

  return user;
}

function renderDashboard(){
  const el = $("#dashboardContent");
  if(!el) return;

  const user = requireAuth();
  if(!user) return;

  const db = getDB();
  const bookings = db.bookings.filter(b => b.userId == user.id);
  const payments = db.payments.filter(p => p.userId == user.id);
  const activePlan = db.plans.find(p => p.id == user.planId);

  $("#memberName").textContent = `${user.firstName} ${user.lastName}`;

  el.innerHTML = `
    <div class="grid grid-3 mb">
      <div class="card metric">
        <div>
          <p class="muted">Active Plan</p>
          <strong>${activePlan ? activePlan.name : "None"}</strong>
        </div>
        <span class="status ${activePlan ? "active" : "pending"}">${activePlan ? "Active" : "Pending"}</span>
      </div>

      <div class="card metric">
        <div>
          <p class="muted">Bookings</p>
          <strong>${bookings.filter(b => b.status === "Confirmed").length}</strong>
        </div>
        <span>📅</span>
      </div>

      <div class="card metric">
        <div>
          <p class="muted">Payments</p>
          <strong>${payments.length}</strong>
        </div>
        <span>💳</span>
      </div>
    </div>

    <div class="grid grid-2">
      <section class="card">
        <h3>Upcoming Bookings</h3>
        <div class="divider"></div>
        ${
          bookings.length
          ? bookings.map(b => bookingRow(b, true)).join("")
          : `<p class="muted">No bookings yet.</p><a class="btn small" href="schedule.php">Book a Class</a>`
        }
      </section>

      <section class="card">
        <h3>Payment History</h3>
        <div class="divider"></div>
        ${
          payments.length
          ? payments.map(p => `<p><strong>${planName(p.planId)}</strong> — ${p.amount} JOD <span class="status paid">${p.status}</span><br><span class="muted">${p.date} • ${p.ref}</span></p>`).join("")
          : `<p class="muted">No payments yet.</p>`
        }
      </section>
    </div>
  `;

  $all("[data-cancel]").forEach(btn => {
    btn.addEventListener("click", () => {
      const id = Number(btn.dataset.cancel);
      const db = getDB();
      const b = db.bookings.find(x => x.id === id && x.userId === user.id);

      if(b){
        b.status = "Cancelled";
        saveDB(db);
        renderDashboard();
      }
    });
  });
}

function bookingRow(b, withCancel=false){
  const db = getDB();

  let title = b.type === "Class"
    ? (db.classes.find(c => c.id == b.classId)?.title || "Class")
    : `PT Session with ${trainerName(b.trainerId)}`;

  return `
    <div class="notice">
      <strong>${title}</strong>
      <span class="status ${b.status.toLowerCase()}">${b.status}</span><br>
      <span class="muted">${b.date || "Next available"} ${b.note ? "• " + b.note : ""}</span>
      ${withCancel && b.status === "Confirmed" ? `<br><button class="btn small danger mt" data-cancel="${b.id}">Cancel Booking</button>` : ""}
    </div>
  `;
}

function setupBooking(){
  const el = $("#bookingForm");
  if(!el) return;

  const user = requireAuth();
  if(!user) return;

  const db = getDB();
  const params = new URLSearchParams(location.search);
  const classId = params.get("class");
  const trainerId = params.get("trainer");

  $("#bookingClass").innerHTML = db.classes.map(c => `<option value="${c.id}" ${classId == c.id ? "selected" : ""}>${c.title} - ${c.day} ${c.time}</option>`).join("");
  $("#bookingTrainer").innerHTML = db.trainers.filter(t => t.active).map(t => `<option value="${t.id}" ${trainerId == t.id ? "selected" : ""}>${t.name} - ${t.specialty}</option>`).join("");

  const typeSelect = $("#bookingType");

  function toggle(){
    const isClass = typeSelect.value === "Class";
    $("#classField").classList.toggle("hidden", !isClass);
    $("#trainerField").classList.toggle("hidden", isClass);
  }

  if(trainerId){
    typeSelect.value = "PT Session";
  }

  toggle();
  typeSelect.addEventListener("change", toggle);

  el.addEventListener("submit", e => {
    e.preventDefault();

    const db = getDB();
    const type = $("#bookingType").value;
    const date = $("#bookingDate").value;

    if(!user.planId){
      return showMsg("#bookingMsg", "You need an active membership before booking. Please choose a plan first.", "error");
    }

    let booking = {
      id: nextId(db.bookings),
      userId: user.id,
      type,
      classId: null,
      trainerId: null,
      date,
      status: "Confirmed",
      note: $("#bookingNote").value.trim()
    };

    if(type === "Class"){
      booking.classId = Number($("#bookingClass").value);

      if(db.bookings.some(b => b.userId == user.id && b.classId == booking.classId && b.status === "Confirmed")){
        return showMsg("#bookingMsg", "You already booked this class.", "error");
      }

      const c = db.classes.find(x => x.id == booking.classId);
      const count = db.bookings.filter(b => b.classId == booking.classId && b.status === "Confirmed").length;

      if(count >= c.capacity){
        return showMsg("#bookingMsg", "This class is full. Choose another class.", "error");
      }
    }else{
      booking.trainerId = Number($("#bookingTrainer").value);
    }

    db.bookings.push(booking);
    saveDB(db);

    showMsg("#bookingMsg", "Booking confirmed successfully.", "success");

    el.reset();

    setTimeout(() => {
      location.href = "dashboard.php";
    }, 700);
  });
}

function setupPayments(){
  const el = $("#paymentForm");
  if(!el) return;

  const user = requireAuth();
  if(!user) return;

  const db = getDB();
  const params = new URLSearchParams(location.search);
  const planId = Number(params.get("plan") || user.planId || 2);
  const plan = db.plans.find(p => p.id === planId);

  $("#paymentSummary").innerHTML = plan
    ? `
      <h3>${plan.name} Membership</h3>
      <p class="muted">${plan.cycle} subscription</p>
      <div class="price">${plan.price} JOD</div>
      <ul class="list">${plan.features.map(f => `<li>${f}</li>`).join("")}</ul>
    `
    : `<div class="notice error">Plan not found.</div>`;

  el.addEventListener("submit", e => {
    e.preventDefault();

    if(!plan) return;

    const db = getDB();
    const u = db.users.find(x => x.id == user.id);

    u.planId = plan.id;

    db.payments.push({
      id: nextId(db.payments),
      userId: user.id,
      planId: plan.id,
      amount: plan.price,
      status: "Paid",
      date: new Date().toISOString().slice(0,10),
      ref: "PAY-" + Date.now()
    });

    saveDB(db);

    showMsg("#paymentMsg", "Payment completed successfully. Membership activated.", "success");

    setTimeout(() => {
      location.href = "dashboard.php";
    }, 800);
  });
}

function setupContact(){
  const form = $("#contactForm");
  if(!form) return;

  form.addEventListener("submit", e => {
    e.preventDefault();

    const db = getDB();

    db.messages.push({
      id: nextId(db.messages),
      name: $("#contactName").value.trim(),
      email: $("#contactEmail").value.trim(),
      phone: $("#contactPhone").value.trim(),
      subject: $("#contactSubject").value.trim(),
      message: $("#contactMessage").value.trim(),
      status: "New",
      date: new Date().toISOString().slice(0,10)
    });

    saveDB(db);

    showMsg("#contactMsg", "Your message has been sent successfully.", "success");

    form.reset();
  });
}

function setupHeroCarousel(){
  const track = $("#carouselTrack");
  if(!track) return;

  const slides = $all("#carouselTrack .carousel-slide");
  const dotsWrap = $("#carouselDots");
  let current = 0;

  function show(index){
    current = (index + slides.length) % slides.length;

    slides.forEach((slide, i) => {
      slide.classList.toggle("active", i === current);
    });

    $all("#carouselDots .carousel-dot").forEach((dot, i) => {
      dot.classList.toggle("active", i === current);
    });
  }

  dotsWrap.innerHTML = slides.map((_, i) => `
    <button class="carousel-dot ${i === 0 ? "active" : ""}" data-slide="${i}" aria-label="Go to slide ${i + 1}"></button>
  `).join("");

  $("#carouselPrev")?.addEventListener("click", () => show(current - 1));
  $("#carouselNext")?.addEventListener("click", () => show(current + 1));

  $all("#carouselDots .carousel-dot").forEach(dot => {
    dot.addEventListener("click", () => show(Number(dot.dataset.slide)));
  });

  setInterval(() => show(current + 1), 5000);

  show(0);
}

function renderShop(){
  const grid = $("#shopGrid");
  if(!grid) return;

  const db = getDB();
  const search = ($("#shopSearch")?.value || "").toLowerCase();
  const category = $("#shopCategory")?.value || "";

  let products = db.products || [];

  if(search){
    products = products.filter(p => `${p.name} ${p.category} ${p.desc}`.toLowerCase().includes(search));
  }

  if(category){
    products = products.filter(p => p.category === category);
  }

  grid.innerHTML = products.map(p => `
    <article class="card hover product-card">
      <div class="product-img"><img src="${p.image}" alt="${p.name}"></div>

      <div class="product-meta">
        <span class="badge">${p.tag}</span>
        <span class="muted">⭐ ${p.rating}</span>
      </div>

      <h3>${p.name}</h3>
      <p class="muted">${p.category}</p>
      <p>${p.desc}</p>

      <div class="product-bottom">
        <div>
          <strong>${p.price} JOD</strong>
          <span class="price-note">Realistic demo price</span>
        </div>
        <span class="muted">Stock: ${p.stock}</span>
      </div>

      <button class="btn block" data-add-product="${p.id}">Add to Cart</button>
    </article>
  `).join("") || `<div class="notice warning">No products match your search.</div>`;

  $all("[data-add-product]").forEach(btn => {
    btn.addEventListener("click", () => addToCart(Number(btn.dataset.addProduct)));
  });

  renderCart();
}

function getCart(){
  return JSON.parse(localStorage.getItem("gym_shop_cart_v1") || "[]");
}

function saveCart(cart){
  localStorage.setItem("gym_shop_cart_v1", JSON.stringify(cart));
}

function addToCart(productId){
  const db = getDB();
  const product = (db.products || []).find(p => p.id === productId);

  if(!product) return;

  const cart = getCart();
  const item = cart.find(x => x.productId === productId);

  if(item){
    item.qty += 1;
  }else{
    cart.push({productId, qty:1});
  }

  saveCart(cart);

  showMsg("#shopMsg", `${product.name} added to cart.`, "success");

  renderCart();
}

function changeCartQty(productId, change){
  const cart = getCart();
  const item = cart.find(x => x.productId === productId);

  if(!item) return;

  item.qty += change;

  const filtered = cart.filter(x => x.qty > 0);

  saveCart(filtered);

  renderCart();
}

function clearCart(){
  saveCart([]);
  renderCart();
}

function renderCart(){
  const cartBox = $("#cartBox");
  if(!cartBox) return;

  const db = getDB();
  const cart = getCart();

  if(!cart.length){
    cartBox.innerHTML = `<p class="muted">Your cart is empty.</p>`;
    $("#cartTotal") && ($("#cartTotal").textContent = "0 JOD");
    return;
  }

  let total = 0;

  cartBox.innerHTML = cart.map(item => {
    const p = (db.products || []).find(x => x.id === item.productId);

    if(!p) return "";

    const subtotal = p.price * item.qty;
    total += subtotal;

    return `
      <div class="cart-item">
        <div>
          <strong>${p.name}</strong><br>
          <span class="muted">${p.price} JOD × ${item.qty} = ${subtotal} JOD</span>
        </div>

        <div class="cart-actions">
          <button class="btn small secondary" onclick="changeCartQty(${p.id}, -1)">-</button>
          <button class="btn small secondary" onclick="changeCartQty(${p.id}, 1)">+</button>
        </div>
      </div>
    `;
  }).join("");

  $("#cartTotal") && ($("#cartTotal").textContent = total + " JOD");
}

function checkoutShop(){
  const user = currentUser();

  if(!user){
    return showMsg("#shopMsg", "Please login before checkout.", "error");
  }

  const cart = getCart();

  if(!cart.length){
    return showMsg("#shopMsg", "Your cart is empty.", "warning");
  }

  const db = getDB();

  const total = cart.reduce((sum, item) => {
    const p = (db.products || []).find(x => x.id === item.productId);
    return sum + (p ? p.price * item.qty : 0);
  }, 0);

  db.shopOrders = db.shopOrders || [];

  db.shopOrders.push({
    id: nextId(db.shopOrders),
    userId: user.id,
    items: cart,
    total,
    status: "Pending",
    date: new Date().toISOString().slice(0,10)
  });

  saveDB(db);
  clearCart();

  showMsg("#shopMsg", "Demo order created successfully. No real payment was made.", "success");
}

window.changeCartQty = changeCartQty;
window.checkoutShop = checkoutShop;
window.clearCart = clearCart;

document.addEventListener("DOMContentLoaded", () => {
  initLayout();

  renderPlans();
  renderTrainers();
  renderClasses();
  renderShop();

  setupHeroCarousel();
  setupLogin();
  renderDashboard();
  setupBooking();
  setupPayments();
  setupContact();

  ["classSearch","categoryFilter","levelFilter","dayFilter"].forEach(id => {
    $("#" + id)?.addEventListener("input", () => renderClasses());
  });

  ["shopSearch","shopCategory"].forEach(id => {
    $("#" + id)?.addEventListener("input", () => renderShop());
  });

  $("#checkoutBtn")?.addEventListener("click", checkoutShop);
  $("#clearCartBtn")?.addEventListener("click", clearCart);
});
