<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking Confirmation</title>

    <style>
        :root {
            --primary-color: #6742c9;
            --light-gray: #f8f9fa;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
        }

        /* Header styles */
        header {
            width: 100%;
            background-color: #efefef;
            z-index: 100;
        }

        .header-logo-content {

            display: flex;
            justify-content: space-between;
            align-items: center;
        }



        .logo {
            color: #4444ff;
            font-weight: bold;
            font-size: 24px;
        }





        /*End Header Style*/
        .success-icon {
            width: 60px;
            height: 60px;
            background-color: #4CD964;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
        }

        .success-icon i {
            color: white;
            font-size: 30px;
        }

        .success-message {
            color: #4CD964;
            font-size: 24px;
            font-weight: 600;
        }

        .successfully-confirm {
            /* d-flex align-items-center justify-content-center mb-4 py-5; */
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 8px;
            padding: 25px;
            background-color: #bef6c9;
        }

        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .flight-summary-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 25px;
        }

        .reference-no {
            background-color: #F0F0FF;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .booking-info {
            padding: 20px;
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


        .flight-details-section {
            padding: 0 15px 0 25px;
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

        .flight-extra-info {
            display: flex;
            /* justify-content: space-between; */
            align-items: center;
            gap: 20%;
            padding: 15px;
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

        .stop-duration {

            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
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

        .payment-summary {
            background-color: #4B45FF;
            color: white;
            padding: 15px;
            border-radius: 5px;
        }

        .payment-summary .total {
            font-size: 24px;
            font-weight: bold;
        }

        .card-logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 60px;
        }

        .card-logo {
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }

        .card-name {
            font-weight: bold;
            font-size: 14px;
        }

        /* أنماط خاصة لكل نوع بطاقة */
        .visa-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
        }

        .mastercard-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
        }

        .amex-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
        }

        .discover-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
        }

        .card-payment {
            position: sticky;
            top: 0;
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
            margin-bottom: 10px;
            padding-top: 5px;
            border-top: 1px solid #bdb3b3;
        }

        .fare-section-content {
            margin-top: 10px;
            padding-left: 10px;
        }

        .fare-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .footer {
            background-color: white;
            padding: 40px 0;
            margin-top: 50px;
        }

        .footer-logo {
            color: #4B45FF;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .footer-links h5 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links ul li {
            margin-bottom: 10px;
        }

        .footer-links ul li a {
            color: #666;
            text-decoration: none;
        }

        .footer-links ul li a:hover {
            color: #4B45FF;
        }

        .contact-info {
            color: #4444ff;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
        }

        .contact-info i {
            margin-right: 10px;
            color: #4B45FF;
        }

        .contact-info a {

            text-decoration: none;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #f8f9fa;
            color: #666;
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 10px;
        }

        .social-links a:hover {
            background-color: #4B45FF;
            color: white;
        }

        .copyright {
            text-align: center;
            padding: 20px 0;
            color: #666;
            font-size: 14px;
        }

        .payment-methods {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 40px 0;
        }

        .payment-methods img {
            height: 40px;
        }

        .footer-contact-icons {
            width: 30px;
            height: 30px;
        }

        @media (max-width: 767.98px) {
            .header-logo-content {
                flex-direction: column;
                align-items: stretch;
            }

            .booking-title {
                font-size: 14px;

            }

            .logo {
                margin-bottom: 10px;
                text-align: left;
            }

            .contact-info {
                text-align: right;
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .successfully-confirm {
                flex-direction: column;
                padding: 20px;
                margin-bottom: 20px;
            }

            .booking-info {
                margin-top: 15px;
            }

            .booking-steps {
                /* display: flex; */
                gap: 1%;
                font-size: 12px;
                /* color: #666; */
                /* font-weight: 500; */
                padding: 0 15px;
            }

            .booking-header {
                /* display: flex; */
                /* justify-content: space-between; */
                /* align-items: center; */
                /* margin-bottom: 20px; */
                /* padding-bottom: 10px; */
                /* border-bottom: 1px solid var(--border-color); */
                gap: 0;
            }

            .header-dots {
                display: none;
            }

            .flight-airport {
                font-size: 8px;
            }

            table thead tr th {
                font-size: 12px;
            }

            table thead tr td {
                font-size: 12px;
            }

            .footer .d-flex.flex-column.flex-md-row {
                gap: 10px;
            }

            .footer-contact-res {
                font-size: 13px;
                font-weight: 600;
            }

            .footer-contact-icons {
                width: 20px;
                height: 20px;
            }

            .flight-summary-card {
                padding: 5px;
            }

            .flight-route {
                font-size: 12px;
            }

            .flight-date {
                font-size: 12px;
            }

            .flight-details-section {
                padding: 0;
            }

            .flight-extra-info {
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 0;
                font-size: 8px;
                padding: 0;
            }

            .stop-duration {
                font-size: 10px;
            }

            .airport-code {
                font-size: 14px;
            }

            .airport-time {
                font-size: 14px;
            }

            .airport-date {
                font-size: 11px;
            }

            .airport-name {
                font-size: 13px;
            }


            .flight-duration {
                font-size: 13px;
                margin: auto;
            }

            .reference-no {
                margin: 5px auto;
            }

            .travel-class {
                text-align: right;
            }
        }

        /* Print styles */
    </style>
</head>

<body>


    <!-- Booking Confirmation -->
    <div class="container my-4 py-5">
        <div class="header-logo">
            <div class="header-logo-content mb-4">
                <div class="logo">
                    <a href="{{ url('/') }}" class="text-decoration-none text-primary">BookMyFlight</a>
                </div>
                <div class="contact-info">
                    <div>
                        <a href="tel:+1 234 567 890"><i class="fas fa-phone-alt"></i><span>+1 234 567 890</span></a>
                    </div>
                    <div>
                        <a href="https://wa.me/966501234567" target="_blank">
                            <i class="fa-brands fa-whatsapp"></i><span>+1 234 567 890</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="successfully-confirm">
            <div style="margin-right: 10px;">
                <img src="{{ asset('assets/images/check-mark.png') }}" width="60px" height="60px" class="mr-1" alt="">
            </div>
            <div class="text-center">
                <h1 class="success-message mb-0">Your Booking Successfully Complete</h1>
                <p class="text-muted mb-0">Congratulations! Your Booking has been confirm. Thank you!</p>
            </div>

        </div>

        <div class="px-3">
            <p>Thank you for choosing Farebuddies as a preferred travel partner. Your booking is not confirmed yet and
                is under
                process, we will reach you soon via Phone or e-mail for further confirmation, In case you are not
                contacted within 4-24
                hours, feel free to give us a call back on our Toll-free number. Please find the below the travel
                details.</p>
            <p class="m-0">Please find the below the travel details.</p>
            <p>All prices are quoted in USD</p>
            <div>

                <b>OurAgent's Booking ID: {{ $selectedFlight['booking_reference'] }} |</b>
                <span>| Booked on {{ $selectedFlight['booking_date'] }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Booking Info -->
                <div class="card mb-4">
                    <div class="booking-info">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="fw-bold">{{ strtoupper($selectedFlight['passengers'][0]['title']) }} {{
                                    $selectedFlight['passengers'][0]['firstName'] }}</h5>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <p class="mb-1 text-muted">Phone No</p>
                                        <p class="mb-1 text-muted">Email Id</p>
                                        <p class="mb-1 text-muted">Destination</p>
                                        <p class="mb-1 text-muted">Booking Date</p>
                                    </div>
                                    <div class="col-8">
                                        <?php

                                            $destinationCity = session('flight_search.destination_city_name') ?? '';
                                            $cityName = '';
                                            $cityCode = '';
                                            $countryName = '';

                                            // Extract city name (text in parentheses)
                                            if (strpos($destinationCity, '(') !== false && strpos($destinationCity, ')') !== false) {
                                                preg_match('/\((.*?)\)/', $destinationCity, $matches);
                                                $airportCode = isset($matches[1]) ? trim($matches[1]) : '';


                                                $parts = explode(',', $destinationCity);
                                                $cityName = isset($parts[0]) ? trim($parts[0]) : '';
                                                $countryName = isset($parts[1]) ? trim($parts[1]) : '';
                                            }

                                        ?>
                                        <p class="mb-1">: {{ $selectedFlight['contact']['phone'] }}</p>
                                        <p class="mb-1">: {{ $selectedFlight['contact']['email'] }}</p>
                                        <p class="mb-1">: {{ $cityName }} {{ $countryName }}</p>
                                        <p class="mb-1">: {{ $selectedFlight['booking_date'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex justify-content-start align-items-center">
                                <div class="reference-no text-center">
                                    <p class="mb-1">Your booking reference no:</p>
                                    <p class="mb-0 fw-bold">{{ $selectedFlight['booking_reference'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flight Summary -->
                <div class="flight-summary-card">
                    <div id="flightSummary" class="collapse show">


                        <div class="flight-card">
                            <div class="flight-header">
                                <div class="airline-info mb-3">

                                    <div class="fw-bold">
                                        @if(isset($selectedFlight['segments_info'][0]['airline_info']['name']) &&
                                        $selectedFlight['segments_info'][0]['airline_info']['name'] !== 'UNKNOWN')
                                        {{ $selectedFlight['segments_info'][0]['airline_info']['name'] }}
                                        @else
                                        {{ $selectedFlight['validatingAirlineCodes'][0] ?? 'Unknown Airline' }}
                                        @endif
                                    </div>
                                    <div class="ms-auto travel-class">Travel Class: <span class="fw-bold">{{
                                            $selectedFlight['cabin']
                                            ??
                                            'Economy' }}</span></div>
                                </div><!-- flight-header -->

                                <div class="row" style="box-sizing: border-box;">
                                    <div class="col-12 flight-details-section">
                                        <!-- OUTBOUND FLIGHT -->
                                        <div class="flight-details" style="border-bottom: 1px solid #eee;">
                                            <div class="row">
                                                <!-- Departure Details -->
                                                <div class="col-4">
                                                    {{-- @dd(session('flight_search.origin_city_name')) --}}
                                                    <?php
                                                    // dd($selectedFlight['itineraries'][0]['segments'][0]['departure']['at']);
                                                    $departureTime = $selectedFlight['itineraries'][0]['segments'][0]['departure']['at'] ?? '';
                                                    $datetime = \Carbon\Carbon::parse($departureTime);

                                                    $originCity = session('flight_search.origin_city_name') ?? '';
                                                    $cityName = '';
                                                    $cityCode = '';

                                                    // Extract city name (text in parentheses)
                                                    if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
                                                        preg_match('/\((.*?)\)/', $originCity, $matches);
                                                        $cityName = isset($matches[1]) ? trim($matches[1]) : '';
                                                    }
                                                    // $dd($cityName, $originCity);

                                                    // Extract city code (after comma)
                                                    if (strpos($originCity, ',') !== false) {
                                                        $parts = explode(',', $originCity);
                                                        $cityCode = isset($parts[1]) ? trim($parts[1]) : '';
                                                    }
                                                ?>
                                                    <div class="flight-time">{{ $datetime->translatedFormat('H:i') }}
                                                    </div>
                                                    <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y')
                                                        }}
                                                    </div>
                                                    {{-- @dd($cityName, $cityCode) --}}
                                                    <div class="flight-airport">{{ $cityName }}</div>
                                                    <div class="flight-airport">{{ $cityCode }}</div>
                                                </div>

                                                <!-- Flight Duration -->
                                                <div
                                                    class="col-4 d-flex flex-column justify-content-center align-items-center">
                                                    <?php
                                                                                    if(isset($selectedFlight['itineraries'][0]['duration'])) {
                                                                                        $duration = $selectedFlight['itineraries'][0]['duration'];
                                                                                        // Convert PT2H30M format to 2h 30m
                                                                                        $duration = str_replace('PT', '', $duration);
                                                                                        $duration = str_replace('H', 'h ', $duration);
                                                                                        $duration = str_replace('M', 'm', $duration);
                                                                                    } else {
                                                                                        $duration = '';
                                                                                    }

                                                                                    $outboundStops = isset($selectedFlight['outbound_stops_text']) ? $selectedFlight['outbound_stops_text'] :
                                                                                                    (isset($selectedFlight['itineraries'][0]['segments']) ? (count($selectedFlight['itineraries'][0]['segments']) - 1) : '0');
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
                                                            {{-- <button
                                                                class="btn btn-outline-primary rounded-circle outbound-stops-toggle"
                                                                data-flight-id="{{ $selectedFlight['id'] }}"
                                                                style="width: 28px; height: 28px; padding: 0;">
                                                                <i class="fas fa-chevron-down"></i>
                                                            </button> --}}
                                                        </div>
                                                        @else
                                                        Direct Flight
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Arrival Details -->
                                                <div class="col-4 text-end">
                                                    <?php
                                                                                    $lastSegmentIndex = count($selectedFlight['itineraries'][0]['segments'] ?? []) - 1;
                                                                                    $arrivalTime = $selectedFlight['itineraries'][0]['segments'][$lastSegmentIndex]['arrival']['at'] ?? '';
                                                                                    $datetime = \Carbon\Carbon::parse($arrivalTime);
                                                                                ?>
                                                    <div class="flight-time">{{ $datetime->format('H:i')}}</div>
                                                    <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y')
                                                        }}
                                                    </div>
                                                    <div class="flight-airport">{{ trim(explode("(",
                                                        explode(")", session('flight_search.destination_city_name') ??
                                                        '')[0] ??
                                                        '')[1]
                                                        ??
                                                        '')
                                                        }}
                                                    </div>
                                                    <div class="flight-airport">{{ trim(explode(",",
                                                        session('flight_search.destination_city_name') ?? '')[1] ?? '')
                                                        }}</div>
                                                </div>
                                            </div>
                                        </div><!-- flight-details -->

                                        <!-- Outbound Stops Details (Initially Hidden) -->
                                        @if(isset($selectedFlight['itineraries'][0]['segments']) &&
                                        count($selectedFlight['itineraries'][0]['segments']) > 1)
                                        <div class="outbound-stops-details"
                                            id="outbound-stops-{{ $selectedFlight['id'] }}">
                                            <div class="stops-details-container p-3 bg-light">
                                                <h6 class="mb-3">Connection Details</h6>

                                                @foreach($selectedFlight['itineraries'][0]['segments'] as $key =>
                                                $segment)
                                                @if($key < count($selectedFlight['itineraries'][0]['segments'])) <div
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
                                                                                                    $prevArrival = \Carbon\Carbon::parse($selectedFlight['itineraries'][0]['segments'][$key-1]['arrival']['at'] ?? '');
                                                                                                    $connectionTime = $departureDateTime->diffInMinutes($prevArrival);
                                                                                                    $connectionHours = floor($connectionTime / 60);
                                                                                                    $connectionMinutes = $connectionTime % 60;
                                                                                                }
                                                                                            ?>

                                                    <!-- For outbound flights -->
                                                    @if($key > 0)
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span><i class="fas fa-clock text-warning me-1"></i> Connection
                                                            time:
                                                            @if($connectionHours > 0){{ $connectionHours }}h @endif
                                                            {{ $connectionMinutes }}m at {{ $departureAirport }}
                                                        </span>
                                                        <span class="badge bg-secondary">

                                                            @if(isset($selectedFlight['segments_info'][0]['airline_info']['name'])
                                                            &&
                                                            $selectedFlight['segments_info'][0]['airline_info']['name']
                                                            !== 'UNKNOWN')
                                                            {{
                                                            $selectedFlight['segments_info'][0]['airline_info']['name']
                                                            }}
                                                            @else
                                                            {{ $selectedFlight['validatingAirlineCodes'][0] ?? 'Unknown
                                                            Airline'
                                                            }}
                                                            @endif

                                                        </span>
                                                    </div><!-- d-flex justify-content-between mb-2 -->
                                                    @else
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span><i class="fas fa-plane-departure text-success me-1"></i>
                                                            Departure</span>
                                                        <span class="badge bg-secondary">
                                                            @if(isset($selectedFlight['segments_info'][0]['airline_info']['name'])
                                                            &&
                                                            $selectedFlight['segments_info'][0]['airline_info']['name']
                                                            !==
                                                            'UNKNOWN')
                                                            {{
                                                            $selectedFlight['segments_info'][0]['airline_info']['name']
                                                            }}
                                                            @else
                                                            {{ $selectedFlight['validatingAirlineCodes'][0] ?? 'Unknown
                                                            Airline'
                                                            }}
                                                            @endif
                                                        </span>
                                                    </div><!-- /d-flex justify-content-between mb-2 -->
                                                    @endif

                                                    <div class="row">
                                                        <div class="col-5">
                                                            <?php
                                                                $departureTime = $selectedFlight['itineraries'][0]['segments'][0]['departure']['at'] ?? '';
                                                                $datetime = \Carbon\Carbon::parse($departureTime);

                                                                $originCity = session('flight_search.origin_city_name') ?? '';
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

                                                            <div class="text-primary">{{
                                                                $departureDateTime->format('H:i')
                                                                }}
                                                            </div>
                                                            <div class="small">{{
                                                                $departureDateTime->translatedFormat('d M
                                                                Y')
                                                                }}
                                                            </div>
                                                            <div>{{ $departureAirport }}</div>
                                                        </div>
                                                        <div class="col-2 stop-duration">
                                                            <div class="small">{{ str_replace(['PT', 'H', 'M'], ['', 'h
                                                                ',
                                                                'm'],
                                                                $segment['duration'] ?? '') }}</div>
                                                            <div><i class="fas fa-arrow-right"></i></div>
                                                        </div>
                                                        <div class="col-5 text-end">
                                                            <div class="text-primary">{{ $arrivalDateTime->format('H:i')
                                                                }}
                                                            </div>
                                                            <div class="small">{{ $arrivalDateTime->translatedFormat('d
                                                                M
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
                                    @if (isset($selectedFlight['itineraries'][1]))
                                    <div class="flight-details mt-3">
                                        <div class="row">
                                            <!-- Departure Details -->
                                            <div class="col-4">
                                                <?php
                                                                                    $departureTime = $selectedFlight['itineraries'][1]['segments'][0]['departure']['at'] ?? '';
                                                                                    $datetime = \Carbon\Carbon::parse($departureTime);

                                                                                    $destinationCity = session('flight_search.destination_city_name') ?? '';
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
                                                <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}
                                                </div>
                                                <div class="flight-airport">{{ $cityName }}</div>
                                                <div class="flight-airport">{{ $cityCode }}</div>
                                            </div>

                                            <!-- Flight Duration -->
                                            <div
                                                class="col-4 d-flex flex-column justify-content-center align-items-center">
                                                <?php
                                                                                    if(isset($selectedFlight['itineraries'][1]['duration'])) {
                                                                                        $duration = $selectedFlight['itineraries'][1]['duration'];
                                                                                        // Convert PT2H30M format to 2h 30m
                                                                                        $duration = str_replace('PT', '', $duration);
                                                                                        $duration = str_replace('H', 'h ', $duration);
                                                                                        $duration = str_replace('M', 'm', $duration);
                                                                                    } else {
                                                                                        $duration = '';
                                                                                    }

                                                                                    $inboundStops = isset($selectedFlight['inbound_stops_text']) ? $selectedFlight['inbound_stops_text'] :
                                                                                                    (isset($selectedFlight['itineraries'][1]['segments']) ? (count($selectedFlight['itineraries'][1]['segments']) - 1) : '0');
                                                                                ?>
                                                <div class="flight-duration">{{ $duration }}</div>
                                                <div class="position-relative w-100 my-2">
                                                    <div class="border-top w-100"></div>
                                                    <i
                                                        class="fas fa-plane position-absolute top-0 start-50 translate-middle bg-white px-1"></i>
                                                </div>
                                                <div class="flight-duration">
                                                    @if($inboundStops > 0)
                                                    <div>{{ $inboundStops }} stop(s)</div>
                                                    <div class="mt-1">

                                                    </div>
                                                    @else
                                                    Direct Flight
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Arrival Details -->
                                            <div class="col-4 text-end">
                                                <?php
                                                                                    $lastSegmentIndex = count($selectedFlight['itineraries'][1]['segments'] ?? []) - 1;
                                                                                    $arrivalTime = $selectedFlight['itineraries'][1]['segments'][$lastSegmentIndex]['arrival']['at'] ?? '';
                                                                                    $datetime = \Carbon\Carbon::parse($arrivalTime);

                                                                                    $originCity = session('flight_search.destination_city_name') ?? '';
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
                                                <div class="flight-date">{{ $datetime->translatedFormat('d, D M Y') }}
                                                </div>
                                                <div class="flight-airport">{{ $returnCityName }}</div>
                                                <div class="flight-airport">{{ $returnCityCode }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Inbound Stops Details (Initially Hidden) -->
                                    @if(isset($selectedFlight['itineraries'][1]['segments']) &&
                                    count($selectedFlight['itineraries'][1]['segments'])
                                    > 1)
                                    <div class="inbound-stops-details" id="inbound-stops-{{ $selectedFlight['id'] }}">
                                        <div class="stops-details-container p-3 bg-light">
                                            <h6 class="mb-3">Connection Details</h6>

                                            @foreach($selectedFlight['itineraries'][1]['segments'] as $key => $segment)
                                            @if($key < count($selectedFlight['itineraries'][1]['segments'])) <div
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
                                                                                    $prevArrival = \Carbon\Carbon::parse($selectedFlight['itineraries'][1]['segments'][$key-1]['arrival']['at'] ?? '');
                                                                                    $connectionTime = $departureDateTime->diffInMinutes($prevArrival);
                                                                                    $connectionHours = floor($connectionTime / 60);
                                                                                    $connectionMinutes = $connectionTime % 60;
                                                                                }
                                                                            ?>
                                                {{-- @dd($selectedFlight['itineraries'][1]['segments']) --}}

                                                <!-- For Inbound flights -->
                                                @if($key > 0)
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span><i class="fas fa-clock text-warning me-1"></i> Connection
                                                        time:
                                                        @if($connectionHours > 0){{ $connectionHours }}h @endif
                                                        {{ $connectionMinutes }}m at {{ $departureAirport }}
                                                    </span>
                                                    <span class="badge bg-secondary">
                                                        @if(isset($selectedFlight['segments_info'][0]['airline_info']['name'])
                                                        &&
                                                        $selectedFlight['segments_info'][0]['airline_info']['name'] !==
                                                        'UNKNOWN')
                                                        {{ $selectedFlight['segments_info'][0]['airline_info']['name']
                                                        }}
                                                        @else
                                                        {{ $selectedFlight['validatingAirlineCodes'][0] ?? 'Unknown
                                                        Airline'
                                                        }}
                                                        @endif
                                                    </span>
                                                </div>
                                                @else
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span><i class="fas fa-plane-departure text-success me-1"></i>
                                                        Departure</span>
                                                    <span class="badge bg-secondary">
                                                        @if(isset($selectedFlight['segments_info'][0]['airline_info']['name'])
                                                        &&
                                                        $selectedFlight['segments_info'][0]['airline_info']['name'] !==
                                                        'UNKNOWN')
                                                        {{ $selectedFlight['segments_info'][0]['airline_info']['name']
                                                        }}
                                                        @else
                                                        {{ $selectedFlight['validatingAirlineCodes'][0] ?? 'Unknown
                                                        Airline'
                                                        }}
                                                        @endif
                                                    </span>
                                                </div>
                                                @endif

                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="text-primary">{{ $departureDateTime->format('H:i')
                                                            }}
                                                        </div>
                                                        <div class="small">{{ $departureDateTime->translatedFormat('d M
                                                            Y')
                                                            }}
                                                        </div>
                                                        <div>{{ $departureAirport }}</div>
                                                    </div>
                                                    <div class="col-2 stop-duration">
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
                                                </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @endif

                            </div><!-- col-md-9 -->




                        </div><!-- row -->

                        <!-- Seats Remaining and Refund Status -->
                        <div class="flight-extra-info">
                            <div style="padding: 10px 15px;">{{ $selectedFlight['numberOfBookableSeats'] ?? '0' }} seats
                                remaining
                            </div>
                            <!-- Flight Footer -->
                            <div class="flight-footer d-flex justify-content-start">
                                <div class="me-4">
                                    <i class="fas fa-ticket-alt me-1"></i> Last Ticket Date : {{
                                    $selectedFlight['lastTicketingDate'] }}
                                </div>
                                <div class="me-4">
                                    <i class="fa-solid fa-suitcase-rolling me-1"></i> Checked Bags : {{
                                    $selectedFlight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['quantity']
                                    ??
                                    0
                                    }}
                                </div>
                                {{-- <div class="me-4">
                                    <i class="fas fa-exchange-alt me-1"></i> Self Transfer
                                </div> --}}
                                <div>
                                    <i class="fas fa-suitcase-rolling me-1"></i> Cabin Bags : {{
                                    $selectedFlight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCabinBags']['quantity']
                                    ?? 0
                                    }}
                                </div>
                            </div>
                        </div>
                    </div><!-- Flight Card -->


                </div>
            </div><!-- collapse show -->
        </div>

        <!-- Passengers Details -->
        <div class="card mb-4">

            <div class="passengers-details">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-users me-2"></i> Passengers Details
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="passenger-table table table-bordered">
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
                            @foreach($selectedFlight['passengers'] as $index => $passenger)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $passenger['title'] ?? '' }}</td>
                                <td>{{ $passenger['firstName'] ?? '' }}</td>
                                <td>{{ $passenger['middleName'] ?? '' }}</td>
                                <td>{{ $passenger['lastName'] ?? '' }}</td>
                                <td>{{ $passenger['gender'] ?? '' }}</td>
                                <td>{{ $passenger['birthDate'] ?? '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Payment Summary -->
        <div class="card mb-4 card-payment">
            <div class="card-body">

                <h5>PAYMENT</h5>

                @php
                // استرجاع نوع البطاقة ورقمها من الجلسة
                $cardType = $selectedFlight['payment']['cardType'] ?? 'visa'; // القيمة الافتراضية هي visa
                $cardNumber = $selectedFlight['payment']['cardNumber'] ?? ''; // رقم البطاقة من الجلسة

                // تحويل رقم البطاقة إلى النمط المطلوب (XXXX على كل الأرقام ما عدا آخر 4)
                $maskedNumber = strlen($cardNumber) > 4
                ? str_repeat('X', strlen($cardNumber) - 4) . substr($cardNumber, -4)
                : $cardNumber;

                // تحديد الصورة والاسم حسب نوع البطاقة
                $cardInfo = [
                'visa' => [
                'name' => 'VISA',
                'image' => 'visa.webp',
                'class' => 'visa-card'
                ],
                'mastercard' => [
                'name' => 'Mastercard',
                'image' => 'mastercard.webp',
                'class' => 'mastercard-card'
                ],
                'amex' => [
                'name' => 'American Express',
                'image' => 'american-express.webp',
                'class' => 'amex-card'
                ],
                'discover' => [
                'name' => 'Discover',
                'image' => 'discover.webp',
                'class' => 'discover-card'
                ]
                ];

                // get the current card info based on the card type
                $currentCard = $cardInfo[$cardType] ?? $cardInfo['visa'];
                @endphp

                <div class="{{ $currentCard['class'] }} mt-3 mb-4">
                    <div class="d-flex align-items-center">
                        <div class="card-logo-container" style="padding-right: 15px; border-right: 1px solid #000;">
                            @if(isset($currentCard['image']))
                            <img src="{{ asset('assets/images/' . $currentCard['image']) }}"
                                alt="{{ $currentCard['name'] }}" class="card-logo" style="height: 30px; width: auto;">
                            @else
                            <span class="card-name">{{ $currentCard['name'] }}</span>
                            @endif
                        </div>
                        <div style="margin-left: 15px;">
                            <p class="mb-1">Base fare</p>
                            <p class="mb-0">{{ $maskedNumber }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <h5>FARE BREAKUP</h5>
                    <div class="fare-section px-3 mt-1">
                        <div class="fare-section-title" data-bs-toggle="collapse" data-bs-target="#baseFare">
                            <span>Base fare</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div id="baseFare" class="collapse show fare-section-content">
                            <!-- Adults -->
                            @php
                            // Filter adult travelers
                            $adultTravelers = [];
                            foreach ($selectedFlight['travelerPricings'] as $traveler) {
                            if ($traveler['travelerType'] == 'ADULT') {
                            $adultTravelers[] = $traveler;
                            // dd($adultTravelers);
                            }
                            }

                            // Get the first adult's price
                            $adultPrice = !empty($adultTravelers) ? $adultTravelers[0]['price']['total'] : 0;

                            // Get count from session (without 'flight_search' prefix)
                            $adultCount = session('flight_search.adults');
                            $adultTotal = $adultPrice * $adultCount;
                            @endphp

                            <div class="fare-item">
                                {{-- @dd($adultTotal) --}}
                                <span>Adult({{ $adultCount }}) ({{ $adultCount }} × ${{ $adultPrice }})</span>
                                <span>${{ $adultTotal }}</span>
                            </div>

                            <!-- Children -->
                            @php
                            // Filter child travelers
                            $childTravelers = [];
                            foreach ($selectedFlight['travelerPricings'] as $traveler) {
                            if ($traveler['travelerType'] == 'CHILD') {
                            $childTravelers[] = $traveler;
                            }
                            }

                            // Get the first child's price
                            $childPrice = !empty($childTravelers) ? $childTravelers[0]['price']['total'] : 0;

                            // Get count from session
                            $childCount = session('flight_search.children');
                            $childTotal = $childPrice * $childCount;
                            @endphp

                            @if($childCount > 0)
                            <div class="fare-item">
                                <span>Child({{ $childCount }}) ({{ $childCount }} × ${{ $childPrice }})</span>
                                <span>${{ $childTotal }}</span>
                            </div>
                            @endif

                            <!-- Infants -->
                            @php
                            // Filter infant travelers
                            $infantTravelers = [];
                            foreach ($selectedFlight['travelerPricings'] as $traveler) {
                            if ($traveler['travelerType'] == 'HELD_INFANT') {
                            $infantTravelers[] = $traveler;
                            }
                            }

                            // Get the first infant's price
                            $infantPrice = !empty($infantTravelers) ? $infantTravelers[0]['price']['total'] : 0;

                            // Get count from session
                            $infantCount = session('flight_search.held_infants');
                            $infantTotal = $infantPrice * $infantCount;
                            @endphp

                            @if($infantCount > 0)
                            <div class="fare-item">
                                <span>Infant({{ $infantCount }}) ({{ $infantCount }} × ${{ $infantPrice
                                    }})</span>
                                <span>${{ $infantTotal }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="payment-summary mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Total Amount</span>
                        <span class="total">${{ $selectedFlight['price']['total'] }}</span>
                    </div>
                    <small>All prices (including taxes& fees) are quoted in USD</small>
                </div>

                <div class="mt-4 text-center d-flex justify-content-start align-items-center px-3">
                    <div class="me-3">
                        <img src="{{ asset('assets/images/phone-call.webp') }}" width="50px" height="50px" alt="">
                    </div>
                    <div>
                        <p class="m-0 text-start">Need Any Help?</p>
                        <a href="tel:+" style="text-decoration: none; color: #4B45FF;">Call Now
                            <strong>+1-111-111-1111</strong></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</body>

</html>
