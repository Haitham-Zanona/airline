@if(isset($flightsArraySubset) && $flightsArraySubset->count() > 0)

@forelse ($flightsArraySubset as $flight)
<!-- Flight Card -->
<form action="{{ route('flight.select') }}" method="post">
    @csrf
    <input type="hidden" name="flight_id" value="{{ $flight['id'] }}">
    <div class="flight-card">
        <div class="flight-header">
            <div class="d-flex align-items-center">
                {{-- <div class="airline-logo">
                    @php
                    $airlineName = $flight['segments_info'][0]['airline_info']['name'] ?? 'UNKNOWN';


                    $logoUrl = \App\Services\AirlineLogoService::getLogoUrl($airlineName);
                    // dd($logoUrl);
                    // dd($flight['segments_info'][0]['airline_info']['name']);
                    $defaultLogo = \App\Services\AirlineLogoService::getDefaultLogo();
                    @endphp

                    @if($airlineName !== 'UNKNOWN')
                    <img src="{{ $logoUrl }}" alt="{{ $airlineName }} Logo" class="airline-logo-img"
                        onerror="this.onerror=null; this.src='{{ $defaultLogo }}';">
                    @else
                    <span class="airline-name">{{ $airlineName }}</span>
                    @endif
                </div> --}}
                <div class="fw-bold">
                    @if(isset($flight['segments_info'][0]['airline_info']['name']) &&
                    $flight['segments_info'][0]['airline_info']['name'] !== 'UNKNOWN')
                    {{ $flight['segments_info'][0]['airline_info']['name'] }}
                    @else
                    {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                    @endif
                </div>
            </div>
            <div>Travel Class: <span class="fw-bold">{{ $flightData['cabin'] ?? 'Economy' }}</span>
            </div>
        </div><!-- flight-header -->

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
                            <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}
                            </div>
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
                                <i
                                    class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                            </div>
                            <div class="flight-duration">
                                @if($outboundStops > 0)
                                <div>{{ $outboundStops }} stop(s)</div>
                                <div class="mt-1">
                                    <button class="btn btn-outline-primary rounded-circle outbound-stops-toggle"
                                        data-flight-id="{{ $flight['id'] }}"
                                        style="width: 28px; height: 28px; padding: 0;">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
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
                            <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}
                            </div>
                            <div class="flight-airport">{{ trim(explode("(",
                                explode(")", $flightData['destinationCity'] ?? '')[0] ?? '')[1] ??
                                '')
                                }}
                            </div>
                            <div class="flight-airport">{{ trim(explode(",",
                                $flightData['destinationCity'] ?? '')[1] ?? '')
                                }}</div>
                        </div>
                    </div>
                </div><!-- flight-details -->

                <!-- Outbound Stops Details (Initially Hidden) -->
                @if(isset($flight['itineraries'][0]['segments']) &&
                count($flight['itineraries'][0]['segments']) > 1)
                <div class="outbound-stops-details" id="outbound-stops-{{ $flight['id'] }}" style="display: none;">
                    <div class="stops-details-container p-3 bg-light">
                        <h6 class="mb-3">Connection Details</h6>

                        @foreach($flight['itineraries'][0]['segments'] as $key => $segment)
                        @if($key < count($flight['itineraries'][0]['segments'])) <div
                            class="connection-info mb-3 p-2 border-start border-4 @if($key == 0) border-success @else border-primary @endif">
                            <?php
                                                                        $departureAirport = $segment['departure']['iataCode'] ?? '';
                                                                        $departureTime = $segment['departure']['at'] ?? '';
                                                                        $departureDateTime = \Carbon\Carbon::parse($departureTime);

                                                                        $arrivalAirport = $segment['arrival']['iataCode'] ?? '';
                                                                        $arrivalTime = $segment['arrival']['at'] ?? '';
                                                                        $arrivalDateTime = \Carbon\Carbon::parse($arrivalTime);

                                                                        // Display connection time only for segments after the first one
                                                                        if($key > 0) {
                                                                            $prevArrival = \Carbon\Carbon::parse($flight['itineraries'][0]['segments'][$key-1]['arrival']['at'] ?? '');
                                                                            $connectionTime = $departureDateTime->diffInMinutes($prevArrival);
                                                                            $connectionHours = floor($connectionTime / 60);
                                                                            $connectionMinutes = $connectionTime % 60;
                                                                        }
                                                                    ?>

                            <!-- For outbound flights -->
                            @if($key > 0)
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fas fa-clock text-warning me-1"></i> Connection
                                    time:
                                    @if($connectionHours > 0){{ $connectionHours }}h @endif
                                    {{ $connectionMinutes }}m at {{ $departureAirport }}
                                </span>
                                <span class="badge bg-secondary">

                                    @if(isset($flight['segments_info'][0]['airline_info']['name'])
                                    &&
                                    $flight['segments_info'][0]['airline_info']['name'] !==
                                    'UNKNOWN')
                                    {{ $flight['segments_info'][0]['airline_info']['name'] }}
                                    @else
                                    {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                                    @endif

                                </span>
                            </div><!-- d-flex justify-content-between mb-2 -->
                            @else
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="fas fa-plane-departure text-success me-1"></i>
                                    Departure</span>
                                <span class="badge bg-secondary">
                                    @if(isset($flight['segments_info'][0]['airline_info']['name'])
                                    &&
                                    $flight['segments_info'][0]['airline_info']['name'] !==
                                    'UNKNOWN')
                                    {{ $flight['segments_info'][0]['airline_info']['name'] }}
                                    @else
                                    {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                                    @endif
                                </span>
                            </div><!-- /d-flex justify-content-between mb-2 -->
                            @endif

                            <div class="row">
                                <div class="col-5">
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
                                    <div class="text-primary">{{ $departureDateTime->format('H:i')
                                        }}
                                    </div>
                                    <div class="small">{{ $departureDateTime->translatedFormat('d M
                                        Y')
                                        }}
                                    </div>
                                    <div>{{ $departureAirport }}</div>
                                </div>
                                <div class="col-2 text-center d-flex flex-column justify-content-center">
                                    <div class="small">{{ str_replace(['PT', 'H', 'M'], ['', 'h ',
                                        'm'],
                                        $segment['duration'] ?? '') }}</div>
                                    <div><i class="fas fa-arrow-right"></i></div>
                                </div>
                                <div class="col-5 text-end">
                                    <div class="text-primary">{{ $arrivalDateTime->format('H:i') }}
                                    </div>
                                    <div class="small">{{ $arrivalDateTime->translatedFormat('d M
                                        Y') }}
                                    </div>
                                    <div>{{ $arrivalAirport }}</div>
                                </div>
                            </div><!-- row -->

                    </div><!-- stops-details-container -->
                    @endif

                    @endforeach
                    {{-- div div/div> --}}
                    <!-- outbound-stops-details -->
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
                            <div>{{ $inboundStops }} stop(s)</div>
                            <div class="mt-1">
                                <button class="btn btn-outline-primary rounded-circle inbound-stops-toggle"
                                    data-flight-id="{{ $flight['id'] }}" style="width: 28px; height: 28px; padding: 0;">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
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
            count($flight['itineraries'][1]['segments'])
            > 1)
            <div class="inbound-stops-details" id="inbound-stops-{{ $flight['id'] }}" style="display: none;">
                <div class="stops-details-container p-3 bg-light">
                    <h6 class="mb-3">Connection Details</h6>

                    @foreach($flight['itineraries'][1]['segments'] as $key => $segment)
                    @if($key < count($flight['itineraries'][1]['segments'])) <div
                        class="connection-info mb-3 p-2 border-start border-4 @if($key == 0) border-success @else border-primary @endif">
                        <?php
                                                        $departureAirport = $segment['departure']['iataCode'] ?? '';
                                                        $departureTime = $segment['departure']['at'] ?? '';
                                                        $departureDateTime = \Carbon\Carbon::parse($departureTime);

                                                        $arrivalAirport = $segment['arrival']['iataCode'] ?? '';
                                                        $arrivalTime = $segment['arrival']['at'] ?? '';
                                                        $arrivalDateTime = \Carbon\Carbon::parse($arrivalTime);

                                                        // Display connection time only for segments after the first one
                                                        if($key > 0) {
                                                            $prevArrival = \Carbon\Carbon::parse($flight['itineraries'][1]['segments'][$key-1]['arrival']['at'] ?? '');
                                                            $connectionTime = $departureDateTime->diffInMinutes($prevArrival);
                                                            $connectionHours = floor($connectionTime / 60);
                                                            $connectionMinutes = $connectionTime % 60;
                                                        }
                                                    ?>
                        {{-- @dd($flight['itineraries'][1]['segments']) --}}

                        <!-- For Inbound flights -->
                        @if($key > 0)
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-clock text-warning me-1"></i> Connection time:
                                @if($connectionHours > 0){{ $connectionHours }}h @endif
                                {{ $connectionMinutes }}m at {{ $departureAirport }}
                            </span>
                            <span class="badge bg-secondary">
                                @if(isset($flight['segments_info'][0]['airline_info']['name']) &&
                                $flight['segments_info'][0]['airline_info']['name'] !== 'UNKNOWN')
                                {{ $flight['segments_info'][0]['airline_info']['name'] }}
                                @else
                                {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                                @endif
                            </span>
                        </div>
                        @else
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-plane-departure text-success me-1"></i>
                                Departure</span>
                            <span class="badge bg-secondary">
                                @if(isset($flight['segments_info'][0]['airline_info']['name']) &&
                                $flight['segments_info'][0]['airline_info']['name'] !== 'UNKNOWN')
                                {{ $flight['segments_info'][0]['airline_info']['name'] }}
                                @else
                                {{ $flight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                                @endif
                            </span>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-5">
                                <div class="text-primary">{{ $departureDateTime->format('H:i') }}
                                </div>
                                <div class="small">{{ $departureDateTime->translatedFormat('d M Y')
                                    }}
                                </div>
                                <div>{{ $departureAirport }}</div>
                            </div>
                            <div class="col-2 text-center d-flex flex-column justify-content-center">
                                <div class="small">{{ str_replace(['PT', 'H', 'M'], ['', 'h ', 'm'],
                                    $segment['duration'] ?? '') }}</div>
                                <div><i class="fas fa-arrow-right"></i></div>
                            </div>
                            <div class="col-5 text-end">
                                <div class="text-primary">{{ $arrivalDateTime->format('H:i') }}
                                </div>
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
                <button class="book-button px-3 py-2">Book Now</button>
            </div>
        </div>
    </div><!-- col-md-3 -->


    </div><!-- row -->

    <!-- Seats Remaining and Refund Status -->
    <div class="flight-extra-info p-3">
        <div style="padding: 10px 15px;">{{ $flight['numberOfBookableSeats'] ?? '0' }} seats remaining
        </div>
        <!-- Flight Footer -->
        <div class="flight-footer d-flex justify-content-start">
            <div class="me-4">
                <i class="fas fa-ticket-alt me-1"></i> Last Ticket Date : {{ $flight['lastTicketingDate'] }}
            </div>
            <div class="me-4">
                <i class="fa-solid fa-suitcase-rolling me-1"></i> Checked Bags : {{
                $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['quantity']
                ??
                0
                }}
            </div>
            {{-- <div class="me-4">
                <i class="fas fa-exchange-alt me-1"></i> Self Transfer
            </div> --}}
            <div>
                <i class="fas fa-suitcase-rolling me-1"></i> Cabin Bags : {{
                $flight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCabinBags']['quantity']
                ?? 0
                }}
            </div>
        </div>
    </div>
    </div><!-- Flight Card -->

</form>

<div class="banner-container my-3">
    <!-- Left side with icons and text -->
    <div class="banner-icons mb-3 mb-md-0">
        <div class="d-flex me-3">
            <div class="icon-circle">
                <i class="fa-solid fa-hotel"></i>
            </div>
            <div class="icon-circle position-relative" style="margin-left: -15px; z-index: 2;">
                <i class="fa-solid fa-plane"></i>
            </div>
            <div class="icon-circle position-relative" style="margin-left: -15px;">
                <i class="fa-solid fa-car-side"></i>
            </div>
        </div>
        <div>
            <div class="yellow-pill">Save big on Bundle</div>
            <div class="save-text">Add Hotel or Car with Flight and<br>Save Extra 30% on Your Trip</div>
        </div>

    </div>

    <!-- Right side with phone button -->
    <div class="right-side-banner">


        <div>
            <a href="tel:+17144775913" class="phone-button">
                <i class="fa-solid fa-phone-volume me-2" style="width: 30px; height: 30px;"></i>
                <div>
                    <span class="phone-number">+1-714-477-5913</span>
                    <span class="expert-text">Talk to a Travel Expert Now</span>
                </div>
            </a>
        </div>

    </div>
</div><!-- banner-container -->
@empty
<div class="container">
    <div class="result-container">


        <div class="content-section">
            <h1 class="result-heading d-block">No Result Found. Don't Worry!</h1>
            <p class="description d-block">Our agents can help you out. Call us to find our best flights
                to
                meet
                your travel
                requirements.</p>

            <div class="justify-content-end">
                <p class="mb-2" style="padding-right: 80px;">Call us now at</p>
                <a href="tel:+12163022732" class="call-button" style="width: 250px; padding-right: 50px;">
                    <i class="bi bi-telephone-fill me-2"></i> +1-216-302-2732
                </a>
                <p class="availability" style="padding-right: 50px;">we are available 24x7</p>

                <div class="discount-section">
                    <p class="discount-text mb-0" style="padding-right: 100px;">Up to</p>
                    <p class="discount-value">15% Discount</p>
                    <p style="padding-right: 50px;">on total value awaits!!</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endforelse
@else
<div class="alert alert-info">
    No flights found matching your criteria.
</div>
@endif