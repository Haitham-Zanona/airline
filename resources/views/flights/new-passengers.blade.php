<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete your booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #6742c9;
            --light-gray: #f8f9fa;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: var(--light-gray);
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

        .booking-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .flight-summary-toggle {
            border: none;
            background-color: transparent;
            width: 100%;
            text-align: left;
            padding: 15px 0;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e9ecef;
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .flight-route {
            /* display: flex; */
            align-items: center;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .flight-icon {
            margin: 0 15px;
        }

        .flight-date {
            font-size: 14px;
            color: #666;
        }

        .airline-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .airline-logo {
            width: 30px;
            height: 30px;
            /* margin-right: 10px; */
            background-color: #e0e0e0;
            border-radius: 50%;
        }

        .flight-details {
            background-color: #f0f2ff;
            border-radius: 8px;
            padding: 15px;
        }

        .flight-segment {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .airport-code {
            font-weight: bold;
            font-size: 18px;
        }

        .airport-time {
            font-size: 16px;
            font-weight: bold;
        }

        .airport-date {
            font-size: 12px;
            color: #666;
        }

        .fare-summary {
            background-color: #fff;
            border-radius: 8px;
            color: #000;
            /* padding: 20px; */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
        }

        .fare-section {
            margin-bottom: 20px;
        }

        .fare-section-title {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            margin-bottom: 10px;
            padding-top: 5px;
            border-top: 1px solid #bdb3b3;
        }

        .fare-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .fare-total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #ddd;

            display: flex;
            justify-content: space-between;
            border-top: 1px solid var(--border-color);
        }

        .fare-section-content {
            margin-top: 10px;
            padding-left: 10px;
        }

        .fare-header {
            background-color: #6742c9;
        }

        .fare-section-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }



        .collapsible-section {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .collapsible-header {
            padding: 15px;
            background-color: #fff;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
        }

        .collapsible-content {
            padding: 15px;
            border-top: 1px solid var(--border-color);
            background-color: #fff;
        }

        .form-section {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-section-title {
            font-size: 16px;
            font-weight: 600;
            margin-top: 15px;
        }

        .passenger-info {
            background-color: #f8fbff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .passenger-note {
            background-color: #e6f7ff;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: #fff;
        }

        footer {
            background-color: #fff;
            padding: 40px 0;
            border-top: 1px solid var(--border-color);
        }

        .footer-title {
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .footer-links a {
            display: block;
            color: #666;
            text-decoration: none;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .social-links {
            margin-top: 15px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #f0f0f0;
            color: #666;
            margin-right: 10px;
            text-decoration: none;
        }

        .social-links a:hover {
            background-color: var(--primary-color);
            color: #fff;
        }

        .payment-methods {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .payment-method {
            height: 30px;
            max-width: 100px;
            object-fit: contain;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }

        /* New styles for the top header section */
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .booking-title {
            font-size: 18px;
            font-weight: 600;
            color: #000;
        }

        .booking-steps {
            display: flex;
            /* gap: 15px; */
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }

        .booking-step.active {
            color: var(--primary-color);
            font-weight: 500;
        }
    </style>
</head>

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

                    </ul>

                    <!-- Contact Info in Menu -->
                    <div class="contact-info-mobile mt-3 pt-3 border-top">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/phone-call.webp') }}" width="30px" height="30px" alt="">
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

<body>
    <div class="container py-4">
        <!-- Modified top header - replaced pills with text elements -->
        <div class="booking-header">
            <div class="booking-title">Complete your booking</div>
            <div class="booking-steps active">
                <span class="booking-step active">Flight Summary</span><span style="margin: 0 5px;">•</span><span
                    class="booking-step active">Important Guidelines</span><span style="margin: 0 5px;">•</span><span
                    class="booking-step active">Contact Details</span><span style="margin: 0 5px;">•</span><span
                    class="booking-step active">Passengers</span>
                {{-- <span style="margin: 0 5px;">•</span><span class="booking-step">Cancellation Policy</span> --}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="booking-container">
                    <h3 class="section-title">Enter your booking details</h3>
                    <div class="d-flex align-items-center mb-4">
                        <div class="mx-4"><img src="{{ asset('assets/images/airplane-pass.webp') }}" width="100"
                                height="100" alt="">
                        </div>
                        <div class="flight-route m-0">
                            <span>Nairobi (NBI)</span>
                            <span class="flight-icon mx-2">
                                <i class="fas fa-plane"></i>
                            </span>
                            <span>Mombasa (MBO)</span>
                            <div class="flight-date">
                                Saturday 20th JAN - Mon 22nd - 2nd 20th JI
                            </div>
                        </div>


                    </div>
                    <button class="flight-summary-toggle" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flightSummary">
                        Flight Summary
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div id="flightSummary" class="collapse show">

                        <div class="airline-info mb-3">
                            <div class="airline-logo text-center d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plane"></i>
                            </div>
                            <div class="ms-2">ABC Airline</div>
                            <div class="ms-auto">Travel Class: Economy</div>
                        </div><!-- airline-info -->

                        <div class="flight-details mb-4">
                            <div class="flight-segment">
                                <div class="departure">
                                    <div class="airport-code">NBI</div>
                                    <div class="airport-time">14:30</div>
                                    <div class="airport-date">Saturday, Jan 20</div>
                                    <div class="airport-name">Jomo Kenyatta International</div>
                                    <div class="airport-terminal">Terminal A Gate 35</div>
                                </div>

                                <div class="flight-duration text-center">
                                    <div>9hr 50min</div>
                                    <div><i class="fas fa-plane"></i></div>
                                    <div>Non-Stop</div>
                                </div>

                                <div class="arrival text-end">
                                    <div class="airport-code">MBO</div>
                                    <div class="airport-time">18:20</div>
                                    <div class="airport-date">Saturday, Jan 20</div>
                                    <div class="airport-name">Mombasa International</div>
                                    <div class="airport-terminal">Terminal B Gate 24</div>
                                </div>
                            </div>
                        </div><!-- flight-details -->
                    </div><!-- collapse show -->
                </div><!-- booking-container -->

                <!-- Important Guidelines Section -->
                <div class="collapsible-section">
                    <div class="collapsible-header" data-bs-toggle="collapse" data-bs-target="#guidelinesContent">
                        <h5 class="mb-0">Important Guidelines</h5>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="guidelinesContent" class="collapse show collapsible-content">
                        <p>We are making it a requirement for passengers to follow certain guidelines. For more
                            stringent and strict rules, please refer to a complete guide for passengers before booking a
                            flight.</p>
                        <ol>
                            <li>Please check travel details before confirming your booking, especially vendor, flight
                                details, fares, ticket validity and passenger name. Make sure that the information
                                entered is accurate as per your government ID.</li>
                        </ol>
                        <button class="btn btn-link p-0">Read more</button>
                    </div>
                </div>

                <!-- Contact Details Section -->

                <div class="form-section">

                    <form action="{{ route('flight.search') }}" method="POST">
                        @csrf
                        <h5 class="form-section-title">Contact Details (Booking details will be sent to)</h5>
                        <div id="contactForm">
                            <div class="row px-2">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Mobile Number</label>
                                    <input type="tel" id="phone" name="phone" class="form-control">
                                    <div class="invalid-feedback">Please enter a valid mobile number.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" required>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                            </div>

                        </div>


                        <!-- Passengers Details Section -->
                        <h5 class="form-section-title">Passengers Details</h5>
                        <div class="form-section py-1">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Primary Passenger</h6>
                                <div>
                                    <select class="form-select form-select-sm">
                                        <option>Adult (Over 12 years)</option>
                                        <option>Child (2-12 years)</option>
                                        <option>Infant (Under 2)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="passenger-note mb-4">
                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                Use all given names and surnames exactly as they appear in your passport/ID to avoid
                                boarding
                                conflicts later.
                            </div>

                            <div id="passengerForm">
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="title" class="form-label">Title</label>
                                        <select class="form-control form-select" id="title" name="title" required>
                                            <option value="" disabled selected>Select Title</option>
                                            <option value="mr">Mr.</option>
                                            <option value="ms">Ms.</option>
                                            <option value="mrs">Mrs.</option>
                                            <option value="miss">Miss</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" placeholder="e.g. Smith"
                                            required>
                                        <div class="invalid-feedback">Please enter your First Name.</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName" placeholder="e.g. Doe"
                                            required>
                                        <div class="invalid-feedback">Please enter your middle name.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">last Name</label>
                                        <input type="text" class="form-control" id="lastName" placeholder="e.g. Smith"
                                            required>
                                        <div class="invalid-feedback">Please enter your Last Name.</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <label class="form-label" for="nationality">Select Nationality:</label>
                                        <select name="country" class="form-control" required>
                                            <option value="">Select Nationality</option>
                                            @foreach($countries as $code => $name)
                                            <option value="{{ $code }}">
                                                <span class="flag-icon flag-icon-{{ strtolower($code) }}"></span> {{
                                                $name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please select your nationality.</div>
                                    </div>
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-select" id="gender" required>
                                            <option value="">Select</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                        <div class="invalid-feedback">Please select your gender.</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dob" class="form-label">Date of birth</label>
                                        <input type="date" class="form-control" id="dob" required>
                                        <div class="invalid-feedback">Please enter your date of birth.</div>
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="passportNumber" class="form-label">Passport Number</label>
                                        <input type="text" class="form-control" id="passportNumber"
                                            placeholder="Passport Number" required>
                                        <div class="invalid-feedback">Please enter your passport number.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="passportExpiry" class="form-label">Passport expiration date</label>
                                        <input type="date" class="form-control" id="passportExpiry" required>
                                        <div class="invalid-feedback">Please enter your passport expiration date.</div>
                                    </div>
                                </div> --}}

                                {{-- <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="noExpiration">
                                        <label class="form-check-label" for="noExpiration">
                                            No expiration
                                        </label>
                                    </div>
                                </div> --}}

                                <div class="text-end">
                                    <button type="button" class="btn btn-outline-primary" id="addPassenger">
                                        <i class="fas fa-plus me-2"></i> Add passenger
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cancellation Policy Section -->
                        {{-- <div class="collapsible-section">
                            <div class="collapsible-header" data-bs-toggle="collapse"
                                data-bs-target="#cancellationContent">
                                <h5 class="mb-0">Cancellation/Refund Policy</h5>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div id="cancellationContent" class="collapse collapsible-content">
                                <p>At AirClick, we understand that plans can change unexpectedly. We strive to provide a
                                    flexible and reasonable policy for flight bookings. Please review the following for
                                    details:
                                </p>
                                <ol>
                                    <li>Cancellation Procedures: Cancellations can be made through our website by
                                        logging into
                                        your account or by contacting our customer support team.</li>
                                    <li>Cancellation charges will be applied based on how close to the date of travel
                                        you're
                                        making the cancellation and the fare type you booked.</li>
                                </ol>
                                <button class="btn btn-link p-0">Read more</button>
                            </div>
                        </div> --}}

                        <div class="d-flex justify-content-between my-4">
                            <button class="btn btn-outline-secondary">Cancel</button>
                            <button class="btn btn-primary" id="proceedToPayment">Proceed to Payment</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="fare-summary">
                    <div class="fare-header m">
                        <h5 class="p-3 m-0 text-light">Fare Summary</h5>
                    </div><!-- fare-header -->

                    <div class="fare-section px-3 mt-1">
                        <div class="fare-section-title" data-bs-toggle="collapse" data-bs-target="#baseFare">
                            <span>Base fare</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div id="baseFare" class="collapse show fare-section-content">
                            <div class="fare-item">
                                <span>Adult(1) (1 × $110)</span>
                                <span>$110</span>
                            </div>
                        </div>
                    </div>

                    <div class="fare-section px-3 mt-1">
                        <div class="fare-section-title" data-bs-toggle="collapse" data-bs-target="#taxes">
                            <span>Taxes, Fee and Surcharges</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div id="taxes" class="collapse show fare-section-content">
                            <div class="fare-item">
                                <span>Airline Taxes and Surcharges</span>
                                <span>$7.3</span>
                            </div>
                            <div class="fare-item">
                                <span>Service Fee</span>
                                <span>$6</span>
                            </div>
                            <div class="fare-item text-end">
                                <span>$23</span>
                            </div>
                        </div>
                    </div>

                    <div class="fare-section px-3 mt-1">
                        <div class="fare-section-title" data-bs-toggle="collapse" data-bs-target="#services">
                            <span>Other Services</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div id="services" class="collapse show fare-section-content">
                            <div class="fare-item">
                                <span>Charity</span>
                                <span>$5</span>
                            </div>
                        </div>
                    </div>

                    <div class="fare-total fare-item px-3 mt-1 pb-3">
                        <span>Total Amount</span>
                        <span>$139</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
        // Existing code for form validation
        function validateForm(formId) {
        let isValid = true;
        const form = $(`#${formId}`);

        form.find('input, select').each(function() {
        if ($(this).prop('required') && !$(this).val()) {
        $(this).addClass('is-invalid');
        $(this).siblings('.invalid-feedback').show();
        isValid = false;
        } else {
        $(this).removeClass('is-invalid');
        $(this).siblings('.invalid-feedback').hide();
        }
        });

        // Email validation
        const emailInput = form.find('input[type="email"]');
        if (emailInput.length) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.val())) {
        emailInput.addClass('is-invalid');
        emailInput.siblings('.invalid-feedback').show();
        isValid = false;
        }
        }

        // Phone validation
        const phoneInput = form.find('input[type="tel"]');
        if (phoneInput.length) {
        const phonePattern = /^\d{9,15}$/;
        if (!phonePattern.test(phoneInput.val())) {
        phoneInput.addClass('is-invalid');
        phoneInput.siblings('.invalid-feedback').show();
        isValid = false;
        }
        }

        return isValid;
        }

        // Remove validation class on input change
        $('input, select').on('change', function() {
        $(this).removeClass('is-invalid');
        $(this).siblings('.invalid-feedback').hide();
        });

        // Handle proceed to payment button
        $('#proceedToPayment').on('click', function(e) {
        e.preventDefault();

        // Validate both forms
        const isContactValid = validateForm('contactForm');
        const isPassengerValid = validateForm('passengerForm');

        if (isContactValid && isPassengerValid) {
        alert('Form is valid! Proceeding to payment...');
        // Uncomment the line below to redirect to the payment page
        // window.location.href = "payment-page.html";
        } else {
        // Scroll to the first error
        $('html, body').animate({
        scrollTop: $('.is-invalid:first').offset().top - 100
        }, 200);
        }
        });

        // Toggle no expiration date
        $('#noExpiration').on('change', function() {
        if ($(this).is(':checked')) {
        $('#passportExpiry').prop('disabled', true).prop('required', false);
        } else {
        $('#passportExpiry').prop('disabled', false).prop('required', true);
        }
        });

        // Add passenger button (just a placeholder behavior)
        $('#addPassenger').on('click', function() {
        alert('Add another passenger functionality would be added here.');
        });

        // // NEW CODE: Handle fare summary section toggles
        // // Add unique IDs to each fare detail content section
        // $('.fare-summary .fare-details').each(function(index) {
        // $(this).attr('id', 'fareDetails' + index);
        // });

        // // Group fare details that belong together
        // const baseFareDetails = $('.fare-summary .fare-details').eq(0);
        // const taxesFeeDetails = $('.fare-summary .fare-details').eq(1).add($('.fare-summary .fare-details').eq(2));
        // const otherServicesDetails = $('.fare-summary .fare-details').eq(3);

        // // Set up click handlers for each section
        // $('.fare-summary .fare-title').eq(0).on('click', function() {
        // baseFareDetails.slideToggle();
        // $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        // });

        // $('.fare-summary .fare-title').eq(1).on('click', function() {
        // taxesFeeDetails.slideToggle();
        // $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        // });

        // $('.fare-summary .fare-title').eq(2).on('click', function() {
        // otherServicesDetails.slideToggle();
        // $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
        // });

        // // Make the titles look clickable with pointer cursor
        // $('.fare-summary .fare-title').css('cursor', 'pointer');
         });

        document.addEventListener("DOMContentLoaded", function () {
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
        separateDialCode: true,
        preferredCountries: ["us", "gb", "fr", "in"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        document.querySelector("form").addEventListener("submit", function () {
        var fullNumber = iti.getNumber();
        document.querySelector("#phone").value = fullNumber;
        });
        });
    </script>
</body>

</html>
