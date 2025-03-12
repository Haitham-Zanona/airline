<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موقع حجز رحلات طيران</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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

        @media (max-width: 767.98px) {
            .nav-link {
                padding: 10px 0;
                border-bottom: 1px solid #eee;
            }

            .nav-item:last-child .nav-link {
                border-bottom: none;
            }
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

        .flight-result-search .col-md-2 label {
            padding-left: 10px;
        }

        .search-container {
            background-color: #f1f1f1;
            padding: 20px 0;
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
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .filter-title {
            font-weight: bold;
            margin-bottom: 15px;
        }

        .filter-option {
            margin-bottom: 10px;
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
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .flight-header {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .flight-details {
            background-color: #f6f7ff;
            padding: 15px;
        }

        .flight-time {
            font-weight: bold;
            font-size: 18px;
        }

        .flight-date {
            font-size: 12px;
            color: #666;
        }

        .flight-airport {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }

        .flight-duration {
            text-align: center;
            font-size: 12px;
            color: #333;
        }

        .flight-price {
            font-weight: bold;
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .book-button {
            background-color: #6c3eff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 14px;
            width: 100%;
        }

        .refund-status {
            font-size: 12px;
            margin: 10px 0;
        }

        .non-refundable {
            color: #ff5050;
        }

        .partially-refundable {
            color: #ffa500;
        }

        .fully-refundable {
            color: #55aa55;
        }

        .flight-footer {
            padding: 10px 15px;
            /* border-top: 1px solid #eee; */
            font-size: 12px;
            color: #666;
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
    </style>
</head>

<body>

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
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact us</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li> --}}
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
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact us</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Blog</a>
                            </li> --}}
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
        <div class="container">
            <div class="radio-container">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tripType" id="oneWay" checked>
                    <label class="form-check-label" for="oneWay">ONE WAY</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tripType" id="roundTrip">
                    <label class="form-check-label" for="roundTrip">ROUND WAY</label>
                </div>
            </div>

            <form action="{{ route('flight.search') }}" method="POST" class="search-form">
                @csrf
                <div class="row flight-result-search">
                    <div class="col-md-2">
                        <label for="origin_city"><i class="fas fa-plane-departure me-1"></i> From</label>
                        <input type="text" id="search1" class="form-select" placeholder="Enter City Name"
                            autocomplete="off">
                        <input type="hidden" name="origin_city" value="">
                        <input type="hidden" name="origin_city_name" id="origin_city_name">
                        <div id="result1" style="width: 90%;"></div>
                    </div>
                    <div class="col-md-2">
                        <label for="destination_city"><i class="fas fa-plane-arrival me-1"></i> To</label>
                        <input type="text" id="search2" placeholder="Enter City Name" autocomplete="off"
                            class="form-select">
                        <input type="hidden" name="destination_city" value="">

                        <input type="hidden" name="destination_city_name" id="destination_city_name">
                        <div id="result2" style="width: 90%;"></div>
                    </div>
                    <div class="col-md-2">
                        <label for="departureDate"><i class="far fa-calendar-alt me-1"></i> Departure</label>
                        <input type="date" id="departureDate" name="departureDate" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="returnDate"><i class="far fa-calendar-alt me-1"></i> Return</label>
                        <input type="date" id="returnDate" name="returnDate" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label><i class="fas fa-user me-1"></i> Class</label>
                        <select id="cabin" name="cabin" class="form-select">
                            <option value="ECONOMY">Economy</option>
                            <option value="PREMIUM_ECONOMY">Premium Economy</option>
                            <option value="BUSINESS">Business</option>
                            <option value="FIRST">First Class</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="travelers" class="px-2"><i class="fas fa-users me-1"></i> Pax</label>
                        <div class="dropdown">
                            <button
                                class="form-control d-flex justify-content-between align-items-center dropdown-toggle"
                                type="button" id="travelersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <span id="totalTravelers">1</span>
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
                            </div><!-- dropdown-menu -->
                        </div><!-- dropdown -->
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button class="search-button w-100">Modify search</button>
                    </div>
                </div><!-- row -->
            </form>

        </div>
    </section>

    <!-- Filter and Results Section -->
    <section class="container filter-section">
        <div class="row">
            <!-- Filters Column -->
            <div class="col-md-3">
                <div class="filter-card">
                    <div class="filter-title">Filter By</div>

                    <!-- Stop Filter -->
                    <div class="mb-4">
                        <div class="filter-subtitle mb-2">Stop</div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="nonstop">
                                <label class="form-check-label" for="nonstop">Nonstop(23)</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="1stop">
                                <label class="form-check-label" for="1stop">1 Stop (4)</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="2stops">
                                <label class="form-check-label" for="2stops">2+ Stops (2)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Airlines Filter -->
                    <div class="mb-4">
                        <div class="filter-subtitle mb-2">Airlines</div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="abcTech">
                                <label class="form-check-label" for="abcTech">ABC Air Technologies</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="abcAir">
                                <label class="form-check-label" for="abcAir">ABC Airlines</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="xyzAir">
                                <label class="form-check-label" for="xyzAir">XYZ Airways</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="bopLink">
                                <label class="form-check-label" for="bopLink">BOP Links</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edfExpress">
                                <label class="form-check-label" for="edfExpress">EDF Express</label>
                            </div>
                        </div>
                    </div>

                    <!-- Departure Time Filter -->
                    <div class="mb-4">
                        <div class="filter-subtitle mb-2">Departure Time</div>
                        <div class="time-slider-container">
                            <div class="time-labels">
                                <span>Mon 5:00 AM</span>
                                <span>Tue 12:00 AM</span>
                            </div>
                            <div class="time-slider">
                                <div class="time-slider-range" style="left: 25%; width: 30%;"></div>
                                <div class="time-slider-handle" style="left: 25%;"></div>
                                <div class="time-slider-handle" style="left: 55%;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Arrival Time Filter -->
                    <div class="mb-4">
                        <div class="filter-subtitle mb-2">Arrival Time</div>
                        <div class="time-slider-container">
                            <div class="time-labels">
                                <span>Mon 5:00 AM</span>
                                <span>Tue 12:00 AM</span>
                            </div>
                            <div class="time-slider">
                                <div class="time-slider-range" style="left: 25%; width: 30%;"></div>
                                <div class="time-slider-handle" style="left: 25%;"></div>
                                <div class="time-slider-handle" style="left: 55%;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Departure Airports Filter -->
                    <div class="mb-4">
                        <div class="filter-subtitle mb-2">Departure Airports</div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lcyLondon">
                                <label class="form-check-label" for="lcyLondon">LCY, London (11)</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lhrLondon">
                                <label class="form-check-label" for="lhrLondon">LHR, London (19)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Arrival Airports Filter -->
                    <div class="mb-4">
                        <div class="filter-subtitle mb-2">Arrival Airports</div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="nboNairobi">
                                <label class="form-check-label" for="nboNairobi">NBO, Nairobi (32)</label>
                            </div>
                        </div>
                        <div class="filter-option">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="wilNairobi">
                                <label class="form-check-label" for="wilNairobi">WIL, Nairobi (21)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-secondary">Reset</button>
                        <button class="btn btn-primary">Apply Filters</button>
                    </div>
                </div>
            </div>

            <!-- Results Column -->
            <div class="col-md-9">
                <!-- Pricing Tabs -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0">Pricing table</h6>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="card-body pt-2 pb-0">
                        <div class="pricing-tabs">
                            <div class="pricing-tab active">
                                <div>Recommended</div>
                                {{-- <div class="pricing-price">$500 · 10h 20m</div> --}}
                            </div>
                            <div class="pricing-tab">
                                <div>Fastest</div>
                                {{-- <div class="pricing-price">$500 · 10h 20m</div> --}}
                            </div>
                            <div class="pricing-tab">
                                <div>Cheapest</div>
                                {{-- <div class="pricing-price">$500 · 10h 20m</div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flight Card -->
                <div class="flight-card">
                    <div class="flight-header">
                        <div class="d-flex align-items-center">
                            <div class="airline-logo">
                                <i class="fas fa-plane text-primary"></i>
                            </div>
                            <div>ABC Airline</div>
                        </div>
                        <div>Travel Class: <span class="fw-bold">Economy</span></div>
                    </div>
                    <div class="row" style="box-sizing: border-box;">
                        <div class="col-md-9" style="padding: 0 15px 0 25px;">
                            <div class="flight-details" style="border-bottom: 1px solid #eee;">
                                <div class="row">
                                    <!-- Departure Details -->
                                    <div class="col-3">
                                        <div class="flight-time">14.50</div>
                                        <div class="flight-date">Sun, 29 Jan 2023</div>
                                        <div class="flight-airport">Moi Intl, Mombasa</div>
                                        <div class="flight-airport">Kenya</div>
                                    </div>

                                    <!-- Flight Duration -->
                                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                                        <div class="flight-duration">9hr 50min</div>
                                        <div class="position-relative w-100 my-2">
                                            <div class="border-top w-100"></div>
                                            <i
                                                class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                                        </div>
                                        <div class="flight-duration">Non-refundable</div>
                                    </div>

                                    <!-- Arrival Details -->
                                    <div class="col-3 text-end">
                                        <div class="flight-time">14.50</div>
                                        <div class="flight-date">Sun, 29 Jan 2023</div>
                                        <div class="flight-airport">JFK Terminal, Nairobi</div>
                                        <div class="flight-airport">Kenya</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Another flight segment (for round trip or connection) -->
                            <div class="flight-details">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="flight-time">14.50</div>
                                        <div class="flight-date">Sun, 29 Jan 2023</div>
                                        <div class="flight-airport">Moi Intl, Mombasa</div>
                                        <div class="flight-airport">Kenya</div>
                                    </div>
                                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                                        <div class="flight-duration">9hr 50min</div>
                                        <div class="position-relative w-100 my-2">
                                            <div class="border-top w-100"></div>
                                            <i
                                                class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                                        </div>
                                    </div>
                                    <div class="col-3 text-end">
                                        <div class="flight-time">14.50</div>
                                        <div class="flight-date">Sun, 29 Jan 2023</div>
                                        <div class="flight-airport">JFK Terminal, Nairobi</div>
                                        <div class="flight-airport">Kenya</div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- col-md-9 -->

                        <div class="col-md-3 d-flex justify-content-center">

                            <!-- Price and Book Button -->
                            <div class="p-3 d-flex text-center justify-content-center align-items-center">
                                <div class="me-3">
                                    <div class="flight-price">$18,500</div>
                                    <button class="book-button px-5 py-3">Book Now</button>
                                </div>
                            </div>
                        </div><!-- col-md-3 -->
                    </div><!-- row -->

                    <!-- Seats Remaining and Refund Status -->
                    <div class="p-3 d-flex justify-content-between">
                        <div style="padding: 10px 15px;">100 seats remaining</div>
                        <!-- Flight Footer -->
                        <div class="flight-footer d-flex justify-content-start">
                            <div class="me-4">
                                <i class="fas fa-ticket-alt me-1"></i> Separate tickets booked together for cheaper
                                price
                            </div>
                            <div class="me-4">
                                <i class="fas fa-plane-arrival me-1"></i> Change of Terminal
                            </div>
                            <div class="me-4">
                                <i class="fas fa-exchange-alt me-1"></i> Self Transfer
                            </div>
                            <div>
                                <i class="fas fa-suitcase-rolling me-1"></i> 7kg
                            </div>
                        </div>
                        {{-- <div class="non-refundable">Non-refundable</div>
                        <div class="text-primary">View flight details</div> --}}
                    </div>




                </div>

                {{--
                <!-- Flight Information Tabs -->
                <div class="flight-tabs mb-4">
                    <div class="flight-tab active">Flight Information</div>
                    <div class="flight-tab">Fare Detail</div>
                    <div class="flight-tab">Baggage Rules</div>
                    <div class="flight-tab">Cancellation Rules</div>
                </div> --}}

                <!-- Show More Button -->
                <button class="show-more-btn">Show more</button>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>