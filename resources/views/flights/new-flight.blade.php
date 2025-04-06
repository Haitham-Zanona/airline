<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>موقع حجز رحلات طيران</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom Styles */

        :root {
            --primary-color: #6742c9;
            --light-gray: #f8f9fa;
            --border-color: #e0e0e0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /*Pop-up style*/
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .popup-container {
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #f0f0f0;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .popup-content {
            display: flex;
            flex-direction: row;

        }

        .popup-image {
            flex: 0 0 40%;
            background-color: #f0f0ff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .popup-details {
            flex: 0 0 60%;
            padding: 40px 20px;
        }

        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .timer {
            color: #4444ff;
            font-weight: bold;
        }

        .price {
            font-size: 28px;
            color: #4444ff;
            font-weight: bold;
        }

        .price-note {
            color: #555;
            font-size: 16px;
            text-align: right;
        }

        .flight-details-popup {

            margin: 20px 0;
            background-color: #f6f7ff;
            padding: 15px 3%;
            /* margin-bottom: 10px; */
        }

        .flight-route {
            flex: 1;
        }

        .flight-route h3 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .flight-route p {
            margin: 0;
            color: #555;
            font-size: 12px;
        }

        .route-separator {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 10px;
        }

        .call-button {
            background-color: #5d3e9e;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            font-size: 18px;
            margin-top: 20px;
            cursor: pointer;
        }

        .call-button:hover {
            background-color: #4a2d8b;
        }

        .disclaimer {
            text-align: center;
            color: #777;
            margin-top: 15px;
            font-size: 14px;
        }

        .customer-service {
            position: relative;
        }

        .service-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #5d3e9e;
            color: white;
            border-radius: 12px;
            padding: 5px 10px;
            font-size: 14px;
        }



        .container {
            max-width: 1200px;
        }

        /* Header styles */
        header {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            z-index: 100;
        }

        .navbar-toggler {
            background-color: #f8f9fa;
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
            color: #4444ff;
        }

        /*End Header Style*/

        .flight-result-search .col-md-2 label {
            padding-left: 10px;
        }

        .search-container {
            background-color: #f1f1f1;
            padding: 20px 5%;
        }

        .search-option {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .radio-container {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .search-form {
            /* display: flex; */
            /* gap: 5px; */
            flex-wrap: wrap;
        }

        .search-form .form-control {
            border-radius: 4px;
        }

        .search-button {
            background-color: #6c3eff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
        }

        .filter-section {
            margin-top: 30px;
        }

        .filter-card {
            background-color: white;
            padding-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .filter-title {
            font-weight: bold;
            margin-bottom: 15px;
            cursor: pointer;
            background-color: #6c3eff;
            color: white;
            position: relative;
            padding: 15px;
            border-radius: 5px;

        }

        .filter-title::before {
            content: '\25BC';
            /* Unicode character for a down-pointing triangle */
            position: absolute;
            top: 50%;
            right: 5%;
            transform: translateY(-50%);
            transition: transform 0.3s ease;
            /* Smooth transition for rotation */
        }

        .filter-title.collapsed::before {
            transform: translateY(-50%) rotate(-90deg);
            /* Rotate the arrow 90 degrees when collapsed */
        }

        .filter-option {
            margin-bottom: 10px;
        }

        .filter-content {
            /* display: block; */
            overflow: hidden;
            transition: height 0.3s ease;
            padding: 0 20px;
            /* Smooth transition for the height change */
        }

        .filter-subtitle {
            font-size: 18px;
            font-weight: bold;
            color: #4444ff;
        }

        .pricing-tabs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .pricing-tab {
            padding: 10px;
            flex: 1;
            text-align: center;
            cursor: pointer;
        }

        .pricing-tab.active {
            border-bottom: 3px solid #6c3eff;
            color: #6c3eff;
        }

        .pricing-price {
            font-size: 12px;
            color: #666;
        }

        .flight-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .flight-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .flight-details {

            margin: 20px 0;
            background-color: #f6f7ff;
            padding: 15px 3%;
            /* margin-bottom: 10px; */
        }

        .airline-logo {
            width: 30px;
            height: 30px;
            background-color: #e0e6ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }



        .btn-outline-secondary.rounded-circle {
            width: 30px;
            height: 30px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary.rounded-circle:hover {
            background-color: #6c757d;
            color: white;
        }

        .outbound-stops-details,
        .inbound-stops-details {
            margin-top: 10px;
            margin-bottom: 20px;
            border-left: 3px solid #e9ecef;
            padding-left: 15px;
        }



        .flight-time {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .flight-date {
            font-size: 12px;
            color: #666;
        }

        .flight-airport {
            font-size: 10px;
            color: #666;
            margin: 7px 0;
        }

        .flight-duration {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin: 7px 0;
        }

        .flight-price {
            font-size: 20px;
            font-weight: bold;
            /* color: #28a745; */
            color: #333;
            margin-bottom: 10px;
        }

        .book-button {

            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            background-color: #6c3eff;
            padding: 8px 15px;
            font-size: 14px;
            width: 100%;
        }

        .book-button:hover {
            background-color: #0069d9;
        }

        .flight-extra-info {
            display: flex;
            /* justify-content: space-between; */
            align-items: center;
            gap: 20%;
        }

        .flight-footer {
            color: #666;
            padding: 10px 15px;
            /* border-top: 1px solid #eee; */
            font-size: 13px;
        }

        .stops-details-container {
            border-radius: 4px;
            margin: 10px 0;
        }

        .connection-info {
            background-color: white;
            border-radius: 4px;
        }



        .flight-tabs {
            display: flex;
            border-bottom: 1px solid #eee;
        }

        .flight-tab {
            padding: 10px 15px;
            cursor: pointer;
        }

        .flight-tab.active {
            border-bottom: 2px solid #6c3eff;
            color: #6c3eff;
        }

        .time-slider-container {
            padding: 10px 0;
        }

        .time-slider {
            height: 5px;
            background-color: #ddd;
            position: relative;
            margin: 5px 0 20px 0;
        }

        .time-slider-handle {
            width: 12px;
            height: 12px;
            background-color: #6c3eff;
            border-radius: 50%;
            position: absolute;
            top: -4px;
        }

        .time-slider-range {
            height: 5px;
            background-color: #6c3eff;
            position: absolute;
        }

        .time-labels {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #666;
        }

        .show-more-btn {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            background-color: white;
            color: #6c3eff;
            border-radius: 5px;
            margin: 20px 0;
        }

        .banner-container {
            display: flex;
            /* flex-wrap: wrap; */
            /* justify-content: space-between; */
            align-items: center;
            background-color: #4285f4;
            border-radius: 10px;
            padding: 20px;
            color: white;
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            gap: 10%;
        }

        .right-side-banner {
            display: flex;
            /* flex-direction: column; */
            justify-content: center;
            align-items: center;
            width: 70%;
            gap: 5%;

        }

        .banner-icons {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10%;
            width: 100%;
        }

        .icon-circle {
            background-color: #0069d9;
            color: #fff;
            border-radius: 50%;
            border: 3px solid #fff;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .icon-circle i {
            color: #4285f4;
            font-size: 24px;
        }

        .yellow-pill {
            background-color: #FFD600;
            color: #000;
            border-radius: 20px;
            padding: 6px 15px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
        }

        .save-text {
            font-size: 18px;
            line-height: 1.3;
        }

        .phone-button {
            background-color: #FF6A00;
            color: white;
            border-radius: 8px;
            padding: 12px 20px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-weight: bold;
        }

        .phone-button:hover {
            background-color: #e55f00;
            color: white;
        }

        .phone-number {
            font-size: 20px;
            font-weight: bold;
        }

        .expert-text {
            font-size: 14px;
            display: block;
            text-align: center;
        }

        .result-container {
            background-image: url('assets/images/no-result.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin: 2rem auto;
        }

        .bg-light-blue {
            background-color: #e6f2ff;
            position: relative;
            min-height: 450px;
        }

        .agent-image {
            position: absolute;
            bottom: 0;
            left: 50px;
            max-width: 400px;
        }

        .agent-chat {
            position: absolute;
            top: 100px;
            left: 50px;
            background-color: #0099cc;
            color: white;
            padding: 15px;
            border-radius: 20px;
            width: 120px;
            height: 80px;
            display: flex;
            align-items: center;
        }

        .agent-chat .lines {
            width: 80px;
            height: 40px;
        }

        .line {
            background-color: white;
            height: 4px;
            margin: 6px 0;
            border-radius: 2px;
        }

        .content-section {
            padding: 2rem;
            text-align: right;
        }

        .result-heading {
            color: #0a2463;
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .description {
            color: #444;
            font-size: 24px;
            margin-bottom: 2rem;
        }

        .call-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            text-decoration: none;
            display: inline-block;
        }

        .availability {
            color: #444;
            margin-bottom: 2rem;
        }

        .discount-text {
            color: #4a86e8;
            font-size: 1.1rem;
        }

        .discount-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #212529;
            margin-top: -10px;
        }

        .agent-figure {
            position: relative;
        }

        .coffee-cup {
            position: absolute;
            top: 120px;
            left: 20px;
            width: 50px;
            height: 60px;
        }

        .airline-logo-img {
            max-width: 50px;
            max-height: 50px;
            object-fit: contain;
        }

        .airline-logo-img.logo-error {
            display: none;
            /* إخفاء الصورة */
        }

        .airline-logo .airline-name {
            display: inline-block;
            font-weight: bold;
            color: #333;
        }

        .footer-contact-icons {
            width: 30px;
            height: 30px;
        }

        @media (max-width: 767.98px) {
            .nav-link {
                padding: 10px 0;
                border-bottom: 1px solid #eee;
            }

            .nav-item:last-child .nav-link {
                border-bottom: none;
            }
        }

        @media (min-width: 768px) {
            .filter-content.collapse {
                display: block;
                /* Override Bootstrap's collapse class */
                height: auto !important;
                /* Override Bootstrap's height */
            }

            .filter-section .col-md-3 {
                display: block;
            }
        }

        @media (max-width: 768px) {


            .flight-extra-info {
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 0;
            }

            .flight-footer {
                font-size: 12px;
            }

            .popup-content {
                flex-direction: column;
                padding: 0;
            }

            .popup-image {
                flex: 0 0 200px;
                display: none;
            }

            .popup-container {
                height: 65%;
                width: 80%;
                max-width: 500px;
                max-height: 700px;
            }

            .popup-details {
                flex: 1;
            }

            .flight-details-popup {
                flex-direction: row;
                margin: 0;
            }

            .route-separator {
                transform: rotate(90deg);
                margin: 10px 0;
            }

            .popup-header {
                flex-direction: row;
                align-items: flex-center;
                margin: 10px 0;
            }

            .timer {
                /* margin-top: 10px; */
            }

            .filter-section .col-md-3 {
                /* display: none; */
                /* Hide the filter column by default */
            }

            .filter-section .col-md-9 {
                width: 100%;
            }

            .filter-title {
                display: block;

                border: none;
                padding: 8px 15px;
                border-radius: 4px;
                cursor: pointer;
                margin-bottom: 15px;
                /* Add margin to separate from content */
            }

            .filter-title::before {
                content: '\25BC';
                /* Unicode character for a down-pointing triangle */
                position: absolute;
                top: 50%;
                right: 10px;
                transform: translateY(-50%);
                transition: transform 0.3s ease;
                /* Smooth transition for rotation */
            }

            .filter-title.collapsed::before {
                transform: translateY(-50%) rotate(-90deg);
                /* Rotate the arrow 90 degrees when collapsed */
            }

            .filter-content {
                display: none;
                /* Hide the filter content by default */
            }

            .filter-content.show {
                display: block;
                /* Show the filter content when the title is clicked */
            }

            .banner-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                /* gap: 10px; */
                padding: 15px;
            }

            .right-side-banner {
                /* flex-direction: row; */
                align-items: self-start;
            }

            .banner-icons {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .icon-circle {
                background-color: #0069d9;
                color: #fff;
                border-radius: 50%;
                border: 3px solid #fff;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 10px;
            }

            .icon-circle i {
                color: #4285f4;
                font-size: 24px;
            }

            .yellow-pill {
                background-color: #FFD600;
                color: #000;
                border-radius: 20px;
                padding: 6px 15px;
                font-weight: bold;
                display: inline-block;
                margin-bottom: 10px;
            }

            .save-text {
                font-size: 13px;
                line-height: 1.3;
                padding: 0 5px;
            }

            .phone-button {
                background-color: #FF6A00;
                color: white;
                border-radius: 8px;
                padding: 10px 11px;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                font-weight: bold;
            }

            .phone-button:hover {
                background-color: #e55f00;
                color: white;
            }

            .phone-number {
                font-size: 14px;
                font-weight: bold;
            }

            .expert-text {
                font-size: 10px;
                display: block;
                text-align: center;
            }

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

        /* @media(max width) */
    </style>
</head>

<body>

    {{-- @dd($flightsArraySubset) --}}
    {{-- @dd(session('flight_search')) --}}
    <!-- Popup -->
    <div class="popup-overlay" id="specialFarePopup">
        <div class="popup-container">
            <button class="popup-close" id="closePopup">&times;</button>
            <div class="popup-content">
                <div class="popup-image">
                    <div class="customer-service">
                        <img src="{{ asset('assets/images/pop-up-frame.webp') }}" alt="Customer Service Representative"
                            class="img-fluid">
                        {{-- <div class="service-badge">24/7</div> --}}
                    </div>
                </div>
                <div class="popup-details">
                    <div class="popup-header">
                        <h4 class="m-0">Limited Time Offer!</h4>
                        <div class="timer">Ends in <span id="countdown">15m 30s</span></div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Special fare to <span class="fw-bold">Kenya</span></h5>
                        <div class="text-end">
                            <div class="price">$155.42*</div>
                            <div class="price-note">Price per Adult</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center flight-details-popup">
                        <div class=" flight-route">
                            <h3>NBI</h3>
                            <p>14.50</p>
                            <p>Sun, 29 Jan 2023</p>
                            <p>Moi Intl, Mombasa</p>
                            <p>Kenya</p>
                            <p>Terminal - 2, Gate - 25</p>
                        </div>

                        {{-- <div class=" route-separator">
                            <i class="fas fa-plane position-absolute bg-white px-1"></i>
                        </div> --}}
                        <div class="position-relative my-2">
                            <div class="border-top w-100"></div>
                            <i class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                        </div>

                        <div class=" flight-route text-end">
                            <h3>MBO</h3>
                            <p>14.50</p>
                            <p>Sun, 29 Jan 2023</p>
                            <p>JFK Terminal, Nairobi</p>
                            <p>Kenya</p>
                            <p>Terminal - 2, Gate - 25</p>
                        </div>
                    </div>

                    <button class="call-button">Call Now +1-111-111-1111</button>

                    <p class="disclaimer">*Fares are subject to seat availability and not guaranteed until ticketed</p>
                </div>
            </div>
        </div>
    </div>

    {{-- @dd($flightOffers, $flightOffers[1]['itineraries'][1],) --}}
    {{-- @dd($flightOffers, $flightOffers[0]['travelerPricings'][0]['fareDetailsBySegment'][0]['amenities'],
    $flightOffers[0]['travelerPricings'][0]['fareDetailsBySegment'][1]['amenities'],
    $flightOffers[1]['travelerPricings'][0]['fareDetailsBySegment'][0]['amenities']) --}}
    <!-- Header -->
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
                    <div class="contact-info d-flex align-items-center justify-content-end">
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
                    <div class="bg-light p-3 rounded">
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
                                    <p class="m-0" style="font-size: 12px;">Contact us 24/7 for book the best deal!</p>
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

    <!-- Search Section -->
    <section class="search-container">



        <form class="search-form">
            @csrf
            <div class="radio-container">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tripType" id="oneWay" {{
                        session('flight_search.tripType', 'oneWay' )=='oneWay' ? 'checked' : '' }}>
                    <label class="form-check-label" for="oneWay">ONE WAY</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tripType" id="roundTrip" {{
                        session('flight_search.tripType')=='roundTrip' ? 'checked' : '' }}>
                    <label class="form-check-label" for="roundTrip">ROUND WAY</label>
                </div>
            </div>
            <div class="row flight-result-search">
                <div class="col-md-2">
                    <label for="origin_city"><i class="fas fa-plane-departure me-1"></i> From</label>
                    <input type="text" id="search1" class="form-select" placeholder="Enter City Name" autocomplete="off"
                        value="{{ session('flight_search.origin_city_name', '') }}" readonly>
                    {{-- <input type="hidden" name="origin_city" value="">
                    <input type="hidden" name="origin_city_name" id="origin_city_name">
                    <div id="result1" style="width: 90%;"></div> --}}
                </div>
                <div class="col-md-2">
                    <label for="destination_city"><i class="fas fa-plane-arrival me-1"></i> To</label>
                    <input type="text" id="search2" placeholder="Enter City Name" autocomplete="off" class="form-select"
                        value="{{ session('flight_search.destination_city_name', '') }}" readonly>
                    {{-- <input type="hidden" name="destination_city" value="">
                    <input type="hidden" name="destination_city_name" id="destination_city_name">
                    <div id="result2" style="width: 90%;"></div> --}}
                </div>

                <div class="col-md-2">
                    <label for="departureDate"><i class="far fa-calendar-alt me-1"></i> Departure</label>
                    <input type="date" id="departureDate" name="departureDate" class="form-control"
                        value="{{ session('flight_search.departureDate', '') }}" readonly>
                </div>
                @if (session('flight_search.tripType')=='roundTrip')
                <div class="col-md-2">
                    <label for="returnDate"><i class="far fa-calendar-alt me-1"></i> Return</label>
                    <input type="date" id="returnDate" name="returnDate" class="form-control"
                        value="{{ session('flight_search.returnDate', '') }}" readonly>
                </div>
                @endif

                <div class="col-md-2">
                    <label><i class="fas fa-user me-1"></i> Class</label>
                    <select id="cabin" name="cabin" class="form-select" disabled>
                        <option value="ECONOMY" {{ session('flight_search.cabin')=='ECONOMY' ? 'selected' : '' }}>
                            Economy</option>
                        <option value="PREMIUM_ECONOMY" {{ session('flight_search.cabin')=='PREMIUM_ECONOMY'
                            ? 'selected' : '' }}>Premium Economy</option>
                        <option value="BUSINESS" {{ session('flight_search.cabin')=='BUSINESS' ? 'selected' : '' }}>
                            Business</option>
                        <option value="FIRST" {{ session('flight_search.cabin')=='FIRST' ? 'selected' : '' }}>First
                            Class</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <label for="travelers" class="px-2"><i class="fas fa-users me-1"></i> Pax</label>
                    <div class="dropdown">
                        <button class="form-control d-flex justify-content-between align-items-center dropdown-toggle"
                            type="button" id="travelersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span id="totalTravelers">{{ session('flight_search.total_travelers', 1) }}</span>
                            {{-- <i class="fas fa-chevron-down"></i> --}}
                        </button>
                        <div class="dropdown-menu p-3" style="width: 300px;">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-label mb-0">Adults</label>
                                    <div class="d-flex align-items-center">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                            data-type="adults" data-action="decrease" disabled>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="mx-3" id="adultsCount">{{ session('flight_search.adults', 1)
                                            }}</span>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                            data-type="adults" data-action="increase" disabled>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="adults" id="adultsInput"
                                    value="{{ session('flight_search.adults', 1) }}">
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-label mb-0">Children</label>
                                    <div class="d-flex align-items-center">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                            data-type="children" data-action="decrease" disabled>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="mx-3" id="childrenCount">{{ session('flight_search.children', 0)
                                            }}</span>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                            data-type="children" data-action="increase" disabled>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="children" id="childrenInput"
                                    value="{{ session('flight_search.children', 0) }}">
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-label mb-0">Infants</label>
                                    <div class="d-flex align-items-center">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                            data-type="held_infants" data-action="decrease" disabled>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="mx-3" id="heldInfantsCount">{{
                                            session('flight_search.held_infants', 0) }}</span>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-circle traveler-btn"
                                            data-type="held_infants" data-action="increase" disabled>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="held_infants" id="heldInfantsInput"
                                    value="{{ session('flight_search.held_infants', 0) }}">
                            </div>
                        </div><!-- dropdown-menu -->
                    </div><!-- dropdown -->
                </div>
                <div
                    class="{{ session('flight_search.tripType')=='roundTrip' ? 'col-md-1' : 'col-md-2' }} d-flex align-items-end">
                    <button class="search-button w-100"><a href="{{ route('index') }}"
                            style="text-decoration: none; color: #fff;">Modify search</a></button>
                </div>
            </div><!-- row -->
        </form>


    </section>

    <!-- Filter and Results Section -->
    <section class="container filter-section">
        <div class="row">

            <!-- Filters Column -->
            <div class="col-md-3">

                <div class="filter-card">
                    <div class="filter-title collapsed" data-bs-toggle="collapse" data-bs-target="#filterContent">
                        Filter By
                    </div>
                    <div class="filter-content collapse" id="filterContent">
                        <!-- Stop Filter -->
                        <div class="mb-4">
                            <div class="filter-subtitle mb-2">Stop</div>
                            <div id="stops-filter">
                                <!-- This will be populated dynamically by JavaScript -->
                            </div>
                        </div>

                        <!-- Airlines Filter -->
                        <div class="mb-4">
                            <div class="filter-subtitle mb-2">Airlines</div>
                            <div id="airlines-filter">
                                <!-- This will be populated dynamically by JavaScript -->
                            </div>
                        </div>

                        <!-- Departure Time Filter -->
                        <div class="mb-4">
                            <div class="filter-subtitle mb-2">Departure Time</div>
                            <div class="time-slider-container">
                                <div id="departure-time-slider-values" class="time-labels">
                                    <span>00:00 - 24:00</span>
                                </div>
                                <div id="departure-time-slider" class="time-slider">
                                    <!-- Slider will be initialized by jQuery UI -->
                                </div>
                            </div>
                        </div>

                        <!-- Arrival Time Filter -->
                        <div class="mb-4">
                            <div class="filter-subtitle mb-2">Arrival Time</div>
                            <div class="time-slider-container">
                                <div id="arrival-time-slider-values" class="time-labels">
                                    <span>00:00 - 24:00</span>
                                </div>
                                <div id="arrival-time-slider" class="time-slider">
                                    <!-- Slider will be initialized by jQuery UI -->
                                </div>
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="d-flex justify-content-between">
                            <button id="reset-filters" class="btn btn-outline-secondary">Reset</button>
                            <button id="apply-filters" class="btn btn-primary">Apply Filters</button>
                        </div>
                    </div><!-- filter-content collapse -->
                </div><!-- filter-card -->
            </div><!-- col-md-3 -->

            <!-- Results Column -->
            <div class="col-md-9">

                {{-- @dd($flightOffers) --}}
                <div id="flight-results-container">
                    @forelse ($flightsArraySubset as $flight)
                    <!-- Flight Card -->
                    <form action="{{ route('flight.select') }}" method="post">
                        @csrf
                        <input type="hidden" name="flight_id" value="{{ $flight['id'] }}">
                        <div class="flight-card">
                            <div class="flight-header">
                                <div class="d-flex align-items-center">

                                    <div class="fw-bold">
                                        @if(isset($flight['segments_info'][0]['airline_info']['name']) &&
                                        $flight['segments_info'][0]['airline_info']['name'] !== 'UNKNOWN')
                                        {{ $flight['segments_info'][0]['airline_info']['name'] }}
                                        @else
                                        {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                                        @endif
                                    </div>
                                </div>
                                <div>Travel Class: <span class="fw-bold">{{ $flightData['cabin'] ?? 'Economy' }}</span>
                                </div>
                            </div><!-- flight-header -->

                            <div class="row" style="box-sizing: border-box;">
                                <div class="col-md-9" style="padding: 0 15px 0 25px;">
                                    <!-- OUTBOUND FLIGHT -->
                                    <div class="flight-details" style="border-bottom: 1px solid #eee;">
                                        <div class="row">
                                            <!-- Departure Details -->
                                            <div class="col-3">
                                                <?php
                                                            $departureTime = $flight['itineraries'][0]['segments'][0]['departure']['at'] ?? '';
                                                            $datetime = \Carbon\Carbon::parse($departureTime);

                                                            $originCity = $flightData['originCity'] ?? '';
                                                            $cityName = '';
                                                            $cityCode = '';

                                                            // Extract city name (text in parentheses)
                                                            if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
                                                                preg_match('/\((.*?)\)/', $originCity, $matches);
                                                                $cityName = isset($matches[1]) ? trim($matches[1]) : '';
                                                            }

                                                            // Extract city code (after comma)
                                                            if (strpos($originCity, ',') !== false) {
                                                                $parts = explode(',', $originCity);
                                                                $cityCode = isset($parts[1]) ? trim($parts[1]) : '';
                                                            }
                                                        ?>
                                                <div class="flight-time">{{ $datetime->translatedFormat('H:i') }}</div>
                                                <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}
                                                </div>
                                                <div class="flight-airport">{{ $cityName }}</div>
                                                <div class="flight-airport">{{ $cityCode }}</div>
                                            </div>

                                            <!-- Flight Duration -->
                                            <div
                                                class="col-6 d-flex flex-column justify-content-center align-items-center">
                                                <?php
                                                            if(isset($flight['itineraries'][0]['duration'])) {
                                                                $duration = $flight['itineraries'][0]['duration'];
                                                                // Convert PT2H30M format to 2h 30m
                                                                $duration = str_replace('PT', '', $duration);
                                                                $duration = str_replace('H', 'h ', $duration);
                                                                $duration = str_replace('M', 'm', $duration);
                                                            } else {
                                                                $duration = '';
                                                            }

                                                            $outboundStops = isset($flight['outbound_stops_text']) ? $flight['outbound_stops_text'] :
                                                                            (isset($flight['itineraries'][0]['segments']) ? (count($flight['itineraries'][0]['segments']) - 1) : '0');
                                                        ?>
                                                <div class="flight-duration">{{ $duration }}</div>
                                                <div class="position-relative w-100 my-2">
                                                    <div class="border-top w-100"></div>
                                                    <i
                                                        class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                                                </div>
                                                <div class="flight-duration">
                                                    @if($outboundStops > 0)
                                                    <div>{{ $outboundStops }} stop(s)</div>
                                                    <div class="mt-1">
                                                        <button
                                                            class="btn btn-outline-primary rounded-circle outbound-stops-toggle"
                                                            data-flight-id="{{ $flight['id'] }}"
                                                            style="width: 28px; height: 28px; padding: 0;">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                    @else
                                                    Direct Flight
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Arrival Details -->
                                            <div class="col-3 text-end">
                                                <?php
                                                            $lastSegmentIndex = count($flight['itineraries'][0]['segments'] ?? []) - 1;
                                                            $arrivalTime = $flight['itineraries'][0]['segments'][$lastSegmentIndex]['arrival']['at'] ?? '';
                                                            $datetime = \Carbon\Carbon::parse($arrivalTime);
                                                        ?>
                                                <div class="flight-time">{{ $datetime->format('H:i')}}</div>
                                                <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}
                                                </div>
                                                <div class="flight-airport">{{ trim(explode("(",
                                                    explode(")", $flightData['destinationCity'] ?? '')[0] ?? '')[1] ??
                                                    '')
                                                    }}
                                                </div>
                                                <div class="flight-airport">{{ trim(explode(",",
                                                    $flightData['destinationCity'] ?? '')[1] ?? '')
                                                    }}</div>
                                            </div>
                                        </div>
                                    </div><!-- flight-details -->

                                    <!-- Outbound Stops Details (Initially Hidden) -->
                                    @if(isset($flight['itineraries'][0]['segments']) &&
                                    count($flight['itineraries'][0]['segments']) > 1)
                                    <div class="outbound-stops-details" id="outbound-stops-{{ $flight['id'] }}"
                                        style="display: none;">
                                        <div class="stops-details-container p-3 bg-light">
                                            <h6 class="mb-3">Connection Details</h6>

                                            @foreach($flight['itineraries'][0]['segments'] as $key => $segment)
                                            @if($key < count($flight['itineraries'][0]['segments'])) <div
                                                class="connection-info mb-3 p-2 border-start border-4 @if($key == 0) border-success @else border-primary @endif">
                                                <?php
                                                                        $departureAirport = $segment['departure']['iataCode'] ?? '';
                                                                        $departureTime = $segment['departure']['at'] ?? '';
                                                                        $departureDateTime = \Carbon\Carbon::parse($departureTime);

                                                                        $arrivalAirport = $segment['arrival']['iataCode'] ?? '';
                                                                        $arrivalTime = $segment['arrival']['at'] ?? '';
                                                                        $arrivalDateTime = \Carbon\Carbon::parse($arrivalTime);

                                                                        // Display connection time only for segments after the first one
                                                                        if($key > 0) {
                                                                            $prevArrival = \Carbon\Carbon::parse($flight['itineraries'][0]['segments'][$key-1]['arrival']['at'] ?? '');
                                                                            $connectionTime = $departureDateTime->diffInMinutes($prevArrival);
                                                                            $connectionHours = floor($connectionTime / 60);
                                                                            $connectionMinutes = $connectionTime % 60;
                                                                        }
                                                                    ?>

                                                <!-- For outbound flights -->
                                                @if($key > 0)
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span><i class="fas fa-clock text-warning me-1"></i> Connection
                                                        time:
                                                        @if($connectionHours > 0){{ $connectionHours }}h @endif
                                                        {{ $connectionMinutes }}m at {{ $departureAirport }}
                                                    </span>
                                                    <span class="badge bg-secondary">

                                                        @if(isset($flight['segments_info'][0]['airline_info']['name'])
                                                        &&
                                                        $flight['segments_info'][0]['airline_info']['name'] !==
                                                        'UNKNOWN')
                                                        {{ $flight['segments_info'][0]['airline_info']['name'] }}
                                                        @else
                                                        {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                                                        @endif

                                                    </span>
                                                </div><!-- d-flex justify-content-between mb-2 -->
                                                @else
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span><i class="fas fa-plane-departure text-success me-1"></i>
                                                        Departure</span>
                                                    <span class="badge bg-secondary">
                                                        @if(isset($flight['segments_info'][0]['airline_info']['name'])
                                                        &&
                                                        $flight['segments_info'][0]['airline_info']['name'] !==
                                                        'UNKNOWN')
                                                        {{ $flight['segments_info'][0]['airline_info']['name'] }}
                                                        @else
                                                        {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                                                        @endif
                                                    </span>
                                                </div><!-- /d-flex justify-content-between align-items-center mb-2 -->
                                                @endif

                                                <div class="row">
                                                    <div class="col-5">
                                                        <?php
                                                                    $departureTime = $flight['itineraries'][0]['segments'][0]['departure']['at'] ?? '';
                                                                    $datetime = \Carbon\Carbon::parse($departureTime);

                                                                    $originCity = $flightData['originCity'] ?? '';
                                                                    $cityName = '';
                                                                    $cityCode = '';

                                                                    // Extract city name (text in parentheses)
                                                                    if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
                                                                        preg_match('/\((.*?)\)/', $originCity, $matches);
                                                                                                                $cityName = isset($matches[1]) ? trim($matches[1]) : '';
                                                                    }

                                                                    // Extract city code (after comma)
                                                                    if (strpos($originCity, ',') !== false) {
                                                                        $parts = explode(',', $originCity);
                                                                        $cityCode = isset($parts[1]) ? trim($parts[1]) : '';
                                                                    }
                                                                ?>
                                                        <div class="text-primary">{{ $departureDateTime->format('H:i')
                                                            }}
                                                        </div>
                                                        <div class="small">{{ $departureDateTime->translatedFormat('d M
                                                            Y')
                                                            }}
                                                        </div>
                                                        <div>{{ $departureAirport }}</div>
                                                    </div>
                                                    <div
                                                        class="col-2 text-center d-flex flex-column justify-content-center">
                                                        <div class="small">{{ str_replace(['PT', 'H', 'M'], ['', 'h ',
                                                            'm'],
                                                            $segment['duration'] ?? '') }}</div>
                                                        <div><i class="fas fa-arrow-right"></i></div>
                                                    </div>
                                                    <div class="col-5 text-end">
                                                        <div class="text-primary">{{ $arrivalDateTime->format('H:i') }}
                                                        </div>
                                                        <div class="small">{{ $arrivalDateTime->translatedFormat('d M
                                                            Y') }}
                                                        </div>
                                                        <div>{{ $arrivalAirport }}</div>
                                                    </div>
                                                </div><!-- row -->

                                        </div><!-- stops-details-container -->
                                        @endif

                                        @endforeach
                                        {{-- div div/div> --}}
                                        <!-- outbound-stops-details -->
                                    </div>

                                </div>
                                @endif

                                <!-- RETURN FLIGHT (if exists) -->
                                @if (isset($flight['itineraries'][1]))
                                <div class="flight-details mt-3">
                                    <div class="row">
                                        <!-- Departure Details -->
                                        <div class="col-3">
                                            <?php
                                                            $departureTime = $flight['itineraries'][1]['segments'][0]['departure']['at'] ?? '';
                                                            $datetime = \Carbon\Carbon::parse($departureTime);

                                                            $destinationCity = $flightData['destinationCity'] ?? '';
                                                            $cityName = '';
                                                            $cityCode = '';

                                                            // Extract city name (text in parentheses)
                                                            if (strpos($destinationCity, '(') !== false && strpos($destinationCity, ')') !== false) {
                                                                preg_match('/\((.*?)\)/', $destinationCity, $matches);
                                                                $cityName = isset($matches[1]) ? trim($matches[1]) : '';
                                                            }

                                                            // Extract city code (after comma)
                                                            if (strpos($destinationCity, ',') !== false) {
                                                                $parts = explode(',', $destinationCity);
                                                                $cityCode = isset($parts[1]) ? trim($parts[1]) : '';
                                                            }
                                                        ?>
                                            <div class="flight-time">{{ $datetime->translatedFormat('H:i') }}</div>
                                            <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}</div>
                                            <div class="flight-airport">{{ $cityName }}</div>
                                            <div class="flight-airport">{{ $cityCode }}</div>
                                        </div>

                                        <!-- Flight Duration -->
                                        <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                                            <?php
                                                            if(isset($flight['itineraries'][1]['duration'])) {
                                                                $duration = $flight['itineraries'][1]['duration'];
                                                                // Convert PT2H30M format to 2h 30m
                                                                $duration = str_replace('PT', '', $duration);
                                                                $duration = str_replace('H', 'h ', $duration);
                                                                $duration = str_replace('M', 'm', $duration);
                                                            } else {
                                                                $duration = '';
                                                            }

                                                            $inboundStops = isset($flight['inbound_stops_text']) ? $flight['inbound_stops_text'] :
                                                                            (isset($flight['itineraries'][1]['segments']) ? (count($flight['itineraries'][1]['segments']) - 1) : '0');
                                                        ?>
                                            <div class="flight-duration">{{ $duration }}</div>
                                            <div class="position-relative w-100 my-2">
                                                <div class="border-top w-100"></div>
                                                <i
                                                    class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                                            </div>
                                            <div class="flight-duration">
                                                @if($inboundStops > 0)
                                                <div>{{ $inboundStops }} stop(s)</div>
                                                <div class="mt-1">
                                                    <button
                                                        class="btn btn-outline-primary rounded-circle inbound-stops-toggle"
                                                        data-flight-id="{{ $flight['id'] }}"
                                                        style="width: 28px; height: 28px; padding: 0;">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>
                                                @else
                                                Direct Flight
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Arrival Details -->
                                        <div class="col-3 text-end">
                                            <?php
                                                            $lastSegmentIndex = count($flight['itineraries'][1]['segments'] ?? []) - 1;
                                                            $arrivalTime = $flight['itineraries'][1]['segments'][$lastSegmentIndex]['arrival']['at'] ?? '';
                                                            $datetime = \Carbon\Carbon::parse($arrivalTime);

                                                            $originCity = $flightData['originCity'] ?? '';
                                                            $returnCityName = '';
                                                            $returnCityCode = '';

                                                            // Extract city name (text in parentheses)
                                                            if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
                                                                preg_match('/\((.*?)\)/', $originCity, $matches);
                                                                $returnCityName = isset($matches[1]) ? trim($matches[1]) : '';
                                                            }

                                                            // Extract city code (after comma)
                                            if (strpos($originCity, ',') !== false) {
                                                $parts = explode(',', $originCity);
                                                $returnCityCode = isset($parts[1]) ? trim($parts[1]) : '';
                                            }
                                        ?>
                                            <div class="flight-time">{{ $datetime->format('H:i')}}</div>
                                            <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}</div>
                                            <div class="flight-airport">{{ $returnCityName }}</div>
                                            <div class="flight-airport">{{ $returnCityCode }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Inbound Stops Details (Initially Hidden) -->
                                @if(isset($flight['itineraries'][1]['segments']) &&
                                count($flight['itineraries'][1]['segments'])
                                > 1)
                                <div class="inbound-stops-details" id="inbound-stops-{{ $flight['id'] }}"
                                    style="display: none;">
                                    <div class="stops-details-container p-3 bg-light">
                                        <h6 class="mb-3">Connection Details</h6>

                                        @foreach($flight['itineraries'][1]['segments'] as $key => $segment)
                                        @if($key < count($flight['itineraries'][1]['segments'])) <div
                                            class="connection-info mb-3 p-2 border-start border-4 @if($key == 0) border-success @else border-primary @endif">
                                            <?php
                                                        $departureAirport = $segment['departure']['iataCode'] ?? '';
                                                        $departureTime = $segment['departure']['at'] ?? '';
                                                        $departureDateTime = \Carbon\Carbon::parse($departureTime);

                                                        $arrivalAirport = $segment['arrival']['iataCode'] ?? '';
                                                        $arrivalTime = $segment['arrival']['at'] ?? '';
                                                        $arrivalDateTime = \Carbon\Carbon::parse($arrivalTime);

                                                        // Display connection time only for segments after the first one
                                                        if($key > 0) {
                                                            $prevArrival = \Carbon\Carbon::parse($flight['itineraries'][1]['segments'][$key-1]['arrival']['at'] ?? '');
                                                            $connectionTime = $departureDateTime->diffInMinutes($prevArrival);
                                                            $connectionHours = floor($connectionTime / 60);
                                                            $connectionMinutes = $connectionTime % 60;
                                                        }
                                                    ?>
                                            {{-- @dd($flight['itineraries'][1]['segments']) --}}

                                            <!-- For Inbound flights -->
                                            @if($key > 0)
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span><i class="fas fa-clock text-warning me-1"></i> Connection time:
                                                    @if($connectionHours > 0){{ $connectionHours }}h @endif
                                                    {{ $connectionMinutes }}m at {{ $departureAirport }}
                                                </span>
                                                <span class="badge bg-secondary">
                                                    @if(isset($flight['segments_info'][0]['airline_info']['name']) &&
                                                    $flight['segments_info'][0]['airline_info']['name'] !== 'UNKNOWN')
                                                    {{ $flight['segments_info'][0]['airline_info']['name'] }}
                                                    @else
                                                    {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                                                    @endif
                                                </span>
                                            </div>
                                            @else
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span><i class="fas fa-plane-departure text-success me-1"></i>
                                                    Departure</span>
                                                <span class="badge bg-secondary">
                                                    @if(isset($flight['segments_info'][0]['airline_info']['name']) &&
                                                    $flight['segments_info'][0]['airline_info']['name'] !== 'UNKNOWN')
                                                    {{ $flight['segments_info'][0]['airline_info']['name'] }}
                                                    @else
                                                    {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                                                    @endif
                                                </span>
                                            </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="text-primary">{{ $departureDateTime->format('H:i') }}
                                                    </div>
                                                    <div class="small">{{ $departureDateTime->translatedFormat('d M Y')
                                                        }}
                                                    </div>
                                                    <div>{{ $departureAirport }}</div>
                                                </div>
                                                <div
                                                    class="col-2 text-center d-flex flex-column justify-content-center">
                                                    <div class="small">{{ str_replace(['PT', 'H', 'M'], ['', 'h ', 'm'],
                                                        $segment['duration'] ?? '') }}</div>
                                                    <div><i class="fas fa-arrow-right"></i></div>
                                                </div>
                                                <div class="col-5 text-end">
                                                    <div class="text-primary">{{ $arrivalDateTime->format('H:i') }}
                                                    </div>
                                                    <div class="small">{{ $arrivalDateTime->translatedFormat('d M Y') }}
                                                    </div>
                                                    <div>{{ $arrivalAirport }}</div>
                                                </div>
                                            </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @endif

                        </div><!-- col-md-9 -->

                        <div class="col-md-3 d-flex justify-content-center">
                            <!-- Price and Book Button -->
                            <div class="p-3 d-flex text-center justify-content-center align-items-center">
                                <div class="me-3">
                                    <div class="flight-price">${{ $flight['price']['grandTotal'] ?? '0.00' }}</div>
                                    <button class="book-button px-3 py-2">Book Now</button>
                                </div>
                            </div>
                        </div><!-- col-md-3 -->


                </div><!-- row -->

                <!-- Seats Remaining and Refund Status -->
                <div class="flight-extra-info p-3">
                    <div style="padding: 10px 15px;">{{ $flight['numberOfBookableSeats'] ?? '0' }} seats remaining
                    </div>
                    <!-- Flight Footer -->
                    <div class="flight-footer d-flex justify-content-start">
                        <div class="me-4">
                            <i class="fas fa-ticket-alt me-1"></i> Last Ticket Date : {{ $flight['lastTicketingDate'] }}
                        </div>
                        <div class="me-4">
                            <i class="fa-solid fa-suitcase-rolling me-1"></i> Checked Bags : {{
                            $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['quantity']
                            ??
                            0
                            }}
                        </div>
                        {{-- <div class="me-4">
                            <i class="fas fa-exchange-alt me-1"></i> Self Transfer
                        </div> --}}
                        <div>
                            <i class="fas fa-suitcase-rolling me-1"></i> Cabin Bags : {{
                            $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCabinBags']['quantity']
                            ?? 0
                            }}
                        </div>
                    </div>
                </div>
            </div><!-- Flight Card -->

            </form>

            <div class="banner-container my-3">
                <!-- Left side with icons and text -->
                <div class="banner-icons mb-3 mb-md-0">
                    <div class="d-flex me-3">
                        <div class="icon-circle">
                            <i class="fa-solid fa-hotel"></i>
                        </div>
                        <div class="icon-circle position-relative" style="margin-left: -15px; z-index: 2;">
                            <i class="fa-solid fa-plane"></i>
                        </div>
                        <div class="icon-circle position-relative" style="margin-left: -15px;">
                            <i class="fa-solid fa-car-side"></i>
                        </div>
                    </div>
                    <div>
                        <div class="yellow-pill">Save big on Bundle</div>
                        <div class="save-text">Add Hotel or Car with Flight and<br>Save Extra 30% on Your Trip</div>
                    </div>

                </div>

                <!-- Right side with phone button -->
                <div class="right-side-banner">


                    <div>
                        <a href="tel:+17144775913" class="phone-button">
                            <i class="fa-solid fa-phone-volume me-2" style="width: 30px; height: 30px;"></i>
                            <div>
                                <span class="phone-number">+1-714-477-5913</span>
                                <span class="expert-text">Talk to a Travel Expert Now</span>
                            </div>
                        </a>
                    </div>

                </div>
            </div><!-- banner-container -->
            @empty
            <div class="container">
                <div class="result-container">


                    <div class="content-section">
                        <h1 class="result-heading d-block">No Result Found. Don't Worry!</h1>
                        <p class="description d-block">Our agents can help you out. Call us to find our best flights
                            to
                            meet
                            your travel
                            requirements.</p>

                        <div class="justify-content-end">
                            <p class="mb-2" style="padding-right: 80px;">Call us now at</p>
                            <a href="tel:+12163022732" class="call-button" style="width: 250px; padding-right: 50px;">
                                <i class="bi bi-telephone-fill me-2"></i> +1-216-302-2732
                            </a>
                            <p class="availability" style="padding-right: 50px;">we are available 24x7</p>

                            <div class="discount-section">
                                <p class="discount-text mb-0" style="padding-right: 100px;">Up to</p>
                                <p class="discount-value">15% Discount</p>
                                <p style="padding-right: 50px;">on total value awaits!!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforelse
        </div><!-- #flight-results-container -->



        <!-- HTML changes for the loading indicator -->
        <div id="loading" style="display:none; text-align:center; padding: 20px; margin: 20px 0;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading more flights...</p>
        </div>
        </div><!-- col-md-9 -->
        </div><!-- row -->
        {{-- </div>
        </div> --}}
        <!-- Show More Button -->
        {{-- <button class="show-more-btn">Show more</button> --}}
    </section>

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

                    <?xml version="1.0" encoding="utf-8"?><svg version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 122.873 23.572" enable-background="new 0 0 122.873 23.572" xml:space="preserve">
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
                                <span class="mx-2 footer-contact-res">+1-111-111-1111</span></a>
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
                                <span class="mx-2 footer-contact-res">email@gmail.com</span></a></li>

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


    <!-- jQuery library (must come first) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Countdown timer functionality
        function startCountdown() {
            let minutes = 15;
            let seconds = 30;

            const countdownInterval = setInterval(() => {
                if (seconds === 0) {
                    if (minutes === 0) {
                        clearInterval(countdownInterval);
                        document.getElementById('specialFarePopup').style.display = 'none';
                        return;
                    }
                    minutes--;
                    seconds = 59;
                } else {
                        seconds--;
                }

                document.getElementById('countdown').textContent = `${minutes}m ${seconds}s`;
            }, 1000);
        }

        // Close popup functionality
        document.getElementById('closePopup').addEventListener('click', function() {
        document.getElementById('specialFarePopup').style.display = 'none';
        });

        // Start the countdown when page loads
        window.addEventListener('load', startCountdown);

        // Function to show the popup (can be triggered by a button or after a delay)
        function showPopup() {
        document.getElementById('specialFarePopup').style.display = 'flex';
        }

        // Example: Show popup after 3 seconds
        setTimeout(showPopup, 3000);

        // Toggle function for outbound and inbound stops
        function toggleFlightStops(toggleSelector, prefix) {
            $(toggleSelector).on('click', function() {
                const flightId = $(this).data('flight-id');
                const detailsDiv = $(`#${prefix}-stops-${flightId}`);

                if (detailsDiv.length) {
                    detailsDiv.slideToggle();
                    $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
                }
            });
        }

        // Apply toggle for both outbound and inbound
        toggleFlightStops('.outbound-stops-toggle', 'outbound');
        toggleFlightStops('.inbound-stops-toggle', 'inbound');
        });

    // Global Variables Definition
    const searchFlightUrl = "{{ route('flight.search') }}";
    const originCity = "{{ $flightData['originCityName'] ?? '' }}";
    const destinationCity = "{{ $flightData['destinationCityName'] ?? '' }}";
    const departureDate = "{{ $flightData['departureDate'] ?? '' }}";
    const returnDate = "{{ $flightData['returnDate'] ?? '' }}";
    const adults = "{{ $flightData['adults'] ?? '1' }}";
    const cabin = "{{ $flightData['cabin'] ?? 'ECONOMY' }}";
    const tripType = "{{ ($flightData['returnDate']) ? 'roundTrip' : 'oneWay' }}";

       document.addEventListener('DOMContentLoaded', function() {
    // Class definition
    class FlightFilter {
        constructor() {
        this.filters = {
            stops: [],
            airlines: [],
            departureTime: [0, 1440],
            arrivalTime: [0, 1440]
        };
        this.isLoading = false;
        this.initializeEventListeners();
        this.initializePopup();
        this.initializeInfiniteScroll();
        }

    initializeEventListeners() {
    // فلتر التوقفات
    // $('.filter-checkbox[data-filter="stop"]').on('change', (e) => {
    //     this.updateFilter('stops', this.collectCheckboxValues('stop'));
    // });

    // فلتر شركات الطيران
    $('.filter-checkbox[data-filter="airline"]').on('change', (e) => {
        this.updateFilter('airlines', this.collectCheckboxValues('airline'));
    });

    // Attach event listeners for stops filter checkboxes
    //  $('.filter-checkbox[data-filter="stop"]').on('change', (e) => {
    //     flightFilter.updateFilter('stops', flightFilter.collectCheckboxValues('stop'));
    //  });

    // أزرار التطبيق وإعادة التعيين
    $('#apply-filters').on('click', () => this.applyFilters());
    $('#reset-filters').on('click', () => this.reset());

    // Toggle buttons for flight details
    this.initializeToggleButtons();

    // Show more button
    $('.show-more-btn').on('click', () => this.loadMore());

    // فلتر الوقت
    this.initializeTimeSliders();
    }


    // Add this new method for infinite scrolling
    initializeInfiniteScroll() {
    // Hide the "Show more" button as we'll use automatic scrolling
    $('.show-more-btn').hide();

    // Function to check if we need to load more content
        const checkScroll = () => {
        // If we're already loading, don't trigger another request
        if (this.isLoading) return;

        // Calculate if we're near the bottom of the page
        const scrollPosition = $(window).scrollTop() + $(window).height();
        const threshold = $(document).height() - 200; // 200px before the bottom

        if (scrollPosition >= threshold) {
        // We're near the bottom, load more content if available
        this.loadMoreOnScroll();
        }
        };

        // Attach scroll event with throttling to improve performance
        let scrollTimeout;
        $(window).on('scroll', () => {
        if (scrollTimeout) clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(checkScroll, 100);
        });

        // Initial check in case the page isn't tall enough to scroll
        setTimeout(checkScroll, 500);
        }

        // Add this method to load more flights on scroll
        loadMoreOnScroll() {
        // Get the current number of displayed flights
        const displayedFlights = $('.flight-card').length;
        const totalResults = {{ $totalResults ?? 0 }}; // This will be replaced with the actual count

        // If we've displayed all flights, don't try to load more
        if (displayedFlights >= totalResults) {
        return;
        }

        // Show loading indicator
        $('#loading').show();

        // Set loading flag
        this.isLoading = true;

        // Make AJAX request to get more flights
        $.ajax({
        url: searchFlightUrl,
        type: 'GET',
        data: {
        offset: displayedFlights,
        limit: 10, // Load 10 more flights
        ...this.filters,
        origin_city: originCity,
        destination_city: destinationCity,
        departureDate: departureDate,
        returnDate: returnDate,
        adults: adults,
        cabin: cabin,
        tripType: tripType
        },
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Accept': 'application/json'
        },
        success: (response) => {
        // Hide loading indicator
        $('#loading').hide();

        // Reset loading flag
        this.isLoading = false;

        if (response.html) {
        // Append new flights to the container
        $('#flight-results-container').append(response.html);

        // Initialize toggle buttons for the new flights
        this.initializeToggleButtons();
        }
        },
        error: () => {
        // Hide loading indicator
        $('#loading').hide();

        // Reset loading flag
        this.isLoading = false;

        // Show error message
        console.error('Failed to load more flights');
        }
        });
    }


    initializePopup() {
    // Countdown timer functionality
    this.startCountdown();

    // Close popup functionality
    document.getElementById('closePopup').addEventListener('click', () => {
    document.getElementById('specialFarePopup').style.display = 'none';
    });

    // Show popup after delay
    setTimeout(() => {
    document.getElementById('specialFarePopup').style.display = 'flex';
    }, 3000);
    }

    startCountdown() {
    let minutes = 15;
    let seconds = 30;

    const countdownInterval = setInterval(() => {
    if (seconds === 0) {
    if (minutes === 0) {
    clearInterval(countdownInterval);
    document.getElementById('specialFarePopup').style.display = 'none';
    return;
    }
    minutes--;
    seconds = 59;
    } else {
    seconds--;
    }

    document.getElementById('countdown').textContent = `${minutes}m ${seconds}s`;
    }, 1000);
    }

    collectCheckboxValues(filterType) {
        const values = [];
            $(`.filter-checkbox[data-filter="${filterType}"]:checked`).each(function() {
                values.push($(this).data('value'));
            });
        console.log(`Collected ${filterType} values:`, values);
        return values;
    }

    initializeTimeSliders() {
    const timeSliderOptions = {
    range: true,
    min: 0,
    max: 1440,
    step: 15,
    values: [0, 1440],
    slide: (event, ui) => {
    this.updateTimeLabels(event.target.id, ui.values);
    },
    change: (event, ui) => {
    const filterType = event.target.id.includes('departure') ? 'departureTime' : 'arrivalTime';
    this.updateFilter(filterType, ui.values);
    }
    };

    $('#departure-time-slider').slider(timeSliderOptions);
    $('#arrival-time-slider').slider(timeSliderOptions);

    // Initialize labels
    this.updateTimeLabels('departure-time-slider', [0, 1440]);
    this.updateTimeLabels('arrival-time-slider', [0, 1440]);
    }

    initializeToggleButtons() {
        const toggleFlightStops = (toggleSelector, prefix) => {
            $(toggleSelector).off('click').on('click', function(event) {

                event.preventDefault();
                event.stopPropagation();

                const flightId = $(this).data('flight-id');
                const detailsDiv = $(`#${prefix}-stops-${flightId}`);

                if (detailsDiv.length) {
                    detailsDiv.slideToggle();
                    $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
                }
            });
        };

        toggleFlightStops('.outbound-stops-toggle', 'outbound');
        toggleFlightStops('.inbound-stops-toggle', 'inbound');
    }

    updateTimeLabels(sliderId, values) {
    const formatTime = (minutes) => {
    const hours = Math.floor(minutes / 60);
    const mins = minutes % 60;
    return `${hours.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}`;
    };

    $(`#${sliderId}-values`).html(
    `${formatTime(values[0])} - ${formatTime(values[1])}`
    );
    }

  updateFilter(filterType, values) {
    // تجنب التحديث إذا كانت القيم نفسها
    if (JSON.stringify(this.filters[filterType]) === JSON.stringify(values)) {
    return;
    }

    this.filters[filterType] = values;

    // إضافة تأخير قصير لتجنب الطلبات المتكررة
    if (this.filterTimeout) {
    clearTimeout(this.filterTimeout);
    }

    this.filterTimeout = setTimeout(() => {
    console.log('Applying filter:', {
    type: filterType,
    values: values,
    allFilters: this.filters
    });
    this.applyFilters();
    }, 300);
    }

   applyFilters() {
        $('#loading').show();
        $('#flight-results-container').hide();

        // Collect the selected airline names
        this.filters.airlines = this.collectCheckboxValues('airline');

        // تنسيق البيانات قبل الإرسال
        const filterData = {
            stops: this.filters.stops || [],
            airlines: this.filters.airlines || [],
            departureTime: this.filters.departureTime,
            arrivalTime: this.filters.arrivalTime,
            origin_city: originCity,
            destination_city: destinationCity,
            departureDate: departureDate,
            returnDate: returnDate,
            adults: adults,
            cabin: cabin,
            tripType: tripType,
            refresh_cache: true
        };

        console.log('Sending filter request:', filterData);
        console.log('Airlines being sent in filter:', filterData.airlines);

        $.ajax({
        url: searchFlightUrl,
        type: 'GET',
        data: filterData,
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Accept': 'application/json'
        },
        success: (response) => {
        console.log('Raw response:', response);
        if (response.error) {
        this.handleFilterError(null, 'error', response.error);
        return;
        }
        this.handleFilterSuccess(response);
        },
        error: (xhr, status, error) => {
        console.error('Filter request failed:', {
        status: xhr.status,
        error: error,
        response: xhr.responseText
        });
        this.handleFilterError(xhr, status, error);
        }
        });
        }

    handleFilterSuccess(response) {
    $('#loading').hide();

    console.log('Processing response:', response);

    if (!response || !response.html) {
    $('#flight-results-container').html(`
    <div class="alert alert-warning">
        Invalid response received from server.
    </div>
    `).show();
    return;
    }

    $('#flight-results-container')
    .html(response.html)
    .show();

    // إعادة تهيئة الأحداث
    this.initializeToggleButtons();

    // تحديث عدد النتائج إذا كان متوفراً
    if (response.totalResults !== undefined) {
    console.log(`Found ${response.totalResults} results`);
    }
    }

   handleFilterError(xhr, status, error) {
    $('#loading').hide();
    $('#flight-results-container').show();

    let errorMessage = 'Failed to apply filters. ';

    if (xhr.responseJSON && xhr.responseJSON.message) {
    errorMessage += xhr.responseJSON.message;
    } else if (error) {
    errorMessage += error;
    }

    console.error('Filter Error:', {
    status: status,
    error: error,
    response: xhr.responseText
    });

    // عرض رسالة خطأ للمستخدم
    $('#flight-results-container').html(`
    <div class="alert alert-danger">
        ${errorMessage}
    </div>
    `);
    }

   loadMore() {
    this.loadMoreOnScroll();
    }

    reset() {
    // إعادة تعيين جميع الفلاتر
    $('.filter-checkbox').prop('checked', false);
    $('#departure-time-slider').slider('values', [0, 1440]);
    $('#arrival-time-slider').slider('values', [0, 1440]);

    this.filters = {
    stops: [],
    airlines: [],
    departureTime: [0, 1440],
    arrivalTime: [0, 1440]
    };

    this.updateTimeLabels('departure-time-slider', [0, 1440]);
    this.updateTimeLabels('arrival-time-slider', [0, 1440]);

    this.applyFilters();
    }


    } //class FlightFilter

    // Initialize the filter
    const flightFilter = new FlightFilter();

    // Collect initial data
    const collectInitialData = () => {
    let airlines = new Set();
    let stopCounts = new Map();

    $('.flight-card').each(function() {

    const airlineInfo = $(this).find('.flight-header .fw-bold').first();
    const airlineName = airlineInfo.clone()
    .children()
    .remove()
    .end()
    .text()
    .trim();

    if (airlineName && airlineName !== 'Unknown Airline') {
    airlines.add(airlineName);
    }


    const segments = $(this).find('.flight-details').first();
    const stopsCount = segments.find('.flight-duration').filter(function() {
    return $(this).text().includes('stop') || $(this).text().includes('Direct Flight');
    }).first();

    if (stopsCount.length) {
    const isDirectFlight = stopsCount.text().includes('Direct Flight');
    const count = isDirectFlight ? "0" : stopsCount.text().match(/(\d+)\s+stop/)[1];
    stopCounts.set(count, (stopCounts.get(count) || 0) + 1);
    }
    });

    return { airlines, stopCounts };
    };
    // Populate filters
    const { airlines, stopCounts } = collectInitialData();

    // Populate airline filters
    const airlinesContainer = $('#airlines-filter');
    airlines.forEach(airline => {
    const checkboxId = 'airline-' + airline.replace(/\s+/g, '-').toLowerCase();
    airlinesContainer.append(`
    <div class="filter-option">
        <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" id="${checkboxId}" data-filter="airline"
                data-value="${airline}">
            <label class="form-check-label" for="${checkboxId}">${airline}</label>
        </div>
    </div>
    `);
    console.log('Airline checkbox value:', airline);
    });

    // Populate stops filters
    const stopsContainer = $('#stops-filter');
    [...stopCounts.entries()].sort((a, b) => parseInt(a[0]) - parseInt(b[0])).forEach(([stopCount, count]) => {
    const label = stopCount === "0" ? `Nonstop (${count})` :
    stopCount === "1" ? `1 Stop (${count})` :
    `${stopCount} Stops (${count})`;

    stopsContainer.append(`
    <div class="filter-option">
        <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" id="stop-${stopCount}" data-filter="stop"
                data-value="${stopCount}">
            <label class="form-check-label" for="stop-${stopCount}">${label}</label>
        </div>
    </div>
    `);
    });
    // Attach event listeners for stops filter checkboxes
    $('.filter-checkbox[data-filter="stop"]').on('change', (e) => {
    flightFilter.updateFilter('stops', flightFilter.collectCheckboxValues('stop'));
    });

    });


    </script>

</body>

</html>
