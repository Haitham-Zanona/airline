<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام الحجز</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6742c9;
            --light-gray: #f8f9fa;
            --border-color: #e0e0e0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .booking-progress {
            display: flex;
            /* gap: 15px; */
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }

        .booking-progress span {
            margin: 0 5px;
            color: #6c757d;
        }

        .booking-progress span.active {
            color: var(--primary-color);
            font-weight: 500;
        }

        .booking-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
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

        .airport-code {
            font-size: 18px;
            font-weight: bold;
        }


        .airport-date,
        .airport-info {
            font-size: 12px;
            color: #6c757d;
        }

        .flight-duration {
            text-align: center;
            position: relative;
            padding: 0 20px;
        }

        .flight-line {
            height: 2px;
            background-color: #ddd;
            position: relative;
            margin: 8px 0;
        }

        .flight-line::before,
        .flight-line::after {
            content: '';
            position: absolute;
            width: 6px;
            height: 6px;
            background-color: #ddd;
            border-radius: 50%;
            top: -2px;
        }

        .flight-line::before {
            left: -3px;
        }

        .flight-line::after {
            right: -3px;
        }

        .flight-info-row {
            display: flex;
            margin-top: 10px;
            font-size: 12px;
        }

        .flight-info-item {
            margin-right: 20px;
            text-align: center;
        }

        .flight-info-label {
            color: #6c757d;
            margin-bottom: 5px;
        }

        .payment-methods {
            margin: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-logos {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .card-logo {
            width: 50px;
            height: 30px;
            border-radius: 4px;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #6a3de8;
            border-color: #6a3de8;
        }

        .btn-secondary {
            background-color: #fff;
            color: #6c757d;
            border-color: #6c757d;
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
        }

        .fare-section-content {
            margin-top: 10px;
            padding-left: 10px;
        }

        .non-refundable {
            color: #dc3545;
            font-size: 12px;
            float: right;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .was-validated .invalid-feedback {
            display: block;
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

        .policy-container {
            max-width: 850px;
            margin: 20px auto;
            padding: 20px 20px 60px 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .policy-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
        }

        .policy-header h2 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
        }

        .policy-content {
            margin-bottom: 20px;
        }

        .policy-text {
            color: #555;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .read-more {
            color: #673AB7;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            display: block;
            margin: 10px 0;
        }

        .checkbox-container {
            margin: 20px 0;
        }

        .submit-btn {
            background-color: #673AB7;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            float: right;
        }

        .submit-btn:disabled {
            background-color: #B39DDB;
            cursor: not-allowed;
        }

        .secure-text {
            font-size: 0.8rem;
            color: #666;
            text-align: center;
            margin-top: 5px;
        }

        .icon-lock {
            margin-right: 5px;
        }

        .payment-form {
            margin-top: 30px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: none;
        }

        .fare-header {
            background-color: #6742c9;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="booking-header">
            <h5 class="fw-bold">Complete your booking</h5>
            <div class="booking-progress">
                <span class="active">Flight Summary</span>
                <span>•</span>
                <span class="active">Passengers Details</span>
                <span>•</span>
                <span class="active">Payment</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">

                {{-- <div class="booking-container">
                    <h4 class="mb-4">Enter your booking details</h4>
                    <div class="route-details">
                        <div class="flight-icon">
                            <i class="fas fa-plane"></i>
                        </div>
                        <div>
                            <h5>Nairobi (NBI) -> Mombasa (MBO)</h5>
                            <p class="text-muted">Sunday, 29th Jan • Non stop • 9hr 50min</p>
                        </div>
                    </div>
                    <button class="flight-summary-toggle" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flightSummary">
                        Flight Summary
                        <i class="fas fa-chevron-down"></i>
                    </button>

                    <div id="flightSummary" class="collapse show"> --}}
                        <div class="booking-container">
                            <h4 class="section-title mb-4">Enter your booking details</h4>
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
                                    <div
                                        class="airline-logo text-center d-flex align-items-center justify-content-center">
                                        <i class="fas fa-plane"></i>
                                    </div>
                                    <div class="ms-2">ABC Airline</div>
                                    <div class="ms-auto">Travel Class: Economy</div>
                                </div>

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
                                    </div><!-- flight-segment -->
                                </div><!-- flight-details -->
                            </div><!-- collapse show -->
                        </div><!-- booking-container -->
                        {{--
                    </div> --}}
                    {{--
                </div> --}}

                <!-- Passengers Details -->
                <div class="card mb-4">
                    <div class="passengers-details">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">
                                <i class="fas fa-users me-2"></i> Passengers Details
                            </h4>
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
                <form id="paymentForm" novalidate>
                    <div class="booking-container">
                        <div class="payment-title d-flex justify-content-between align-items-center">
                            <h5>Payment & Billing</h5>
                            <div>
                                <img src="{{ asset('assets/images/digicert.webp') }}" style="max-height: 50px;" alt="">
                                <img src="{{ asset('assets/images/godaddy.webp') }}" style="max-height: 50px;" alt="">
                                <img src="{{ asset('assets/images/pci.webp') }}" style="max-height: 50px;" alt="">
                            </div>
                        </div><!-- payment-title -->
                        <div class="payment-methods">
                            <p>We accept</p>
                            <div class="card-logos">
                                <div class="card-logo">
                                    <i class="fa-brands fa-cc-visa" style="color: #1565c0; max-height: 20px;"></i>
                                </div>
                                <div class="card-logo">
                                    <img src="{{ asset('assets/images/mastercard.webp') }}" style="max-height: 20px;"
                                        alt="">
                                </div>
                                <div class="card-logo">
                                    <img src="{{ asset('assets/images/american-express.webp') }}"
                                        style="max-height: 30px;" alt="">
                                </div>
                                <div class="card-logo">
                                    <img src="{{ asset('assets/images/discover.webp') }}" style="max-height: 30px;"
                                        alt="">
                                </div>
                            </div>
                        </div><!-- payment-methods -->


                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="cardType">Card Type</label>
                                <select id="cardType" name="cardType" class="form-select">
                                    <option value="visa">Visa</option>
                                    <option value="mastercard">Mastercard</option>
                                    <option value="amex">American Express</option>
                                    <option value="discover">Discover</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="cardNumber">Card Number *</label>
                                <input type="text" class="form-control" id="cardNumber"
                                    placeholder="XXXX XXXX XXXX XXXX" required>
                                <div class="invalid-feedback">Please enter a valid card number (16 digits)</div>
                            </div><!-- col-md-6 -->
                        </div><!-- form-group row -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expiryDate">Expiry date *</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="expiryMonth" placeholder="Month"
                                                required>
                                            <div class="invalid-feedback">Enter valid month (1-12)</div>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="expiryYear" placeholder="Year"
                                                required>
                                            <div class="invalid-feedback">Enter valid year</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cvv">CVV/CVC *</label>
                                    <input type="text" class="form-control" id="cvv" placeholder="XXX" required>
                                    <div class="invalid-feedback">Please enter a valid CVV/CVC code (3-4 digits)</div>
                                </div>
                            </div>
                        </div><!-- row -->

                        <div class="form-group">
                            <label for="cardHolderName">Card holder name *</label>
                            <input type="text" class="form-control" id="cardHolderName" placeholder="Name on card"
                                required>
                            <div class="invalid-feedback">Please enter the name as it appears on card</div>
                        </div><!-- form-group -->

                    </div><!-- booking-container -->

                    <div class="policy-container my-3">
                        <div class="policy-header" id="policyHeader">
                            <h2>Cancellation/Refund Policy</h2>
                            <span class="dropdown-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </span>
                        </div>

                        <div class="policy-content" id="policyContent">
                            <div class="policy-text">
                                <p>At GlobGoer, we understand that plans can change unexpectedly. We strive to provide a
                                    flexible and
                                    customer-friendly cancellation and refund policy for flight bookings. Please review
                                    the following policy
                                    details:</p>

                                <ol>
                                    <li>Cancellation Requests:
                                        <ul>
                                            <li>All cancellation requests must be submitted through our website or by
                                                contacting our
                                                customer support team.</li>
                                            <li>Cancellation requests made through our website should be done by
                                                accessing your booking and
                                                following the cancellation process.</li>
                                        </ul>
                                    </li>
                                </ol>

                                <div class="collapse" id="additionalContent">
                                    <ol start="2">
                                        <li>Refund Timeline:
                                            <ul>
                                                <li>Refunds are processed within 7-10 business days after approval.</li>
                                                <li>The actual credit may take additional time to appear in your account
                                                    depending on your
                                                    payment provider.</li>
                                            </ul>
                                        </li>
                                        <li>Cancellation Fees:
                                            <ul>
                                                <li>Cancellations made 48+ hours before departure: Full refund minus a
                                                    $25 processing fee.
                                                </li>
                                                <li>Cancellations made 24-48 hours before departure: 75% refund of the
                                                    booking amount.</li>
                                                <li>Cancellations made less than 24 hours before departure: 50% refund
                                                    of the booking
                                                    amount.</li>
                                            </ul>
                                        </li>
                                        <li>Special Circumstances:
                                            <ul>
                                                <li>For cancellations due to medical emergencies, bereavement, or
                                                    natural disasters, please
                                                    contact our customer support with appropriate documentation for
                                                    special consideration.
                                                </li>
                                            </ul>
                                        </li>
                                    </ol>
                                </div>

                                <a class="read-more" data-bs-toggle="collapse" href="#additionalContent" role="button"
                                    aria-expanded="false" aria-controls="additionalContent" id="readMoreLink">
                                    Read more
                                </a>
                            </div>
                        </div>


                        <div class="checkbox-container">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreeCheckbox">
                                <label class="form-check-label" for="agreeCheckbox">
                                    By clicking on <strong style="color: #6742c9">"Confirm & Book"</strong> I agree to
                                    the cancellation/ Refund
                                    Policy
                                </label>
                            </div>
                            <button type="submit" class="btn submit-btn" id="submitBtn" disabled>
                                Confirm and Book
                                <div class="secure-text">
                                    <span class="icon-lock">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                                        </svg>
                                    </span>
                                    Secure Payment
                                </div>
                            </button>
                        </div>

                    </div><!-- policy-container -->

                    {{-- <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Pay $33.00 Now</button>
                    </div> --}}
                </form>
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

                    <div class="fare-total fare-item px-3 mt-1">
                        <span>Total Amount</span>
                        <span>$139</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
                // Toggle policy content
                $('#policyHeader').click(function() {
                    $('#policyContent').slideToggle();
                    $('.dropdown-icon').toggleClass('rotate');
                });

                // Handle Read More link
                $('#readMoreLink').click(function() {
                    if($('#additionalContent').hasClass('show')) {
                        $(this).text('Read more');
                    } else {
                        $(this).text('Read less');
                    }
                });

                // Enable/disable submit button based on checkbox
                $('#agreeCheckbox').change(function() {
                    if($(this).is(':checked')) {
                        $('#submitBtn').prop('disabled', false);
                    } else {
                        $('#submitBtn').prop('disabled', true);
                    }
                });


    // تعريف أنماط البطاقات المختلفة
    const cardPatterns = {
        visa: {
            pattern: /^4[0-9]{12}(?:[0-9]{3})?$/,
            length: [13, 16],
            cvvLength: 3,
            format: /(\d{1,4})/g
        },
        mastercard: {
            pattern: /^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/,
            length: [16],
            cvvLength: 3,
            format: /(\d{1,4})/g
        },
        amex: {
            pattern: /^3[47][0-9]{13}$/,
            length: [15],
            cvvLength: 4,
            format: /(\d{1,4})(\d{1,6})?(\d{1,5})?/
        },
        discover: {
            pattern: /^6(?:011|5[0-9]{2})[0-9]{12}$/,
            length: [16],
            cvvLength: 3,
            format: /(\d{1,4})/g
        }
    };

    // تحديث الـ validation بناءً على نوع البطاقة المختارة
    $('#cardType').change(function() {
        const cardType = $(this).val();
        updateCardValidation(cardType);

        // إعادة تعيين القيم عند تغيير نوع البطاقة
        $('#cardNumber').val('');
        $('#cvv').val('');
        $('#cardNumber').removeClass('is-invalid');
        $('#cvv').removeClass('is-invalid');

        // تحديث النص الخاص بالـ placeholder
        updatePlaceholders(cardType);
    });

    // تحديث النص الخاص بالـ placeholder حسب نوع البطاقة
    function updatePlaceholders(cardType) {
        if (cardType === 'amex') {
            $('#cardNumber').attr('placeholder', 'XXXX XXXXXX XXXXX');
            $('#cvv').attr('placeholder', 'XXXX');
        } else {
            $('#cardNumber').attr('placeholder', 'XXXX XXXX XXXX XXXX');
            $('#cvv').attr('placeholder', 'XXX');
        }
    }

    // تعيين الـ validation الأولي حسب نوع البطاقة المختارة افتراضياً
    updateCardValidation($('#cardType').val());
    updatePlaceholders($('#cardType').val());

    // تحديث قواعد الـ validation بناءً على نوع البطاقة
    function updateCardValidation(cardType) {
        // تحديث قواعد تنسيق رقم البطاقة
        $('#cardNumber').off('input').on('input', function() {
            const value = $(this).val().replace(/\D/g, '');
            const maxLength = cardType === 'amex' ? 15 : 16;
            const formattedValue = formatCardNumber(value.substring(0, maxLength), cardType);
            $(this).val(formattedValue);
        });

        // تحديث قواعد تنسيق رمز التحقق CVV
        $('#cvv').off('input').on('input', function() {
            const maxLength = cardType === 'amex' ? 4 : 3;
            const value = $(this).val().replace(/\D/g, '').substring(0, maxLength);
            $(this).val(value);

            if (value.length < maxLength) {
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
    }

    // تنسيق رقم البطاقة حسب نوع البطاقة
    function formatCardNumber(value, cardType) {
        if (cardType === 'amex') {
            return value.replace(/(\d{1,4})(\d{1,6})?(\d{1,5})?/, function(match, p1, p2, p3) {
                let result = p1;
                if (p2) result += ' ' + p2;
                if (p3) result += ' ' + p3;
                return result;
            });
        } else {
            return value.replace(/(\d{1,4})/g, function(match, p1, offset) {
                return offset && offset % 4 === 0 ? ' ' + p1 : p1;
            });
        }
    }

    // التحقق من صحة رقم البطاقة باستخدام خوارزمية Luhn
    function isValidCardNumber(cardNumber) {
        cardNumber = cardNumber.replace(/\D/g, '');

        let nCheck = 0;
        let bEven = false;

        for (let i = cardNumber.length - 1; i >= 0; i--) {
            let nDigit = parseInt(cardNumber.charAt(i));

            if (bEven) {
                nDigit *= 2;
                if (nDigit > 9) nDigit -= 9;
            }

            nCheck += nDigit;
            bEven = !bEven;
        }

        return (nCheck % 10) === 0;
    }

    // إضافة تأثير الـ focus لإزالة الخطأ عند النقر على الحقل
    $('#cardNumber, #expiryMonth, #expiryYear, #cvv, #cardHolderName').on('focus', function() {
        $(this).removeClass('is-invalid');
    });

    // التحقق من صحة الشهر (1-12)
    $('#expiryMonth').on('input', function() {
        const value = $(this).val().replace(/\D/g, '').substring(0, 2);
        $(this).val(value);

        const month = parseInt(value);
        if (value.length > 0 && (isNaN(month) || month < 1 || month > 12)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    // التحقق من صحة السنة (السنة الحالية وحتى 10 سنوات مستقبلية)
    $('#expiryYear').on('input', function() {
        const value = $(this).val().replace(/\D/g, '').substring(0, 4);
        $(this).val(value);

        const year = parseInt(value);
        const currentYear = new Date().getFullYear();

        if (value.length === 4 && (isNaN(year) || year < currentYear || year > currentYear + 10)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    // التحقق من صحة اسم حامل البطاقة (غير فارغ وعلى الأقل 3 أحرف)
    $('#cardHolderName').on('input', function() {
        const value = $(this).val();

        if (value.length < 3) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    // التحقق من صحة النموذج عند تقديمه
    $('#paymentForm').on('submit', function(e) {
        e.preventDefault();

        // التحقق من الموافقة على سياسة الإلغاء/الاسترداد
        if (!$('#agreeCheckbox').is(':checked')) {
            alert('يرجى الموافقة على سياسة الإلغاء/الاسترداد.');
            return false;
        }

        let isValid = true;
        const cardType = $('#cardType').val();
        const cardPattern = cardPatterns[cardType];

        // التحقق من رقم البطاقة
        const cardNumber = $('#cardNumber').val().replace(/\s/g, '');
        if (!cardPattern.pattern.test(cardNumber) || !isValidCardNumber(cardNumber)) {
            $('#cardNumber').addClass('is-invalid');
            isValid = false;
        } else {
            $('#cardNumber').removeClass('is-invalid');
        }

        // التحقق من تاريخ انتهاء الصلاحية - الشهر
        const month = parseInt($('#expiryMonth').val());
        if (isNaN(month) || month < 1 || month > 12) {
            $('#expiryMonth').addClass('is-invalid');
            isValid = false;
        } else {
            $('#expiryMonth').removeClass('is-invalid');
        }

        // التحقق من تاريخ انتهاء الصلاحية - السنة
        const year = parseInt($('#expiryYear').val());
        const currentYear = new Date().getFullYear();
        if (isNaN(year) || year < currentYear || year > currentYear + 10 || $('#expiryYear').val().length !== 4) {
            $('#expiryYear').addClass('is-invalid');
            isValid = false;
        } else {
            $('#expiryYear').removeClass('is-invalid');
        }

        // التحقق من رمز التحقق CVV
        const cvv = $('#cvv').val();
        if (cvv.length !== cardPattern.cvvLength || !/^\d+$/.test(cvv)) {
            $('#cvv').addClass('is-invalid');
            isValid = false;
        } else {
            $('#cvv').removeClass('is-invalid');
        }

        // التحقق من اسم حامل البطاقة
        const cardHolderName = $('#cardHolderName').val();
        if (cardHolderName.length < 3) {
            $('#cardHolderName').addClass('is-invalid');
            isValid = false;
        } else {
            $('#cardHolderName').removeClass('is-invalid');
        }

        if (isValid) {
            alert('تم التحقق من معلومات الدفع بنجاح!');
            $(this).unbind('submit').submit();
        } else {
            $(this).addClass('was-validated');
        }
    });
});
    </script>



    {{-- <script>
        $(document).ready(function() {
    // Format card number as XXXX XXXX XXXX XXXX
    $('#cardNumber').on('input', function() {
    var value = $(this).val().replace(/\D/g, '').substring(0, 16);
    var formattedValue = '';

    for (var i = 0; i < value.length; i++) { if (i> 0 && i % 4 === 0) {
        formattedValue += ' ';
        }
        formattedValue += value[i];
        }

        $(this).val(formattedValue);
        });

        // Add focus event to remove error when user clicks on the field
        $('#cardNumber, #expiryMonth, #expiryYear, #cvv, #cardHolderName').on('focus', function() {
        $(this).removeClass('is-invalid');
        });

        // Validate month (1-12)
        $('#expiryMonth').on('input', function() {
        var value = $(this).val().replace(/\D/g, '').substring(0, 2);
        $(this).val(value);

        var month = parseInt(value);
        if (value.length > 0 && (isNaN(month) || month < 1 || month> 12)) {
            $(this).addClass('is-invalid');
            } else {
            $(this).removeClass('is-invalid');
            }
            });

            // Validate year (current year and up to 10 years in future)
            $('#expiryYear').on('input', function() {
            var value = $(this).val().replace(/\D/g, '').substring(0, 4);
            $(this).val(value);

            var year = parseInt(value);
            var currentYear = new Date().getFullYear();

            if (value.length === 4 && (isNaN(year) || year < currentYear || year> currentYear + 10)) {
                $(this).addClass('is-invalid');
                } else {
                $(this).removeClass('is-invalid');
                }
                });

                // Validate CVV (3-4 digits)
                $('#cvv').on('input', function() {
                var value = $(this).val().replace(/\D/g, '').substring(0, 4);
                $(this).val(value);

                if (value.length < 3 || value.length> 4) {
                    $(this).addClass('is-invalid');
                    } else {
                    $(this).removeClass('is-invalid');
                    }
                    });

                    // Validate card holder name (not empty and at least 3 characters)
                    $('#cardHolderName').on('input', function() {
                    var value = $(this).val();

                    if (value.length < 3) { $(this).addClass('is-invalid'); } else { $(this).removeClass('is-invalid'); }
                        });
                         $('#paymentForm').on('submit', function(e) { e.preventDefault(); var
                        isValid=true;

                         // Validate card number
                        var cardNumber=$('#cardNumber').val().replace(/\s/g, '' ); if
                        (cardNumber.length !==16 || !/^\d+$/.test(cardNumber)) { $('#cardNumber').addClass('is-invalid');
                        isValid=false; } else { $('#cardNumber').removeClass('is-invalid'); } // Validate expiry month var
                        month=parseInt($('#expiryMonth').val()); if (isNaN(month) || month < 1 || month> 12) {
                        $('#expiryMonth').addClass('is-invalid');
                        isValid = false;
                        } else {
                        $('#expiryMonth').removeClass('is-invalid');
                        }

                        // Validate expiry year
                        var year = parseInt($('#expiryYear').val());
                        var currentYear = new Date().getFullYear();
                        if (isNaN(year) || year < currentYear || year> currentYear + 10 || $('#expiryYear').val().length !==
                            4) {
                            $('#expiryYear').addClass('is-invalid');
                            isValid = false;
                            } else {
                            $('#expiryYear').removeClass('is-invalid');
                            }

                            // Validate CVV
                            var cvv = $('#cvv').val();
                            if (cvv.length < 3 || cvv.length> 4 || !/^\d+$/.test(cvv)) {
                                $('#cvv').addClass('is-invalid');
                                isValid = false;
                                } else {
                                $('#cvv').removeClass('is-invalid');
                                }

                                // Validate card holder name
                                var cardHolderName = $('#cardHolderName').val();
                                if (cardHolderName.length < 3) { $('#cardHolderName').addClass('is-invalid'); isValid=false;
                                    } else { $('#cardHolderName').removeClass('is-invalid'); }

                                    if (isValid) {

                                    alert('Payment information validated successfully!');

                                    $(this).unbind('submit').submit(); } else {


                                     $(this).addClass('was-validated');
                                    }
                                 });
                                 });
                                 // Format card number as XXXX XXXX XXXX XXXX
                $('#cardNumber').on('input', function() {
                    var value = $(this).val().replace(/\D/g, '').substring(0, 16);
                    var formattedValue = '';

                    for (var i = 0; i < value.length; i++) {
                        if (i > 0 && i % 4 === 0) {
                            formattedValue += ' ';
                        }
                        formattedValue += value[i];
                    }

                    $(this).val(formattedValue);
                });

                // Add focus event to remove error when user clicks on the field
                $('#cardNumber, #expiryMonth, #expiryYear, #cvv, #cardHolderName').on('focus', function() {
                    $(this).removeClass('is-invalid');
                });

                // Validate month (1-12)
                $('#expiryMonth').on('input', function() {
                    var value = $(this).val().replace(/\D/g, '').substring(0, 2);
                    $(this).val(value);

                    var month = parseInt(value);
                    if (value.length > 0 && (isNaN(month) || month < 1 || month > 12)) {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                // Validate year (current year and up to 10 years in future)
                $('#expiryYear').on('input', function() {
                    var value = $(this).val().replace(/\D/g, '').substring(0, 4);
                    $(this).val(value);

                    var year = parseInt(value);
                    var currentYear = new Date().getFullYear();

                    if (value.length === 4 && (isNaN(year) || year < currentYear || year > currentYear + 10)) {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                // Validate CVV (3-4 digits)
                $('#cvv').on('input', function() {
                    var value = $(this).val().replace(/\D/g, '').substring(0, 4);
                    $(this).val(value);

                    if (value.length < 3 || value.length > 4) {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                // Validate card holder name (not empty and at least 3 characters)
                $('#cardHolderName').on('input', function() {
                    var value = $(this).val();

                    if (value.length < 3) {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                // Form submission validation
                $('#paymentForm').on('submit', function(e) {
                    e.preventDefault();

                    // First check if checkbox is checked
                    if (!$('#agreeCheckbox').is(':checked')) {
                        alert('Please agree to the cancellation/refund policy.');
                        return false;
                    }

                    var isValid = true;

                    // Validate card number
                    var cardNumber = $('#cardNumber').val().replace(/\s/g, '');
                    if (cardNumber.length !== 16 || !/^\d+$/.test(cardNumber)) {
                        $('#cardNumber').addClass('is-invalid');
                        isValid = false;
                    } else {
                        $('#cardNumber').removeClass('is-invalid');
                    }

                    // Validate expiry month
                    var month = parseInt($('#expiryMonth').val());
                    if (isNaN(month) || month < 1 || month > 12) {
                        $('#expiryMonth').addClass('is-invalid');
                        isValid = false;
                    } else {
                        $('#expiryMonth').removeClass('is-invalid');
                    }

                    // Validate expiry year
                    var year = parseInt($('#expiryYear').val());
                    var currentYear = new Date().getFullYear();
                    if (isNaN(year) || year < currentYear || year > currentYear + 10 || $('#expiryYear').val().length !== 4) {
                        $('#expiryYear').addClass('is-invalid');
                        isValid = false;
                    } else {
                        $('#expiryYear').removeClass('is-invalid');
                    }

                    // Validate CVV
                    var cvv = $('#cvv').val();
                    if (cvv.length < 3 || cvv.length > 4 || !/^\d+$/.test(cvv)) {
                        $('#cvv').addClass('is-invalid');
                        isValid = false;
                    } else {
                        $('#cvv').removeClass('is-invalid');
                    }

                    // Validate card holder name
                    var cardHolderName = $('#cardHolderName').val();
                    if (cardHolderName.length < 3) {
                        $('#cardHolderName').addClass('is-invalid');
                        isValid = false;
                    } else {
                        $('#cardHolderName').removeClass('is-invalid');
                }

                if (isValid) {
                    alert('Payment information validated successfully!');
                    $(this).unbind('submit').submit();
                } else {
                    $(this).addClass('was-validated');
                }
            });
    </script> --}}
</body>

</html>
