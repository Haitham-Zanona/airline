<x-front-layout>

    <x-slot name="styles">
        <style>
            #result1,
            #result2 {
                position: absolute;
                width: 20%;
                background: white;
                border: 1px solid #ccc;
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

            .hero {
                position: relative;
                /* لتحديد المرجع للعناصر المطلقة داخله */
                width: 100%;
                height: 100vh;
                /* يمكن التعديل حسب الحاجة */
                /* background: url('{{ asset(' assets/images/airport-section-hero.jpg') }}') no-repeat center center; */
                background-size: cover;
            }

            .search-form {
                position: absolute;
                /* تثبيت العنصر داخل .hero */
                top: 40%;
                left: 5%;
                /* جعله يأخذ مسافة صغيرة من اليسار */
                transform: translateY(-50%);
                /* لجعل المنتصف يظهر بشكل جيد */
                background: rgba(255, 255, 255, 0.8);
                /* خلفية شبه شفافة للحفاظ على وضوح النص */
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
                width: 40%;
                height: 50%;

            }
        </style>
    </x-slot>



    <section class="hero" style="background-image: url('{{ asset('assets/images/airport-section-hero.jpg') }}');">


        <div class="search-form">


            <form action="{{ route('flight.search') }}" method="POST">
                @csrf

                <div class="my-3" style="display: flex;">
                    <div style="width: 50%;">
                        <label for="origin_city" class="d-block font-weight-bold">From City/Airport</label>
                        <input type="text" id="search1" placeholder="Enter City Name" autocomplete="off"
                            style="width: 90%;">
                        <input type="hidden" name="origin_city" value="">
                        <input type="hidden" name="origin_city_name" id="origin_city_name">
                        <div id="result1" style="width: 90%;"></div>
                    </div><!-- originCity -->

                    <div style="width: 50%;">
                        <label for="destination_city" class="d-block font-weight-bold">To City/Airport</label>
                        <input type="text" id="search2" placeholder="Enter City Name" autocomplete="off"
                            style="width: 90%;">
                        <input type="hidden" name="destination_city" value="">

                        <input type="hidden" name="destination_city_name" id="destination_city_name">
                        <div id="result2" style="width: 90%;"></div>
                    </div><!-- destination_city -->
                </div>
                <div class="my-2">
                    <label class="font-weight-bold">Trip Type:</label>
                    <label class="font-weight-bold" for="oneWay">One-way</label>
                    <input type="radio" id="oneWay" name="tripType" value="oneWay" checked>

                    <label class="font-weight-bold" for="roundTrip">Round-trip</label>
                    <input type="radio" id="roundTrip" name="tripType" value="roundTrip">
                </div>
                <div class="row my-2">
                    <div class="col-md-6">
                        <div>
                            <label for="departureDate" class="d-block font-weight-bold">Departure Date</label>
                            <input style="width: 90%;" type="date" id="departureDate" name="departureDate" required>
                        </div>
                    </div><!-- col-md-6 -->
                    <div class="col-md-6">
                        <div id="returnDateContainer" style="display:none;">
                            <label for="returnDate" class="d-block font-weight-bold">Return Date</label>
                            <input style="width: 90%;" type="date" id="returnDate" name="returnDate">
                        </div>
                    </div><!-- col-md-6 -->
                </div><!-- row -->
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="">
                            <label for="adults" class="d-block font-weight-bold">Adults</label>
                            <input type="number" id="adults" name="adults" value="1" min="1" required>
                        </div>
                    </div><!-- col-md-6 -->
                    <div class="col-md-6">
                        <div class="">
                            <label for="cabin" class="d-block font-weight-bold">Class of travel</label>
                            <select name="cabin">
                                <option value="ECONOMY">Economy</option>
                                <option value="PREMIUM_ECONOMY">Premium Economy</option>
                                <option value="BUSINESS">Business</option>
                                <option value="FIRST">First Class</option>
                            </select>
                        </div>
                    </div><!-- col-md-6 -->
                </div><!-- row -->



                <div class="mt-4">
                    <button type="submit">Search Flights</button>
                </div>
            </form>




        </div>

    </section>

    <section class="features">
        <h2 class="text-center my-5">We Provide the Right Platform for Your Travel Plans</h2>

        <div class="container d-flex justify-content-center align-items-center my-4">
            <p class="text-center px-5 py-1" style="max-width: 90%; font-size: 1.2rem; line-height: 1.6;">
                Being an experienced travel company, we (farebuddies.com) know what travellers want,
                what excites their
                mood. And why
                they feel there is a lot more to explore than their native city.

                We don't claim we know it, but it is true, our itinerary planners can map your needs, your wish, and
                your vacation
                desires.When you pick exotic destinations to recharge and relax,we ensure holidays won't pinch your
                pocket.

                Travelling is not just about sightseeing or lazing on the beach, many things add to your memories.
                To
                make your tour an
                unforgettable experience, our dedicated team facilitates rich information about local markets,
                currency
                hubs, and
                eateries.

                Besides family travel, we also plan corporate tours. Deals on airfare offered by us surprise our
                competitors. Here in
                the most humble way we, would like to announce, once you choose us as your dedicated travel partner,
                your happiness
                becomes our priority.

                If you are planning a domestic trip, cultural trip, group travel, safari tours, romantic vacations,
                castle and knight
                tours, or want to visit a special destination to celebrate the achievement in your life, you
                can call us at +1-877-847-4278 or visit our website.

                We believe your vacations culminate in a happy note when you have the most trusted travel partner by
                your side.
            </p>
        </div>
    </section>
    <section class="partners py-5" @style([ 'background-color: #b9d1ca' ])>
        <div class="container">
            <h2 class="text-center my-4">Our Partners</h2>
            <div class="row mx-auto justify-content-center align-items-center mb-3">
                <div class="col-md-2 w-auto">
                    <img src="{{ asset('assets/images/Trustpilot.webp') }}" alt="Air Canada" height="100px"
                        width="100px" class="img-fluid">
                </div>
                <div class="col-md-2 w-auto">
                    <img src="{{ asset('assets/images/visa.webp') }}" alt="American Airlines" height="100px"
                        width="100px" class="img-fluid">
                </div>
                <div class="col-md-2 w-auto">
                    <img src="{{ asset('assets/images/mastercard.webp') }}" alt="Delta Airlines" height="100px"
                        width="100px" class="img-fluid">
                </div>
                <div class="col-md-2 w-auto">
                    <img src="{{ asset('assets/images/American Express.webp') }}" alt="Emirates" height="100px"
                        width="100px" class="img-fluid">
                </div>
                <div class="col-md-2 w-auto">
                    <img src="{{ asset('assets/images/Discover.webp') }}" alt="Emirates" height="100px" width="100px"
                        class="img-fluid">
                </div>
                <div class="col-md-2 w-auto">
                    <img src="{{ asset('assets/images/Paypal.webp') }}" alt="Emirates" height="100px" width="100px"
                        class="img-fluid">
                </div>
            </div><!-- row -->
            <div class="disclaimers">
                <p>
                    <span class="fw-bold">Disclaimer</span> The information provided by <span class="fw-bold">Fare
                        Buddy
                        LLC</span> (“Company”, “we”, “our”, “us”) on
                    farebuddies.com (the “Site”) is
                    for general informational purposes only. All information on the Site is provided in good
                    faith,
                    however we make no
                    representation or warranty of any kind, express or implied, regarding the accuracy,
                    adequacy,
                    validity, reliability,
                    availability, or completeness of any information on the Site.

                    UNDER NO CIRCUMSTANCE SHALL WE HAVE ANY LIABILITY TO YOU FOR ANY LOSS OR DAMAGE OF ANY KIND
                    INCURRED AS A RESULT OF THE
                    USE OF THE SITE OR RELIANCE ON ANY INFORMATION PROVIDED ON THE SITE. YOUR USE OF THE SITE
                    AND
                    YOUR RELIANCE ON ANY
                    INFORMATION ON THE SITE IS SOLELY AT YOUR OWN RISK.
                </p>
                <h5>EXTERNAL LINKS DISCLAIMER</h5>
                <p>The Site may contain (or you may be sent through the Site) links to
                    other websites or content belonging to or originating from third parties or links to websites
                    and features. Such external links are not investigated, monitored, or checked for accuracy,
                    adequacy, validity, reliability, availability or completeness by us. WE DO NOT WARRANT, ENDORSE,
                    GUARANTEE, OR ASSUME RESPONSIBILITY FOR THE ACCURACY OR RELIABILITY OF ANY INFORMATION OFFERED
                    BY THIRD-PARTY WEBSITES LINKED THROUGH THE SITE OR ANY WEBSITE OR FEATURE LINKED IN ANY BANNER
                    OR OTHER ADVERTISING. WE WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY
                    TRANSACTION BETWEEN YOU AND THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES.
                </p>
                <h5>ERRORS AND OMISSIONS DISCLAIMER</h5>
                <p>While we have made every attempt to ensure that the information contained in this
                    site has been obtained from reliable sources, Fare Buddy LLC is not responsible for any errors
                    or omissions or for the results obtained from the use of this information. All information in
                    this site is provided “as is”, with no guarantee of completeness, accuracy, timeliness or of the
                    results obtained from the use of this information, and without warranty of any kind, express or
                    implied, including, but not limited to warranties of performance, merchantability, and fitness
                    for a particular purpose. In no event will fare buddy LLC, its related partnerships or
                    corporations, or the partners, agents or employees thereof be liable to you or anyone else for
                    any decision made or action taken in reliance on the information in this Site or for any
                    consequential, special or similar damages, even if advised of the possibility of such damages.
                </p>
                <h5>LOGOS AND TRADEMARKS DISCLAIMER</h5>
                <p class="mb-0">All logos and trademarks of third parties referenced on
                    farebuddies.com are the trademarks and logos of their respective owners. Any inclusion of such
                    trademarks or logos does not imply or constitute any approval, endorsement or sponsorship of
                    Fare Buddies LLC by such owners. </p>
            </div>
        </div><!-- container -->
    </section><!-- partners -->



    <x-slot name="scripts">
        <script>
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
                                    $("#result1").show(); // إظهار القائمة عند وجود نتائج
                                    response.data.forEach(element => {
                                        $("#result1").append(`<p data-city-code="${element.address.cityCode}" style="color: #143ca1;" onmouseover="this.style.backgroundColor='#143ca1'; this.style.color='#fff';"
       onmouseout="this.style.backgroundColor='transparent'; this.style.color='#143ca1';">${element.address.cityName}, ${element.address.countryName}, ${element.address.countryCode} (${element.address.cityCode} - ${element.name})</p>`);
                                    });
                                } else {
                                    $("#result1").hide(); // إخفاء القائمة عند عدم وجود نتائج
                                    }
                                }
                                });
                            } else {
                                $("#result1").hide(); // إخفاء القائمة عند حذف الإدخال
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
                                        $("#result2").show(); // إظهار القائمة عند وجود نتائج
                                        response.data.forEach(element => {
                                        $("#result2").append(`<p data-city-code="${element.address.cityCode}" style="color: #143ca1;" onmouseover="this.style.backgroundColor='#143ca1'; this.style.color='#fff';"
       onmouseout="this.style.backgroundColor='transparent'; this.style.color='#143ca1';">${element.address.cityName}, ${element.address.countryName}, ${element.address.countryCode} (${element.address.cityCode} - ${element.name})</p>`);});
                                    } else {
                                        $("#result2").hide(); // إخفاء القائمة عند عدم وجود نتائج
                                    }
                                    }
                                });
                        } else {
                            $("#result2").hide(); // إخفاء القائمة عند حذف الإدخال
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
                            var code = $(this).attr('data-city-code');
                            var cityName = $(this).text();
                            $("[name='destination_city']").val(code);
                            $("#destination_city_name").val(cityName);
                          })
                          $(document).click(function(event) {
                            if (!$(event.target).closest("#result1").length) {
                                $("#result1").empty(); // يخفي العنصر
                            }
                            if (!$(event.target).closest("#result2").length) {
                                $("#result2").empty(); // يخفي العنصر
                            }
                        });


                          $('input[name="tripType"]').change(function() {
                        var tripType = $('input[name="tripType"]:checked').val();
                        var returnDateContainer = $('#returnDateContainer');

                        if (tripType === 'roundTrip') {
                        returnDateContainer.show(); // إظهار تاريخ العودة
                        } else {
                        returnDateContainer.hide(); // إخفاء تاريخ العودة
                        }
                        });

                        // ✅ تشغيل الدالة عند تحميل الصفحة لأول مرة للتحقق من الحالة الافتراضية
                        $('input[name="tripType"]:checked').trigger('change');

            });
        </script>
    </x-slot>

</x-front-layout>
