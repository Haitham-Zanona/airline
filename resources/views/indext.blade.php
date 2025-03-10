<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Booking Website</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Custom styles that can't be achieved with Bootstrap classes */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Header styles */
        header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            z-index: 100;
        }

        .logo {
            color: #4444ff;
            font-weight: bold;
            font-size: 24px;
        }

        .nav-link {
            color: #333;
            transition: color 0.3s;
            font-size: 18px;
            font-weight: 600;
        }

        .nav-link:hover {
            color: #4444ff;
        }

        .contact-info {
            color: #4444ff;
        }

        #result1,
        #result2 {
            position: absolute;
            width: 20%;
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid #ccc;
            border-radius: 5px;
            max-height: 250px;
            overflow-y: auto;
            z-index: 1000;
        }

        label {
            font-size: 14px;
        }

        #result1 p,
        #result2 p {
            cursor: pointer;
            padding: 10px;
            font-weight: 600;
            margin: 0;
            border-bottom: 1px solid #ddd;
            transition: background 0.3s ease-in-out;
            color: #000;
        }

        #result1 p:hover,
        #result2 p:hover {
            background: #f1f1f1;
            color: #000;
        }

        /* Hero section */
        .hero {
            position: relative;
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.2)), url('assets/images/hero-background.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            width: 100%;
            color: white;
        }

        /* Search form */
        .search-form {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .search-form .form-control,
        .search-form .form-select {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .search-btn {
            background-color: #4444ff;
            border-color: #4444ff;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        .search-btn:hover {
            background-color: #3333cc;
            border-color: #3333cc;
        }

        /* Reviews section */
        .reviews {
            margin-top: -50px;
            position: relative;
        }

        .review-card {
            min-width: 200px;
            text-align: center;
        }

        .review-stars {
            color: #FFD700;
        }

        /* Feature cards */
        .feature-card {
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background-color: #4444ff;
            border-radius: 10px;
            font-size: 24px;
        }

        /* Place cards */
        .place-card {
            transition: transform 0.3s;
            overflow: hidden;
        }

        .place-card:hover {
            transform: translateY(-10px);
        }

        .place-img {
            height: 200px;
            object-fit: cover;
        }

        .explore-more {
            background-color: #4444ff;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        .explore-more:hover {
            background-color: #3333cc;
        }

        /* Color accent */
        .text-accent {
            color: #4444ff;
        }

        /* Scroll arrows */
        .scroll-arrow {
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            z-index: 10;
        }

        .subscribe-section {
            padding: 40px 0;
        }

        .subscribe-btn {
            background-color: #6f42c1;
            color: white;
            border: none;
        }

        .logo {
            color: #6f42c1;
            font-weight: bold;
            font-size: 24px;
        }

        .footer {
            font-family: Arial, sans-serif;
        }

        .footer a:hover {
            color: #6f42c1 !important;
        }

        .footer .btn-primary:hover {
            opacity: 0.9;
        }

        @media (max-width: 767px) {
            .footer .d-flex.flex-column.flex-md-row {
                gap: 10px;
            }
        }

        /* .footer-links h5 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
            padding-left: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #6c757d;
            text-decoration: none;
        }

        .footer-links a:hover {
            color: #6f42c1;
        } */

        .social-icons {
            margin-right: 15px;
            color: #6c757d;
            font-size: 20px;
        }

        .app-badge {
            height: 40px;
            margin-bottom: 10px;
        }

        .partners-logos {
            margin-top: 30px;
        }

        .partners-logos img {
            height: 40px;
            margin: 0 15px;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu.show {
            display: block;
        }

        .btn-outline-secondary {
            color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
        }

        .btn-outline-secondary:focus {
            box-shadow: none;
        }
    </style>
</head>

<body>


    <section class="hero d-flex align-items-center">
        <header class="py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 col-6">
                        <div class="logo">LOGO</div>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0 order-md-2 order-3">
                        <ul class="nav justify-content-center">
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
                    <div class="col-md-3 col-6 text-end order-md-3 order-2">
                        <div class="contact-info d-flex align-items-center">
                            <img src="{{ asset('assets/images/phone-call.png') }}" width="40px" height="40px" alt="">
                            <div class="text-start mx-2">
                                <p class="m-0" style="font-size: 12px;">Contact us 24/7 for book the best deal!</p>
                                <span class="fw-bold"><a href="tel:+1-111-111-1111"
                                        style="text-decoration: none; color: #4444ff;">+1-111-111-1111</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="hero-content container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">
                    <h1 class="display-4 fw-bold">Transforming Travel,<br>One Trip at a Time</h1>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('flight.search') }}" method="POST" class="search-form p-4">
                        @csrf
                        <h3 class="text-center mb-4">Find your ticket Now</h3>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="origin_city" class="form-label"><i class="fas fa-plane-departure me-2"></i>
                                    From</label>
                                <input type="text" id="search1" class="form-select" placeholder="Enter City Name"
                                    autocomplete="off">
                                <input type="hidden" name="origin_city" value="">
                                <input type="hidden" name="origin_city_name" id="origin_city_name">
                                <div id="result1" style="width: 90%;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="destination_city" class="form-label"><i
                                        class="fas fa-plane-arrival me-2"></i>
                                    To</label>
                                <input type="text" id="search2" placeholder="Enter City Name" autocomplete="off"
                                    class="form-select">
                                <input type="hidden" name="destination_city" value="">

                                <input type="hidden" name="destination_city_name" id="destination_city_name">
                                <div id="result2" style="width: 90%;"></div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="departureDate" class="form-label"><i class="far fa-calendar-alt me-2"></i>
                                    Check-In</label>
                                <input type="date" id="departureDate" name="departureDate" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <div id="returnDateContainer" style="display:none;">
                                    <label for="returnDate" class="form-label"><i class="far fa-calendar-alt me-2"></i>
                                        Check-Out</label>
                                    <input type="date" id="returnDate" name="returnDate" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            {{-- <div class="col-md-6 mb-3 mb-md-0">
                                <label for="adults" class="form-label"><i class="fas fa-user me-2"></i> Tickets</label>
                                <input type="number" id="adults" name="adults" class="form-control" value="1" min="1">
                            </div>--}}
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="travelers" class="form-label"><i class="fas fa-user me-2"></i>
                                    Tickets</label>
                                <div class="dropdown">
                                    <button
                                        class="form-control d-flex justify-content-between align-items-center dropdown-toggle"
                                        type="button" id="travelersDropdown" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <span id="totalTravelers">1 Traveler</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu p-3" style="width: 300px;">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0">Adults</label>
                                                <div class="d-flex align-items-center">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                                        data-type="adults" data-action="decrease">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="mx-3" id="adultsCount">1</span>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                                        data-type="adults" data-action="increase">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="adults" id="adultsInput" value="1">
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0">Children</label>
                                                <div class="d-flex align-items-center">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                                        data-type="children" data-action="decrease">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="mx-3" id="childrenCount">0</span>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                                        data-type="children" data-action="increase">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="children" id="childrenInput" value="0">
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0">Infants</label>
                                                <div class="d-flex align-items-center">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                                        data-type="infants" data-action="decrease">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="mx-3" id="infantsCount">0</span>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                                        data-type="infants" data-action="increase">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="infants" id="infantsInput" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="class" class="form-label"><i class="fas fa-ticket-alt me-2"></i>
                                    Class</label>
                                <select id="cabin" name="cabin" class="form-select">
                                    <option value="ECONOMY">Economy</option>
                                    <option value="PREMIUM_ECONOMY">Premium Economy</option>
                                    <option value="BUSINESS">Business</option>
                                    <option value="FIRST">First Class</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="oneWay" name="tripType"
                                        value="oneWay" checked>
                                    <label class="form-check-label" for="oneWay">ONE WAY</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="roundTrip" name="tripType"
                                        value="roundTrip">
                                    <label class="form-check-label" for="roundTrip">ROUND WAY</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 search-btn">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="reviews py-4">
        <div class="container">
            <div class="position-relative">
                <!-- Previous Arrow Button (Mobile Only) -->
                <button
                    class="btn btn-sm btn-light rounded-circle position-absolute start-0 top-50 translate-middle-y d-md-none shadow-sm z-1"
                    id="prevBtn">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <!-- Next Arrow Button (Mobile Only) -->
                <button
                    class="btn btn-sm btn-light rounded-circle position-absolute end-0 top-50 translate-middle-y d-md-none shadow-sm z-1"
                    id="nextBtn">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <div class="row flex-nowrap overflow-auto pb-2" id="reviewsContainer"
                    style="scrollbar-width: none; -ms-overflow-style: none;">
                    <div class="col-auto">
                        <div class="card review-card p-3 h-100">
                            <img src="https://via.placeholder.com/100x30" class="mx-auto mb-2" alt="Google">
                            <div class="review-stars mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="mb-1 fw-medium">Instant Feedback</p>
                            <p class="small text-muted">Based on 1,200 Reviews</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="card review-card p-3 h-100">
                            <img src="https://via.placeholder.com/100x30" class="mx-auto mb-2" alt="Google">
                            <div class="review-stars mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="mb-1 fw-medium">Instant Feedback</p>
                            <p class="small text-muted">Based on 1,200 Reviews</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="card review-card p-3 h-100">
                            <img src="https://via.placeholder.com/100x30" class="mx-auto mb-2" alt="Google">
                            <div class="review-stars mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="mb-1 fw-medium">Instant Feedback</p>
                            <p class="small text-muted">Based on 1,200 Reviews</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="card review-card p-3 h-100">
                            <img src="https://via.placeholder.com/100x30" class="mx-auto mb-2" alt="Google">
                            <div class="review-stars mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="mb-1 fw-medium">Instant Feedback</p>
                            <p class="small text-muted">Based on 1,200 Reviews</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="card review-card p-3 h-100">
                            <img src="https://via.placeholder.com/100x30" class="mx-auto mb-2" alt="Google">
                            <div class="review-stars mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="mb-1 fw-medium">Instant Feedback</p>
                            <p class="small text-muted">Based on 1,200 Reviews</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="card review-card p-3 h-100">
                            <img src="https://via.placeholder.com/100x30" class="mx-auto mb-2" alt="Google">
                            <div class="review-stars mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="mb-1 fw-medium">Instant Feedback</p>
                            <p class="small text-muted">Based on 1,200 Reviews</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features py-5">
        <div class="container">
            <div class="d-flex text-center align-items-center justify-content-center mb-3">
                <span class="pb-2 mx-5"><img src="{{ asset('assets/images/indian_flag.png') }}" style="display: inline;"
                        alt=""></span>
                <h2 class="text-center d-inline-block fs-1">Discover Why Choose <span class="text-accent">Us</span>
                    for
                    Your Flight
                    Booking?</h2>
                <span class="pb-2 mx-5"><img src="{{ asset('assets/images/indian_flag.png') }}" style="display: inline;"
                        alt=""></span>
            </div>
            <p class="text-center text-muted mb-5">Hassle-free Flight Booking with Us.</p>
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="feature-card p-4 text-center bg-light rounded h-100">
                        <div
                            class="feature-icon d-flex align-items-center justify-content-center text-white mx-auto mb-4">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="h4 mb-3">Seamless Booking Experience</h3>
                        <p class="text-muted mb-0">offering unparalleled choices for your travel needs</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="feature-card p-4 text-center bg-light rounded h-100">
                        <div
                            class="feature-icon d-flex align-items-center justify-content-center text-white mx-auto mb-4">
                            <i class="fas fa-tag"></i>
                        </div>
                        <h3 class="h4 mb-3">Best Pricing and Deals</h3>
                        <p class="text-muted mb-0">offering unparalleled choices for your travel needs</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center bg-light rounded h-100">
                        <div
                            class="feature-icon d-flex align-items-center justify-content-center text-white mx-auto mb-4">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="h4 mb-3">Personalized Travel Recommendations</h3>
                        <p class="text-muted mb-0">offering unparalleled choices for your travel needs</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="places py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Explore unique <span class="text-accent">places to stay</span></h2>
                <a href="#" class="text-accent d-flex align-items-center">All <i
                        class="fas fa-arrow-right ms-2"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="place-card card h-100 shadow-sm">
                        <img src="{{ asset('assets/images/maldives.jpeg') }}" alt="Maldives"
                            class="place-img card-img-top">
                        <div class="card-body">
                            <h3 class="h5 card-title">Stay among the atolls in <span class="text-accent">Maldives</span>
                            </h3>
                            <p class="card-text text-muted">From the Sanskrit 'AD,' the islands were known as the 'Money
                                Isles' due to
                                the abundance of cowry shells, a currency of the early ages.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="place-card card h-100 shadow-sm">
                        <img src="{{ asset('assets/images/morocco.jpeg') }}" alt="Morocco"
                            class="place-img card-img-top">
                        <div class="card-body">
                            <h3 class="h5 card-title">Experience the Ourika Valley in <span
                                    class="text-accent">Morocco</span></h3>
                            <p class="card-text text-muted">Morocco's Moorish architecture blends influences from Berber
                                culture,
                                Spain, and contemporary artistic currents in the Middle East.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="place-card card h-100 shadow-sm">
                        <img src="{{ asset('assets/images/mongolia.jpeg') }}" alt="Mongolia"
                            class="place-img card-img-top">
                        <div class="card-body">
                            <h3 class="h5 card-title">Live traditionally in <span class="text-accent">Mongolia</span>
                            </h3>
                            <p class="card-text text-muted">Traditional Mongolian yurts consists of an angled
                                latticework of
                                wood or
                                bamboo for walls, ribs, and a wheel.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-primary px-4 explore-more">Explore more stays</a>
            </div>
        </div>
    </section>

    <section class="testimonials py-5">
        <div class="container">
            <h2 class="text-center mb-5">What <span class="text-accent">Our</span> users are saying</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/50" alt="User" class="rounded-circle me-3">
                            <div>
                                <h4 class="h5 mb-1">Yifei Chen</h4>
                                <p class="text-muted small mb-0">Seoul, South Korea | April 2019</p>
                            </div>
                        </div>
                        <div class="mb-3 review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted">What a great experience using Tripma! I booked all of my flights for my
                            gap
                            year through Tripma and never had any issues. Their customer service team was always very
                            quick
                            to respond when I had questions. I highly recommend Tripma!</p>
                        <a href="#" class="text-accent mt-2">read more...</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/50" alt="User" class="rounded-circle me-3">
                            <div>
                                <h4 class="h5 mb-1">Kaori Yamaguchi</h4>
                                <p class="text-muted small mb-0">Honolulu, Hawaii | February 2017</p>
                            </div>
                        </div>
                        <div class="mb-3 review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p class="text-muted">My family and I visit Hawaii every year, and we usually book our flights
                            separately. This year we used Tripma to book our flights and it was so much easier. We got a
                            great deal!</p>
                        <a href="#" class="text-accent mt-2">read more...</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/50" alt="User" class="rounded-circle me-3">
                            <div>
                                <h4 class="h5 mb-1">Anthony Lewis</h4>
                                <p class="text-muted small mb-0">Berlin, Germany | April 2019</p>
                            </div>
                        </div>
                        <div class="mb-3 review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted">When I was looking to book my flight to Berlin from LA, Tripma had the
                            best
                            prices by far. I checked a few other services that I've used in the past, but I'll be using
                            Tripma from now on!</p>
                        <a href="#" class="text-accent mt-2">read more...</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="questions py-5 bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-6 text-left">
                    <p class="fw-bold mb-1">Find Cheap Flights & Travel Deals at Cheapflightsfares</p>
                    <p class="text-muted">
                        Looking for the cheapest flights to your dream destination? You've come to the right place! At
                        Cheapflightsfares, we
                        specialize in finding the best travel deals on airline tickets worldwide. Whether you're
                        planning a quick getaway, a
                        long vacation, or a business trip, we make booking affordable flights hassle-free. Our advanced
                        technology ensures a
                        fast, safe, and seamless experience, helping you find the best airfares with just a few clicks.
                    </p>
                    <p class="text-muted">
                        We pride ourselves on offering world-class customer service and support at every step of your
                        booking journey. Our
                        dedicated team is available 24/7 to assist you with finding flights, understanding airline
                        policies, and managing
                        itinerary changes. By partnering with top airlines and travel providers, we offer exclusive
                        discounts and unbeatable
                        fares, ensuring you get the most affordable and convenient travel options.
                    </p>

                    <p class="fw-bold mb-1">When to Buy Airline Tickets</p>
                    <p class="text-muted">
                        Timing is key when booking flights. Based on recent travel trends, the best time to book
                        domestic flights is 28 days
                        before departure, while international airfare is typically cheaper when purchased 60 to 120 days
                        in advance.
                        Additionally, Sundays are often the most budget-friendly day to book tickets, making it easier
                        to find cheap flights and
                        secure the lowest fares.
                    </p>
                    <p class="fw-bold mb-1">How to Find the Best Flight Deals</p>
                    <p class="text-muted m-0">
                        Scoring the best airfare isn't just about booking in advanceâ€”it's also about knowing where to
                        look and what to
                        consider. Here are some expert tips:
                    </p>
                    <ul class="">
                        <li>Compare prices across multiple airlines and online travel agencies.</li>
                        <li>Be flexible with your travel dates and consider off-peak seasons.</li>
                        <li>Book in advance, but not too far in advance, as prices can fluctuate
                            significantly.</li>
                        <li>Look for error fares, sales, and special promotions.</li>
                        <li>Sign up for fare alerts to stay informed about price drops and deals.</li>
                    </ul>
                </div><!-- col-md-6 -->
                <div class="col-md-6">


                    <p class="fw-bold mb-3">Find Cheap Flights & Travel Deals at Cheapflightsfares</p>
                    <p class="text-muted p-5 mb-0">
                        Looking for the cheapest flights to your dream destination? You've come to the right
                        place!
                        At Cheapflightsfares, we specialize in finding you the best travel deals on airline
                        tickets
                        to destinations across the globe...
                    </p>
                </div><!-- col-md-6 -->


            </div><!-- row -->
        </div><!-- container -->
    </section>


    <div class="d-flex justify-content-end mx-5 my-3 subscribe-section">
        <input type="email" class="form-control d-inline-block" placeholder="Email Address" style="width: 250px;">
        <select class="form-select d-inline-block" style="width: 250px;">
            <option>United States</option>
        </select>


        <button class="btn subscribe-btn d-inline-block">Subscribe</button>

    </div><!-- subscribe-section -->

    <!-- Footer Section -->
    <footer class="footer pt-5 pb-3 bg-light">

        <!-- Main Footer Content -->
        <div class="container">
            <div class="row">
                <!-- Logo Column -->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h2 class="mb-3" style="color: #6f42c1; font-weight: bold;">LOGO</h2>
                    <p class="text-muted">About the website</p>
                </div>

                <!-- Quick Links Column -->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-secondary mb-3">Quick links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Home</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Partner Column -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-secondary mb-3">Partner with us</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Partnership programs</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Affiliate program</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Connectivity partners</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Promotions and events</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Integrations</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Community</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Loyalty program</a></li>
                    </ul>
                </div>

                <!-- Legal Column -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-secondary mb-3">Legal</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Help Center</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Contact us</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Privacy policy</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Terms of service</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Taxes & Fees</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Accessibility</a></li>
                    </ul>
                </div>

                <!-- Contact Column -->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('assets/images/phone-call-purple.png') }}" width="30px" height="30px" alt="">
                        <span class="mx-2">+1-111-111-1111</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('assets/images/email.png') }}" width="30px" height="30px" alt="">
                        <span class="mx-2">email@gmail.com</span>
                    </div>
                    <h5 class="mb-3">Follow Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-decoration-none text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                viewBox="0 0 50 50">
                                <path
                                    d="M 11 4 C 7.134 4 4 7.134 4 11 L 4 39 C 4 42.866 7.134 46 11 46 L 39 46 C 42.866 46 46 42.866 46 39 L 46 11 C 46 7.134 42.866 4 39 4 L 11 4 z M 13.085938 13 L 21.023438 13 L 26.660156 21.009766 L 33.5 13 L 36 13 L 27.789062 22.613281 L 37.914062 37 L 29.978516 37 L 23.4375 27.707031 L 15.5 37 L 13 37 L 22.308594 26.103516 L 13.085938 13 z M 16.914062 15 L 31.021484 35 L 34.085938 35 L 19.978516 15 L 16.914062 15 z">
                                </path>
                            </svg>
                        </a>
                        <a href="#" class="text-decoration-none text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                viewBox="0 0 64 64">
                                <radialGradient id="TGwjmZMm2W~B4yrgup6jda_119026_gr1" cx="32" cy="32.5" r="31.259"
                                    gradientTransform="matrix(1 0 0 -1 0 64)" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#efdcb1"></stop>
                                    <stop offset="0" stop-color="#f2e0bb"></stop>
                                    <stop offset=".011" stop-color="#f2e0bc"></stop>
                                    <stop offset=".362" stop-color="#f9edd2"></stop>
                                    <stop offset=".699" stop-color="#fef4df"></stop>
                                    <stop offset="1" stop-color="#fff7e4"></stop>
                                </radialGradient>
                                <path fill="url(#TGwjmZMm2W~B4yrgup6jda_119026_gr1)"
                                    d="M58,54c-1.1,0-2-0.9-2-2s0.9-2,2-2h2.5c1.9,0,3.5-1.6,3.5-3.5S62.4,43,60.5,43H50c-1.4,0-2.5-1.1-2.5-2.5	S48.6,38,50,38h8c1.7,0,3-1.3,3-3s-1.3-3-3-3H42v-6h18c2.3,0,4.2-2,4-4.4c-0.2-2.1-2.1-3.6-4.2-3.6H58c-1.1,0-2-0.9-2-2s0.9-2,2-2	h0.4c1.3,0,2.5-0.9,2.6-2.2c0.2-1.5-1-2.8-2.5-2.8h-14C43.7,9,43,8.3,43,7.5S43.7,6,44.5,6h3.9c1.3,0,2.5-0.9,2.6-2.2	C51.1,2.3,50,1,48.5,1H15.6c-1.3,0-2.5,0.9-2.6,2.2C12.9,4.7,14,6,15.5,6H19c1.1,0,2,0.9,2,2s-0.9,2-2,2H6.2c-2.1,0-4,1.5-4.2,3.6	C1.8,16,3.7,18,6,18h2.5c1.9,0,3.5,1.6,3.5,3.5S10.4,25,8.5,25H5.2c-2.1,0-4,1.5-4.2,3.6C0.8,31,2.7,33,5,33h17v11H6	c-1.7,0-3,1.3-3,3s1.3,3,3,3l0,0c1.1,0,2,0.9,2,2s-0.9,2-2,2H4.2c-2.1,0-4,1.5-4.2,3.6C-0.2,60,1.7,62,4,62h53.8	c2.1,0,4-1.5,4.2-3.6C62.2,56,60.3,54,58,54z">
                                </path>
                                <radialGradient id="TGwjmZMm2W~B4yrgup6jdb_119026_gr2" cx="18.51" cy="66.293" r="69.648"
                                    gradientTransform="matrix(.6435 -.7654 .5056 .4251 -26.92 52.282)"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset=".073" stop-color="#eacc7b"></stop>
                                    <stop offset=".184" stop-color="#ecaa59"></stop>
                                    <stop offset=".307" stop-color="#ef802e"></stop>
                                    <stop offset=".358" stop-color="#ef6d3a"></stop>
                                    <stop offset=".46" stop-color="#f04b50"></stop>
                                    <stop offset=".516" stop-color="#f03e58"></stop>
                                    <stop offset=".689" stop-color="#db359e"></stop>
                                    <stop offset=".724" stop-color="#ce37a4"></stop>
                                    <stop offset=".789" stop-color="#ac3cb4"></stop>
                                    <stop offset=".877" stop-color="#7544cf"></stop>
                                    <stop offset=".98" stop-color="#2b4ff2"></stop>
                                </radialGradient>
                                <path fill="url(#TGwjmZMm2W~B4yrgup6jdb_119026_gr2)"
                                    d="M45,57H19c-5.5,0-10-4.5-10-10V21c0-5.5,4.5-10,10-10h26c5.5,0,10,4.5,10,10v26C55,52.5,50.5,57,45,57z">
                                </path>
                                <path fill="#fff"
                                    d="M32,20c4.6,0,5.1,0,6.9,0.1c1.7,0.1,2.6,0.4,3.2,0.6c0.8,0.3,1.4,0.7,2,1.3c0.6,0.6,1,1.2,1.3,2 c0.2,0.6,0.5,1.5,0.6,3.2C46,28.9,46,29.4,46,34s0,5.1-0.1,6.9c-0.1,1.7-0.4,2.6-0.6,3.2c-0.3,0.8-0.7,1.4-1.3,2 c-0.6,0.6-1.2,1-2,1.3c-0.6,0.2-1.5,0.5-3.2,0.6C37.1,48,36.6,48,32,48s-5.1,0-6.9-0.1c-1.7-0.1-2.6-0.4-3.2-0.6 c-0.8-0.3-1.4-0.7-2-1.3c-0.6-0.6-1-1.2-1.3-2c-0.2-0.6-0.5-1.5-0.6-3.2C18,39.1,18,38.6,18,34s0-5.1,0.1-6.9 c0.1-1.7,0.4-2.6,0.6-3.2c0.3-0.8,0.7-1.4,1.3-2c0.6-0.6,1.2-1,2-1.3c0.6-0.2,1.5-0.5,3.2-0.6C26.9,20,27.4,20,32,20 M32,17 c-4.6,0-5.2,0-7,0.1c-1.8,0.1-3,0.4-4.1,0.8c-1.1,0.4-2.1,1-3,2s-1.5,1.9-2,3c-0.4,1.1-0.7,2.3-0.8,4.1C15,28.8,15,29.4,15,34 s0,5.2,0.1,7c0.1,1.8,0.4,3,0.8,4.1c0.4,1.1,1,2.1,2,3c0.9,0.9,1.9,1.5,3,2c1.1,0.4,2.3,0.7,4.1,0.8c1.8,0.1,2.4,0.1,7,0.1 s5.2,0,7-0.1c1.8-0.1,3-0.4,4.1-0.8c1.1-0.4,2.1-1,3-2c0.9-0.9,1.5-1.9,2-3c0.4-1.1,0.7-2.3,0.8-4.1c0.1-1.8,0.1-2.4,0.1-7 s0-5.2-0.1-7c-0.1-1.8-0.4-3-0.8-4.1c-0.4-1.1-1-2.1-2-3s-1.9-1.5-3-2c-1.1-0.4-2.3-0.7-4.1-0.8C37.2,17,36.6,17,32,17L32,17z">
                                </path>
                                <path fill="#fff"
                                    d="M32,25c-5,0-9,4-9,9s4,9,9,9s9-4,9-9S37,25,32,25z M32,40c-3.3,0-6-2.7-6-6s2.7-6,6-6s6,2.7,6,6S35.3,40,32,40 z">
                                </path>
                                <circle cx="41" cy="25" r="2" fill="#fff"></circle>
                            </svg>
                        </a>
                        <a href="#" class="text-decoration-none text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                viewBox="0 0 48 48">
                                <path fill="#039be5" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"></path>
                                <path fill="#fff"
                                    d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="container">
            <hr class="my-4">
        </div>

        <!-- Copyright Section -->
        <div class="container">
            <div class="text-center mb-4">
                <p class="text-muted">© 2025 Logo incorporated</p>
            </div>

            <!-- Partner Logos -->
            <div class="row justify-content-center align-items-center mb-4">
                <div class="col-6 col-md-2 mb-3 mb-md-0 text-center">
                    <img src="https://via.placeholder.com/100x50" alt="IATA" class="img-fluid"
                        style="max-height: 50px;">
                </div>
                <div class="col-6 col-md-2 mb-3 mb-md-0 text-center">
                    <img src="https://via.placeholder.com/100x50" alt="Cloudflare" class="img-fluid"
                        style="max-height: 50px;">
                </div>
                <div class="col-6 col-md-2 mb-3 mb-md-0 text-center">
                    <img src="https://via.placeholder.com/100x50" alt="Flexpay" class="img-fluid"
                        style="max-height: 50px;">
                </div>
                <div class="col-6 col-md-2 mb-3 mb-md-0 text-center">
                    <img src="https://via.placeholder.com/100x50" alt="Amazon Pay" class="img-fluid"
                        style="max-height: 50px;">
                </div>
                <div class="col-6 col-md-2 mb-3 mb-md-0 text-center">
                    <img src="https://via.placeholder.com/100x50" alt="DigiCert" class="img-fluid"
                        style="max-height: 50px;">
                </div>
            </div>

            <!-- Bottom Text -->
            <div class="text-center">
                <p class="text-muted small">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                    nibh
                    euismod tincidunt ut laoreet dolore</p>
            </div>
        </div>
    </footer>



    <!-- Bootstrap JavaScript with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
        $("#result1, #result2").hide();

        $("#search1").on("input", function() {
        let query = $(this).val();

        if (query.length > 2) {
        $.ajax({
        url: "{{route('search_city')}}",
        method: "GET",
        data: { q: query },
        success: function(response) {
        $("#result1").empty();
        if (response.data.length > 0) {
        $("#result1").show(); // إظهار القائمة عند وجود نتائج
        response.data.forEach(element => {
        $("#result1").append(`<p data-city-code="${element.address.cityCode}" style="color: #4444ff;"
            onmouseover="this.style.backgroundColor='#fff;'; this.style.color='#4444ff';"
            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4444ff';">${element.address.cityName},
            ${element.address.countryName}, ${element.address.countryCode} (${element.address.cityCode} - ${element.name})</p>
        `);
        });
        } else {
        $("#result1").hide(); // إخفاء القائمة عند عدم وجود نتائج
        }
        }
        });
        } else {
        $("#result1").hide(); // إخفاء القائمة عند حذف الإدخال
        }
        });

        $("#search2").on("input", function() {
        let query = $(this).val();
        if (query.length > 2) {
        $.ajax({
        url: "{{route('search_city')}}",
        method: "GET",
        data: { q: query },
        success: function(response) {
        $("#result2").empty();
        if (response.data.length > 0) {
        $("#result2").show(); // إظهار القائمة عند وجود نتائج
        response.data.forEach(element => {
        $("#result2").append(`<p data-city-code="${element.address.cityCode}" style="color: #4444ff;"
            onmouseover="this.style.backgroundColor='#fff'; this.style.color='#4444ff';"
            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4444ff';">${element.address.cityName},
            ${element.address.countryName}, ${element.address.countryCode} (${element.address.cityCode} - ${element.name})</p>
        `);});
        } else {
        $("#result2").hide(); // إخفاء القائمة عند عدم وجود نتائج
        }
        }
        });
        } else {
        $("#result2").hide(); // إخفاء القائمة عند حذف الإدخال
        }
        });
        $('body').on('click','#result1 p',function () {
        $("#search1").val($(this).text())
        $("#result1").empty()
        var code = $(this).attr('data-city-code');
        var cityName = $(this).text();
        $("[name='origin_city']").val(code);
        $("#origin_city_name").val(cityName);
        })
        $('body').on('click','#result2 p',function () {
        $("#search2").val($(this).text())
        $("#result2").empty()
        var code = $(this).attr('data-city-code');
        var code = $(this).attr('data-city-code');
        var cityName = $(this).text();
        $("[name='destination_city']").val(code);
        $("#destination_city_name").val(cityName);
        })
        $(document).click(function(event) {
        if (!$(event.target).closest("#result1").length) {
        $("#result1").empty(); // يخفي العنصر
        }
        if (!$(event.target).closest("#result2").length) {
        $("#result2").empty(); // يخفي العنصر
        }
        });


        $('input[name="tripType"]').change(function() {
        var tripType = $('input[name="tripType"]:checked').val();
        var returnDateContainer = $('#returnDateContainer');

        if (tripType === 'roundTrip') {
        returnDateContainer.show(); // إظهار تاريخ العودة
        } else {
        returnDateContainer.hide(); // إخفاء تاريخ العودة
        }
        });

        // ✅ تشغيل الدالة عند تحميل الصفحة لأول مرة للتحقق من الحالة الافتراضية
        $('input[name="tripType"]:checked').trigger('change');

        // document.addEventListener('DOMContentLoaded', function() {
        // // Initialize the dropdown
        // updateTravelersText();

        // // Handle dropdown toggle
        // const dropdownToggle = document.getElementById('travelersDropdown');
        // const dropdownMenu = document.querySelector('.dropdown-menu');

        // dropdownToggle.addEventListener('click', function(e) {
        // e.preventDefault();
        // e.stopPropagation();
        // dropdownMenu.classList.toggle('show');
        // });

        // // Add event listeners to all traveler buttons
        // const travelerBtns = document.querySelectorAll('.traveler-btn');
        // travelerBtns.forEach(btn => {
        // btn.addEventListener('click', function(e) {
        // e.preventDefault();
        // e.stopPropagation();

        // const type = this.getAttribute('data-type');
        // const action = this.getAttribute('data-action');

        // if (action === 'increase') {
        // increaseCount(type);
        // } else if (action === 'decrease') {
        // decreaseCount(type);
        // }
        // });
        // });

        // // Close dropdown when clicking outside
        // document.addEventListener('click', function(e) {
        // if (!dropdownMenu.contains(e.target) && e.target !== dropdownToggle) {
        // dropdownMenu.classList.remove('show');
        // }
        // });

        // // Prevent dropdown from closing when clicking inside
        // dropdownMenu.addEventListener('click', function(e) {
        // e.stopPropagation();
        // });
        // });

        // function increaseCount(type) {
        // const countElement = document.getElementById(type + 'Count');
        // const inputElement = document.getElementById(type + 'Input');
        // let count = parseInt(countElement.textContent);

        // // Apply limits
        // if (type === 'adults' && count >= 9) return;
        // if ((type === 'children' || type === 'infants') && count >= 8) return;
        // if (type === 'infants' && count >= parseInt(document.getElementById('adultsCount').textContent)) return;

        // count++;
        // countElement.textContent = count;
        // inputElement.value = count;
        // updateTravelersText();
        // }

        // function decreaseCount(type) {
        // const countElement = document.getElementById(type + 'Count');
        // const inputElement = document.getElementById(type + 'Input');
        // let count = parseInt(countElement.textContent);

        // // Apply limits
        // if (type === 'adults' && count <= 1) return; if ((type==='children' || type==='infants' ) && count <=0) return; count--;
        //     countElement.textContent=count; inputElement.value=count; // If infants are more than adults, reduce infants if
        //     (type==='adults' ) { const infantsCount=parseInt(document.getElementById('infantsCount').textContent); if
        //     (infantsCount> count) {
        //     document.getElementById('infantsCount').textContent = count;
        //     document.getElementById('infantsInput').value = count;
        //     }
        //     }

        //     updateTravelersText();
        //     }

        //     function updateTravelersText() {
        //     const adults = parseInt(document.getElementById('adultsCount').textContent);
        //     const children = parseInt(document.getElementById('childrenCount').textContent);
        //     const infants = parseInt(document.getElementById('infantsCount').textContent);
        //     const total = adults + children + infants;

        //     document.getElementById('totalTravelers').textContent =
        //     total === 1 ? '1 Traveler' : total + ' Travelers';
        //     }
        });
    </script>

</body>

</html>
