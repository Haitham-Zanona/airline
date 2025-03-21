<x-front-layout>
    <x-slot name="styles">
        <style>
            * {
                max-width: 100%;
                box-sizing: border-box;
            }

            .pagination {
                justify-content: center;
                text-align: center;
            }

            .pagination svg {
                display: none !important;
                /* إخفاء أي أيقونات SVG */
            }

            .pagination .page-link {

                font-size: 14px;
                /* تصغير حجم أرقام الترقيم */
                padding: 5px 10px;
                /* ضبط التباعد */
            }

            .card {
                width: 100%;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #fff;
                /* padding: 15px; */
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                display: flex;
                flex-direction: row;
                /* align-items: center; */
                align-content: center;
                border-right: 2px solid #ddd;
                box-sizing: border-box;
                overflow: hidden;
                margin-bottom: 20px;

            }

            .card .row {
                width: 100%;
                display: flex;
                align-items: center;
                box-sizing: border-box;
            }

            .col-md-9,
            .col-md-3 {
                padding: 10px;
                box-sizing: border-box;
            }



            .stop-circle {
                width: 12px;
                height: 12px;
                background-color: #f39c12;
                border-radius: 50%;
                position: absolute;
                left: 50%;
                top: -5px;
                transform: translateX(-50%);
                z-index: 10;
                border: 2px solid white;
            }


            .return-flight {
                border-top: 1px solid #ddd;
                padding-top: 15px;
            }


            .flight-stop {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .stop-text {
                font-size: 14px;
                color: #f39c12;
                font-weight: bold;
            }

            .stop-line {
                width: 50px;
                height: 2px;
                background-color: #ccc;
                position: relative;
                margin: 5px 0;
            }



            .stop-line::before,
            .stop-line::after {
                content: "";
                width: 40px;
                /* طول الخط */
                height: 2px;
                background-color: #ccc;
                position: absolute;
                top: 50%;
            }

            .stop-line::before {
                left: 0;
            }

            .stop-line::after {
                right: 0;
            }



            .stop-duration {
                font-size: 14px;
                font-weight: bold;
                margin-top: 5px;
                color: #333;
            }


            .flight-divider {
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                width: 100%;
            }

            .flight-divider::before,
            .flight-divider::after {
                content: "";
                flex: 1;
                height: 1px;
                background-color: gray;
                margin: 0 10px;
            }

            .plane-icon {
                font-size: 18px;
                color: gray;
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

            .slider-container {
                padding: 10px 0;
            }

            .ui-slider {
                position: relative;
                text-align: left;
            }

            .ui-slider-handle {
                width: 16px;
                height: 16px;
                background: #007bff;
                border-radius: 50%;
                position: absolute;
                cursor: pointer;
            }

            .checkbox-group {
                list-style: none;
                padding: 0;
            }

            .checkbox-group li {
                margin-bottom: 5px;
            }

            .support {
                text-align: center;
                margin-top: 20px;
                padding: 15px 2px 10px;
                background-color: #fff;
                border: 2px solid #000000;
                border-radius: 3px;
            }

            .support h1 {
                font-weight: 700;
                font-size: 22px;
                color: #000;
                margin-top: 0;
                margin-bottom: 20px !important;
            }

            .support ul {
                border-top: 2px solid #000000;
                margin: 0;
                padding: 8px 21px;
                list-style: none;
            }

            .support ul li {
                font-size: 18px;
                line-height: 23px;
                color: #333;
                padding: 8px 15px;
                text-align: left;
                position: relative;
            }

            .support ul li span {
                display: inline-block;
                padding-left: 30px;
            }

            .support ul li img {
                position: absolute;
                top: 0;
                left: -15px;
            }
        </style>
    </x-slot>


    {{-- @dd($flightOffers[1]['travelerPricings'][0]['fareDetailsBySegment'][0]['amenities']) --}}

    {{-- @dd($flightOffers) --}}
    {{-- @php

    جمع جميع أكواد شركات الطيران الموجودة في الرحلات
    $airlineCodes = [];
    foreach ($flightOffers as $flight) {
    if (!empty($flight['validatingAirlineCodes'][0])) {
    $airlineCodes[] = $flight['validatingAirlineCodes'][0];
    }
    }
    إزالة الأكواد المكررة لتقليل عدد الطلبات
    $airlineCodes = array_unique($airlineCodes);
    @endphp--}}

    {{-- @foreach($flightOffers as $flight)
    <div class="flight-result">
        <p><strong>رقم الرحلة:</strong> {{ $flight['id'] }}</p>
        <p><strong>شركة الطيران:</strong>
            <span class="airline-name" data-code="{{ $flight['validatingAirlineCodes'][0] ?? '' }}">
                جاري التحميل...
            </span>
        </p>
        <hr>
    </div>
    @endforeach

    <div class="pagination">
        {{ $flightOffers->links() }}
    </div> --}}
    <div class="flight-info d-flex justify-content-between text-white p-3"
        style="background-color: #1165a2; font-size: 14px;">
        <div class="flight-info__item">
            {{-- @dd($flightData) --}}
            <span>{{ $flightData['originCityName'] }} <svg xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="25" height="25"
                    viewBox="0 0 256 256" xml:space="preserve">

                    <defs>
                    </defs>
                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                        transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                        <path
                            d="M 85.174 42.182 c -0.807 -0.3 -1.456 -0.854 -1.879 -1.603 c -2.018 -3.575 -5.379 -4.105 -7.731 -4.192 C 65 35.994 56.3 35.844 48.611 35.961 L 24.165 21.114 c -1.166 -0.708 -2.503 -1.082 -3.867 -1.082 h -3.982 c -1.427 0 -2.71 0.848 -3.27 2.161 c -0.559 1.312 -0.282 2.825 0.713 3.862 l 11.082 11.418 c -1.794 0.214 -3.585 0.449 -5.39 0.71 c -1.065 0.154 -2.172 -0.212 -2.952 -0.979 l -6.496 -6.381 C 8.728 29.557 7.036 28.86 5.24 28.86 H 3.467 c -0.968 0 -1.859 0.441 -2.446 1.211 c -0.587 0.77 -0.777 1.747 -0.521 2.68 L 3.383 43.26 l 0.128 0.395 c 0.291 0.9 0.553 1.698 0.913 2.407 l -3.695 3.85 c -0.727 0.757 -0.931 1.871 -0.519 2.837 c 0.412 0.967 1.356 1.591 2.406 1.591 h 1.578 c 0.76 0 1.506 -0.209 2.163 -0.607 l 6.088 -3.716 c 4.501 1.033 8.72 1.74 12.502 2.273 L 13.753 63.952 c -0.988 1.029 -1.266 2.542 -0.706 3.854 c 0.559 1.313 1.843 2.161 3.27 2.161 h 3.982 c 1.365 0 2.703 -0.375 3.867 -1.083 l 24.188 -14.689 h 34.877 c 0.166 0 0.327 -0.021 0.48 -0.059 c 5.813 -0.549 6.29 -4.835 6.29 -6.211 C 90 45.013 87.4 43.012 85.174 42.182 z M 17.371 24.032 h 2.927 c 0.631 0 1.25 0.173 1.791 0.501 l 19.159 11.636 c -3.964 0.167 -7.702 0.419 -11.356 0.764 L 17.371 24.032 z M 82.424 50.195 H 54.939 l 1.651 -1.003 c 0.944 -0.573 1.245 -1.803 0.671 -2.747 c -0.572 -0.943 -1.803 -1.244 -2.747 -0.671 L 22.087 65.467 c -0.539 0.328 -1.157 0.501 -1.789 0.501 h -2.936 l 16.412 -17.1 c 0.765 -0.797 0.739 -2.063 -0.058 -2.828 c -0.797 -0.764 -2.064 -0.739 -2.828 0.059 l -2.508 2.613 c -3.291 -0.422 -6.986 -0.953 -10.967 -1.729 l 0.454 -0.277 c 0.943 -0.576 1.241 -1.807 0.665 -2.75 s -1.807 -1.242 -2.749 -0.665 l -7.581 4.61 l 1.457 -1.518 c 0.765 -0.797 0.739 -2.063 -0.058 -2.828 c -0.565 -0.543 -1.364 -0.68 -2.055 -0.434 c -0.071 -0.212 -0.146 -0.44 -0.23 -0.698 l -2.64 -9.563 H 5.24 c 0.734 0 1.426 0.285 1.954 0.809 l 6.502 6.388 c 1.666 1.637 4.029 2.417 6.327 2.084 c 15.539 -2.24 30.034 -2.699 55.392 -1.758 c 1.993 0.074 3.048 0.532 3.752 1.271 h -3.715 c -1.104 0 -2 0.896 -2 2 s 0.896 2 2 2 h 7.748 c 0.193 0.091 0.377 0.2 0.579 0.275 C 85.107 46.426 86 47.362 86 47.926 C 86 48.662 86 50.195 82.424 50.195 z"
                            style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(243, 242, 242); fill-rule: nonzero; opacity: 1;"
                            transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                    </g>
                </svg> {{ $flightData['destinationCityName'] }}</span>
            <div>
                <span>{{ \Carbon\Carbon::parse($flightData['departureDate'])->translatedFormat('l d F Y') }} <span
                        style="color: #000"> |
                    </span>
                </span><span>{{ \Carbon\Carbon::parse($flightData['returnDate'] ?? '')->translatedFormat('l d F Y') }}
                    <span style="color: #000"> | </span>
                </span><span>{{ $flightData['adults'] }} Adults</span>
            </div>
        </div>
        <div class="modify-seaarch">
            <button type="button" class="btn btn-danger p-3" onclick="window.location.href='/';">Modify Search</button>
        </div>
    </div>
    <div class="row">
        {{-- <div class="col-md-3">
            <div class="filter-section">
                <div class="filter-header" data-toggle="collapse" data-target="#stops-filter">Stops <span>▼</span></div>
                <div class="filter-content collapse show" id="stops-filter">
                    <button class="btn btn-primary filter-stop" data-value="direct">Direct $576.60</button>
                    <button class="btn btn-primary filter-stop" data-value="1stop">1 Stop $625.30</button>
                </div>
            </div>


            <div class="filter-section">
                <div class="filter-header" data-toggle="collapse" data-target="#flight-time-filter">Flight Time
                    <span>▼</span>
                </div>
                <div class="filter-content collapse show" id="flight-time-filter">
                    <p>Outbound Flight</p>
                    <div class="slider-container">
                        <div id="outbound-slider"></div>
                    </div>
                    <p>Inbound Flight</p>
                    <div class="slider-container">
                        <div id="inbound-slider"></div>
                    </div>
                </div>
            </div>

            <div class="filter-section">
                <div class="filter-header" data-toggle="collapse" data-target="#flight-price-filter">Flight Price
                    <span>▼</span>
                </div>
                <div class="filter-content collapse show" id="flight-price-filter">
                    <p id="price-range">$576.6 - $813.01</p>
                    <div class="slider-container">
                        <div id="price-slider"></div>
                    </div>
                </div>
            </div>

            <div class="filter-section">
                <div class="filter-header" data-toggle="collapse" data-target="#airline-filter">Preferred Airline
                    <span>▼</span>
                </div>
                <div class="filter-content collapse show" id="airline-filter">
                    <ul class="checkbox-group">
                        <li><input type="checkbox" class="filter-airline" value="JetBlue"> JetBlue $576.60</li>
                        <li><input type="checkbox" class="filter-airline" value="American Airlines"> American Airlines
                            $621.98</li>
                    </ul>
                </div>
            </div>
            <div class="support mx-1">
                <h1>Why book with us?</h1>
                <ul>
                    <li class="mx-1"><img src="{{ asset('assets/images/icon-support.webp') }}" width="55px"
                            alt=""><span>Live 24/7
                            Support</span>
                    </li>
                    <li class="mx-1 my-4"><img src="{{ asset('assets/images/icon-voucher.webp') }}" width="55px"
                            alt=""><span>Big Savings + Great Coupon Codes</span></li>
                </ul>
            </div><!-- support -->
        </div><!-- col-md-3 --> --}}

        <div class="col-md-12">
            <div class="limited-offer d-flex align-items-center m-2">
                <div class="svg-icon-clock d-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        width="70" height="70" viewBox="0 0 256 256" xml:space="preserve">

                        <defs>
                        </defs>
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                            transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                            <path
                                d="M 58.033 76.551 c -14.277 0 -25.893 -11.616 -25.893 -25.894 c 0 -14.278 11.616 -25.894 25.893 -25.894 s 25.894 11.616 25.894 25.894 C 83.927 64.935 72.311 76.551 58.033 76.551 z M 58.033 27.763 c -12.623 0 -22.893 10.27 -22.893 22.894 s 10.27 22.894 22.893 22.894 c 12.624 0 22.894 -10.27 22.894 -22.894 S 70.657 27.763 58.033 27.763 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(26,201,230); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 41.449 52.157 h -1.641 c -0.829 0 -1.5 -0.672 -1.5 -1.5 s 0.671 -1.5 1.5 -1.5 h 1.641 c 0.829 0 1.5 0.672 1.5 1.5 S 42.278 52.157 41.449 52.157 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(26,201,230); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 76.778 52.157 h -1.642 c -0.828 0 -1.5 -0.672 -1.5 -1.5 s 0.672 -1.5 1.5 -1.5 h 1.642 c 0.828 0 1.5 0.672 1.5 1.5 S 77.606 52.157 76.778 52.157 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(26,201,230); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 58.293 70.642 c -0.828 0 -1.5 -0.672 -1.5 -1.5 v -1.641 c 0 -0.828 0.672 -1.5 1.5 -1.5 s 1.5 0.672 1.5 1.5 v 1.641 C 59.793 69.97 59.121 70.642 58.293 70.642 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(26,201,230); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 58.293 35.313 c -0.828 0 -1.5 -0.671 -1.5 -1.5 v -1.641 c 0 -0.829 0.672 -1.5 1.5 -1.5 s 1.5 0.671 1.5 1.5 v 1.641 C 59.793 34.642 59.121 35.313 58.293 35.313 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(26,201,230); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 70.497 45.294 c -0.326 -0.761 -1.207 -1.113 -1.971 -0.785 l -6.856 2.95 c -0.892 -1.014 -2.184 -1.667 -3.637 -1.667 c -0.529 0 -1.029 0.106 -1.506 0.263 l -8.545 -11.684 c -0.489 -0.669 -1.428 -0.814 -2.096 -0.326 c -0.669 0.489 -0.814 1.428 -0.326 2.096 L 54.1 47.819 c -0.58 0.801 -0.931 1.777 -0.931 2.839 c 0 2.683 2.182 4.864 4.864 4.864 s 4.865 -2.182 4.865 -4.864 c 0 -0.151 -0.031 -0.294 -0.045 -0.441 l 6.858 -2.951 C 70.473 46.938 70.824 46.056 70.497 45.294 z M 58.033 52.521 c -1.028 0 -1.864 -0.836 -1.864 -1.864 s 0.836 -1.865 1.864 -1.865 s 1.865 0.837 1.865 1.865 S 59.062 52.521 58.033 52.521 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(26,201,230); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 63.292 19.131 v -3.22 c 1.786 -0.55 3.097 -2.197 3.097 -4.161 c 0 -2.412 -1.962 -4.374 -4.373 -4.374 h -7.964 c -2.412 0 -4.374 1.962 -4.374 4.374 c 0 1.964 1.31 3.61 3.097 4.161 v 3.226 c -12.643 2.14 -23.157 11.844 -25.965 24.64 c -0.177 0.809 0.334 1.609 1.144 1.787 c 0.805 0.172 1.609 -0.335 1.787 -1.144 c 2.889 -13.17 14.789 -22.729 28.293 -22.729 C 74.006 21.69 87 34.685 87 50.657 c 0 15.972 -12.994 28.966 -28.967 28.966 c -13.503 0 -25.401 -9.558 -28.292 -22.725 c -0.179 -0.81 -0.979 -1.326 -1.787 -1.144 c -0.809 0.178 -1.321 0.978 -1.144 1.786 c 3.191 14.533 16.322 25.082 31.223 25.082 C 75.66 82.623 90 68.283 90 50.657 C 90 34.822 78.424 21.647 63.292 19.131 z M 54.052 10.376 h 7.964 c 0.757 0 1.373 0.616 1.373 1.374 s -0.616 1.373 -1.373 1.373 h -7.964 c -0.758 0 -1.374 -0.616 -1.374 -1.373 S 53.294 10.376 54.052 10.376 z M 55.774 18.779 v -2.655 h 4.518 v 2.656 c -0.747 -0.052 -1.499 -0.089 -2.259 -0.089 C 57.275 18.69 56.523 18.725 55.774 18.779 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(26,201,230); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 28.276 52.157 H 1.5 c -0.829 0 -1.5 -0.672 -1.5 -1.5 s 0.671 -1.5 1.5 -1.5 h 26.776 c 0.829 0 1.5 0.672 1.5 1.5 S 29.105 52.157 28.276 52.157 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(26,201,230); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 23.675 42.934 H 6.283 c -0.829 0 -1.5 -0.671 -1.5 -1.5 s 0.671 -1.5 1.5 -1.5 h 17.392 c 0.829 0 1.5 0.671 1.5 1.5 S 24.503 42.934 23.675 42.934 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(26,201,230); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 23.675 61.38 H 6.283 c -0.829 0 -1.5 -0.672 -1.5 -1.5 s 0.671 -1.5 1.5 -1.5 h 17.392 c 0.829 0 1.5 0.672 1.5 1.5 S 24.503 61.38 23.675 61.38 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(26,201,230); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        </g>
                    </svg>
                </div>
                <div class="d-inline-block m-3">
                    <span style="color: #143ca1; font-weight: 500;">Limited Period Offer</span>
                    <p><span style="color: #fac269; font-weight: 500;">Call us and Save Up To 35%* </span>on Flight
                        Deals with our
                        Call-Only Offer!</p>
                </div>
            </div><!-- limited-offer -->




            @forelse ($flightOffers as $flight)
            <div class="card">
                <div class="row">

                    <div class="col-md-9 my-2">

                        <div class="row align-items-center text-center">

                            <div class="col-md-5 d-flex justify-content-center align-items-center px-1">
                                <div>
                                    <strong class="mr-3" style="font-size: 24px; color: #003877;">{{
                                        $flight['validatingAirlineCodes'][0] }}</strong>
                                    <span class="mr-3">{{
                                        $flight['itineraries'][0]['segments'][0]['departure']['iataCode']
                                        }}</span>
                                    <?php
                                                                                        $departureTime = $flight['itineraries'][0]['segments'][0]['departure']['at'];
                                                                                        $datetime = \Carbon\Carbon::parse($departureTime);
                                                                                    ?>
                                    <strong class="time me-2 mr-1" style="font-size: 18px; font-weight: bold;">{{
                                        $datetime->format('H:i')
                                        }}</strong>
                                    <span class="date" style="font-size: 14px; color: #666;">{{
                                        $datetime->translatedFormat('D d M')
                                        }}</span>
                                </div>
                            </div>


                            <div class="col-md-2 d-flex flex-column align-items-center">
                                <div class="position-relative d-flex flex-column align-items-center">
                                    <span class="stop-text text-warning fw-bold">
                                        {{ $flight['outbound_stops_text'] }} stop
                                    </span>
                                    <div class="stop-line">
                                        <span class="stop-circle"></span>
                                    </div>
                                </div>
                                <span class="stop-duration fw-bold">{{ $flight['itineraries'][0]['duration'] }}</span>
                            </div>


                            <div class="col-md-5 d-flex justify-content-center align-items-center">
                                <span class="mr-3">{{ $flight['itineraries'][1]['segments'][0]['departure']['iataCode']
                                    }}</span>
                                <?php
                                                        $arrivalTime = $flight['itineraries'][0]['segments'][0]['arrival']['at'];
                                                        $datetime = \Carbon\Carbon::parse($arrivalTime);
                                                    ?>
                                <strong class="time me-2 mr-1" style="font-size: 18px">{{ $datetime->format('H:i')
                                    }}</strong>
                                <span class="date" style="font-size: 14px;">{{ $datetime->translatedFormat('D d M')
                                    }}</span>
                            </div>
                        </div>


                        <div class="row return-flight d-flex align-items-center text-center">

                            <div class="col-md-5 d-flex justify-content-center align-items-center ">
                                <div>
                                    <strong class="mr-3" style="font-size: 24px; color: #003877;">{{
                                        $flight['validatingAirlineCodes'][0] }}</strong>
                                    <span class="mr-3">{{
                                        $flight['itineraries'][1]['segments'][0]['departure']['iataCode'] }}</span>
                                    <?php
                                                                                        $departureTime = $flight['itineraries'][1]['segments'][0]['departure']['at'];
                                                                                        $datetime = \Carbon\Carbon::parse($departureTime);
                                                                                    ?>
                                    <strong class="time me-2 mr-1" style="font-size: 18px">{{ $datetime->format('H:i')
                                        }}</strong>
                                    <span class="date" style="font-size: 14px;">{{ $datetime->translatedFormat('D d M')
                                        }}</span>
                                </div>
                            </div>


                            <div class="col-md-2 d-flex flex-column align-items-center">
                                <div class="position-relative d-flex flex-column align-items-center">
                                    <span class="stop-text text-warning font-weight-bold">
                                        {{-- {{ $flight['inbound_stops_text'] }} stop --}}
                                        {{-- {{ $flight['departure_airport_info']['name'] }} --}}
                                    </span>
                                    <div class="stop-line">
                                        <span class="stop-circle"></span>
                                    </div>
                                </div>

                                <span class="stop-duration fot-weight-bold">{{ $flight['itineraries'][1]['duration']
                                    }}</span>
                            </div>


                            <div class="col-md-5 d-flex justify-content-center align-items-center">
                                <span class="mr-3">{{
                                    $flight['itineraries'][1]['segments'][0]['arrival']['iataCode'] }}</span>
                                <?php
                                                                                    $arrivalTime = $flight['itineraries'][1]['segments'][0]['arrival']['at'];
                                                                                    $datetime = \Carbon\Carbon::parse($arrivalTime);
                                                                                ?>
                                <strong class="time me-2 mr-1" style="font-size: 18px">{{ $datetime->format('H:i')
                                    }}</strong>
                                <span class="date" style="font-size: 14px;">{{ $datetime->translatedFormat('D d M')
                                    }}</span>
                            </div>
                        </div>



                    </div><!-- col-md-9 -->

                    <div class="col-md-3 me-3"
                        style="border-left: 2px solid #ddd; box-sizing: border-box; overflow: hidden;">
                        <div class="d-flex flex-column align-items-center p-4">
                            <span class="font-weight-bold" style="font-size: 18px; color: #41479B;">{{
                                $flight['price']['total']
                                }} {{ $flight['price']['currency'] }}</span>
                            <p class="m-0 font-weight-bold" style="font-size: 12px;">Per Person</p>
                            <button class="btn mt-2 py-3 px-5 font-weight-bold"
                                style="background-color: #f15a22; color: #fff; font-size: 18px;">Book
                                Now</button>
                        </div>
                    </div><!-- col-md-3 -->
                </div><!-- row -->


                <div class="row g-0 m-0 p-0">
                    <div class="col-md-12 p-0">
                        <div class="details-header"
                            style="background-color: #1165a2; color: #fff; padding: 8px 10px; display: flex;">
                            <img src="{{ asset('assets/images/outbound.webp') }}" width="20px" height="20px"
                                class="mr-3" alt="">
                            <h5 style="font-size: 14px;">Outbound Flight
                                {{ trim(explode(",", $flightData['originCity'])[0]) }} <span style="color:#ffc107;">
                                    TO
                                </span> {{ trim(explode(",", string: $flightData['destinationCity'])[0]) }}</h5>
                        </div><!-- details-header -->

                        <div class="row g-0 m-0 p-0">
                            <div class="col-md-2 px-3" style="text-align: left;">
                                <span class="d-block font-weight-bold" style="color: #003877; font-size: 18px;">{{
                                    $flight['itineraries'][0]['segments'][0]['carrierCode']
                                    }}</span>
                                <span class="d-block" style="font-size: 13px;">{{
                                    $flight['itineraries'][0]['segments'][0]['number'] }}</span>
                                <span class="d-block" style="font-size: 13px;">{{ $flightData['cabin'] }}</span>
                            </div><!-- col-md-2 -->

                            <div class="col-md-3">

                                <?php
                                                        $departureTime = $flight['itineraries'][0]['segments'][0]['departure']['at'];
                                                        $datetime = \Carbon\Carbon::parse($departureTime);
                                                    ?>
                                <span class="time me-2 mr-1 d-block" style="font-size: 14px">
                                    {{ $datetime->translatedFormat('D d M Y H:i') }}
                                </span>

                                <span class="d-block" style="font-size: 12px;">{{ $flightData['originCity'] }}</span>
                                <span class="d-block" style="font-size: 14px;">Terminal {{
                                    $flight['itineraries'][0]['segments'][0]['departure']['terminal']
                                    }}</span>
                            </div><!-- col-md-3 -->

                            <div class="col-md-4">
                                <div class="flight-divider">
                                    <span class="plane-icon">✈</span>
                                </div>
                            </div><!-- col-md-3 -->

                            <div class="col-md-3">
                                <div class="arrival-info">
                                    <?php
                                                            $departureTime = $flight['itineraries'][0]['segments'][0]['arrival']['at'];
                                                            $datetime = \Carbon\Carbon::parse($departureTime);
                                                        ?>
                                    <span class="time me-2 mr-1 d-block" style="font-size: 14px">
                                        {{ $datetime->translatedFormat('D d M Y H:i') }}
                                    </span>
                                    <span style="d-block; font-size: 12px;">{{ $flightData['destinationCity']
                                        }}</span>
                                </div><!-- arrival-info -->
                                <div class="font-weight-bold"
                                    style="text-align: right; color: #143ca1; font-size: 14px;">
                                    <span>Actual Time : {{ $flight['itineraries'][0]['segments'][0]['duration']}}</span>
                                </div>
                            </div><!-- col-md-3 -->

                        </div><!-- row -->

                        <div class="details-header"
                            style="background-color: #1165a2; color: #fff; padding: 8px 10px; display: flex;">
                            <img src="{{ asset('assets/images/inbound.webp') }}" width="20px" height="20px" class="mr-3"
                                alt="">
                            <h5 style="font-size: 14px;">Inbound Flight |{{
                                $flight['itineraries'][0]['segments'][0]['departure']['iataCode'] }}| <span
                                    style="color:#ffc107;">
                                    TO
                                </span> |{{
                                $flight['itineraries'][1]['segments'][0]['departure']['iataCode'] }}|</h5>
                        </div><!-- details-header -->

                        <div class="row g-0 m-0 p-0">
                            <div class="col-md-2 px-3" style="text-align: left;">
                                <span class="d-block font-weight-bold" style="color: #003877; font-size: 18px;">{{
                                    $flight['itineraries'][0]['segments'][0]['carrierCode']
                                    }}</span>
                                <span class="d-block" style="font-size: 13px;">{{
                                    $flight['itineraries'][0]['segments'][0]['number'] }}</span>
                                <span class="d-block" style="font-size: 13px;">{{ $flightData['cabin'] }}</span>
                            </div><!-- col-md-2 -->

                            <div class="col-md-3">

                                <?php
                                                        $departureTime = $flight['itineraries'][0]['segments'][0]['departure']['at'];
                                                        $datetime = \Carbon\Carbon::parse($departureTime);
                                                    ?>
                                <span class="time me-2 mr-1 d-block" style="font-size: 14px">
                                    {{ $datetime->translatedFormat('D d M Y H:i') }}
                                </span>

                                <span class="d-block" style="font-size: 12px;">{{
                                    $flight['itineraries'][0]['segments'][0]['departure']['iataCode'] }}</span>
                                <span class="d-block" style="font-size: 14px;">Terminal {{
                                    $flight['itineraries'][0]['segments'][0]['departure']['terminal']
                                    }}</span>
                            </div><!-- col-md-3 -->

                            <div class="col-md-4">
                                <div class="flight-divider">
                                    <span class="plane-icon">✈</span>
                                </div>
                            </div><!-- col-md-3 -->

                            <div class="col-md-3">
                                <div class="arrival-info">
                                    <?php
                                                            $departureTime = $flight['itineraries'][1]['segments'][0]['arrival']['at'];
                                                            $datetime = \Carbon\Carbon::parse($departureTime);
                                                        ?>
                                    <span class="time me-2 mr-1 d-block" style="font-size: 14px">
                                        {{ $datetime->translatedFormat('D d M Y H:i') }}
                                    </span>
                                    <span style="d-block; font-size: 12px;">{{
                                        $flight['itineraries'][1]['segments'][0]['departure']['iataCode']
                                        }}</span>
                                </div><!-- arrival-info -->
                                <div class="font-weight-bold"
                                    style="text-align: right; color: #143ca1; font-size: 14px;">
                                    <span>Actual Time : {{ $flight['itineraries'][1]['segments'][0]['duration']}}</span>
                                </div>
                            </div><!-- col-md-3 -->

                        </div><!-- row -->

                        <div class="stop-des my-3 text-center"><b>Stopover</b><img
                                src="{{ asset('assets/images/icon-radio-button.webp') }}" width="16" height="16"
                                class="mx-1" alt="">
                        </div><!-- stop-des -->

                        <div class="row g-0 m-0 p-0">
                            <div class="col-md-2 px-3" style="text-align: left;">
                                <span class="d-block font-weight-bold" style="color: #003877; font-size: 18px;">{{
                                    $flight['itineraries'][0]['segments'][0]['carrierCode']
                                    }}</span>
                                <span class="d-block" style="font-size: 13px;">{{
                                    $flight['itineraries'][0]['segments'][0]['number'] }}</span>
                                <span class="d-block" style="font-size: 13px;">{{ $flightData['cabin'] }}</span>
                            </div><!-- col-md-2 -->

                            <div class="col-md-3">

                                <?php
                                                        $departureTime = $flight['itineraries'][0]['segments'][0]['departure']['at'];
                                                        $datetime = \Carbon\Carbon::parse($departureTime);
                                                    ?>
                                <span class="time me-2 mr-1 d-block" style="font-size: 14px">
                                    {{ $datetime->translatedFormat('D d M Y H:i') }}
                                </span>

                                <span class="d-block" style="font-size: 12px;">{{
                                    $flight['itineraries'][0]['segments'][0]['departure']['iataCode'] }}</span>
                                <span class="d-block" style="font-size: 14px;">Terminal {{
                                    $flight['itineraries'][0]['segments'][0]['departure']['terminal']
                                    }}</span>
                            </div><!-- col-md-3 -->

                            <div class="col-md-4">
                                <div class="flight-divider">
                                    <span class="plane-icon">✈</span>
                                </div>
                            </div><!-- col-md-3 -->

                            <div class="col-md-3">
                                <div class="arrival-info">
                                    <?php
                                                            $departureTime = $flight['itineraries'][1]['segments'][0]['arrival']['at'];
                                                            $datetime = \Carbon\Carbon::parse($departureTime);
                                                        ?>
                                    <span class="time me-2 mr-1 d-block" style="font-size: 14px">
                                        {{ $datetime->translatedFormat('D d M Y H:i') }}
                                    </span>
                                    <span style="d-block; font-size: 12px;">{{
                                        $flight['itineraries'][1]['segments'][0]['departure']['iataCode']
                                        }}</span>
                                </div><!-- arrival-info -->
                                <div class="font-weight-bold"
                                    style="text-align: right; color: #143ca1; font-size: 14px;">
                                    <span>Actual Time : {{ $flight['itineraries'][1]['segments'][0]['duration']}}</span>
                                </div>
                            </div><!-- col-md-3 -->

                        </div><!-- row -->

                    </div><!-- col-md-12 -->
                </div><!-- row -->


            </div><!-- card -->
            @empty
            <div class="alert alert-warning">No flights found<button type="button" class="btn btn-warning p-3 m-2"
                    onclick="window.location.href='/';">Search Again</button></div>
            @endforelse

        </div><!-- col-md-9 -->

    </div>
    <x-slot name="scripts">
        <script>
            $(document).ready(function () {
                let airlineElements = $(".airline-name");
                let airlineCodes = [];

                airlineElements.each(function () {
                    let code = $(this).data("code");
                    if (code && !airlineCodes.includes(code)) {
                        airlineCodes.push(code);
                    }
                });

                if (airlineCodes.length > 0) {
                    $.ajax({
                        url: "/search-airlines",
                        type: "GET",
                        data: { airlineCodes: airlineCodes.join(",") },
                        dataType: "json",
                        success: function (response) {
                            airlineElements.each(function () {
                                let code = $(this).data("code");
                                if (response[code]) {
                                    $(this).text(response[code]);
                                } else {
                                    $(this).text("غير متوفر");
                                }
                            });

                        },
                        error: function () {
                            airlineElements.text("خطأ في جلب البيانات");
                        }
                    });
                }


            $(".filter-header").click(function () {
                $(this).next(".filter-content").slideToggle();
                $(this).find("span").text($(this).next(".filter-content").is(":visible") ? "▼" : "▲");
            });

            // فلترة الرحلات بناءً على عدد التوقفات
            $(".filter-stop").click(function () {
                let selectedStop = $(this).data("value");
                console.log("تم اختيار عدد التوقفات:", selectedStop);
            // هنا يمكنك استدعاء وظيفة لجلب البيانات بناءً على الفلتر المحدد
            });

            // فلترة السعر
            $("#price-slider").slider({
                range: true,
                min: 500,
                max: 900,
                values: [576.6, 813.01],
                slide: function (event, ui) {
                $("#price-range").text("$" + ui.values[0] + " - $" + ui.values[1]);
                console.log("تم تعديل نطاق السعر:", ui.values);
                }
            });

            // فلترة وقت الرحلة
            $("#outbound-slider, #inbound-slider").slider({
                range: true,
                min: 0,
                max: 24,
                values: [0, 24],
                slide: function (event, ui) {
                console.log("تم تعديل وقت الرحلة:", ui.values);
                }
            });

            // فلترة شركات الطيران
            $(".filter-airline").change(function () {
                let selectedAirlines = $(".filter-airline:checked").map(function () {
                return $(this).val();
                }).get();
                console.log("شركات الطيران المحددة:", selectedAirlines);
            });
        });
        </script>
    </x-slot>
</x-front-layout>