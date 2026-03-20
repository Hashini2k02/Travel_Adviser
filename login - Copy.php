<?php 
include 'session_check.php'; 
if ($isLoggedIn) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Sign in or create an account with Travel Adviser Sri Lanka." />
    <title>Sign In | Travel Adviser – Sri Lanka 🇱🇰</title>

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
    <style>
        body {
            background: #0a1628;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .auth-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            z-index: 2;
        }

        .auth-bg-decor {
            position: absolute;
            inset: 0;
            background: url('images/hero_srilanka.png') center/cover no-repeat;
            opacity: 0.15;
            z-index: 1;
        }
    </style>
</head>

<body>

    <!-- ========== NAVBAR ========== -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="navbar" style="background: rgba(10, 22, 50, 0.95);">
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="auth-bg-decor"></div>

    <div class="auth-container">
        <div class="login-card w-100">
            <!-- Auth Header -->
            <h3 class="text-white fw-bold mb-4" id="authTitle" style="font-family:'Playfair Display', serif;">Welcome
                Back</h3>

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

            <!-- SIGN UP FORM -->
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
                    <input type="password" class="l-input" id="sPass" placeholder="Password (min. 6 chars)" />
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
    </div>

    <!-- ========== FOOTER ========== -->
    <footer class="py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2026 <strong>Travel Adviser Sri Lanka</strong>. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
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
                            window.location.href = 'index.php';
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
                            window.location.href = 'index.php';
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

        // Check for URL params to switch to signup
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('signup')) {
            toggleAuth(true);
        }
    </script>
</body>

</html>