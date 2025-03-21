<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Destinations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .logo {
            color: #4B45FF;
            font-weight: bold;
            font-size: 24px;
        }

        .navbar {
            padding: 15px 0;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .hero-section {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 90vh;
            background-image: url('{{ asset("assets/images/paris.webp") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1200px;
            padding: 0 15px;
        }

        .text-center {
            text-align: center;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: bold;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: white;
            margin: 0 auto;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            /* These additional properties ensure the subtitle stays centered */
            display: block;
            width: 100%;
            text-align: center;
        }

        .destination-card {
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .destination-card:hover {
            transform: translateY(-5px);
        }

        .destination-image {
            height: 200px;
            background-size: cover;
            background-position: center;
        }

        .destination-content {
            padding: 20px;
            background-color: white;
        }

        .destination-title {
            margin-bottom: 10px;
            font-weight: 600;
        }

        .destination-title a {
            color: #333;
            text-decoration: none;
        }

        .destination-title a:hover {
            color: #4B45FF;
        }

        .destination-title .location {
            color: #4B45FF;
        }

        .destination-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        .partner-section {
            margin: 50px 0;
        }

        .partner-logos {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .partner-logo {
            max-height: 40px;
            margin: 10px;
        }

        .footer {
            background-color: white;
            padding: 40px 0;
            margin-top: 50px;
        }

        .footer-logo {
            color: #4B45FF;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .footer-links h5 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links ul li {
            margin-bottom: 10px;
        }

        .footer-links ul li a {
            color: #666;
            text-decoration: none;
        }

        .footer-links ul li a:hover {
            color: #4B45FF;
        }

        .contact-info {
            margin-bottom: 20px;
        }

        .contact-info i {
            margin-right: 10px;
            color: #4B45FF;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #f8f9fa;
            color: #666;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 10px;
        }

        .social-links a:hover {
            background-color: #4B45FF;
            color: white;
        }

        .copyright {
            text-align: center;
            padding: 20px 0;
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .partner-logos {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand logo" href="#">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact us</a>
                    </li>
                </ul>
            </div>
            <div class="ms-3 d-none d-lg-block">
                <div class="text-end">
                    <small class="d-block text-muted">Contact us 24/7 to unlock the best deals</small>
                    <a href="tel:+1-111-111-1111" class="text-primary fw-bold">
                        <i class="fas fa-phone-alt"></i> +1-111-111-1111
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center align-items-center">
            <h1 class="hero-title">Explore more places to stay</h1>
            <p class="hero-subtitle">Find Your Haven: Unique Stays for Every Journey</p>
        </div>
    </section>

    <!-- Destinations Section -->
    <section class="container my-5">
        <div class="row">
            <!-- First Row -->
            <div class="col-md-4">
                <div class="destination-card">
                    <div class="destination-image"
                        style="background-image: url('{{ asset('assets/images/las-vegas.webp') }}');"></div>
                    <div class="destination-content">
                        <h3 class="destination-title">Stay among the atolls in <span class="location">Maldives</span>
                        </h3>
                        <p class="destination-description">
                            From the 2nd century AD, the islands were known as the "Money Isles" due to the abundance of
                            cowry shells, a currency of the early ages.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="destination-card">
                    <div class="destination-image"
                        style="background-image: url('{{ asset('assets/images/seul.webp') }}');"></div>
                    <div class="destination-content">
                        <h3 class="destination-title">Stay among the atolls in <span class="location">Maldives</span>
                        </h3>
                        <p class="destination-description">
                            From the 2nd century AD, the islands were known as the "Money Isles" due to the abundance of
                            cowry shells, a currency of the early ages.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="destination-card">
                    <div class="destination-image"
                        style="background-image: url('{{ asset('assets/images/tenzania.webp') }}');"></div>
                    <div class="destination-content">
                        <h3 class="destination-title">Stay among the atolls in <span class="location">Maldives</span>
                        </h3>
                        <p class="destination-description">
                            From the 2nd century AD, the islands were known as the "Money Isles" due to the abundance of
                            cowry shells, a currency of the early ages.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Second Row -->
            <div class="col-md-4">
                <div class="destination-card">
                    <div class="destination-image"
                        style="background-image: url('{{ asset('assets/images/las-vegas.webp') }}');"></div>
                    <div class="destination-content">
                        <h3 class="destination-title">Stay among the atolls in <span class="location">Maldives</span>
                        </h3>
                        <p class="destination-description">
                            From the 2nd century AD, the islands were known as the "Money Isles" due to the abundance of
                            cowry shells, a currency of the early ages.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="destination-card">
                    <div class="destination-image"
                        style="background-image: url('{{ asset('assets/images/seul.webp') }}');"></div>
                    <div class="destination-content">
                        <h3 class="destination-title">Stay among the atolls in <span class="location">Maldives</span>
                        </h3>
                        <p class="destination-description">
                            From the 2nd century AD, the islands were known as the "Money Isles" due to the abundance of
                            cowry shells, a currency of the early ages.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="destination-card">
                    <div class="destination-image"
                        style="background-image: url('{{ asset('assets/images/tenzania.webp') }}');"></div>
                    <div class="destination-content">
                        <h3 class="destination-title">Stay among the atolls in <span class="location">Maldives</span>
                        </h3>
                        <p class="destination-description">
                            From the 2nd century AD, the islands were known as the "Money Isles" due to the abundance of
                            cowry shells, a currency of the early ages.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Third Row -->
            <div class="col-md-4">
                <div class="destination-card">
                    <div class="destination-image"
                        style="background-image: url('{{ asset('assets/images/las-vegas.webp') }}');"></div>
                    <div class="destination-content">
                        <h3 class="destination-title">Stay among the atolls in <span class="location">Maldives</span>
                        </h3>
                        <p class="destination-description">
                            From the 2nd century AD, the islands were known as the "Money Isles" due to the abundance of
                            cowry shells, a currency of the early ages.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="destination-card">
                    <div class="destination-image"
                        style="background-image: url('{{ asset('assets/images/seul.webp') }}');"></div>
                    <div class="destination-content">
                        <h3 class="destination-title">Stay among the atolls in <span class="location">Maldives</span>
                        </h3>
                        <p class="destination-description">
                            From the 2nd century AD, the islands were known as the "Money Isles" due to the abundance of
                            cowry shells, a currency of the early ages.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="destination-card">
                    <div class="destination-image"
                        style="background-image: url('{{ asset('assets/images/tenzania.webp') }}');"></div>
                    <div class="destination-content">
                        <h3 class="destination-title">Stay among the atolls in <span class="location">Maldives</span>
                        </h3>
                        <p class="destination-description">
                            From the 2nd century AD, the islands were known as the "Money Isles" due to the abundance of
                            cowry shells, a currency of the early ages.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <div class="container partner-section">
        <div class="partner-logos">
            <img src="/api/placeholder/120/40" alt="IATA" class="partner-logo">
            <img src="/api/placeholder/120/40" alt="CLOUDFLARE" class="partner-logo">
            <img src="/api/placeholder/120/40" alt="FLEXPAY" class="partner-logo">
            <img src="/api/placeholder/120/40" alt="AMAZON PAY" class="partner-logo">
            <img src="/api/placeholder/120/40" alt="DIGICERT" class="partner-logo">
        </div>
        <div class="text-center text-muted mt-4">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                laoreet dolore</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-logo mb-4">LOGO</div>
                    <p>About the website</p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-links">
                        <h5>Quick links</h5>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-links">
                        <h5>Legal</h5>
                        <ul>
                            <li><a href="#">Important Guidelines</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Terms of service</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-links">
                        <h5>Keep in Touch</h5>
                        <div class="contact-info">
                            <p><i class="fas fa-phone-alt"></i> +1-111-111-1111</p>
                            <p><i class="fas fa-envelope"></i> email@gmail.com</p>
                        </div>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>© 2025 Logo incorporated</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>
