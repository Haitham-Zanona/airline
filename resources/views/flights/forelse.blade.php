@forelse ($flightOffers as $flight)
<!-- Flight Card -->
<div class="flight-card">
    <div class="flight-header">
        <div class="d-flex align-items-center">
            <div class="airline-logo">
                <i class="fas fa-plane text-primary"></i>
            </div>
            <div>{{ $flight['validatingAirlineCodes'][0] }}</div>
        </div>
        <div>Travel Class: <span class="fw-bold">{{ $flightData['cabin'] }}</span></div>
    </div>
    <div class="row" style="box-sizing: border-box;">
        <div class="col-md-9" style="padding: 0 15px 0 25px;">
            <div class="flight-details" style="border-bottom: 1px solid #eee;">
                <div class="row">
                    <!-- Departure Details -->
                    <div class="col-3">
                        <?php
                                            $departureTime = $flight['itineraries'][0]['segments'][0]['departure']['at'];
                                            $datetime = \Carbon\Carbon::parse($departureTime);

                                            $originCity = $flightData['originCity'] ?? '';
                                            $cityName = '';
                                            $cityCode = '';

                                            // استخراج اسم المدينة (النص بين الأقواس)
                                            if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
                                                preg_match('/\((.*?)\)/', $originCity, $matches);
                                                $cityName = isset($matches[1]) ? trim($matches[1]) : '';
                                            }

                                            // استخراج الجزء الثاني (بعد الفاصلة)
                                            if (strpos($originCity, ',') !== false) {
                                                $parts = explode(',', $originCity);
                                                $cityCode = isset($parts[1]) ? trim($parts[1]) : '';
                                            }
                                        ?>
                        <div class="flight-time">{{ $datetime->translatedFormat('H:i') }}</div>
                        <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}</div>
                        <div class="flight-airport">{{ $cityName }}</div>
                        <div class="flight-airport">{{ $cityCode }}</div>
                    </div>

                    <!-- Flight Duration -->
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <?php
                                            $departureTime = $flight['itineraries'][0]['segments'][0]['departure']['at'];
                                            $datetime = \Carbon\Carbon::parse($departureTime);
                                        ?>
                        <div class="flight-duration">{{ $datetime->format('H:i') }}</div>
                        <div class="position-relative w-100 my-2">
                            <div class="border-top w-100"></div>
                            <i class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                        </div>
                        {{-- @dd(isset($flight['itineraries'][0]['segments']) ?
                        (count($flight['itineraries'][0]['segments']) - 1) : '0') --}}
                        <div class="flight-duration">{{ isset($flight['itineraries'][0]['segments']) ?
                            (count($flight['itineraries'][0]['segments']) - 1) : '0' }} stop</div>
                    </div>

                    <!-- Arrival Details -->
                    <div class="col-3 text-end">
                        <?php

                                            $lastSegmentIndex = count($flight['itineraries'][0]['segments']) - 1;
                                            $arrivalTime = $flight['itineraries'][0]['segments'][$lastSegmentIndex]['arrival']['at'];
                                            $datetime = \Carbon\Carbon::parse($arrivalTime);
                                        ?>
                        <div class="flight-time">{{ $datetime->format('H:i')}}</div>
                        <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}</div>
                        <div class="flight-airport">{{ trim(explode("(",
                            explode(")",$flightData['destinationCity'])[0])[1]) }}</div>
                        <div class="flight-airport">{{ trim(explode(",",
                            $flightData['destinationCity'])[1])
                            }}</div>
                    </div>
                </div>
            </div>


            @if (isset($flight['itineraries'][1]))

            <?php
                                $departureTime = $flight['itineraries'][1]['segments'][0]['departure']['at'];
                                $datetime = \Carbon\Carbon::parse($departureTime);

                                $originCity = $flightData['originCity'] ?? '';
                                $cityName = '';
                                $cityCode = '';

                                // استخراج اسم المدينة (النص بين الأقواس)
                                if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
                                    preg_match('/\((.*?)\)/', $originCity, $matches);
                                    $cityName = isset($matches[1]) ? trim($matches[1]) : '';
                                }

                                // استخراج الجزء الثاني (بعد الفاصلة)
                                if (strpos($originCity, ',') !== false) {
                                    $parts = explode(',', $originCity);
                                    $cityCode = isset($parts[1]) ? trim($parts[1]) : '';
                                }
                            ?>

            <!-- Another flight segment (for round trip or connection) -->
            <div class="flight-details">
                <div class="row">
                    <div class="col-3">
                        <div class="flight-time">{{ $datetime->translatedFormat('H:i') }}</div>
                        <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}</div>
                        <div class="flight-airport">{{ $cityName }}</div>
                        <div class="flight-airport">{{ $cityCode }}</div>
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <?php
                                            $departureTime = $flight['itineraries'][1]['segments'][0]['departure']['at'];
                                            $datetime = \Carbon\Carbon::parse($departureTime);
                                        ?>
                        <div class="flight-duration">{{ $datetime->format('H:i') }}</div>
                        <div class="position-relative w-100 my-2">
                            <div class="border-top w-100"></div>
                            <i class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                        </div>
                        <div class="flight-duration">{{ isset($flight['itineraries'][1]) &&
                            isset($flight['itineraries'][1]['segments']) ?
                            (count($flight['itineraries'][1]['segments']) - 1) : '0' }} stop</div>

                        {{-- {{ isset($flight['itineraries'][1]) &&
                        isset($flight['itineraries'][1]['segments']) ?
                        (count($flight['itineraries'][1]['segments']) - 1) : '0' }} --}}

                    </div>
                    <div class="col-3 text-end">
                        <?php

                                            $lastSegmentIndex = count($flight['itineraries'][1]['segments']) - 1;
                                            $arrivalTime = $flight['itineraries'][1]['segments'][$lastSegmentIndex]['arrival']['at'];
                                            $datetime = \Carbon\Carbon::parse($arrivalTime);
                                        ?>
                        <div class="flight-time">{{ $datetime->format('H:i')}}</div>
                        <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}</div>
                        <div class="flight-airport">{{ $cityName }}</div>
                        <div class="flight-airport">{{ $cityCode }}</div>
                    </div>
                </div>
            </div><!-- Another flight segment (for round trip or connection) -->
            @endif
        </div><!-- col-md-9 -->

        <div class="col-md-3 d-flex justify-content-center">

            <!-- Price and Book Button -->
            <div class="p-3 d-flex text-center justify-content-center align-items-center">
                <div class="me-3">
                    <div class="flight-price">${{ $flight['price']['grandTotal'] }}</div>
                    <button class="book-button px-5 py-3">Book Now</button>
                </div>
            </div>
        </div><!-- col-md-3 -->
    </div><!-- row -->

    <!-- Seats Remaining and Refund Status -->
    <div class="p-3 d-flex justify-content-between">
        <div style="padding: 10px 15px;">{{ $flight['numberOfBookableSeats'] }} seats remaining</div>
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




