<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام الحجز</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .booking-progress {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .booking-progress span {
            margin: 0 5px;
            color: #6c757d;
        }

        .booking-progress span.active {
            color: #000;
            font-weight: bold;
        }

        .booking-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 30px;
        }

        .flight-icon {
            font-size: 28px;
            transform: rotate(45deg);
            margin-right: 15px;
        }

        .route-details {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .airline-logo {
            width: 30px;
            height: 30px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
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

        .flight-detail-box {
            background-color: #f0f3f8;
            border-radius: 8px;
            padding: 20px;
        }

        .airport-code {
            font-size: 18px;
            font-weight: bold;
        }

        .airport-time {
            font-size: 16px;
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
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
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
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h5>Complete your booking</h5>
                <div class="booking-progress">
                    <span class="active">Flight Summary</span>
                    <span>•</span>
                    <span>Contact Details</span>
                    <span>•</span>
                    <span>Passengers</span>
                    <span>•</span>
                    <span class="active">Payment</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">

                <div class="booking-container">
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

                    <div id="flightSummary" class="collapse show">
                        <div class="d-flex align-items-center mb-3">
                            <div class="airline-logo">
                                <span>A</span>
                            </div>
                            <div>ABC Airline</div>
                            <div class="non-refundable">Non-refundable</div>
                            <div class="ms-auto">Travel Class: Economy</div>
                        </div>

                        <div class="flight-detail-box">
                            <div class="row">
                                <div class="col-5">
                                    <div class="airport-code">NBI</div>
                                    <div class="airport-time">14:50</div>
                                    <div class="airport-date">Sun, 29 Jan 2023</div>
                                    <div class="airport-info">Nairobi, Kenya</div>
                                    <div class="airport-info">Terminal - 2, Gate - 25</div>
                                </div>

                                <div class="col-2">
                                    <div class="flight-duration">
                                        <div>9hr 50min</div>
                                        <div class="flight-line"></div>
                                    </div>
                                </div>

                                <div class="col-5 text-end">
                                    <div class="airport-code">MBO</div>
                                    <div class="airport-time">14:50</div>
                                    <div class="airport-date">Sun, 29 Jan 2023</div>
                                    <div class="airport-info">Mombasa, Kenya</div>
                                    <div class="airport-info">Terminal - 2, Gate - 25</div>
                                </div>
                            </div>

                            <div class="flight-info-row">
                                <div class="flight-info-item">
                                    <div class="flight-info-label">Baggage</div>
                                    <div>23kg (1 Piece * 23kg)</div>
                                </div>
                                <div class="flight-info-item">
                                    <div class="flight-info-label">Check-In</div>
                                    <div>ADULT</div>
                                </div>
                                <div class="flight-info-item">
                                    <div class="flight-info-label">Cabin</div>
                                    <div>7kg (1 Piece * 7kg)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="booking-container">
                    <div class="payment-methods">
                        <p>We accept</p>
                        <div class="card-logos">
                            <div class="card-logo">
                                <i class="fab fa-cc-visa"></i>
                            </div>
                            <div class="card-logo">
                                <i class="fab fa-cc-mastercard"></i>
                            </div>
                        </div>
                    </div>

                    <form id="paymentForm" novalidate>
                        <div class="form-group">
                            <label for="cardNumber">Card Number *</label>
                            <input type="text" class="form-control" id="cardNumber" placeholder="XXXX XXXX XXXX XXXX"
                                required>
                            <div class="invalid-feedback">Please enter a valid card number (16 digits)</div>
                        </div>

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
                        </div>

                        <div class="form-group">
                            <label for="cardHolderName">Card holder name *</label>
                            <input type="text" class="form-control" id="cardHolderName" placeholder="Name on card"
                                required>
                            <div class="invalid-feedback">Please enter the name as it appears on card</div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-primary">Pay $33.00 Now</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="fare-summary">
                    <h5 class="mb-4">Fare Summary</h5>

                    <div class="fare-section">
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

                    <div class="fare-section">
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

                    <div class="fare-section">
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

                    <div class="fare-total fare-item">
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

            // Form submission
            $('#paymentForm').on('submit', function(e) {
                e.preventDefault();

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

                // If everything is valid, submit the form
                if (isValid) {
                    // Show success message or submit the form to server
                    alert('Payment information validated successfully!');
                    // Here you would normally submit the form to your backend
                    // $(this).unbind('submit').submit();
                } else {
                    // Mark the form as validated to show all errors
                    $(this).addClass('was-validated');
                }
            });
        });
    </script>
</body>

</html>
