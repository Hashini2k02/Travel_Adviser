<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Exclusive Travel Offers Sri Lanka – Grab the best deals for your dream vacation." />
    <title>Special Offers | Travel Adviser – Sri Lanka 🇱🇰</title>

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
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="navbar"
        style="background: rgba(10, 22, 50, 0.97) !important;">
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
                    <li class="nav-item"><a class="nav-link active" href="offers.php">Offers</a></li>
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

    <div style="height: 80px;"></div>

    <!-- ========== OFFERS SECTION ========== -->
    <section class="py-5 bg-light">
        <div class="container">
            <!-- Heading -->
            <div class="text-center mb-5">
                <span class="section-badge">Limited Time Only</span>
                <h2 class="section-title mt-2">Special Travel Offers</h2>
                <p class="text-muted mt-2">Exclusive discounts on our most popular tour packages</p>
            </div>

            <div class="row g-4">

                <!-- Offer 1 -->
                <div class="col-lg-6">
                    <div class="offer-card">
                        <div class="offer-badge">30% OFF</div>
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="offer-img-wrap h-100">
                                    <img src="images/360_F_472158460_EEZxYRnfbPVQHR1NGjkvgZKfiSsWnCri.jpg"
                                        alt="Sigiriya Tour" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body p-4">
                                    <div class="offer-expiry mb-2"><i class="bi bi-alarm me-1"></i>Expires in 3 days
                                    </div>
                                    <h4 class="fw-bold mb-2">Heritage Gateway</h4>
                                    <p class="text-muted small mb-3">Explore Sigiriya & Kandy in a 3-day luxury tour
                                        with local guides and 5-star stay.</p>
                                    <div class="mb-4">
                                        <span class="old-price">Rs.22,000</span>
                                        <span class="price-val">Rs.15,400</span>
                                        <span class="price-small">/person</span>
                                    </div>
                                    <a href="contact.php" class="btn btn-blue rounded-pill px-4">Claim Offer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offer 2 -->
                <div class="col-lg-6">
                    <div class="offer-card">
                        <div class="offer-badge">25% OFF</div>
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="offer-img-wrap h-100">
                                    <img src="images/pexels-lucasklein-34714986.jpg" alt="Ella Adventure" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body p-4">
                                    <div class="offer-expiry mb-2"><i class="bi bi-alarm me-1"></i>Ends this Weekend
                                    </div>
                                    <h4 class="fw-bold mb-2">Highland Adventure</h4>
                                    <p class="text-muted small mb-3">Scenic train ride to Ella, tea estate hiking, and
                                        waterfall trekking included.</p>
                                    <div class="mb-4">
                                        <span class="old-price">Rs.20,000</span>
                                        <span class="price-val">Rs.15,000</span>
                                        <span class="price-small">/person</span>
                                    </div>
                                    <a href="contact.php" class="btn btn-blue rounded-pill px-4">Claim Offer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offer 3 -->
                <div class="col-lg-6">
                    <div class="offer-card">
                        <div class="offer-badge">BUY 1 GET 1</div>
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="offer-img-wrap h-100">
                                    <img src="images/download (1).jpg" alt="Beach Holiday" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body p-4">
                                    <div class="offer-expiry mb-2"><i class="bi bi-star-fill me-1"></i>Summer Special
                                    </div>
                                    <h4 class="fw-bold mb-2">East Coast Bliss</h4>
                                    <p class="text-muted small mb-3">Whale watching in Trincomalee and snorkelling at
                                        Pigeon Island for couples.</p>
                                    <div class="mb-4">
                                        <span class="price-val">Rs.18,000</span>
                                        <span class="price-small">for Two</span>
                                    </div>
                                    <a href="contact.php" class="btn btn-blue rounded-pill px-4">Claim Offer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Offer 4 -->
                <div class="col-lg-6">
                    <div class="offer-card">
                        <div class="offer-badge">40% OFF</div>
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="offer-img-wrap h-100">
                                    <img src="images/download (2).jpg" alt="Wildlife Safari" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body p-4">
                                    <div class="offer-expiry mb-2"><i class="bi bi-alarm me-1"></i>Limited Spots!</div>
                                    <h4 class="fw-bold mb-2">Wild Yala Safari</h4>
                                    <p class="text-muted small mb-3">Family package for Yala wildlife safari with luxury
                                        camping and meals included.</p>
                                    <div class="mb-4">
                                        <span class="old-price">Rs.25,000</span>
                                        <span class="price-val">Rs.15,000</span>
                                        <span class="price-small">/family</span>
                                    </div>
                                    <a href="contact.php" class="btn btn-blue rounded-pill px-4">Claim Offer</a>
                                </div>
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
</body>

</html>