</div><!-- Flight Card -->
@empty

@endforelse


<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->

@forelse ($flightOffers as $flight)
<!-- Flight Card -->
<div class="flight-card">
    <div class="flight-header">
        <div class="d-flex align-items-center">
            <div class="airline-logo">
                @if(isset($flight['segments_info'][0]['airline_info']['name']) &&
                $flight['segments_info'][0]['airline_info']['name'] !== 'غير معروف')
                <!-- If we have airline logo URL, we could use it here -->
                <i class="fas fa-plane text-primary"></i>
                @else
                <i class="fas fa-plane text-primary"></i>
                @endif
            </div>
            <div>
                @if(isset($flight['segments_info'][0]['airline_info']['name']) &&
                $flight['segments_info'][0]['airline_info']['name'] !== 'غير معروف')
                {{ $flight['segments_info'][0]['airline_info']['name'] }}
                @else
                {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                @endif
            </div>
        </div>
        <div>Travel Class: <span class="fw-bold">{{ $flightData['cabin'] ?? 'Economy' }}</span></div>
    </div>

    <div class="row" style="box-sizing: border-box;">
        <div class="col-md-9" style="padding: 0 15px 0 25px;">
            <!-- OUTBOUND FLIGHT -->
            <div class="flight-details" style="border-bottom: 1px solid #eee;">
                <div class="row">
                    <!-- Departure Details -->
                    <div class="col-3">
                        <?php
                            $departureTime = $flight['itineraries'][0]['segments'][0]['departure']['at'] ?? '';
                            $datetime = \Carbon\Carbon::parse($departureTime);

                            $originCity = $flightData['originCity'] ?? '';
                            $cityName = '';
                            $cityCode = '';

                            // Extract city name (text in parentheses)
                            if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
                                preg_match('/\((.*?)\)/', $originCity, $matches);
                                $cityName = isset($matches[1]) ? trim($matches[1]) : '';
                            }

                            // Extract city code (after comma)
                            if (strpos($originCity, ',') !== false) {
                                $parts = explode(',', $originCity);
                                $cityCode = isset($parts[1]) ? trim($parts[1]) : '';
                            }
                        ?>
                        <div class="flight-time">{{ $datetime->translatedFormat('H:i') }}</div>
                        <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}</div>
                        <div class="flight-airport">{{ $cityName }}</div>
                        <div class="flight-airport">{{ $cityCode }}</div>
                    </div>

                    <!-- Flight Duration -->
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <?php
                            if(isset($flight['itineraries'][0]['duration'])) {
                                $duration = $flight['itineraries'][0]['duration'];
                                // Convert PT2H30M format to 2h 30m
                                $duration = str_replace('PT', '', $duration);
                                $duration = str_replace('H', 'h ', $duration);
                                $duration = str_replace('M', 'm', $duration);
                            } else {
                                $duration = '';
                            }

                            $outboundStops = isset($flight['outbound_stops_text']) ? $flight['outbound_stops_text'] :
                                            (isset($flight['itineraries'][0]['segments']) ? (count($flight['itineraries'][0]['segments']) - 1) : '0');
                        ?>
                        <div class="flight-duration">{{ $duration }}</div>
                        <div class="position-relative w-100 my-2">
                            <div class="border-top w-100"></div>
                            <i class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                        </div>
                        <div class="flight-duration">
                            @if($outboundStops > 0)
                            <button class="btn btn-link p-0 outbound-stops-toggle" data-flight-id="{{ $flight['id'] }}">
                                {{ $outboundStops }} stop(s) <i class="fas fa-chevron-down ms-1"></i>
                            </button>
                            @else
                            Direct Flight
                            @endif
                        </div>
                    </div>

                    <!-- Arrival Details -->
                    <div class="col-3 text-end">
                        <?php
                            $lastSegmentIndex = count($flight['itineraries'][0]['segments'] ?? []) - 1;
                            $arrivalTime = $flight['itineraries'][0]['segments'][$lastSegmentIndex]['arrival']['at'] ?? '';
                            $datetime = \Carbon\Carbon::parse($arrivalTime);
                        ?>
                        <div class="flight-time">{{ $datetime->format('H:i')}}</div>
                        <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}</div>
                        <div class="flight-airport">{{ trim(explode("(",
                            explode(")", $flightData['destinationCity'] ?? '')[0] ?? '')[1] ?? '') }}
                        </div>
                        <div class="flight-airport">{{ trim(explode(",",
                            $flightData['destinationCity'] ?? '')[1] ?? '')
                            }}</div>
                    </div>
                </div>
            </div>

            <!-- Outbound Stops Details (Initially Hidden) -->
            @if(isset($flight['itineraries'][0]['segments']) &&
            count($flight['itineraries'][0]['segments']) > 1)
            <div class="outbound-stops-details" id="outbound-stops-{{ $flight['id'] }}" style="display: none;">
                <div class="stops-details-container p-3 bg-light">
                    <h6 class="mb-3">Connection Details</h6>

                    @foreach($flight['itineraries'][0]['segments'] as $key => $segment)
                    @if($key > 0)
                    <div class="connection-info mb-3 p-2 border-start border-4 border-primary">
                        <?php
                                    $departureAirport = $segment['departure']['iataCode'] ?? '';
                                    $departureTime = $segment['departure']['at'] ?? '';
                                    $departureDateTime = \Carbon\Carbon::parse($departureTime);

                                    $arrivalAirport = $segment['arrival']['iataCode'] ?? '';
                                    $arrivalTime = $segment['arrival']['at'] ?? '';
                                    $arrivalDateTime = \Carbon\Carbon::parse($arrivalTime);

                                    // Calculate connection time from previous segment
                                    $prevArrival = \Carbon\Carbon::parse($flight['itineraries'][0]['segments'][$key-1]['arrival']['at'] ?? '');
                                    $connectionTime = $departureDateTime->diffInMinutes($prevArrival);
                                    $connectionHours = floor($connectionTime / 60);
                                    $connectionMinutes = $connectionTime % 60;
                                ?>

                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-clock text-warning me-1"></i> Connection time:
                                @if($connectionHours > 0){{ $connectionHours }}h @endif
                                {{ $connectionMinutes }}m at {{ $departureAirport }}
                            </span>
                            <span class="badge bg-secondary">{{ $segment['operating']['carrierCode'] ??
                                $segment['carrierCode'] ?? '' }}</span>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <div class="text-primary">{{ $departureDateTime->format('H:i') }}</div>
                                <div class="small">{{ $departureDateTime->translatedFormat('d M Y') }}
                                </div>
                                <div>{{ $departureAirport }}</div>
                            </div>
                            <div class="col-2 text-center d-flex flex-column justify-content-center">
                                <div class="small">{{ str_replace(['PT', 'H', 'M'], ['', 'h ', 'm'],
                                    $segment['duration'] ?? '') }}</div>
                                <div><i class="fas fa-arrow-right"></i></div>
                            </div>
                            <div class="col-5 text-end">
                                <div class="text-primary">{{ $arrivalDateTime->format('H:i') }}</div>
                                <div class="small">{{ $arrivalDateTime->translatedFormat('d M Y') }}
                                </div>
                                <div>{{ $arrivalAirport }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- RETURN FLIGHT (if exists) -->
            @if (isset($flight['itineraries'][1]))
            <div class="flight-details mt-3">
                <div class="row">
                    <!-- Departure Details -->
                    <div class="col-3">
                        <?php
                            $departureTime = $flight['itineraries'][1]['segments'][0]['departure']['at'] ?? '';
                            $datetime = \Carbon\Carbon::parse($departureTime);

                            $destinationCity = $flightData['destinationCity'] ?? '';
                            $cityName = '';
                            $cityCode = '';

                            // Extract city name (text in parentheses)
                            if (strpos($destinationCity, '(') !== false && strpos($destinationCity, ')') !== false) {
                                preg_match('/\((.*?)\)/', $destinationCity, $matches);
                                $cityName = isset($matches[1]) ? trim($matches[1]) : '';
                            }

                            // Extract city code (after comma)
                            if (strpos($destinationCity, ',') !== false) {
                                $parts = explode(',', $destinationCity);
                                $cityCode = isset($parts[1]) ? trim($parts[1]) : '';
                            }
                        ?>
                        <div class="flight-time">{{ $datetime->translatedFormat('H:i') }}</div>
                        <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}</div>
                        <div class="flight-airport">{{ $cityName }}</div>
                        <div class="flight-airport">{{ $cityCode }}</div>
                    </div>

                    <!-- Flight Duration -->
                    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                        <?php
                            if(isset($flight['itineraries'][1]['duration'])) {
                                $duration = $flight['itineraries'][1]['duration'];
                                // Convert PT2H30M format to 2h 30m
                                $duration = str_replace('PT', '', $duration);
                                $duration = str_replace('H', 'h ', $duration);
                                $duration = str_replace('M', 'm', $duration);
                            } else {
                                $duration = '';
                            }

                            $inboundStops = isset($flight['inbound_stops_text']) ? $flight['inbound_stops_text'] :
                                            (isset($flight['itineraries'][1]['segments']) ? (count($flight['itineraries'][1]['segments']) - 1) : '0');
                        ?>
                        <div class="flight-duration">{{ $duration }}</div>
                        <div class="position-relative w-100 my-2">
                            <div class="border-top w-100"></div>
                            <i class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                        </div>
                        <div class="flight-duration">
                            @if($inboundStops > 0)
                            <button class="btn btn-link p-0 inbound-stops-toggle" data-flight-id="{{ $flight['id'] }}">
                                {{ $inboundStops }} stop(s) <i class="fas fa-chevron-down ms-1"></i>
                            </button>
                            @else
                            Direct Flight
                            @endif
                        </div>
                    </div>

                    <!-- Arrival Details -->
                    <div class="col-3 text-end">
                        <?php
                            $lastSegmentIndex = count($flight['itineraries'][1]['segments'] ?? []) - 1;
                            $arrivalTime = $flight['itineraries'][1]['segments'][$lastSegmentIndex]['arrival']['at'] ?? '';
                            $datetime = \Carbon\Carbon::parse($arrivalTime);

                            $originCity = $flightData['originCity'] ?? '';
                            $returnCityName = '';
                            $returnCityCode = '';

                            // Extract city name (text in parentheses)
                            if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
                                preg_match('/\((.*?)\)/', $originCity, $matches);
                                $returnCityName = isset($matches[1]) ? trim($matches[1]) : '';
                            }

                            // Extract city code (after comma)
                            if (strpos($originCity, ',') !== false) {
                                $parts = explode(',', $originCity);
                                $returnCityCode = isset($parts[1]) ? trim($parts[1]) : '';
                            }
                        ?>
                        <div class="flight-time">{{ $datetime->format('H:i')}}</div>
                        <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}</div>
                        <div class="flight-airport">{{ $returnCityName }}</div>
                        <div class="flight-airport">{{ $returnCityCode }}</div>
                    </div>
                </div>
            </div>

            <!-- Inbound Stops Details (Initially Hidden) -->
            @if(isset($flight['itineraries'][1]['segments']) &&
            count($flight['itineraries'][1]['segments']) > 1)
            <div class="inbound-stops-details" id="inbound-stops-{{ $flight['id'] }}" style="display: none;">
                <div class="stops-details-container p-3 bg-light">
                    <h6 class="mb-3">Connection Details</h6>

                    @foreach($flight['itineraries'][1]['segments'] as $key => $segment)
                    @if($key > 0)
                    <div class="connection-info mb-3 p-2 border-start border-4 border-primary">
                        <?php
                                    $departureAirport = $segment['departure']['iataCode'] ?? '';
                                    $departureTime = $segment['departure']['at'] ?? '';
                                    $departureDateTime = \Carbon\Carbon::parse($departureTime);

                                    $arrivalAirport = $segment['arrival']['iataCode'] ?? '';
                                    $arrivalTime = $segment['arrival']['at'] ?? '';
                                    $arrivalTime = $segment['arrival']['at'] ?? '';
                                    $arrivalDateTime = \Carbon\Carbon::parse($arrivalTime);

                                    // Calculate connection time from previous segment
                                    $prevArrival = \Carbon\Carbon::parse($flight['itineraries'][1]['segments'][$key-1]['arrival']['at'] ?? '');
                                    $connectionTime = $departureDateTime->diffInMinutes($prevArrival);
                                    $connectionHours = floor($connectionTime / 60);
                                    $connectionMinutes = $connectionTime % 60;
                                ?>

                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-clock text-warning me-1"></i> Connection time:
                                @if($connectionHours > 0){{ $connectionHours }}h @endif
                                {{ $connectionMinutes }}m at {{ $departureAirport }}
                            </span>
                            <span class="badge bg-secondary">{{ $segment['operating']['carrierCode'] ??
                                $segment['carrierCode'] ?? '' }}</span>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <div class="text-primary">{{ $departureDateTime->format('H:i') }}</div>
                                <div class="small">{{ $departureDateTime->translatedFormat('d M Y') }}
                                </div>
                                <div>{{ $departureAirport }}</div>
                            </div>
                            <div class="col-2 text-center d-flex flex-column justify-content-center">
                                <div class="small">{{ str_replace(['PT', 'H', 'M'], ['', 'h ', 'm'],
                                    $segment['duration'] ?? '') }}</div>
                                <div><i class="fas fa-arrow-right"></i></div>
                            </div>
                            <div class="col-5 text-end">
                                <div class="text-primary">{{ $arrivalDateTime->format('H:i') }}</div>
                                <div class="small">{{ $arrivalDateTime->translatedFormat('d M Y') }}
                                </div>
                                <div>{{ $arrivalAirport }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
            @endif
        </div><!-- col-md-9 -->

        <div class="col-md-3 d-flex justify-content-center">
            <!-- Price and Book Button -->
            <div class="p-3 d-flex text-center justify-content-center align-items-center">
                <div class="me-3">
                    <div class="flight-price">${{ $flight['price']['grandTotal'] ?? '0.00' }}</div>
                    <button class="book-button px-5 py-3">Book Now</button>
                </div>
            </div>
        </div><!-- col-md-3 -->
    </div><!-- row -->

    <!-- Seats Remaining and Refund Status -->
    <div class="p-3 d-flex justify-content-between">
        <div style="padding: 10px 15px;">{{ $flight['numberOfBookableSeats'] ?? '0' }} seats remaining
        </div>
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
    </div>
</div><!-- Flight Card -->
@empty
<div class="alert alert-info">No flight offers available.</div>
@endforelse


// إضافة خاصية التحميل الكسول للعناصر
const implementLazyLoading = () => {
// تعديل وظيفة تصفية الرحلات لتطبيق التحميل الكسول
const originalClientSideFilter = clientSideFilter;

clientSideFilter = () => {
// تنفيذ وظيفة الفلترة الأصلية
originalClientSideFilter();

// تطبيق التحميل الكسول للعناصر
const visibleFlights = document.querySelectorAll('.flight-card[style="display: block;"]');

// تعيين مؤشر للتحميل المتزامن
let loadIndex = 0;
const maxVisibleAtOnce = 5;

// إخفاء جميع العناصر في البداية
visibleFlights.forEach(card => {
card.classList.add('lazy-hidden');
});

// تحميل العناصر بشكل تدريجي
const loadNext = () => {
const itemsToLoad = Math.min(maxVisibleAtOnce, visibleFlights.length - loadIndex);

for (let i = 0; i < itemsToLoad; i++) { if (visibleFlights[loadIndex + i]) { setTimeout(()=> {
    visibleFlights[loadIndex + i].classList.remove('lazy-hidden');
    }, i * 50);
    }
    }

    loadIndex += itemsToLoad;

    // استمرار التحميل إذا كان هناك المزيد من العناصر
    if (loadIndex < visibleFlights.length) { setTimeout(loadNext, 100); } }; // بدء التحميل الكسول loadNext(); }; }; //
        تحسين التعامل مع الذاكرة const optimizeMemory=()=> {
        // تنظيف الذاكرة دوريًا
        const cleanupMemory = () => {
        // إزالة بيانات التخزين المؤقت القديمة
        const filterCache = {};

        // تنظيف مؤشرات الأحداث غير المستخدمة
        const cleanEventListeners = () => {
        const elements = document.querySelectorAll('.flight-card');
        elements.forEach(element => {
        const newElement = element.cloneNode(true);
        element.parentNode.replaceChild(newElement, element);
        });
        };

        // تنفيذ تنظيف الذاكرة كل 5 دقائق
        setInterval(() => {
        cleanEventListeners();
        }, 5 * 60 * 1000);
        };

        // تأجيل تنفيذ وظائف غير مهمة
        const deferNonCriticalTasks = () => {
        // تأجيل تنفيذ وظائف غير مهمة حتى اكتمال تحميل الصفحة
        window.addEventListener('load', () => {
        setTimeout(() => {
        // تحديث الإحصائيات والبيانات الإضافية
        updateStatistics();

        // تحسين تجربة المستخدم بعد التحميل
        enhancePostLoadExperience();
        }, 1000);
        });
        };

        // وظيفة تحديث الإحصائيات
        const updateStatistics = () => {
        // تحديث معلومات إحصائية إضافية
        const totalFlights = document.querySelectorAll('.flight-card').length;
        const visibleFlights = document.querySelectorAll('.flight-card[style="display: block;"]').length;

        // تخزين الإحصائيات في متغير عام
        window.flightStats = {
        total: totalFlights,
        visible: visibleFlights,
        filtered: totalFlights - visibleFlights,
        lastUpdate: new Date().toISOString()
        };
        };

        // تحسين تجربة المستخدم بعد التحميل
        const enhancePostLoadExperience = () => {
        // إضافة ميزات إضافية بعد التحميل
        const flightCards = document.querySelectorAll('.flight-card');

        flightCards.forEach(card => {
        // إضافة زر لفتح تفاصيل الرحلة
        const detailsButton = document.createElement('button');
        detailsButton.className = 'flight-details-button';
        detailsButton.textContent = 'عرض التفاصيل';
        detailsButton.addEventListener('click', (e) => {
        e.preventDefault();
        card.classList.toggle('show-details');
        });

        // إضافة الزر فقط إذا لم يكن موجودًا بالفعل
        if (!card.querySelector('.flight-details-button')) {
        card.appendChild(detailsButton);
        }
        });
        };

        // تنفيذ تحسينات الذاكرة
        cleanupMemory();
        deferNonCriticalTasks();
        };

        // تنفيذ جميع التحسينات
        const initializeEnhancements = () => {
        // تحسين سلوك الطي للشاشات الصغيرة
        enhanceMobileCollapsing();

        // إصلاح فلتر التوقفات
        fixStopsFilter();

        // إصلاح فلتر الوقت
        fixTimeFilter();

        // دعم الصفحات المتعددة
        setupPagination();

        // تحسينات في تجربة المستخدم
        enhanceUserExperience();

        // تحسينات في الأداء
        improvePerformance();

        // إضافة أنماط CSS للتحسينات
        addEnhancementStyles();
        };

        // إضافة أنماط CSS للتحسينات
        const addEnhancementStyles = () => {
        // إنشاء عنصر <style>
            جديد const styleElement=document.createElement('style');
            styleElement.textContent=`

            /* أنماط مؤشر التحميل */
            .loading-indicator {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(255, 255, 255, 0.8);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.3s ease;
            }

            .loading-indicator.active {
                opacity: 1;
                pointer-events: all;
            }

            .loading-spinner {
                width: 50px;
                height: 50px;
                border: 5px solid #f3f3f3;
                border-top: 5px solid #3498db;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            /* أنماط الإشعارات */
            .notification-container {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                direction: rtl;
            }

            .notification {
                background-color: white;
                color: #333;
                padding: 12px 20px;
                margin-bottom: 10px;
                border-radius: 4px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                transform: translateX(100%);
                opacity: 0;
                transition: transform 0.3s ease, opacity 0.3s ease;
            }

            .notification.show {
                transform: translateX(0);
                opacity: 1;
            }

            .notification.info {
                border-right: 4px solid #3498db;
            }

            .notification.success {
                border-right: 4px solid #2ecc71;
            }

            .notification.warning {
                border-right: 4px solid #f39c12;
            }

            .notification.error {
                border-right: 4px solid #e74c3c;
            }

            /* أنماط الصفحات المتعددة */
            .pagination-container {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 20px 0;
                direction: rtl;
            }

            .pagination-button {
                padding: 8px 12px;
                margin: 0 5px;
                border: 1px solid #ddd;
                background-color: white;
                color: #333;
                cursor: pointer;
                border-radius: 4px;
                transition: background-color 0.2s ease;
            }

            .pagination-button:hover {
                background-color: #f5f5f5;
            }

            .pagination-button.active {
                background-color: #3498db;
                color: white;
                border-color: #3498db;
            }

            .pagination-button:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .pagination-ellipsis {
                margin: 0 5px;
            }

            /* أنماط شريط التمرير المحسن */
            .hour-markers {
                position: relative;
                width: 100%;
                height: 20px;
                margin-top: 10px;
            }

            .hour-marker {
                position: absolute;
                transform: translateX(-50%);
                font-size: 12px;
                color: #666;
            }

            /* أنماط زر تطبيق الفلتر للهواتف المحمولة */
            .apply-filter-mobile {
                display: none;
                width: 100%;
                padding: 12px;
                background-color: #3498db;
                color: white;
                border: none;
                border-radius: 4px;
                margin-top: 15px;
                font-weight: bold;
                cursor: pointer;
            }

            .close-filter {
                display: none;
                position: absolute;
                top: 10px;
                left: 10px;
                background: none;
                border: none;
                font-size: 18px;
                cursor: pointer;
                color: #333;
            }

            /* أنماط التحميل الكسول */
            .lazy-hidden {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.3s ease, transform 0.3s ease;
            }

            .flight-card {
                transition: opacity 0.3s ease, transform 0.3s ease;
            }

            /* أنماط زر تفاصيل الرحلة */
            .flight-details-button {
                background-color: #f8f9fa;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 5px 10px;
                margin-top: 10px;
                cursor: pointer;
                transition: background-color 0.2s ease;
            }

            .flight-details-button:hover {
                background-color: #e9ecef;
            }

            /* أنماط إضافية للشاشات الصغيرة */
            @media (max-width: 768px) {
                .filter-content {
                    position: fixed;
                    top: 0;
                    right: -100%;
                    width: 80%;
                    height: 100%;
                    background-color: white;
                    z-index: 1000;
                    overflow-y: auto;
                    transition: right 0.3s ease;
                    padding: 20px;
                    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
                }

                .filter-content.show {
                    right: 0;
                }

                .close-filter {
                    display: block;
                }

                .apply-filter-mobile {
                    display: block;
                }

                #filter-toggle {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 10px 15px;
                    background-color: #f8f9fa;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    margin-bottom: 15px;
                    cursor: pointer;
                }

                #filter-toggle.active {
                    background-color: #e9ecef;
                }
            }

            `;

            // إضافة عنصر الأنماط إلى <head>
            document.head.appendChild(styleElement);
            }

            ;

            // تهيئة جميع التحسينات عند تحميل الصفحة
            document.addEventListener('DOMContentLoaded', function() {
                    // تهيئة الوظائف الأساسية
                    renderFilter();
                    setupMobileFilter();

                    // تهيئة التحسينات
                    initializeEnhancements();
                });

            // تصدير الوظائف المستخدمة للاختبار
            if (typeof module !=='undefined' && module.exports) {
                module.exports= {
                    enhanceMobileCollapsing,
                    fixStopsFilter,
                    fixTimeFilter,
                    setupPagination,
                    enhanceUserExperience,
                    improvePerformance,
                    getFilterCriteria
                }

                ;
            }

            ;
