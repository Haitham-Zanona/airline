<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Farebuddies</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .header-logo {
            max-width: 180px;
            padding: 15px 0;
        }

        .success-banner {
            background-color: #e6f9f1;
            color: #0c9d6a;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .success-icon {
            width: 60px;
            height: 60px;
            background-color: #0c9d6a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 30px;
            margin: 0 auto 15px;
        }

        .flight-details {
            background-color: #f5f5f5;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .flight-header {
            background-color: #444;
            color: white;
            padding: 10px 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .flight-content {
            background-color: white;
            padding: 15px;
            border: 1px solid #ddd;
        }

        .stopover {
            background-color: #fff9e6;
            padding: 8px;
            border-radius: 4px;
            margin: 10px 0;
        }

        .airline-logo {
            height: 20px;
            margin-right: 10px;
        }

        .passenger-details,
        .payment-details {
            margin-bottom: 20px;
        }

        .total-price {
            background-color: #e41b4d;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
        }

        .terms {
            font-size: 12px;
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 8px;
        }

        .contact-phone {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }

        .whatsapp-icon {
            width: 24px;
            height: 24px;
            background-color: #25D366;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container my-4" style="max-width: 800px;">
        <!-- Header -->
        <div class="row">
            <div class="col-md-6">
                <img src="https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo1.png"
                    alt="Farebuddies Logo" class="header-logo">
            </div>
            <div class="col-md-6 text-end">
                <div><a href="tel:+18778474278" class="contact-phone">+1-877-847-4278</a></div>
                <div>
                    <span class="whatsapp-icon">W</span>
                    <a href="tel:+16673835536" class="contact-phone">+1-667-383-5536</a>
                </div>
            </div>
        </div>

        <!-- Success Banner -->
        <div class="success-banner">
            <div class="success-icon">✓</div>
            <h2>Your Booking Successfully Completed</h2>
            <p>Congratulation your booking has been confirmed. Thank you</p>
        </div>

        <!-- Booking Info -->
        <div class="booking-info mb-4">
            <p>Thank you for choosing Farebuddies as a preferred travel partner. Your booking is not confirmed yet and
                is under process, we will reach you soon via Phone or e-mail for further confirmation. In case you are
                not contacted within 4-24 hours, feel free to give us a call back on our Toll-free number. Please find
                the below the travel details.</p>
            <p>Please find the below the travel details.<br>
                All prices are quoted in USD</p>
            <p><strong>Farebuddies Booking ID: FDB88669</strong> | Booked on Mon, 03 Mar 2025 19:52</p>
        </div>

        <!-- Flight Details - Departure -->
        <div class="flight-details">
            <div class="flight-header d-flex justify-content-between">
                <h5 class="mb-0">Flight Details</h5>
                <span>Flight Duration: 5:03</span>
            </div>
            <div class="flight-content">
                <h6>Departure</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <img src="https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo1.png"
                            alt="American Airlines" class="airline-logo">
                        American Airlines<br>
                        AA - 1355<br>
                        Operated By:<br>
                        American Airlines
                    </div>
                    <div class="col-md-3">
                        03 Mar 2025 19:30<br>
                        John F. Kennedy Intl (JFK)
                    </div>
                    <div class="col-md-3">
                        03 Mar 2025 21:44<br>
                        Charlotte Douglas (CLT)
                    </div>
                    <div class="col-md-2">
                        Cabin Class<br>
                        Economy
                    </div>
                </div>

                <div class="stopover">
                    <strong>Stopover</strong> ● Connection of 0 Hours 42 Mins in Charlotte Douglas, Charlotte, United
                    States
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <img src="https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo1.png"
                            alt="American Airlines" class="airline-logo">
                        American Airlines<br>
                        AA - 3063<br>
                        Operated By:<br>
                        American Airlines
                    </div>
                    <div class="col-md-3">
                        03 Mar 2025 22:26<br>
                        Charlotte Douglas (CLT)
                    </div>
                    <div class="col-md-3">
                        04 Mar 2025 00:33<br>
                        Miami Intl. Arpt. (MIA)
                    </div>
                    <div class="col-md-2">
                        Cabin Class<br>
                        Economy
                    </div>
                </div>
            </div>
        </div>

        <!-- Flight Details - Round Trip -->
        <div class="flight-details">
            <div class="flight-header d-flex justify-content-between">
                <h5 class="mb-0">Round Trip</h5>
                <span>Flight Duration: 2:56</span>
            </div>
            <div class="flight-content">
                <div class="row">
                    <div class="col-md-4">
                        <img src="https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo1.png"
                            alt="American Airlines" class="airline-logo">
                        American Airlines<br>
                        AA - 761<br>
                        Operated By:<br>
                        American Airlines
                    </div>
                    <div class="col-md-3">
                        13 Mar 2025 15:04<br>
                        Miami Intl. Arpt. (MIA)
                    </div>
                    <div class="col-md-3">
                        13 Mar 2025 18:00<br>
                        John F. Kennedy Intl (JFK)
                    </div>
                    <div class="col-md-2">
                        Cabin Class<br>
                        Economy
                    </div>
                </div>
            </div>
        </div>

        <!-- Passenger Details -->
        <div class="passenger-details flight-details">
            <div class="flight-content">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Name</strong>
                    </div>
                    <div class="col-md-4">
                        <strong>Date of Birth</strong>
                    </div>
                    <div class="col-md-4">
                        <strong>Pax Type</strong>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        Mr haitham mohammed zanona
                    </div>
                    <div class="col-md-4">
                        24 Sep 1999
                    </div>
                    <div class="col-md-4">
                        Adult
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="payment-details flight-details">
            <div class="flight-content">
                <div class="row">
                    <div class="col-md-2">
                        <strong>Method:</strong>
                    </div>
                    <div class="col-md-10">
                        Visa Debit/Delta ending in xxxxxxxxxxxx6587
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>Phone:</strong>
                    </div>
                    <div class="col-md-10">
                        05055496877
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-10">
                        <a href="mailto:hythamzanona@gmail.com">hythamzanona@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flight Price Details -->
        <div class="payment-details flight-details">
            <div class="flight-content">
                <h6>Flight Price Details</h6>
                <div class="row">
                    <div class="col-md-6">
                        Adult Ticket
                    </div>
                    <div class="col-md-6 text-end">
                        $390.67
                    </div>
                </div>
                <div class="row total-price mt-2">
                    <div class="col-md-6">
                        <strong>Total Charge:</strong>
                    </div>
                    <div class="col-md-6 text-end">
                        <strong>$390.67</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="terms">
            <h6>Important Terms & Conditions</h6>
            <ol>
                <li>Total price shown includes all applicable taxes and our fees.</li>
                <li>All bookings and fares are not guaranteed until ticketed by the supplier.</li>
                <li>Your credit card may be billed in multiple charges totaling the above amount.</li>
                <li>All Tickets are Non-refundable, Non-changeable and Non-transferable unless otherwise specified.</li>
                <li>We will send your booking confirmation and e-tickets to the email address provided by you while
                    purchasing the product.</li>
                <li>Prices may not include baggage fees or other fees charged directly by the airline.</li>
                <li>Free baggage allowance provide to the passenger where is applicable by the airlines side, varying
                    according to routes and class of seat. Airlines may charge additional fee for checked-in baggage and
                    extra baggage or other optional services. Please call our sales directly for the most recent updates
                    regarding the baggage allowance, weight and dimensions of bags.</li>
                <li>Traveler names must match government issued photo IDs exactly to avoid being denied boarding and/or
                    paying a change fee.</li>
                <li>Airfares are guaranteed only upon ticketing, and not upon submission of payment. If there would be
                    any issue with the booking and payment, we will notify you as soon as possible through email and
                    phone. Otherwise, we will send you the E-ticket of your booking.</li>
                <li>Federal law forbids the carriage of hazardous materials aboard aircraft in your luggage or on your
                    person.</li>
                <li>We understand that sometimes plans change. In order to make any changes in the ticketed booking will
                    be subject to airline policies and our fees.</li>
                <li>If your flight originating from US and UK/and you want to make any changes and cancellation within
                    24 hours, there will be an administrative charge of $50 per person and subject to airline rules and
                    regulations.</li>
            </ol>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
