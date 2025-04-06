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

        .navbar-toggler {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 5px 10px;
            border-radius: 5px;

        }

        .navbar-toggler-icon {
            height: 24px;
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
            color: #4B45FF;
            margin-bottom: 20px;
            margin-right: 10px;
        }

        .nav-background {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        /*End Header Style*/

        #result1,
        #result2 {
            position: absolute;
            width: 20%;
            background-color: rgba(255, 255, 255, 0.5);
            /* border: 1px solid #ccc; */
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
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.2)), url('assets/images/hero-background.webp');
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
            color: #4444ff;
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

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 4px;
            color: white;
            z-index: 1000;
            transform: translateX(150%);
            transition: transform 0.3s ease-in-out;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification-success {
            background-color: #28a745;
        }

        .notification-error {
            background-color: #dc3545;
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

        .footer-contact-icons {
            width: 30px;
            height: 30px;
        }

        @media (max-width: 767px) {
            /* .hero-header {
                font-size: 24px;
            }

            ..search-form {
                height: 60%;
            }

            .form-header {
                 font-size: 14px;
            margin: 0 !important;
        } */

            .footer .d-flex.flex-column.flex-md-row {
                gap: 10px;
            }

            .footer-contact-res {
                font-size: 11px;
                font-weight: 600;
            }

            .footer-contact-icons {
                width: 20px;
                height: 20px;
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

        .is-invalid {
            border-color: #dc3545 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545' %3e%3ccircle cx='6' cy='6' r='4.5' /%3e%3cpath stroke-linejoin='round' d='M5.83.6h.4L6 6.5z' /%3e%3ccircle cx=' 6' cy=' 8.2' r=' .6' fill=' %23dc3545' stroke=' none' /%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .validation-alert {
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>


    <section class="hero d-flex align-items-center">
        <header class="py-3">
            <div class="container">
                <!-- Desktop View -->
                <div class="row align-items-center d-none d-md-flex">
                    <div class="col-md-3">
                        <div class="logo">LOGO</div>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about_us') }}">About us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact_us') }}">Contact us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3 text-end">
                        <div class="contact-info d-flex align-items-center justify-content-end m-0">
                            <img src="{{ asset('assets/images/phone-call.webp') }}" width="40px" height="40px" alt="">
                            <div class="text-start mx-2">
                                <p class="m-0" style="font-size: 12px;">Contact us 24/7 for book the best deal!</p>
                                <span class="fw-bold"><a href="tel:+1-111-111-1111"
                                        style="text-decoration: none; color: #4444ff;">+1-111-111-1111</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile View -->
                <div class="d-md-none">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Logo on Left -->
                        <div class="logo">LOGO</div>

                        <!-- Menu Button on Right -->
                        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarMobile" aria-controls="navbarMobile" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon d-flex align-items-center justify-content-center">
                                <i class="fas fa-bars"></i>
                            </span>
                        </button>
                    </div>

                    <!-- Collapsible Content -->
                    <div class="collapse mt-3" id="navbarMobile">
                        <div class="nav-background p-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('index') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about_us') }}">About us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact_us') }}">Contact us</a>
                                </li>

                            </ul>

                            <!-- Contact Info in Menu -->
                            <div class="contact-info-mobile mt-3 pt-3 border-top">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/images/phone-call.webp') }}" width="30px" height="30px"
                                        alt="">
                                    <div class="text-start mx-2">
                                        <p class="m-0" style="font-size: 12px;">Contact us 24/7 for book the best deal!
                                        </p>
                                        <span class="fw-bold"><a href="tel:+1-111-111-1111"
                                                style="text-decoration: none; color: #4444ff;">+1-111-111-1111</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="hero-content container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center text-lg-start">
                    <h1 class="display-4 fw-bold hero-header">Transforming Travel,<br>One Trip at a Time</h1>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('flight.search') }}" method="POST" class="search-form p-4">
                        @csrf
                        <h3 class="text-center mb-4 form-header">Find your ticket Now</h3>
                        <div class="row mb-3">
                            <div class="col-6 mb-3 mb-md-0 mb-sm-0">
                                <label for="origin_city" class="form-label"><i class="fas fa-plane-departure me-2"></i>
                                    From</label>
                                <input type="text" id="search1" class="form-select" placeholder="Enter City Name"
                                    autocomplete="off" required>
                                <input type="hidden" name="origin_city" value="">
                                <input type="hidden" name="origin_city_name" id="origin_city_name">
                                <div id="result1" style="width: 60%;"></div>
                            </div>
                            <div class="col-6">
                                <label for="destination_city" class="form-label"><i
                                        class="fas fa-plane-arrival me-2"></i>
                                    To</label>
                                <input type="text" id="search2" placeholder="Enter City Name" autocomplete="off"
                                    class="form-select" required>
                                <input type="hidden" name="destination_city" value="">

                                <input type="hidden" name="destination_city_name" id="destination_city_name">
                                <div id="result2" style="width: 60%;"></div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6 mb-3 mb-md-0">
                                <label for="departureDate" class="form-label"><i class="far fa-calendar-alt me-2"></i>
                                    Check-In</label>
                                <input type="date" id="departureDate" name="departureDate" class="form-control"
                                    required>
                            </div>
                            <div class="col-6">
                                <div id="returnDateContainer" style="display:none;">
                                    <label for="returnDate" class="form-label"><i class="far fa-calendar-alt me-2"></i>
                                        Check-Out</label>
                                    <input type="date" id="returnDate" name="returnDate" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-6 mb-3 mb-md-0">
                                <label for="travelers" class="form-label"><i class="fas fa-user me-2"></i>
                                    Tickets</label>
                                <div class="dropdown">
                                    <button
                                        class="form-control d-flex justify-content-between align-items-center dropdown-toggle "
                                        type="button" id="travelersDropdown" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <span id="totalTravelers">Traveler</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu p-3 " style="width: 300px;">
                                        <div class="mb-3" id="adults">
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
                                        <div class="mb-3" id="children">
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

                                        <div class="mb-3" id="heldInfants">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0">Infants</label>
                                                <div class="d-flex align-items-center">
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                                        data-type="held_infants" data-action="decrease">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="mx-3" id="heldInfantsCount">0</span>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                                        data-type="held_infants" data-action="increase">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="held_infants" id="heldInfantsInput" value="0">
                                        </div>
                                    </div><!-- dropdown-menu -->
                                </div><!-- dropdown -->
                            </div><!-- col-md-6 -->

                            <div class="col-6">
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
                <span class="pb-2 mx-5"><img src="{{ asset('assets/images/indian_flag.webp') }}"
                        style="display: inline;" alt=""></span>
                <h2 class="text-center d-inline-block fs-1">Discover Why Choose <span class="text-accent">Us</span>
                    for
                    Your Flight
                    Booking?</h2>
                <span class="pb-2 mx-5"><img src="{{ asset('assets/images/indian_flag.webp') }}"
                        style="display: inline;" alt=""></span>
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
                <a href="{{ route('explore_places') }}" class="text-accent d-flex align-items-center">All <i
                        class="fas fa-arrow-right ms-2"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="place-card card h-100 shadow-sm">
                        <img src="{{ asset('assets/images/maldives.webp') }}" alt="Maldives"
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
                        <img src="{{ asset('assets/images/morocco.webp') }}" alt="Morocco"
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
                        <img src="{{ asset('assets/images/mongolia.webp') }}" alt="Mongolia"
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
                <a href="{{ route('explore_places') }}" class="btn btn-primary px-4 explore-more">Explore more stays</a>
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
        <input type="email" id="subscribeEmail" class="form-control d-inline-block mx-3" placeholder="Email Address"
            style="width: 250px;">



        <button id="subscribeBtn" class="btn subscribe-btn d-inline-block">Subscribe</button>

    </div><!-- subscribe-section -->
    <div id="notification" class="notification" style="display: none;"></div>

    <!-- Footer Section -->
    <footer class="footer pt-5 pb-3 bg-light">

        <!-- Main Footer Content -->
        <div class="container">
            <!-- Partner Logos -->
            <div class="row justify-content-center align-items-center mb-5">
                <div class="col-6 col-md-2 mb-3 mb-md-0 text-center">
                    <img src="{{ asset('assets/images/IATA.webp') }}" alt="IATA" class="img-fluid"
                        style="max-height: 50px;">
                </div><!-- col-6 col-md-2 mb-3 mb-md-0 text-center -->
                <div class="col-6 col-md-2 mb-3 mb-md-0 text-center">

                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.873 23.572"
                        enable-background="new 0 0 122.873 23.572" xml:space="preserve">
                        <g>
                            <path fill-rule="evenodd" clip-rule="evenodd" fill="#F79C34"
                                d="M48.485,18.439c-4.541,3.351-11.124,5.133-16.792,5.133 c-7.945,0-15.1-2.938-20.514-7.826c-0.425-0.384-0.046-0.908,0.465-0.611c5.841,3.399,13.065,5.447,20.525,5.447 c5.033,0,10.565-1.045,15.656-3.204C48.593,17.053,49.237,17.884,48.485,18.439L48.485,18.439z" />
                            <path fill-rule="evenodd" clip-rule="evenodd" fill="#F79C34"
                                d="M50.375,16.281c-0.582-0.743-3.839-0.353-5.303-0.177 c-0.443,0.054-0.512-0.334-0.113-0.615c2.6-1.825,6.859-1.299,7.354-0.687c0.499,0.616-0.132,4.887-2.567,6.924 c-0.375,0.313-0.731,0.146-0.565-0.267C49.73,20.09,50.957,17.026,50.375,16.281L50.375,16.281z" />
                            <path fill-rule="evenodd" clip-rule="evenodd" fill="#333E47"
                                d="M111.219,18.126c0-0.314,0-0.598,0-0.912 c0-0.26,0.127-0.438,0.398-0.423c0.505,0.072,1.22,0.144,1.728,0.039c0.662-0.138,1.138-0.607,1.419-1.251 c0.396-0.906,0.658-1.638,0.824-2.117l-5.032-12.466c-0.085-0.211-0.109-0.604,0.313-0.604h1.76c0.335,0,0.472,0.212,0.547,0.421 l3.648,10.125l3.482-10.125c0.071-0.208,0.214-0.421,0.546-0.421h1.659c0.42,0,0.396,0.392,0.313,0.604l-4.991,12.854 c-0.646,1.712-1.507,4.437-3.444,4.91c-0.972,0.254-2.198,0.162-2.918-0.14C111.288,18.53,111.219,18.287,111.219,18.126 L111.219,18.126z M90.582,2.084c2.752,0,3.502,2.165,3.502,4.643c0.016,1.67-0.292,3.16-1.156,4.013 c-0.647,0.639-1.371,0.813-2.46,0.813c-0.969,0-2.244-0.505-3.196-1.209V3.257C88.263,2.496,89.528,2.084,90.582,2.084 L90.582,2.084z M86.851,18.57h-1.662c-0.232,0-0.423-0.189-0.423-0.422c0-5.771,0-11.542,0-17.313c0-0.232,0.19-0.422,0.423-0.422 h1.271c0.268,0,0.451,0.193,0.484,0.422l0.134,0.907c1.191-1.057,2.725-1.735,4.187-1.735c4.092,0,5.438,3.372,5.438,6.878 c0,3.751-2.059,6.766-5.54,6.766c-1.466,0-2.836-0.541-3.891-1.48v5.978C87.271,18.381,87.082,18.57,86.851,18.57L86.851,18.57z M108.872,12.912c0,0.232-0.19,0.423-0.424,0.423h-1.24c-0.268,0-0.451-0.194-0.484-0.423l-0.125-0.844 c-0.57,0.482-1.27,0.906-2.028,1.201c-1.459,0.566-3.141,0.66-4.566-0.215c-1.031-0.633-1.578-1.87-1.578-3.146 c0-0.987,0.304-1.966,0.979-2.677c0.9-0.971,2.204-1.448,3.78-1.448c0.951,0,2.313,0.112,3.304,0.436V4.521 c0-1.728-0.728-2.476-2.646-2.476c-1.466,0-2.588,0.222-4.148,0.707c-0.25,0.008-0.396-0.182-0.396-0.414V1.37 c0-0.232,0.198-0.457,0.413-0.526c1.114-0.485,2.693-0.788,4.372-0.844c2.188,0,4.788,0.493,4.788,3.858V12.912L108.872,12.912z M106.488,10.432V7.868c-0.833-0.228-2.211-0.322-2.744-0.322c-0.842,0-1.764,0.199-2.246,0.717 c-0.359,0.38-0.522,0.926-0.522,1.454c0,0.682,0.236,1.367,0.787,1.705c0.641,0.435,1.634,0.382,2.567,0.117 C105.228,11.284,106.069,10.833,106.488,10.432L106.488,10.432z M9.566,13.642c-0.16,0.144-0.391,0.153-0.571,0.057 c-0.804-0.668-0.948-0.977-1.387-1.612c-1.328,1.353-2.268,1.758-3.988,1.758C1.584,13.844,0,12.587,0,10.074 C0,8.11,1.063,6.775,2.58,6.121C3.892,5.544,5.725,5.44,7.127,5.283V4.969c0-0.577,0.046-1.257-0.293-1.754 C6.539,2.769,5.973,2.586,5.476,2.586c-0.923,0-1.744,0.473-1.944,1.452C3.49,4.256,3.331,4.472,3.111,4.483L0.767,4.229 C0.568,4.184,0.349,4.025,0.406,3.724c0.531-2.805,3.036-3.679,5.313-3.703h0.179c1.166,0.015,2.654,0.334,3.56,1.204 c1.176,1.1,1.063,2.566,1.063,4.163v3.768c0,1.134,0.471,1.631,0.913,2.241c0.154,0.221,0.19,0.482-0.008,0.644 c-0.494,0.414-1.372,1.176-1.855,1.606L9.566,13.642L9.566,13.642z M7.127,7.744c0,0.942,0.023,1.728-0.453,2.566 C6.291,10.99,5.68,11.409,5,11.409c-0.927,0-1.47-0.707-1.47-1.754c0-2.061,1.848-2.435,3.598-2.435V7.744L7.127,7.744z M41.275,13.642c-0.16,0.144-0.39,0.153-0.571,0.057c-0.803-0.668-0.947-0.977-1.387-1.612c-1.328,1.353-2.268,1.758-3.988,1.758 c-2.036,0-3.62-1.257-3.62-3.77c0-1.964,1.064-3.299,2.58-3.954c1.313-0.576,3.145-0.681,4.548-0.838V4.969 c0-0.577,0.045-1.257-0.294-1.754c-0.294-0.446-0.859-0.629-1.357-0.629c-0.923,0-1.742,0.473-1.944,1.452 c-0.042,0.218-0.201,0.434-0.419,0.445l-2.345-0.254c-0.198-0.045-0.417-0.204-0.361-0.506c0.532-2.805,3.037-3.679,5.313-3.703 h0.18c1.165,0.015,2.653,0.334,3.56,1.204c1.177,1.1,1.063,2.566,1.063,4.163v3.768c0,1.134,0.471,1.631,0.913,2.241 c0.155,0.221,0.189,0.482-0.008,0.644c-0.494,0.414-1.372,1.176-1.854,1.606L41.275,13.642L41.275,13.642z M38.837,7.744 c0,0.942,0.022,1.728-0.453,2.566c-0.385,0.68-0.996,1.099-1.674,1.099c-0.927,0-1.471-0.707-1.471-1.754 c0-2.061,1.848-2.435,3.598-2.435V7.744L38.837,7.744z M71.066,13.672h-2.41c-0.242-0.015-0.434-0.207-0.434-0.445L68.218,0.808 c0.021-0.228,0.222-0.406,0.466-0.406l2.243,0c0.212,0.011,0.386,0.155,0.43,0.347v1.899h0.046 c0.678-1.699,1.625-2.508,3.296-2.508c1.084,0,2.146,0.392,2.822,1.463c0.633,0.993,0.633,2.664,0.633,3.866v7.813 c-0.026,0.221-0.225,0.391-0.464,0.391h-2.425c-0.224-0.014-0.404-0.179-0.431-0.391v-6.74c0-1.358,0.158-3.345-1.513-3.345 c-0.587,0-1.129,0.392-1.399,0.993c-0.34,0.758-0.385,1.516-0.385,2.352v6.685C71.533,13.473,71.324,13.672,71.066,13.672 L71.066,13.672z M60.9,2.674c-1.783,0-1.896,2.429-1.896,3.944c0,1.515-0.022,4.755,1.875,4.755c1.874,0,1.965-2.612,1.965-4.206 c0-1.044-0.046-2.299-0.362-3.292C62.211,3.013,61.668,2.674,60.9,2.674L60.9,2.674z M60.879,0.14c3.59,0,5.531,3.084,5.531,7.002 c0,3.787-2.145,6.792-5.531,6.792c-3.523,0-5.442-3.083-5.442-6.922C55.437,3.144,57.378,0.14,60.879,0.14L60.879,0.14z M16.172,13.672h-2.418c-0.23-0.015-0.415-0.188-0.434-0.408l0.002-12.416c0-0.248,0.209-0.446,0.467-0.446l2.253,0 c0.235,0.012,0.424,0.19,0.439,0.417v1.621h0.045c0.587-1.567,1.693-2.299,3.184-2.299c1.513,0,2.461,0.732,3.139,2.299 c0.587-1.567,1.919-2.299,3.341-2.299c1.016,0,2.123,0.418,2.799,1.359c0.768,1.045,0.611,2.56,0.611,3.892l-0.003,7.834 c0,0.247-0.208,0.446-0.466,0.446h-2.416c-0.244-0.015-0.435-0.207-0.435-0.445l0-6.582c0-0.522,0.045-1.828-0.068-2.324 c-0.181-0.837-0.722-1.072-1.421-1.072c-0.588,0-1.198,0.392-1.446,1.019c-0.248,0.628-0.225,1.672-0.225,2.378v6.581 c0,0.247-0.209,0.446-0.467,0.446h-2.416c-0.243-0.015-0.435-0.207-0.435-0.445l-0.002-6.582c0-1.385,0.226-3.421-1.49-3.421 c-1.739,0-1.671,1.984-1.671,3.421l-0.001,6.581C16.639,13.473,16.43,13.672,16.172,13.672L16.172,13.672z M45.175,2.592V0.818 c0.001-0.27,0.205-0.45,0.449-0.449l7.951-0.001c0.254,0,0.459,0.185,0.459,0.448v1.521c-0.003,0.255-0.218,0.588-0.599,1.117 l-4.119,5.88c1.529-0.035,3.146,0.194,4.535,0.974c0.313,0.176,0.397,0.437,0.422,0.692v1.893c0,0.262-0.286,0.563-0.586,0.406 c-2.446-1.282-5.694-1.422-8.4,0.016c-0.276,0.146-0.565-0.151-0.565-0.412v-1.799c0-0.287,0.006-0.78,0.296-1.219l4.771-6.846 l-4.155,0C45.38,3.039,45.176,2.858,45.175,2.592L45.175,2.592z" />
                        </g>
                    </svg>
                </div><!-- col-6 col-md-2 mb-3 mb-md-0 text-center -->
                <div class="col-6 col-md-2 mb-3 mb-md-0 text-center">
                    <img src="{{ asset('assets/images/flexpay.webp') }}" alt="Flexpay" class="img-fluid"
                        style="max-height: 50px;">
                </div><!-- col-6 col-md-2 mb-3 mb-md-0 text-center -->

                <div class="col-6 col-md-2 mb-3 mb-md-0 text-center">
                    <img src="{{ asset('assets/images/cloudflare.webp') }}" alt="Cloudflare" class="img-fluid"
                        style="max-height: 50px;">
                </div><!-- col-6 col-md-2 mb-3 mb-md-0 text-center -->
                <div class="col-6 col-md-2 mb-3 mb-md-0 text-center">
                    <img src="{{ asset('assets/images/digicert.webp') }}" alt="DigiCert" class="img-fluid"
                        style="max-height: 50px;">
                </div><!-- col-6 col-md-2 mb-3 mb-md-0 text-center -->
            </div><!-- row justify-content-center align-items-center mb-5 -->
            <!-- Bottom Text -->
            <div class="text-center mb-5">
                <p class="text-muted small">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                    nibh euismod tincidunt ut laoreet dolore</p>
            </div><!-- text-center mb-5 -->
            <div class="row px-3">
                <!-- Logo Column -->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h2 class="mb-3" style="color: #6f42c1; font-weight: bold;">LOGO</h2>
                    <p class="text-muted">About the website</p>
                </div><!-- col-lg-2 col-md-6 mb-4 mb-md-0 -->

                <!-- Quick Links Column -->
                <div class="col-lg-2 col-md-6 col-sm-3 mb-4 mb-md-0 p-sm-1">
                    <h5 class="text-secondary mb-3 fw-bold">Quick links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('index') }}" class="text-decoration-none text-muted">Home</a>
                        </li>
                        <li class="mb-2"><a href="{{ route('about_us') }}" class="text-decoration-none text-muted">About
                                Us</a></li>
                        <li class="mb-2"><a href="{{ route('contact_us') }}"
                                class="text-decoration-none text-muted">Contact Us</a></li>
                    </ul>
                </div><!-- col-lg-2 col-md-6 mb-4 mb-md-0 -->



                <!-- Legal Column -->
                <div class="col-lg-3 col-md-6 col-sm-3 mb-4 mb-md-0 p-sm-1">
                    <h5 class="text-secondary mb-3 fw-bold">Legal</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Important Guidelines</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Privacy policy</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Terms of service</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Cancellation Policy</a>
                        </li>
                    </ul>
                </div><!-- col-lg-3 col-md-6 mb-4 mb-md-0 -->

                <!-- keep in touch Column -->
                <div class="col-lg-3 col-md-6 col-sm-3 mb-4 mb-md-0 p-sm-1">
                    <h5 class="text-secondary mb-3 fw-bold">Keep In Touch</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="tel:+" class="text-decoration-none text-muted"><img
                                    src="{{ asset('assets/images/phone-call-purple.webp') }}"
                                    class="footer-contact-icons" alt="">
                                <span class="footer-contact-res">+1-111-111-1111</span></a>
                        </li>
                        <li class="mb-2"><a href="mailto:" class="text-decoration-none text-muted"><svg fill="#7042c1"
                                    viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg"
                                    class="footer-contact-icons">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M1920 428.266v1189.54l-464.16-580.146-88.203 70.585 468.679 585.904H83.684l468.679-585.904-88.202-70.585L0 1617.805V428.265l959.944 832.441L1920 428.266ZM1919.932 226v52.627l-959.943 832.44L.045 278.628V226h1919.887Z"
                                            fill-rule="evenodd"></path>
                                    </g>
                                </svg>
                                <span class="footer-contact-res">email@gmail.com</span></a></li>

                    </ul>
                </div><!-- col-lg-3 col-md-6 mb-4 mb-md-0 -->

                <!-- Contact Column -->
                <div class="col-lg-2 col-md-6 col-sm-3 mb-4 mb-md-0 p-sm-1">

                    <h5 class="text-secondary mb-3 fw-bold">Follow Us</h5>
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
                </div><!-- col-lg-2 col-md-6 mb-4 mb-md-0 -->
            </div><!-- row -->
        </div><!-- container -->

        <!-- Divider -->
        <div class="container">
            <hr class="my-4">
        </div><!-- container -->

        <!-- Copyright Section -->
        <div class="container">
            <div class="text-center mb-4">
                <p class="text-muted">© 2025 Logo incorporated</p>
            </div><!-- text-center mb-4 -->
        </div><!-- container -->
    </footer>



    <!-- Bootstrap JavaScript with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->

    <script>
        // ===== Main code to search for City & Airport =====
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
                            $("#result1").show();
                            response.data.forEach(element => {
                                $("#result1").append(`<p data-city-code="${element.address.cityCode}" style="color: #4444ff;" onmouseover="this.style.backgroundColor='#fff'; this.style.color='#4444ff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4444ff';">${element.address.cityName}, ${element.address.countryName}, ${element.address.countryCode} (${element.address.cityCode} - ${element.name})</p>`);
                            });
                        } else {
                            $("#result1").hide();
                        }
                    }
                });
            } else {
                $("#result1").hide();
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
                            $("#result2").show();
                            response.data.forEach(element => {
                                $("#result2").append(`<p data-city-code="${element.address.cityCode}" style="color: #4444ff;" onmouseover="this.style.backgroundColor='#fff'; this.style.color='#4444ff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4444ff';">${element.address.cityName}, ${element.address.countryName}, ${element.address.countryCode} (${element.address.cityCode} - ${element.name})</p>`);
                            });
                        } else {
                            $("#result2").hide();
                        }
                    }
                });
            } else {
                $("#result2").hide();
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
            var cityName = $(this).text();
            $("[name='destination_city']").val(code);
            $("#destination_city_name").val(cityName);
        })

        $(document).click(function(event) {
            if (!$(event.target).closest("#result1").length) {
                $("#result1").empty();
            }
            if (!$(event.target).closest("#result2").length) {
                $("#result2").empty();
            }
        });

        $('input[name="tripType"]').change(function() {
            var tripType = $('input[name="tripType"]:checked').val();
            var returnDateContainer = $('#returnDateContainer');

            if (tripType === 'roundTrip') {
                returnDateContainer.show();
            } else {
                returnDateContainer.hide();
            }
        });

        $('input[name="tripType"]:checked').trigger('change');


       // Form validation
    $('form.search-form').on('submit', function(e) {
    let isValid = true;
    let errorMessage = '';

    // Origin city validation
    if ($('input[name="origin_city"]').val() === '') {
    isValid = false;
    errorMessage = 'Please select departure city';
    $('#search1').addClass('is-invalid');
    } else {
    $('#search1').removeClass('is-invalid');
    }

    // Destination city validation
    if ($('input[name="destination_city"]').val() === '') {
    isValid = false;
    errorMessage = errorMessage || 'Please select destination city';
    $('#search2').addClass('is-invalid');
    } else {
    $('#search2').removeClass('is-invalid');
    }

    // Departure date validation
    if ($('#departureDate').val() === '') {
    isValid = false;
    errorMessage = errorMessage || 'Please select a departure date';
    $('#departureDate').addClass('is-invalid');
    } else {
    $('#departureDate').removeClass('is-invalid');
    }

    // Return date validation for round trips
    if ($('#roundTrip').is(':checked') && $('#returnDate').val() === '') {
    isValid = false;
    errorMessage = errorMessage || 'Please select a return date';
    $('#returnDate').addClass('is-invalid');
    } else {
    $('#returnDate').removeClass('is-invalid');
    }

    // Show error message and prevent form submission if validation fails
    if (!isValid) {
    e.preventDefault();

    // Create or update validation feedback element
    showValidationError(errorMessage);
    }
    });

    // Function to show validation error message
    function showValidationError(message) {
    // Remove any existing alert
    $('.validation-alert').remove();

    // Create new alert
    const alertHtml = `
    <div class="validation-alert alert alert-danger alert-dismissible fade show mt-3" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `;

    // Insert alert before the submit button
    $('.search-btn').before(alertHtml);

    // Scroll to the error message
    $('html, body').animate({
    scrollTop: $('.validation-alert').offset().top - 100
    }, 200);
    }
        function setupCounter(parentId,spanEle,inputEle) {

        const parentElement = document.getElementById(parentId);

        if (!parentElement) return;


        const increaseBtn = parentElement.querySelector('[data-action="increase"]');
        const decreaseBtn = parentElement.querySelector('[data-action="decrease"]');
        const totalTravelersSpan = document.getElementById('totalTravelers');
        const span = parentElement.querySelector(spanEle);
        const input = parentElement.querySelector(inputEle);

        if (!span || !input) return;

        let currentValue = parseInt(span.textContent);

        increaseBtn.addEventListener("click", () => updateCounter("increase"));
        decreaseBtn.addEventListener("click", () => updateCounter("decrease"));

            function updateCounter(action) {

                let defaultValue=0;
                if (parentId === 'adults') {
                    defaultValue = 1;
                }

                if (action === "increase") {

                currentValue++;
                } else if (action === "decrease" && currentValue > defaultValue) {
                currentValue--;
                }
                span.textContent = currentValue;
                input.value = currentValue;
            }




        }

        setupCounter('adults', '#adultsCount', '#adultsInput');
        setupCounter('children', '#childrenCount', '#childrenInput');
        // setupCounter('infants', '#infantsCount', '#infantsInput');
        setupCounter('heldInfants', '#heldInfantsCount', '#heldInfantsInput');

        function updateTotalTravelersDisplay() {
        const adults = parseInt($('#adultsInput').val() || 1);
        const children = parseInt($('#childrenInput').val() || 0);
        // const infants = parseInt($('#infantsInput').val() || 0);
        const heldInfants = parseInt($('#heldInfantsInput').val() || 0);

        const total = adults + children + heldInfants;
        $('#totalTravelers').text(total + ' ' + (total === 1 ? 'Traveler' : 'Travelers'));
        }

        // Call initially to set the display
        updateTotalTravelersDisplay();

        // Update whenever traveler buttons are clicked
        $('.traveler-btn').on('click', function() {
        // Give time for the counter to update
        setTimeout(updateTotalTravelersDisplay, 50);
        });


        $('#subscribeBtn').click(function() {
        const email = $('#subscribeEmail').val();
        const btn = $(this);
        const notification = $('#notification');

        if (!email) {
        showNotification('Please enter your email address', 'error');
        return;
        }

        // Disable button and show loading state
        btn.prop('disabled', true).html('Subscribing...');

        $.ajax({
        url: '{{ route("subscribe") }}',
        type: 'POST',
        data: {
        email: email,
        _token: '{{ csrf_token() }}'
        },
        success: function(response) {
        if (response.success) {
        showNotification(response.message, 'success');
        $('#subscribeEmail').val('');
        }
        },
        error: function(xhr) {
        showNotification('Failed to subscribe. Please try again.', 'error');
        },
        complete: function() {
        // Re-enable button and restore text
        btn.prop('disabled', false).html('Subscribe');
        }
        });

        // Add this function to handle notifications
        function showNotification(message, type) {
        const notification = $('#notification');
        notification.removeClass('notification-success notification-error')
        .addClass('notification-' + type)
        .html(message)
        .css('display', 'block')
        .addClass('show');

        // Hide notification after 3 seconds
        setTimeout(function() {
        notification.removeClass('show');
        setTimeout(function() {
        notification.css('display', 'none');
        }, 300);
        }, 3000);
        }

        });

        });
    </script>


</body>

</html>
