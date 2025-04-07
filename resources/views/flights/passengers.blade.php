<x-front-layout>

    <style>
        .progress-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #15406a;
            padding: 15px;
            color: white;
            font-weight: bold;
            position: relative;
        }

        .progress-container .step {
            position: relative;
            text-align: center;
            flex-grow: 1;
        }

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

        .progress-container .active .circle {
            background-color: #f0ad4e;
            color: white;
        }

        .progress-container .completed .circle {
            background-color: #28a745;
            color: white;
        }

        ul {
            list-style: none;
            /* إزالة التنقيط الافتراضي */
            padding-left: 0;
            /* إزالة أي مسافة غير مرغوب فيها */
        }

        ul li {
            display: flex;
            /* استخدام Flexbox لمحاذاة النقطة مع النص */
            /* align-items: center; */
            /* ضمان محاذاة رأسية صحيحة */
        }

        .important-note-list ul li::before {
            content: "•";
            /* رمز النقطة */
            color: #41479b;
            /* تغيير لون النقطة */
            font-size: 1.2em;
            /* تكبير حجم النقطة */
            font-weight: bold;
            /* جعلها واضحة */
            margin-right: 8px;
            /* توفير مسافة بين النقطة والنص */
        }

        ul li p {
            margin: 0;
            padding: 5px 0;
        }

        .required:invalid {
            border-color: red;
        }

        .error-text {
            color: red;
            font-size: 12px;
            display: none;
        }

        .form-header {
            background-color: #0D5EA5;
            color: white;
            padding: 10px;
            font-weight: bold;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        .form-header i {
            margin-right: 8px;
        }

        .row .col-md-1 label,
        .row .col-md-2 label,
        .row .col-md-3 label {
            font-weight: bold;
            font-size: 15px;
        }


        .flight-details-container {
            width: 100%;
            max-width: 350px;

            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            transition: all 0.3s ease-in-out;
            position: sticky;
            top: 0;
        }

        .flight-details {
            transition: all 0.3s ease-in-out;
        }



        .bottom-stop {
            position: absolute;
            bottom: auto;
            top: auto;
        }

        /* تحريك السهم عند الفتح والإغلاق */
        .arrow.rotate {
            transform: rotate(180deg);
        }





        /* ✅ عند العودة لأعلى، يعود العنصر إلى مكانه الطبيعي */
        .original-position {
            position: relative;
            bottom: auto;
            left: auto;
            transform: none;
            box-shadow: none;
        }

        /* ✅ أنماط زر فتح/إغلاق القوائم */
        .toggle-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
            transition: background 0.3s ease-in-out;
        }

        .toggle-section:hover {
            background: #f8f8f8;
        }

        /* ✅ أنماط القوائم المخفية */
        .section-content {
            display: none;
            padding: 10px;
            font-size: 14px;
            color: #555;
        }

        /* ✅ تحريك السهم عند فتح وإغلاق القائمة */
        .arrow-icon {
            transition: transform 0.3s ease-in-out;
        }

        .arrow-icon.rotate {
            transform: rotate(180deg);
        }

        /* ✅ تحسينات عامة على الأزرار */
        .continue-booking {
            width: 100%;
            background: #e60000;
            color: white;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .continue-booking:hover {
            background: #c40000;
        }

        /* ✅ تحسينات على مؤشر الضمان */
        .price-guarantee {
            display: flex;
            align-items: center;
            background: #e6f7e6;
            color: #008000;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        /* ✅ أيقونة الصح بجانب الضمان */
        .price-guarantee i {
            margin-right: 5px;
        }

        /* ✅ تحسينات عامة على النصوص */
        .flight-details-container h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .flight-details-container p {
            font-size: 14px;
            color: #555;
        }

        .filter-section {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .filter-header {
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .filter-content {
            display: none;
            margin-top: 10px;
        }
    </style>



    <div class="progress-container">
        <div class="step completed">
            <span class="circle">1</span>
            <p>SEARCH RESULT</p>
        </div>
        <div class="step active">
            <span class="circle">2</span>
            <p>PASSENGER</p>
        </div>
        <div class="step">
            <span class="circle">3</span>
            <p>PAYMENT</p>
        </div>
        <div class="step">
            <span class="circle">4</span>
            <p>CONFIRM</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9 d-flex align-items-center">
            <div class="mx-2 d-inline-block">
                <img src="{{ asset('assets/images/shield.jpg') }}" class="m-0" height="50" width="50" alt="lock">
            </div>
            <div class="my-3 d-inline-block" style="color: #15406a;">
                <h4 class="m-0 p-0">Secure Booking</h4>
                <p class="m-0">We use secure transmission and encrypted storage to protect your personal information!
                </p>
            </div>
        </div><!-- col-md-9 -->

        <div class="col-md-3 d-flex align-items-center">
            <div class="mx-2 d-inline-block">
                <img src="{{ asset('assets/images/call.jpg') }}" class="m-0" height="50" width="50" alt="lock">
            </div>
            <div class="my-3 d-inline-block" style="color: #15406a;">
                <p class="m-0 p-0">Need Any Help?</p>
                <p class="m-0">Call Now +1-877-847-4278</p>
            </div>
        </div><!-- col-md-3 -->
    </div><!-- row -->
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
                <div class="important-note p-2" style="background-color: #1165a2; color: #fff;">

                    <h2 class="m-0 d-inline-block" style="font-size: 20px;"><span><svg
                                xmlns="https://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-journal-text mr-1" viewBox="0 0 16 16">
                                <path
                                    d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                                <path
                                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                                <path
                                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                            </svg></span> Important Note</h2>
                </div><!-- important-note -->
                <div class="important-note-list px-3">
                    <ul class="my-3">
                        <li>
                            <p>Please ensure that the names of all passengers are entered precisely as it appears on
                                their
                                passport. Any changes
                                notified later may incur a fee. However, in some cases the Airline does not allow
                                changes
                                and may demand a full
                                re-purchase of the product.</p>
                        </li>
                        <li>
                            <p>We need your mobile number so that we can call or text you if there would be any change
                                to
                                your itinerary or to provide
                                helpful information about your trip.</p>
                        </li>
                        <li>
                            <p>Your credentials are safe with us. Kindly <span><a href="#">click here</a></span> to know
                                our
                                privacy policy.</p>
                        </li>

                    </ul>
                </div><!-- important-note-list -->
                <div class="passenger-title p-2" style="background-color: #1165a2; color: #fff;">

                    <h2 class="m-0 d-inline-block" style="font-size: 20px;"><span><svg
                                xmlns="https://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-person-circle mr-1" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg></span> Passenger Information</h2>
                </div><!-- passenger-title -->
                <div class="passenger-info px-2">
                    <h3 style="color: #524c61; font-size: 13px;">Adults: 1</h3>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="me-3 mr-5"><input type="radio" name="gender" checked>
                                <strong>Male</strong></label>
                            <label><input type="radio" name="gender"> <strong>Female</strong></label>
                        </div>
                    </div>


                    <div class="row g-2 mb-5">
                        <div class="col-md-1 p-0 pl-2">
                            <label class="form-label mb-3" style="display: inline-block;">Title <span
                                    class="text-danger">*</span></label>
                            <select class="form-select required" style="display: block; width: 100%;">
                                <option value="">Select</option>
                                <option>Mr</option>
                                <option>Mrs</option>
                                <option>Ms</option>
                            </select>
                            <span class="error-text">Please select a title</span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" placeholder="Enter First Name">
                            <span class="error-text">Enter First Name</span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" placeholder="Enter Last Name">
                            <span class="error-text">Enter Last Name</span>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                            <input type="text" class="form-control required" placeholder="MM-DD-YYYY">
                            <span class="error-text">Enter Date of Birth</span>
                        </div>
                    </div>
                </div><!-- passenger-info -->
                <div class="contact-details p-2" style="background-color: #1165a2; color: #fff;">

                    <h2 class="m-0 d-inline-block" style="font-size: 20px; color: #fff;"><span><svg width="20"
                                height="20" viewBox="0 0 24 24" fill="white" xmlns="https://www.w3.org/2000/svg">
                                <path
                                    d="M6.62 10.79a15.72 15.72 0 006.59 6.59l2.2-2.2a1 1 0 011.06-.23 11.05 11.05 0 003.47.56 1 1 0 011 1v3.65a1 1 0 01-1 1A19 19 0 013 5a1 1 0 011-1h3.65a1 1 0 011 1 11.05 11.05 0 00.56 3.47 1 1 0 01-.23 1.06z" />
                            </svg></span> Contact Details</h2>
                </div><!-- passenger-title -->
                <div class="row g-2 mb-5 mt-2 px-2">
                    <div class="col-md-6">
                        <label class="form-label font-weight-bold">Mobile Number <span
                                class="text-danger">*</span></label>
                        <input type="tel" class="form-control required" placeholder="Enter Mobile Number">
                        <span class="error-text">Enter Mobile Number</span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label font-weight-bold">Email Address <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control required" placeholder="Enter Email Address">
                        <span class="error-text">Enter Email Address</span>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>



            </div><!-- col-md-9 -->
            <div class="col-md-3">


                <div class="filter-section">
                    <div class="filter-header" data-toggle="collapse" data-target="#stops-filter">Stops <span>▼</span>
                    </div>
                    <div class="filter-content collapse show" id="stops-filter">
                        <button class="btn btn-primary filter-stop" data-value="direct">Direct $576.60</button>
                        <button class="btn btn-primary filter-stop" data-value="1stop">1 Stop $625.30</button>
                    </div>
                </div>
                <div class="flight-details-container">
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


    <script>
        $(document).ready(function () {

            // ✅ تحديث شريط التقدم بناءً على المرحلة الحالية
            function updateProgress(currentStep) {
                $(".step").each(function (index) {
                    if (index + 1 < currentStep) {
                        $(this).addClass("completed").removeClass("active");
                    } else if (index + 1 === currentStep) {
                        $(this).addClass("active");
                    } else {
                        $(this).removeClass("active completed");
                    }
                });
            }

            updateProgress(2); // ضبط الخطوة الحالية

            $(".filter-header").click(function () {
                $(this).next(".filter-content").slideToggle();
                $(this).find("span").text($(this).next(".filter-content").is(":visible") ? "▼" : "▲");
                });
            $(".filter-stop").click(function () {
                let selectedStop = $(this).data("value");
                console.log("تم اختيار عدد التوقفات:", selectedStop);
                // هنا يمكنك استدعاء وظيفة لجلب البيانات بناءً على الفلتر المحدد
            });
        });


    </script>


</x-front-layout>
