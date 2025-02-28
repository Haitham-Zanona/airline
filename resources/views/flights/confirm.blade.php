<x-front-layout>

    <style>
        body {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #15406a;
            padding: 15px;
            color: white;
            font-weight: bold;
            position: relative;
            max-width: 100%;
            overflow-x: hidden;
        }

        .progress-container .step {
            position: relative;
            text-align: center;
            flex-grow: 1;
        }

        /* ✅ إصلاح الخطوط بين الخطوات */
        .progress-container .step::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: #28a745 !important;
            transform: translateY(-50%);
            z-index: -1;
        }

        .progress-container .step:first-child::before {
            width: 50%;
            left: 50%;
        }

        .progress-container .step:last-child::before {
            width: 50%;
        }

        .progress-container .circle {
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            background-color: #28a745 !important;
            color: white !important;
            display: inline-block;
            font-weight: bold;
        }

        /* ✅ ألوان الخطوات */
        .progress-container .active .circle {
            background-color: #f0ad4e;
            color: white;
        }

        .progress-container .completed .circle {
            background-color: #28a745;
            color: white;
        }

        .progress-container .step.completed::before {
            background-color: #28a745 !important;
        }

        .passenger-details {
            padding: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-head {
            background-color: #ffffff;
            font-weight: bold;
            color: #333;
        }

        .table-head td {
            padding: 8px;
            border-bottom: 2px solid black;
        }

        table td {
            padding: 8px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
            /* ✅ صفوف متناوبة بلون رمادي فاتح */
        }

        .print-btn {
            display: flex;
            width: 220px;
            /* تعديل الحجم حسب الحاجة */
            height: 50px;
            border: none;
            border-radius: 8px;
            overflow: hidden;
            /* background-color: #0d3c72; */
            /* اللون الأزرق الداكن */
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            /* إضافة ظل */
            transition: box-shadow 0.3s ease-in-out, transform 0.2s;
        }

        .print-btn:hover {
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
            /* زيادة الظل عند التمرير */
            transform: translateY(-2px);
            /* رفع بسيط عند التحويم */
        }

        .print-btn .icon {
            background-color: #0d3c72;
            width: 30%;
            display: flex;
            border-radius: 8px 0 0 8px;
            align-items: center;
            justify-content: center;
        }

        .print-btn .icon i {
            font-size: 18px;
            color: white;
        }

        .print-btn .text {
            background-color: white;
            color: #0d3c72;
            width: 70%;
            display: flex;
            align-items: center;
            border-radius: 0 8px 8px 0;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
        }

        .pass-personal-info label {
            color: #000;
            font-size: 17px;
            position: relative;
            width: 17%;
            font-weight: 700;
        }

        .pass-personal-info label::after {
            content: ':';
            position: absolute;
            right: 10%;
        }

        .pass-personal-info span {
            font-size: 15px;
            color: #000;
            font-weight: 600;
        }
    </style>




    <div class="progress-container">
        <div class="step completed">
            <span class="circle">1</span>
            <p>SEARCH RESULT</p>
        </div>
        <div class="step completed">
            <span class="circle">2</span>
            <p>PASSENGER</p>
        </div>
        <div class="step active">
            <span class="circle">3</span>
            <p>PAYMENT</p>
        </div>
        <div class="step">
            <span class="circle">4</span>
            <p>CONFIRM</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-9 d-flex align-items-center">
            <div class="mx-2 d-inline-block pl-4">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                    width="40" height="40" viewBox="0 0 256 256" xml:space="preserve">

                    <defs>
                    </defs>
                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                        transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                        <circle cx="45" cy="45" r="45"
                            style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(1,179,114); fill-rule: nonzero; opacity: 1;"
                            transform="  matrix(1 0 0 1 0 0) " />
                        <path
                            d="M 38.478 64.5 c -0.01 0 -0.02 0 -0.029 0 c -1.3 -0.009 -2.533 -0.579 -3.381 -1.563 L 21.59 47.284 c -1.622 -1.883 -1.41 -4.725 0.474 -6.347 c 1.884 -1.621 4.725 -1.409 6.347 0.474 l 10.112 11.744 L 61.629 27.02 c 1.645 -1.862 4.489 -2.037 6.352 -0.391 c 1.862 1.646 2.037 4.49 0.391 6.352 l -26.521 30 C 40.995 63.947 39.767 64.5 38.478 64.5 z"
                            style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;"
                            transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                    </g>
                </svg>
            </div>
            <div class="my-3 d-inline-block" style="color: #41479b;">
                <h4 class="m-0 p-0">Your Booking Successfully Completed.</h4>
                <p class="m-0">Congratulations! your Booking has been Confirmed. Thank you</p>
            </div>
        </div>

        <div class="col-md-3">
            <button class="print-btn p-0">
                <div class="icon p-4">
                    <i class="fas fa-print" style="color: #fff;"></i> <!-- أيقونة الطباعة -->
                </div>
                <div class="text p-4">Print A Copy</div>
            </button>
        </div><!-- col-md-3 -->
    </div><!-- row -->

    <div class="row px-3">
        <div class="col-md-7 pl-4">
            <h2 class="passenger-name" style="font-size: 24px;">Mr Haitham Mohamed abdel majed Abo Zanona</h2>
            <div class="pass-personal-info"><label for="">Phone No.</label><span>0592235375</span></div>
            <div class="pass-personal-info"><label for="">Email Id</label><span>hythamzanona@gmail.com</span></div>
            <div class="pass-personal-info"><label for="">Destination</label><span>Miami Miami Intl. Arpt. United
                    States(MIA)</span></div>
            <div class="pass-personal-info"><label for="">Booking Date</label><span>28 Feb 2025 11:02:18</span></div>
        </div><!-- col-md-7 -->
        <div class="col-md-5">
            <div class="book-date px-2 d-flex justify-content-between">
                <div class="book-time p-3">
                    <p class="m-0 mb-1">Booking Date & Time:</p>
                    <span>28 Feb 2025 11:02:18</span>
                </div><!-- book-time -->
                <div class="book-ref px-5 py-3" style="background-color: #daf0e8; border-radius: 8px;">
                    <p class="m-0 mb-1">Your booking reference no.:</p>
                    <span style="color:#01b372; font-size: 19px;">FDB88651</span>
                </div><!-- book-ref -->
            </div><!-- book-date -->
            <div></div>
        </div><!-- col-md-5 -->
    </div><!-- row -->
    <hr class="my-4">
    <form id="passengerForm" novalidate>
        <div class="row px-3">
            <div class="col-md-9">
                <div>
                    <div>
                        <h3>Selected Flight</h3>
                    </div>
                    <div class="text-white py-1 px-2 " style="background-color: #1165a2;">
                        <div class="outbound-flight d-flex justify-content-between">
                            <div class="outbound-flight">
                                <img src="" alt="alter" class="d-inline-block">
                                <h5 class="m-0 d-inline-block">Outbound Flight</h5>
                            </div>
                            <p class="m-0 text-right ">Non stop</p>
                        </div>
                    </div>

                </div>
                <div class="passenger-details-title p-2" style="background-color: #1165a2; color: #fff;">

                    <h2 class="m-0 d-inline-block" style="font-size: 20px;"><span><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-person-circle mr-1" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg></span> Passenger Details</h2>
                </div><!-- important-note -->
                <div class="Passenger-details mb-4">
                    <table>
                        <tbody>
                            <tr class="table-head">
                                <td>Sr.</td>
                                <td>Title</td>
                                <td>First Name</td>
                                <td>Date of Birth</td>
                            </tr><!-- table-head -->
                            <tr>
                                <td>1</td>
                                <td>Mr</td>
                                <td>hytham Mohamed Abo zanona</td>
                                <td>24-09-1999</td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- Passenger-details -->
                <div class="important-terms p-3">
                    <h4 style="font-size: 18px;">Important Terms & Conditions</h4>
                    <div class="terms-conditions" style="font-size: 13px; font-weight: 400;">
                        1. All Tickets are Non-refundable, Non-changeable and Non-transferable unless otherwise
                        specified.
                        <br>
                        <br>
                        2. Passengers must ensure that all names are correct as per their passports and that the travel
                        itinerary is
                        correct. Changes may not be permissible after the tickets are issued and a payment for a new
                        ticket may be charged.
                        <br>
                        <br>
                        <sapn>3.</sapn> Airfares are guaranteed upon ticketing only. If there would be any issue with
                        the payment, we will
                        notify you as soon as possible through email and phone. Otherwise, we will send you the ticket
                        within 48 hours of
                        your booking. <br>
                        <br>
                        4. Free baggage allowance will be provided to the passenger wherever applicable by the airlines,
                        varying according
                        to routes and class of services.
                        <br>
                        <br>
                        5. Passengers must reach airport 3 hours prior in case of international flights and 2 hours
                        prior in case of
                        domestic flights. Tickets cannot be refunded or changed due to no-show at the airport (unless
                        otherwise specified by
                        airlines).
                        <br>
                        <br>
                        6. Passengers are responsible for all travel documentation including visas. Visas may be
                        required for the entire
                        journey both for the destination and/or transit. Visas must be secured before ticket issue.
                        Tickets cannot be
                        refunded for failure to obtain a visa.
                        <br>
                        <span class="noleft">
                            6.1. Passport ,Visa &amp; Health Recommendation
                            <br>
                            <br>
                            6.2. Passports must be valid for at least 6 months beyond the period of your stay.
                            <br>
                            <br>
                            6.3. ESTA visa is a mandatory requirement for all USA bound travel including transiting the
                            USA.
                            <br>
                            <br>
                            6.4. If your flight has a change involving two different airports with the itinerary, it is
                            your responsibility
                            to organize the transfer to the right airport and also check the transit visa requirement.
                            <br>
                            <br>
                            6.5. If you have booked code-share flight, terminal change may be there and you may require
                            transit visa for
                            changing the terminals. Please check with the embassy or airline directly for checking visa
                            requirements in case
                            of terminal change.
                            <br>
                            <br>
                            6.6. Farebuddies is not responsible for the VISA formalities. Please consult the relevant
                            embassy or consulate
                            for this information.
                            <br>
                            <br>
                            6.7. Health Recommendation: Recommended inoculations for travel may change at any time. It
                            is your
                            responsibility to ensure that you obtain all recommended inoculations, take all recommended
                            medication and
                            follow all medical advice in relation to your trip.
                            <br>
                            <br>
                        </span>
                        7. Insurance / Travel Insurance:- The Company strongly recommends that the Client takes out
                        adequate travel
                        insurance. The Client is herewith recommended to read the terms of any insurance to satisfy them
                        as to the fitness
                        of cover. The Company will be pleased to quote you for insurance.
                        <br>
                        <br>

                        8. Flights/ packages are protected by CAA in case the airline goes out of operation or
                        bankruptcy. However bookings
                        made on low cost airlines or charter flights / airlines not under SAFI are not covered by the
                        airline failure
                        insurance, therefore agent will not be liable for loss of money in such cases.
                        <br>
                        <br>
                        9. Changes :- If you wish to change any item – other than increasing the number of persons in
                        your party/ booking –
                        And providing we can accommodate the change, you will have to pay an amendment Fee of USD 50.00
                        per booking plus the
                        airlines/ supplier charges (if any) .From time to time we are required to collect additional
                        taxes . You will be
                        informed for any additional taxes prior to ticket issuance/ reissuance. After ticket issuance
                        most of the airlines
                        do not allow changes.
                        <br>
                        <br>
                        10. Cancellation
                        <br>
                        <span class="noleft">
                            a. Cancellation before ticket issuance :- Should you or any member of your party be forced
                            to cancel your flight
                            or holidays, we must be notified by the person who made the booking and who therefore
                            responsible for the
                            payment of cancellation charges.
                            <br>
                            <br>
                            b. Cancellation after ticket issuance: - Cancellation after ticket issuance will result in
                            loss of 100 % of
                            total cost of all travel arrangements in most of cases. Please consult with your travel
                            consultant. Low cost
                            airlines/Charter flights carry a 100 % cancellation fee in both conditions before or after
                            ticket issuance.
                        </span>
                        <br>
                        <br>

                        11. South African travel requirements for minors travelling to and from South Africa. New
                        requirements, introduced
                        by the South African Department of Home Affairs from 1 June 2015, specify that all minors
                        (children under 18 years)
                        are required to produce, in addition to their passport, an Unabridged Birth Certificate which
                        shows the details of
                        both parents for all international travel to and from South Africa. Travellers will be asked to
                        produce the required
                        documentation at check-in for each flight.
                        <br>
                        <br>
                        12. New passport regulations for Travellers to the U.S.A.The United States of America has made
                        it mandatory, that
                        anyone flying to the US for holidays or business under the Visa Waiver Program must hold the
                        latest Biometric
                        Passport or a Machine Readable Passport that contains an electronic chip, even if the electronic
                        visa has been
                        granted. The biometric passport has a sequence of lines, that can be swiped by the US
                        Customs/Immigration/Border
                        Protection officers that will quickly confirm the passport holder's identity and collect other
                        information about the
                        holder.VWP visitors arriving in the US without the Biometric Passport would be denied entrance
                        into the country.
                        Travellers among the VWP countries are encouraged to check with their passport issuing authority
                        to be in possession
                        of a biometric passport. Travellers with an immediate travel plan, who are unable to possess
                        such a passport, may
                        apply for a US visa at the respective embassy or consulate.
                        <br>
                        <br>
                        13. If you need further information on above mentioned points regarding
                        refund/cancellation/special assistance etc.,
                        please call our customer care number ++1-877-847-4278 or email us on support@fare buddy.com.
                        <br>
                        <br>
                        14. A direct flight in the aviation industry is any flight between two points by an airline with
                        no change in flight
                        numbers, which may include a stop at an intermediate point. The stop over may either be to get
                        new passengers (or
                        allow some to disembark) or a mere technical stop over (i.e., for refuelling) or due to
                        operational reasons.
                        <br>
                    </div>
                </div><!-- important-terms -->





            </div><!-- col-md-9 -->
            <div class="col-md-3">
                <div class="flight-details-container" id="flight-box">
                    <!-- ✅ قسم تفاصيل الرحلة -->
                    <div class="section">
                        <div class="toggle-section">
                            Flight Details
                            <span class="arrow-icon">&#9660;</span>
                        </div>
                        <div class="section-content">
                            <p><strong>Return Flight</strong></p>
                            <p>1 Ticket 1 Adult</p>
                            <p><strong>jetBlue</strong> (B6-2593)</p>
                            <p>JFK → MIA (27 Feb 2025, 13:29 → 16:39)</p>
                            <p><strong>jetBlue</strong> (B6-202)</p>
                            <p>MIA → JFK (04 Mar 2025, 07:00 → 09:59)</p>
                        </div>
                    </div>

                    <!-- ✅ قسم تفاصيل السعر -->
                    <div class="section">
                        <div class="toggle-section">
                            Price Details (USD)
                            <span class="arrow-icon">&#9660;</span>
                        </div>
                        <div class="section-content">
                            <p>1 X Adult: <strong>$641.60</strong></p>
                        </div>
                    </div>

                    <!-- ✅ المجموع -->
                    <div class="total">
                        <strong>Total:</strong> $641.60
                    </div>

                    <!-- ✅ ضمان السعر -->
                    <div class="price-guarantee">
                        <i class="check-icon">✔</i> Price Guarantee
                    </div>

                    <!-- ✅ زر متابعة الحجز -->
                    <a href="#" class="continue-booking">
                        Continue Booking →
                    </a>
                </div>
            </div>
        </div><!-- row -->

    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script>
        $(document).ready(function(){
            function updateProgress(currentStep) {
                $(".step").each(function (index) {
                    $(this).addClass("completed").removeClass("active");
                });
            }
            updateProgress(3); // ✅ ضبط الخطوة الثالثة كـ "active" والخطوتين الأولى والثانية كـ "completed"

        });

    </script>

</x-front-layout>