<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        :root {
            --primary-color: #6742c9;
            --light-gray: #f8f9fa;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
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

        .success-icon {
            width: 60px;
            height: 60px;
            background-color: #4CD964;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
        }

        .success-icon i {
            color: white;
            font-size: 30px;
        }

        .success-message {
            color: #4CD964;
            font-size: 24px;
            font-weight: 600;
        }

        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .reference-no {
            background-color: #F0F0FF;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .booking-info {
            padding: 20px;
        }

        .flight-summary {
            position: relative;
        }

        .flight-summary-header {
            padding: 15px;
            font-weight: 600;
            font-size: 18px;
            border-bottom: 1px solid #eee;
        }

        .flight-details {
            padding: 20px;
            position: relative;
        }

        .flight-path {
            position: relative;
            padding: 10px 0;
        }

        .flight-path:before {
            content: "";
            position: absolute;
            top: 50%;
            left: 70px;
            right: 70px;
            height: 1px;
            background: #ddd;
        }

        .flight-path:after {
            content: "✈";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 0 10px;
            color: #999;
        }

        .airport-code {
            font-weight: bold;
            font-size: 22px;
        }

        .airport-time {
            font-size: 16px;
        }

        .airport-location {
            font-size: 14px;
            color: #666;
        }

        .baggage-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .baggage-item {
            text-align: center;
        }

        .baggage-item p {
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }

        .baggage-item strong {
            font-size: 16px;
        }

        .passengers-details {
            padding: 20px;
        }

        .passenger-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .passenger-table th,
        .passenger-table td {
            padding: 12px;
        }

        .passenger-table thead th {
            background-color: #F0F0FF;
            font-weight: 600;
        }

        .passenger-table tbody tr:nth-child(even) {
            background-color: #F8F8FF;
        }

        .payment-summary {
            background-color: #4B45FF;
            color: white;
            padding: 15px;
            border-radius: 5px;
        }

        .payment-summary .total {
            font-size: 24px;
            font-weight: bold;
        }

        .visa-card {
            background-color: #F0F0FF;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .visa-logo {
            background-color: #1A1F71;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }

        .card-payment {
            position: sticky;
            top: 0;
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

        .payment-methods {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 40px 0;
        }

        .payment-methods img {
            height: 40px;
        }

        @media (max-width: 768px) {
            .flight-path:before {
                left: 40px;
                right: 40px;
            }

            .baggage-info {
                flex-direction: column;
            }

            .baggage-item {
                margin-bottom: 10px;
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

    <!-- Booking Confirmation -->
    <div class="container my-4">
        <div class="d-flex align-items-center mb-4">
            <div style="margin-right: 10px;">
                <img src="{{ asset('assets/images/check-mark.png') }}" width="60px" height="60px" class="mr-1" alt="">
            </div>
            <div>
                <h1 class="success-message mb-0">Your Booking Successfully Complete</h1>
                <p class="text-muted mb-0">Congratulations! Your Booking has been confirm. Thank you!</p>
            </div>
            <div class="ms-auto">
                <a href="#" class="btn btn-outline-primary me-2">Download Ticket</a>
                <a href="#" class="btn btn-outline-primary">Share Ticket</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Booking Info -->
                <div class="card mb-4">
                    <div class="booking-info">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="fw-bold">Mr. John Doe</h5>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <p class="mb-1 text-muted">Phone No</p>
                                        <p class="mb-1 text-muted">Email Id</p>
                                        <p class="mb-1 text-muted">Destination</p>
                                        <p class="mb-1 text-muted">Booking Date</p>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="mb-1">: 8976788989</p>
                                        <p class="mb-1">: wxzf@gmail.com</p>
                                        <p class="mb-1">: Nairobi Mombasa</p>
                                        <p class="mb-1">: 14 Mar 2025 17: 25: 55</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex justify-content-start align-items-center">
                                <div class="reference-no text-center">
                                    <p class="mb-1">Your booking reference no:</p>
                                    <p class="mb-0 fw-bold">#D88679</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flight Summary -->
                <div class="card mb-4">
                    <div class="flight-summary">
                        <div class="d-flex justify-content-between align-items-center flight-summary-header">
                            <h5 class="mb-0 fw-bold">Flight Summary</h5>
                            <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flightDetails">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <div id="flightDetails" class="flight-details">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <img src="/api/placeholder/30/30" alt="ABC Airline" class="me-2">
                                    <span>ABC Airline</span>
                                </div>
                                <div class="text-danger">Non-refundable</div>
                                <div>Travel Class: <strong>Economy</strong></div>
                            </div>

                            <div class="flight-path mb-4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="airport-code">NBI</div>
                                        <div class="airport-time">14:50</div>
                                        <div class="airport-location">Sun, 29 Jan 2023</div>
                                        <div class="airport-location">Moi Intl, Mombasa</div>
                                        <div class="airport-location">Kenya</div>
                                        <div class="airport-location">Terminal - 2, Gate - 25</div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="duration">
                                            <p>9hr 50min</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text-end">
                                        <div class="airport-code">MBO</div>
                                        <div class="airport-time">14:50</div>
                                        <div class="airport-location">Sun, 29 Jan 2023</div>
                                        <div class="airport-location">JFK Terminal, Nairobi,</div>
                                        <div class="airport-location">Kenya</div>
                                        <div class="airport-location">Terminal - 2, Gate - 25</div>
                                    </div>
                                </div>
                            </div>

                            <div class="baggage-info">
                                <div class="baggage-item">
                                    <p>Baggage</p>
                                    <strong>ADULT</strong>
                                </div>
                                <div class="baggage-item">
                                    <p>Check-in</p>
                                    <strong>23Kgs (1 Piece * 23Kgs)</strong>
                                </div>
                                <div class="baggage-item">
                                    <p>Cabin</p>
                                    <strong>7Kgs (1 Piece * 7Kgs)</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Passengers Details -->
                <div class="card mb-4">
                    <div class="passengers-details">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-users me-2"></i> Passengers Details
                            </h5>
                        </div>
                        <div class="table-responsive">
                            <table class="passenger-table">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Title</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Empty table rows as shown in the image -->
                                    <tr>
                                        <td colspan="7">&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Payment Summary -->
                <div class="card mb-4 card-payment">
                    <div class="card-body">
                        <p class="mb-4" style="color: #605DEC;">All prices are quoted in USD</p>
                        <h5>PAYMENT</h5>

                        <div class="visa-card mt-3 mb-4">
                            <div class="d-flex align-items-center">
                                <div style="padding-right: 15px; border-right: 1px solid #000;">
                                    <span VISA class=" visa-logo">VISA</span>
                                </div>
                                <div style="margin-left: 15px;">
                                    <p class="mb-1">Base fare</p>
                                    <p class="mb-0">XXXXXXXXXXXX3820</p>
                                </div>

                            </div>

                        </div>

                        <div class="mb-3">
                            <h5>FARE BREAKUP</h5>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span>Adult x 1</span>
                                <span>$139</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Total</span>
                                <span>$139</span>
                            </div>
                        </div>

                        <div class="payment-summary mt-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Total Amount</span>
                                <span class="total">$139</span>
                            </div>
                            <small>All prices (including taxes& fees) are quoted in USD</small>
                        </div>

                        <div class="mt-4 text-center d-flex justify-content-start align-items-center px-3">
                            <div class="me-3">
                                <img src="{{ asset('assets/images/phone-call.webp') }}" width="50px" height="50px"
                                    alt="">
                            </div>
                            <div>
                                <p class="m-0 text-start">Need Any Help?</p>
                                <a href="tel:+" style="text-decoration: none; color: #4B45FF;">Call Now
                                    <strong>+1-111-111-1111</strong></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="payment-methods">
            <img src="/api/placeholder/120/40" alt="IATA">
            <img src="/api/placeholder/120/40" alt="CLOUDFLARE">
            <img src="/api/placeholder/120/40" alt="FLEXPAY">
            <img src="/api/placeholder/120/40" alt="AMAZON PAY">
            <img src="/api/placeholder/120/40" alt="DIGICERT">
        </div>

        <div class="text-center text-muted">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                laoreet
                dolore</p>
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
                        <h5>Quick Links</h5>
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
                            <p class="fw-bold"><i class="fas fa-phone-alt"></i> +1-111-111-1111</p>
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
