<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Travel Adviser Sri Lanka – Explore Sigiriya, Kandy, Ella, Galle, Trincomalee and Yala." />
    <title>Travel Adviser – Sri Lanka 🇱🇰</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@700;800&display=swap"
        rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <!-- ========== NAVBAR ========== -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top transparent" id="navbar">
        <div class="container">
            <!-- Brand -->
            <a href="index.php" class="navbar-brand">
                <span class="brand-name">
                    <i class="bi bi-airplane-fill text-info me-2"></i>Travel <strong>Adviser</strong> 🇱🇰
                </span>
            </a>
            <!-- Mobile toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Links -->
            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                <ul class="navbar-nav gap-lg-1 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="destination.php">Destinations</a></li>
                    <li class="nav-item"><a class="nav-link" href="offers.php">Offers</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item ms-lg-3">
                        <?php if ($isLoggedIn): ?>
                            <div class="dropdown">
                                <button class="btn btn-info btn-sm rounded-pill px-4 fw-bold dropdown-toggle" type="button" id="userDrop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-1"></i>Hi, <?php echo htmlspecialchars($userName); ?>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDrop">
                                    <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <a class="btn btn-info btn-sm rounded-pill px-4 fw-bold" href="login.php">Sign In</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- ========== HERO SECTION ========== -->
    <section id="home">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>

        <div class="container hero-content text-white py-5">
            <div class="row align-items-center g-5">

                <!-- Left: Headline -->
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="hero-badge mb-3"><i class="bi bi-stars me-1"></i>The Pearl of the Indian Ocean</div>

                    <h1 class="hero-title mb-3">
                        Explore the Wonder of<br />
                        <span>Sri Lanka</span>
                    </h1>

                    <p class="hero-sub mb-5">
                        Ancient temples, misty mountains, golden beaches &amp; wild safaris —<br
                            class="d-none d-md-block" />
                        Sri Lanka packs an entire world into one magnificent island.
                    </p>
                </div>

                <!-- Right: Login Card -->
                <div class="col-lg-6">
                    <?php if (!$isLoggedIn): ?>
                    <div class="login-card">

                        <!-- Auth Header -->
                        <h3 class="text-white fw-bold mb-4" id="authTitle"
                            style="font-family:'Playfair Display', serif;">Welcome Back</h3>

                        <!-- Success message -->
                        <div class="login-success" id="authSuccess">
                            <i class="bi bi-check-circle-fill"></i>
                            <span id="authSuccessMsg">Welcome back! Redirecting…</span>
                        </div>

                        <!-- LOGIN FORM -->
                        <form id="loginForm" onsubmit="handleLogin(event)" novalidate>
                            <div class="login-input-wrap">
                                <i class="bi bi-envelope l-icon"></i>
                                <input type="email" class="l-input" id="lEmail" placeholder="Email address" />
                            </div>
                            <p class="l-err-msg" id="lEmailErr">Please enter a valid email.</p>

                            <div class="login-input-wrap">
                                <i class="bi bi-lock l-icon"></i>
                                <input type="password" class="l-input" id="lPass" placeholder="Password" />
                            </div>
                            <p class="l-err-msg" id="lPassErr">Password must be at least 6 characters.</p>

                            <div class="text-end mb-3">
                                <a href="forgot_password.php" class="text-info small" style="text-decoration: none;">Forgot Password?</a>
                            </div>

                            <button type="submit" class="btn-login">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Log in
                            </button>

                            <div class="text-center mt-4">
                                <p class="mb-0" style="font-size: 0.85rem; color: rgba(255,255,255,0.6);">
                                    Don't have an account? <a href="javascript:void(0)" onclick="toggleAuth(true)"
                                        class="text-info fw-bold" style="text-decoration: none;">Sign Up</a>
                                </p>
                            </div>
                        </form>

                        <!-- SIGN UP FORM (Hidden by default) -->
                        <form id="signupForm" onsubmit="handleSignup(event)" novalidate style="display: none;">
                            <div class="login-input-wrap">
                                <i class="bi bi-person l-icon"></i>
                                <input type="text" class="l-input" id="sName" placeholder="Full Name" />
                            </div>
                            <p class="l-err-msg" id="sNameErr">Please enter your name.</p>

                            <div class="login-input-wrap">
                                <i class="bi bi-envelope l-icon"></i>
                                <input type="email" class="l-input" id="sEmail" placeholder="Email address" />
                            </div>
                            <p class="l-err-msg" id="sEmailErr">Please enter a valid email.</p>

                            <div class="login-input-wrap">
                                <i class="bi bi-lock l-icon"></i>
                                <input type="password" class="l-input" id="sPass"
                                    placeholder="Password (min. 6 chars)" />
                            </div>
                            <p class="l-err-msg" id="sPassErr">Password must be at least 6 characters.</p>

                            <button type="submit" class="btn-login">
                                <i class="bi bi-person-plus me-2"></i>Create Account
                            </button>

                            <div class="text-center mt-4">
                                <p class="mb-0" style="font-size: 0.85rem; color: rgba(255,255,255,0.6);">
                                    Already have an account? <a href="javascript:void(0)" onclick="toggleAuth(false)"
                                        class="text-info fw-bold" style="text-decoration: none;">Log In</a>
                                </p>
                            </div>
                        </form>

                    </div>
                    <?php else: ?>
                    <div class="text-center text-white py-5">
                        <i class="bi bi-check-circle text-info display-1 mb-4"></i>
                        <h2 class="fw-bold">You are logged in!</h2>
                        <p class="lead mb-4">Start exploring the beauty of Sri Lanka today.</p>
                        <a href="destination.php" class="btn btn-info rounded-pill px-5 fw-bold">Explore Destinations</a>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

    <!-- ========== REVIEWS SECTION ========== -->
    <section id="reviews" class="reviews-section py-5">
        <div class="container py-lg-4">
            <div class="text-center mb-5">
                <span class="section-badge">Testimonials</span>
                <h2 class="section-title mt-2">What Our Travelers Say</h2>
                <p class="text-muted">Real experiences from people who explored Sri Lanka with us</p>
            </div>

            <div class="row g-4">
                <!-- Review 1 -->
                <div class="col-lg-4">
                    <div class="review-card">
                        <i class="bi bi-quote rev-quote"></i>
                        <div class="rev-stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
                        </div>
                        <p class="rev-text">"Sigiriya was absolutely breathtaking. The climb was worth every step for
                            that view. Travel Adviser made the whole trip seamless and worry-free!"</p>
                        <div class="d-flex align-items-center gap-3">
                            <div
                                class="rev-pfp d-flex align-items-center justify-content-center bg-info-subtle text-info fw-bold">
                                JD</div>
                            <div>
                                <h6 class="rev-name">James Dalton</h6>
                                <span class="rev-country">United Kingdom</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Review 2 -->
                <div class="col-lg-4">
                    <div class="review-card">
                        <i class="bi bi-quote rev-quote"></i>
                        <div class="rev-stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
                        </div>
                        <p class="rev-text">"The train ride from Kandy to Ella was the highlight of my life. Sri Lanka
                            is truly a paradise, and the people are so incredibly kind."</p>
                        <div class="d-flex align-items-center gap-3">
                            <div
                                class="rev-pfp d-flex align-items-center justify-content-center bg-warning-subtle text-warning fw-bold">
                                SM</div>
                            <div>
                                <h6 class="rev-name">Sarah Müller</h6>
                                <span class="rev-country">Germany</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Review 3 -->
                <div class="col-lg-4">
                    <div class="review-card">
                        <i class="bi bi-quote rev-quote"></i>
                        <div class="rev-stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-half"></i>
                        </div>
                        <p class="rev-text">"Galle Fort has such a unique vibe. Blending history with modern boutiques
                            and cafes. Can't wait to come back next year for the surfing!"</p>
                        <div class="d-flex align-items-center gap-3">
                            <div
                                class="rev-pfp d-flex align-items-center justify-content-center bg-success-subtle text-success fw-bold">
                                AL</div>
                            <div>
                                <h6 class="rev-name">Antonio Lopez</h6>
                                <span class="rev-country">Spain</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========== FOOTER ========== -->
    <footer class="py-5">
        <div class="container text-center">
            <p>&copy; 2026 <strong>Travel Adviser Sri Lanka</strong>. All Rights Reserved.</p>
        </div>
    </footer>


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.addEventListener('scroll', function () {
            const nav = document.getElementById('navbar');
            nav.classList.toggle('transparent', window.scrollY < 60);
        });

        function toggleAuth(isSignup) {
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            const authTitle = document.getElementById('authTitle');
            const authSuccess = document.getElementById('authSuccess');

            authSuccess.classList.remove('show');

            if (isSignup) {
                loginForm.style.display = 'none';
                signupForm.style.display = 'block';
                authTitle.textContent = 'Join the Journey';
            } else {
                loginForm.style.display = 'block';
                signupForm.style.display = 'none';
                authTitle.textContent = 'Welcome Back';
            }
        }

        function lSetErr(id, errId) {
            document.getElementById(id).classList.add('l-error');
            document.getElementById(errId).classList.add('show');
        }
        function lClearErr(id, errId) {
            document.getElementById(id).classList.remove('l-error');
            document.getElementById(errId).classList.remove('show');
        }

        function handleLogin(e) {
            e.preventDefault();
            const emailVal = document.getElementById('lEmail').value.trim();
            const passVal = document.getElementById('lPass').value;
            const emailRx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let ok = true;

            if (!emailRx.test(emailVal)) { lSetErr('lEmail', 'lEmailErr'); ok = false; }
            else { lClearErr('lEmail', 'lEmailErr'); }

            if (passVal.length < 6) { lSetErr('lPass', 'lPassErr'); ok = false; }
            else { lClearErr('lPass', 'lPassErr'); }

            if (ok) {
                const formData = new FormData();
                formData.append('email', emailVal);
                formData.append('password', passVal);

                fetch('login_process.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const suc = document.getElementById('authSuccess');
                    const msgEl = document.getElementById('authSuccessMsg');

                    if (data.status === 'success') {
                        msgEl.textContent = 'Welcome back, ' + data.user_name + '! Redirecting...';
                        suc.style.background = 'rgba(16, 185, 129, 0.2)';
                        suc.style.color = '#10b981';
                        suc.classList.add('show');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        msgEl.textContent = data.message;
                        suc.style.background = 'rgba(239, 68, 68, 0.2)';
                        suc.style.color = '#ef4444';
                        suc.classList.add('show');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }

        function handleSignup(e) {
            e.preventDefault();
            const nameVal = document.getElementById('sName').value.trim();
            const emailVal = document.getElementById('sEmail').value.trim();
            const passVal = document.getElementById('sPass').value;
            const emailRx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let ok = true;

            if (nameVal === "") { lSetErr('sName', 'sNameErr'); ok = false; }
            else { lClearErr('sName', 'sNameErr'); }

            if (!emailRx.test(emailVal)) { lSetErr('sEmail', 'sEmailErr'); ok = false; }
            else { lClearErr('sEmail', 'sEmailErr'); }

            if (passVal.length < 6) { lSetErr('sPass', 'sPassErr'); ok = false; }
            else { lClearErr('sPass', 'sPassErr'); }

            if (ok) {
                const formData = new FormData();
                formData.append('fullName', nameVal);
                formData.append('email', emailVal);
                formData.append('password', passVal);

                fetch('register_process.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const suc = document.getElementById('authSuccess');
                    const msgEl = document.getElementById('authSuccessMsg');

                    if (data.status === 'success') {
                        msgEl.textContent = 'Account created successfully! Redirecting...';
                        suc.style.background = 'rgba(16, 185, 129, 0.2)';
                        suc.style.color = '#10b981';
                        suc.classList.add('show');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        msgEl.textContent = data.message;
                        suc.style.background = 'rgba(239, 68, 68, 0.2)';
                        suc.style.color = '#ef4444';
                        suc.classList.add('show');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</body>

</html>