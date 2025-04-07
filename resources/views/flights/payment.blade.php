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
            background-color: #f0ad4e;
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
            background-color: white;
            color: black;
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

        .payment-form {
            max-width: 100%;
            /* margin: auto; */
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        .input-group-text {
            background: #fff;
            border-left: 0;
        }

        .card-icons {
            display: flex;
            gap: 5px;
        }

        .card-icons img {
            width: 40px;
            height: auto;
        }

        .icon {
            font-size: 20px;
            color: #333;
        }

        .required {
            color: red;
            font-weight: bold;
        }




        .expiry-container select {
            width: 120px;
            /* يمكنك تعديله حسب الحاجة */
        }

        .cvv-container {
            position: relative;
            display: flex;
            align-items: center;
            width: 200px;
            /* تعديل الحجم حسب الحاجة */
        }

        .cvv-input {
            padding-right: 45px;
            /* حتى لا تتداخل الأيقونة مع النص */
        }

        .cvv-icon {
            position: absolute;
            right: 10px;
            width: 35px;
            height: auto;
        }

        .billing-header {
            background-color: #1165a2;
            color: white;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .billing-header i {
            margin-right: 8px;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 5px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #1165a2;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #0d4f85;
        }

        .is-invalid {
            border-color: red !important;
        }

        .select2-container .select2-selection--single {
            height: 38px;
            padding: 6px;
        }

        .tooltip-box {
            display: none;
            position: absolute;
            background-color: #333;
            color: #fff;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            white-space: nowrap;
            z-index: 1000;
            /* تأكد من أن العنصر يظهر فوق العناصر الأخرى */
        }

        .terms-condition-container {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .terms-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin-right: 8px;
        }

        .error-message {
            font-size: 12px;
            margin-left: 10px;
        }

        .container-button {
            position: relative;
            display: inline-block;
        }

        .details {
            display: none;
            background: gray;
            padding: 10px;
            position: absolute;
            top: 40px;
            left: 0;
            width: 200px;
            color: white;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .details button.close-details {
            background: red;
            color: white;
            border: none;
            padding: 3px 7px;
            cursor: pointer;
            float: right;
            font-size: 14px;
        }

        .toggle-details {
            padding: 10px 15px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toggle-content {
            padding: 10px 15px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .content {
            display: none;
            background: gray;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
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

    <div class="row mt-3">
        <div class="col-md-9 d-flex align-items-center">
            <div class="mx-2 d-inline-block pl-4">
                <img src="{{ asset('assets/images/shield.jpg') }}" class="m-0" height="50" width="50" alt="lock">
            </div>
            <div class="my-3 d-inline-block" style="color: #15406a;">
                <h4 class="m-0 p-0">Secure Booking</h4>
                <p class="m-0">We use secure transmission and encrypted storage to protect your personal information!
                </p>
            </div>
        </div>

        <div class="col-md-3 d-flex align-items-center">
            <div class="mx-2 d-inline-block">
                <img src="{{ asset('assets/images/call.jpg') }}" class="m-0" height="50" width="50" alt="call">
            </div>
            <div class="my-3 d-inline-block" style="color: #15406a;">
                <p class="m-0 p-0">Need Any Help?</p>
                <p class="m-0">Call Now +1-877-847-4278</p>
            </div>
        </div>
    </div>
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
                                xmlns="https://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-person-circle mr-1" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg></span> Passenger Details</h2>
                </div><!-- important-note -->
                <div class="Passenger-details px-3 mb-4">
                    <table>
                        <tbody>
                            <tr class="table-head">
                                <td>Sr.</td>
                                <td>Title</td>
                                <td>First Name</td>
                                <td>Middle Name</td>
                                <td>Last Name</td>
                                <td>Gender</td>
                                <td>Date of Birth</td>
                            </tr><!-- table-head -->
                            <tr>
                                <td>1</td>
                                <td>Mr</td>
                                <td>hytham</td>
                                <td></td>
                                <td>mohamed</td>
                                <td>Male</td>
                                <td>24-09-1999</td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- Passenger-details -->
                <div class="payment-title p-2" style="background-color: #1165a2; color: #fff;">

                    <h2 class="m-0 d-inline-block p-2" style="font-size: 20px;"><span><svg
                                xmlns="https://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-credit-card-2-front-fill mr-1" viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
                            </svg></span> Payment Info</h2>
                </div><!-- passenger-title -->

                <div class="payment-info">
                    <div class="d-flex justify-content-between"
                        style="font-size: 14px; font-weight: 600; background-color: #eeffd9;">
                        <span class="p-2">Your information is encrypted and secured.</span>
                        <span class="p-2"><img src="{{ asset('assets/images/ssl-lock.png') }}" alt=""> Secure SSL
                            Booking</span>
                    </div>

                    <div class="payment-form">

                        <!-- نوع البطاقة -->
                        <label>Select Card Type <span class="required">*</span></label>
                        <select class="form-control" style="width: 50%;">
                            <option>Select</option>
                            <option>Visa</option>
                            <option>MasterCard</option>
                            <option>American Express</option>
                            <option>Maestro</option>
                        </select>

                        <!-- رقم البطاقة -->
                        <label class="fw-bold mt-2">Card number <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center gap-2" style="max-width: 500px;">
                            <!-- حقل إدخال رقم البطاقة -->
                            <div class="input-group flex-grow-1">
                                <input type="text" class="form-control" placeholder="Enter card number">
                                <span class="input-group-text">
                                    <i class="fas fa-credit-card"></i>
                                </span>
                            </div>

                            <!-- أيقونات البطاقات -->
                            <div class="d-flex align-items-center gap-2 mx-2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa"
                                    style="width: 30px; margin-right: 3px;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg"
                                    alt="MasterCard" style="width: 30px; margin-right: 3px;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/3/30/American_Express_logo.svg"
                                    alt="Amex" style="width: 30px; margin-right: 3px;">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Expiry Date -->
                                <label class="fw-bold">Expiry Date <span class="text-danger">*</span></label>
                                <div class="row expiry-container">
                                    <div class="col-md-6">
                                        <select class="form-control me-2 w-100">
                                            <option>Month</option>
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>06</option>
                                            <option>07</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                        </select>
                                    </div><!-- col-md-6 -->
                                    <div class="col-md-6">
                                        <select class="form-control w-100">
                                            <option>Year</option>
                                            <option>2024</option>
                                            <option>2025</option>
                                            <option>2026</option>
                                            <option>2027</option>
                                            <option>2028</option>
                                        </select>
                                    </div><!-- col-md-6 -->
                                </div><!-- row expiry-container -->
                            </div><!-- col-md-8 -->
                            <div class="col-md-4">
                                <!-- CVV -->
                                <label class="fw-bold mt-3">CVV / CCV <span class="text-danger">*</span></label>
                                <div class="cvv-container">
                                    <input type="text" class="form-control cvv-input" placeholder="CVV / CCV">
                                    <img src="{{ asset('assets/images/cv-card.png') }}" class="cvv-icon" alt="CVV">
                                </div>
                            </div><!-- col-md-4 -->
                        </div><!-- row -->




                        <!-- اسم حامل البطاقة -->
                        <label>Card Holder Name <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter name">

                    </div>
                </div><!-- payment-info -->

                <div class="address-details mb-5">
                    <div class="address-title p-2" style="background-color: #1165a2; color: #fff;">

                        <h2 class="m-0 d-inline-block p-2" style="font-size: 20px;"><span><svg
                                    xmlns="https://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-pin-map-fill mr-1" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z" />
                                    <path fill-rule="evenodd"
                                        d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
                                </svg></span> Fill Your Billing address details</h2>
                    </div><!-- address-title -->
                    <div class="row">
                        <!-- Address Line 1 -->
                        <div class="col-md-4">
                            <label class="form-label">Address line1 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="address1" placeholder="Enter address">
                        </div>

                        <!-- Address Line 2 -->
                        <div class="col-md-4">
                            <label class="form-label">Address line 2</label>
                            <input type="text" class="form-control" id="address2"
                                placeholder="Enter address (optional)">
                        </div>

                        <!-- City -->
                        <div class="col-md-4">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="city" placeholder="Enter city">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- State -->
                        <div class="col-md-4">
                            <label class="form-label">State <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="state" placeholder="Enter state">
                        </div>

                        <!-- Country -->
                        <div class="col-md-4">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <select class="form-control country-select" id="country" name="country">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Postal Code -->
                        <div class="col-md-4">
                            <label class="form-label">Postal Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" id="postalCode"
                                placeholder="Enter postal code">
                        </div>
                    </div>
                </div><!-- address-details -->

                <div class="price d-flex justify-content-between p-3">
                    <div class="price-left" style="font-size: 18px;">
                        <span class="font-weight-bold"><svg xmlns="https://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-tag-fill mr-1" viewBox="0 0 16 16">
                                <path
                                    d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            </svg> Your Final Price</span>

                        <span>taxes and fees included</span>
                    </div>
                    <div class="price-right p-4" style="color: #fff; background-color: #000;">
                        {{-- <div class="container-button">
                            <button class="toggle-details" type="button">Pay</button>
                            <div class="details">
                                <button class="close-details">×</button>
                                <p>هذه بعض التفاصيل حول العنصر.</p>
                            </div>
                        </div> --}}
                        <button type="button" class="toggle-content">عرض التفاصيل</button>
                        <span class="content" style="display: none; margin-left: 10px; color: blue;">
                            هذا هو المحتوى المخفي ✨
                        </span>
                    </div>
                </div><!-- price -->

                <div class="polices-review p-3">
                    <p class="font-weight-bold" style="font-size: 24px;"><img
                            src="{{ asset('assets/images/flight-ticket.png') }}" class="mr-1" width="40px" height="40px"
                            alt=""> Policies & Review</p>
                    <div class="polices-content p-2">
                        <p class="mb-2">Please confirm that the dates and times of your flights are correct.</p>
                        <p class="mb-2">Please also confirm that the names of travelers are accurate. Tickets are
                            non-transferable
                            and name changes are not
                            permitted. Passenger names must match government-issued photo ID exactly.</p>
                        <p class="mb-2">Total price shown includes all applicable taxes and our fees. Some airlines may
                            charge
                            additional baggage fees or other
                            fees. Fares are not guaranteed until ticketed. Tickets and our fees are generally
                            non-refundable. A charge may incur for
                            any changes in the ticket issued. Date and routing changes will be subject to airline
                            penalties and our fees. We will
                            send your booking confirmation and e-tickets to the email address provided by you while
                            purchasing the product.</p>
                    </div>
                </div><!-- polices-review -->
                <div class="terms">
                    <label class="terms-condition-container" style="font-size: 16px;">
                        <input type="checkbox" class="terms-checkbox" name="check-payment"
                            id="TermsAndConditionsAccepted">
                        <span class="checkmark"></span>
                        &nbsp; By clicking on <span>"Pay Now"</span>,
                        I accept the
                        <a class="text-primary mx-1" target="_blank" href="/terms-conditions"> Terms &
                            Conditions</a> &
                        <a target="_blank" href="/privacy-policy" class="mx-1"> Privacy Policy</a>.
                        <span class="error-message text-danger d-none">Please accept the Terms & Conditions.</span>
                    </label>
                </div><!-- terms -->
                <div class="d-flex justify-content-end mt-3 mb-5">
                    <button type="submit" class="btn py-3 px-4"
                        style="background-color:#c72026; color: #fff; font-size: 20px;"><span><svg
                                xmlns="https://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-lock-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2" />
                            </svg></span> Pay Now</button>
                </div>


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
            // $(".toggle-details").click(function (event) {
            // event.preventDefault(); // يمنع إعادة تحميل الصفحة عند الضغط على الزر
            // $(this).next(".details").fadeToggle(200);
            // });

            // $(".close-details").click(function (event) {
            // event.preventDefault();
            // $(this).parent(".details").fadeOut(200);
            // });

            // // إغلاق التفاصيل عند النقر خارجها
            // $(document).click(function (event) {
            // if (!$(event.target).closest(".container-button").length) {
            // $(".details").fadeOut(200);
            // }
            // });

            $(".toggle-content").click(function () {
            $(this).next(".content").fadeToggle(200);
            });
            function updateProgress(currentStep) {
                $(".step").each(function (index) {
                    if (index + 1 < currentStep) {
                        $(this).addClass("completed").removeClass("active");
                    } else if (index + 1 === currentStep) {
                        $(this).addClass("active").removeClass("completed");
                    } else {
                        $(this).removeClass("active completed");
                    }
                });
            }

            updateProgress(3); // ✅ ضبط الخطوة الثالثة كـ "active" والخطوتين الأولى والثانية كـ "completed"

        //    $("button").click(function(event) {
        //     // console.log('clicked');
        //     event.preventDefault();
        //         $('payment_details').toggle();
        //     });



    });
    </script>

</x-front-layout>
