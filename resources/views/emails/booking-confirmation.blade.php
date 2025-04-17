<!-- resources/views/emails/flight_summary.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Flight Booking Summary</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 14px; color: #333; margin: 0; padding: 0;">





    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f7f7f7; padding: 40px 0;">

        <tr>
            <td align="center">
                <table align="center" border="0" width="600" style="max-width:100%; margin-bottom:15px ;">
                    <tbody>
                        <tr>
                            <td align="left" width="10"></td>
                            <td align="left" valign="middle" width="210">
                                <table align="left" border="0">
                                    <tbody>
                                        <tr>
                                            <td height="63" align="left" valign="middle"><a href="https://google.com/"
                                                    target="_blank">OurAgent's Name</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td align="right" valign="middle" width="410">
                                <table width="100%" border="0" align="right">
                                    <tbody>
                                        <tr>
                                            <td align="right"
                                                style="line-height:15px;font-family:Arial,Helvetica,sans-serif;color:#143ca1;font-weight:bold;font-size:20px">
                                                <span>Phone: </span>
                                                <a href="tel:+1-234-567-890" target="_blank"
                                                    style="text-decoration: none;">+1-234-567-89</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"
                                                style="line-height:15px;font-family:Arial,Helvetica,sans-serif;color:#143ca1;font-weight:bold;font-size:20px">
                                                <span>WhatsApp: </span><a href="https://wa.me/966501234567"
                                                    style="text-decoration: none;">+1-667-383-5536</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td align="right" width="10"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; font-family: Arial, sans-serif; overflow: hidden;">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #e6f4ea; padding:15px;">
                            <img src="{{ asset('assets/images/check-mark.jpg') }}" width="50" height="50"
                                alt="Success Icon" style="display: block; margin-bottom: 15px;" />
                            <h2 style="color: #2e7d32; margin: 0; font-size: 24px;">Booking Confirmation</h2>
                            <p style="color: #4f4f4f; font-size: 14px; margin-top: 10px;">Thank you for booking with us.
                                Below are your flight and payment details.</p>
                        </td>
                    </tr>

                    <!-- Intro Message -->
                    <tr>
                        <td style="padding: 10px 20px;">
                            <p style="font-size: 14px; color: #4f4f4f;">
                                Thank you for choosing OurAgent as a preferred travel partner. Your booking is not
                                confirmed yet and is under process, we will reach you soon via Phone or e-mail for
                                further confirmation, In case you are not contacted within 4-24 hours, feel free to give
                                us a call back on our Toll-free number.
                            </p>
                            <p>Please find the below the travel details.</p>
                            <b>OurAgent's Booking ID: {{ $selectedFlight['booking_reference'] }} |</b>
                            <span>| Booked on {{ $selectedFlight['booking_date'] }}</span>
                        </td>
                    </tr>

                    <!-- Flight Summary -->
                    <tr>
                        <td style="padding: 15px 20px; border: 15px solid #000;">
                            <h3
                                style="margin-bottom: 15px; font-size: 18px; border-bottom: 1px solid #ddd; padding-bottom: 8px; color: #6c3eff;">
                                Flight Details</h3>

                            @php

                            $departureTime = $selectedFlight['itineraries'][0]['segments'][0]['departure']['at'] ?? '';
                            $departureDatetime = \Carbon\Carbon::parse($departureTime);

                            $originCity = session('flight_search.origin_city_name') ?? '';
                            $cityName = '';
                            $cityCode = '';
                            $countryName = '';

                            // Extract city name (text in parentheses)
                            if (strpos($originCity, '(') !== false && strpos($originCity, ')') !== false) {
                            preg_match('/\((.*?)\)/', $originCity, $matches);
                            $airportCode = isset($matches[1]) ? trim($matches[1]) : '';


                            $parts = explode(',', $originCity);
                            $originCityName = isset($parts[0]) ? trim($parts[0]) : '';
                            $originCountryName = isset($parts[1]) ? trim($parts[1]) : '';
                            }

                            // Extract destination city name (text in parentheses)
                            $lastSegmentIndex = count($selectedFlight['itineraries'][0]['segments'] ?? []) - 1;
                            $arrivalTime =
                            $selectedFlight['itineraries'][0]['segments'][$lastSegmentIndex]['arrival']['at'] ?? '';
                            $arrivalDatetime = \Carbon\Carbon::parse($arrivalTime);

                            $destinationCity = session('flight_search.destination_city_name') ?? '';
                            $cityName = '';
                            $cityCode = '';
                            $countryName = '';

                            // Extract city name (text in parentheses)
                            if (strpos($destinationCity, '(') !== false && strpos($destinationCity, ')') !== false) {
                            preg_match('/\((.*?)\)/', $destinationCity, $matches);
                            $airportCode = isset($matches[1]) ? trim($matches[1]) : '';

                            // extract city and country names
                            $parts = explode(',', $destinationCity);
                            $destinationCityName = isset($parts[0]) ? trim($parts[0]) : '';
                            $destinationCountryName = isset($parts[1]) ? trim($parts[1]) : '';

                            }

                            if(isset($selectedFlight['itineraries'][0]['duration'])) {
                            $duration = $selectedFlight['itineraries'][0]['duration'];
                            // Convert PT2H30M format to 2h 30m
                            $duration = str_replace('PT', '', $duration);
                            $duration = str_replace('H', 'h ', $duration);
                            $duration = str_replace('M', 'm', $duration);
                            } else {
                            $duration = '';
                            }
                            if(isset($selectedFlight['itineraries'][1]['duration'])) {
                            $returnDuration = $selectedFlight['itineraries'][1]['duration'];
                            // Convert PT2H30M format to 2h 30m
                            $returnDuration = str_replace('PT', '', $returnDuration);
                            $returnDuration = str_replace('H', 'h ', $returnDuration);
                            $returnDuration = str_replace('M', 'm', $returnDuration);
                            } else {
                            $returnDuration = '';
                            }

                            // Extract connection origin duration
                            if(isset($selectedFlight['itineraries'][0]['segments'][0]['departure']['at'])) {
                            $connectionOriginDuration = $selectedFlight['itineraries'][0]['segments'][0]['duration'] ??
                            '';

                            // Convert PT2H30M format to 2h 30m
                            $connectionOriginDuration = str_replace('PT', '', $connectionOriginDuration);
                            $connectionOriginDuration = str_replace('H', 'h ', $connectionOriginDuration);
                            $connectionOriginDuration = str_replace('M', 'm', $connectionOriginDuration);
                            } else {
                            $connectionOriginDuration = '';
                            }
                            // Extract connection destination duration
                            if(isset($selectedFlight['itineraries'][0]['segments'][0]['departure']['at'])) {
                            $connectionDestinationDuration =
                            $selectedFlight['itineraries'][0]['segments'][1]['duration'] ?? '';
                            // Convert PT2H30M format to 2h 30m
                            $connectionDestinationDuration = str_replace('PT', '', $connectionDestinationDuration);
                            $connectionDestinationDuration = str_replace('H', 'h ', $connectionDestinationDuration);
                            $connectionDestinationDuration = str_replace('M', 'm', $connectionDestinationDuration);
                            } else {
                            $connectionDestinationDuration = '';
                            }

                            // Extract connection destination duration
                            if(isset($selectedFlight['itineraries'][1]['segments'][0]['departure']['at'])) {
                            $connectionReturnOriginDuration =
                            $selectedFlight['itineraries'][0]['segments'][1]['duration'] ?? '';
                            // Convert PT2H30M format to 2h 30m
                            $connectionReturnOriginDuration = str_replace('PT', '', $connectionReturnOriginDuration);
                            $connectionReturnOriginDuration = str_replace('H', 'h ', $connectionReturnOriginDuration);
                            $connectionReturnOriginDuration = str_replace('M', 'm', $connectionReturnOriginDuration);
                            } else {
                            $connectionReturnOriginDuration = '';
                            }

                            // Extract connection destination duration
                            if(isset($selectedFlight['itineraries'][1]['segments'][1]['departure']['at'])) {
                            $connectionReturnDestinationDuration =
                            $selectedFlight['itineraries'][1]['segments'][1]['duration'] ?? '';
                            // Convert PT2H30M format to 2h 30m
                            $connectionReturnDestinationDuration = str_replace('PT', '',
                            $connectionReturnDestinationDuration);
                            $connectionReturnDestinationDuration = str_replace('H', 'h ',
                            $connectionReturnDestinationDuration);
                            $connectionReturnDestinationDuration = str_replace('M', 'm',
                            $connectionReturnDestinationDuration);
                            } else {
                            $connectionReturnDestinationDuration = '';
                            }

                            @endphp
                            <h3 style="color: #4444ff">Departure:</h3>

                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-bottom: 8px; padding-bottom:10px; font-size: 14px; border-bottom: 2px solid #000;">
                                <tr style="padding: 10px 0; height: 30px;">



                                    <td style="width: 45%;"><strong>From:</strong> {{ $originCityName }} ({{
                                        $departureDatetime }})</td>

                                    <td style="width: 45%;"><strong>To:</strong> {{ $destinationCityName }} ({{
                                        $arrivalDatetime }})</td>
                                </tr>
                                <tr>
                                    <td height="10" style="line-height:10px; font-size:10px;">&nbsp;</td>
                                </tr>
                                <tr>

                                    <td><strong>Airline:</strong> {{
                                        $selectedFlight['segments_info'][0]['airline_info']['name'] }}</td>

                                    <td><strong>Flight Number:</strong> {{
                                        $selectedFlight['segments_info'][0]['flightNumber'] }}</td>

                                    <td><strong>Duration:</strong> {{ $duration }}</td>
                                </tr>
                            </table>
                            @if (isset($selectedFlight['itineraries'][0]['segments']) &&
                            count($selectedFlight['itineraries'][0]['segments']) > 1)
                            <h3 style="color: #ffc107">Connection:</h3>
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-bottom: 18px; font-size: 14px; padding: 5px; border-left: 5px solid #198754;">
                                <tr style="height: 20px;">
                                    <td style="width: 45%;"><strong>From:</strong> {{
                                        $selectedFlight['itineraries'][0]['segments'][0]['departure']['iataCode'] }} ({{
                                        $selectedFlight['itineraries'][0]['segments'][0]['departure']['at'] }})
                                    </td>

                                    <td style="width: 45%;"><strong>To:</strong> {{
                                        $selectedFlight['itineraries'][0]['segments'][0]['arrival']['iataCode'] }}
                                        ({{ $selectedFlight['itineraries'][0]['segments'][0]['arrival']['at'] }})
                                    </td>
                                </tr>
                                <tr>
                                    <td height="10" style="line-height:10px; font-size:10px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>Airline:</strong> {{
                                        $selectedFlight['segments_info'][0]['airline_info']['name'] }}
                                    </td>

                                    <td><strong>Flight Number:</strong> {{
                                        $selectedFlight['segments_info'][0]['flightNumber'] }}
                                    </td>

                                    <td><strong>Duration:</strong> {{ $connectionOriginDuration }}</td>
                                </tr>
                            </table>
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-bottom: 18px; font-size: 14px; padding: 5px; border-left: 5px solid #0d6efd;">
                                <tr style="height: 20px;">
                                    <td style="width: 45%;"><strong>From:</strong> {{
                                        $selectedFlight['itineraries'][0]['segments'][1]['departure']['iataCode'] }} ({{
                                        $selectedFlight['itineraries'][0]['segments'][1]['departure']['at'] }})
                                    </td>

                                    <td style="width: 45%;"><strong>To:</strong> {{
                                        $selectedFlight['itineraries'][0]['segments'][1]['arrival']['iataCode'] }}
                                        ({{ $selectedFlight['itineraries'][0]['segments'][1]['arrival']['at'] }})
                                    </td>
                                </tr>
                                <tr>
                                    <td height="10" style="line-height:10px; font-size:10px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>Airline:</strong> {{
                                        $selectedFlight['segments_info'][0]['airline_info']['name'] }}
                                    </td>

                                    <td><strong>Flight Number:</strong> {{
                                        $selectedFlight['segments_info'][1]['flightNumber'] }}
                                    </td>

                                    <td><strong>Duration:</strong> {{ $connectionDestinationDuration }}</td>
                                </tr>
                            </table>
                            @endif


                            @if (session('flight_search.tripType') == 'roundTrip')
                            <h3 style="color: #4444ff">Return:</h3>
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-bottom: 8px; padding-bottom:10px; font-size: 14px; border-bottom: 2px solid #000;">
                                <tr style="padding: 10px 0; height: 30px;">



                                    <td style="width: 45%;"><strong>From:</strong> {{ $originCityName }}
                                        ({{$selectedFlight['return_segments_info'][0]['departure']['at'] }})</td>

                                    <td style="width: 45%;"><strong>To:</strong> {{ $destinationCityName }}
                                        ({{$selectedFlight['return_segments_info'][1]['arrival']['at'] }})</td>
                                </tr>
                                <tr>
                                    <td height="10" style="line-height:10px; font-size:10px;">&nbsp;</td>
                                </tr>
                                <tr>

                                    <td><strong>Airline:</strong> {{
                                        $selectedFlight['return_segments_info'][0]['airline_info']['name'] }}</td>

                                    <td><strong>Flight Number:</strong> {{
                                        $selectedFlight['return_segments_info'][0]['flightNumber'] }}</td>

                                    <td><strong>Duration:</strong> {{ $returnDuration }}</td>
                                </tr>
                            </table>
                            @if (isset($selectedFlight['itineraries'][1]['segments']) &&
                            count($selectedFlight['itineraries'][1]['segments']) > 1)
                            <h3 style="color: #ffc107">Connection:</h3>
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-bottom: 18px; font-size: 14px; padding: 5px; border-left: 5px solid #198754;">
                                <tr style="height: 20px;">
                                    <td style="width: 45%;"><strong>From:</strong> {{
                                        $selectedFlight['itineraries'][1]['segments'][0]['departure']['iataCode'] }} ({{
                                        $selectedFlight['itineraries'][1]['segments'][0]['departure']['at'] }})
                                    </td>

                                    <td style="width: 45%;"><strong>To:</strong> {{
                                        $selectedFlight['itineraries'][1]['segments'][0]['arrival']['iataCode'] }}
                                        ({{ $selectedFlight['itineraries'][1]['segments'][0]['arrival']['at'] }})
                                    </td>
                                </tr>
                                <tr>
                                    <td height="10" style="line-height:10px; font-size:10px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>Airline:</strong> {{
                                        $selectedFlight['return_segments_info'][0]['airline_info']['name'] }}
                                    </td>

                                    <td><strong>Flight Number:</strong> {{
                                        $selectedFlight['return_segments_info'][0]['flightNumber'] }}
                                    </td>

                                    <td><strong>Duration:</strong> {{ $connectionReturnOriginDuration }}</td>
                                </tr>
                            </table>
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-bottom: 18px; font-size: 14px; padding: 5px; border-left: 5px solid #0d6efd;">
                                <tr style="height: 20px;">
                                    <td style="width: 45%;"><strong>From:</strong> {{
                                        $selectedFlight['itineraries'][1]['segments'][1]['departure']['iataCode'] }} ({{
                                        $selectedFlight['itineraries'][1]['segments'][1]['departure']['at'] }})
                                    </td>

                                    <td style="width: 45%;"><strong>To:</strong> {{
                                        $selectedFlight['itineraries'][1]['segments'][1]['arrival']['iataCode'] }}
                                        ({{ $selectedFlight['itineraries'][1]['segments'][1]['arrival']['at'] }})
                                    </td>
                                </tr>
                                <tr>
                                    <td height="10" style="line-height:10px; font-size:10px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>Airline:</strong> {{
                                        $selectedFlight['return_segments_info'][0]['airline_info']['name'] }}
                                    </td>

                                    <td><strong>Flight Number:</strong> {{
                                        $selectedFlight['return_segments_info'][1]['flightNumber'] }}
                                    </td>

                                    <td><strong>Duration:</strong> {{ $connectionReturnDestinationDuration }}</td>
                                </tr>
                            </table>
                            @endif
                            @endif


                            <p style="font-size: 14px;"><strong>Seats Remaining:</strong> {{
                                $selectedFlight['numberOfBookableSeats'] ?? '0' }}</p>
                            <p style="font-size: 14px;"><strong>Last Ticket Date:</strong> {{
                                $selectedFlight['lastTicketingDate'] }}</p>
                            <p style="font-size: 14px;"><strong>Checked Bags:</strong> {{
                                $selectedFlight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['quantity']
                                ??
                                0
                                }}</p>
                            <p style="font-size: 14px;"><strong>Cabin Bags:</strong> {{
                                $selectedFlight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCabinBags']['quantity']
                                ?? 0
                                }}</p>
                        </td>
                    </tr>
                    <!-- Passenger Info -->
                    <tr>
                        <td style="padding:15px 20px; border:10px solid #000;">
                            <h3
                                style="margin-bottom: 15px; font-size: 18px; border-bottom: 1px solid #ddd; padding-bottom: 8px;">
                                Passenger Details</h3>
                            <table width="100%" cellpadding="8" cellspacing="0"
                                style="border-collapse: collapse; font-size: 14px;">
                                <thead>
                                    <tr style="background-color: #f2f2f2;">
                                        <th align="left" style="border: 1px solid #ccc;">#</th>
                                        <th align="left" style="border: 1px solid #ccc;">Title</th>
                                        <th align="left" style="border: 1px solid #ccc;">First Name</th>
                                        <th align="left" style="border: 1px solid #ccc;">Last Name</th>
                                        <th align="left" style="border: 1px solid #ccc;">Gender</th>
                                        <th align="left" style="border: 1px solid #ccc;">DOB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($selectedFlight['passengers'] as $index => $passenger)
                                    <tr>
                                        <td style="border: 1px solid #ccc;">{{ $index + 1 }}</td>
                                        <td style="border: 1px solid #ccc;">{{ $passenger['title'] ?? '' }}</td>
                                        <td style="border: 1px solid #ccc;">{{ $passenger['firstName'] ?? '' }}</td>
                                        <td style="border: 1px solid #ccc;">{{ $passenger['lastName'] ?? '' }}</td>
                                        <td style="border: 1px solid #ccc;">{{ $passenger['gender'] ?? '' }}</td>
                                        <td style="border: 1px solid #ccc;">{{ $passenger['birthDate'] ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <!-- Payment Summary -->
                    <tr>
                        <td style="padding:15px 20px; border:10px solid #000;">
                            <h3
                                style="margin-bottom: 15px; font-size: 18px; border-bottom: 1px solid #ddd; padding-bottom: 8px;">
                                Payment Summary</h3>

                            @php
                            $adultCount = session('flight_search.adults');
                            $childCount = session('flight_search.children');
                            $infantCount = session('flight_search.held_infants');

                            $adultTotal = 0;
                            $childTotal = 0;
                            $infantTotal = 0;

                            foreach ($selectedFlight['travelerPricings'] as $traveler) {
                            if ($traveler['travelerType'] == 'ADULT') {
                            $adultTotal += $traveler['price']['total'];
                            } elseif ($traveler['travelerType'] == 'CHILD') {
                            $childTotal += $traveler['price']['total'];
                            } elseif ($traveler['travelerType'] == 'HELD_INFANT') {
                            $infantTotal += $traveler['price']['total'];
                            }
                            }

                            $totalAmount = $selectedFlight['price']['total'];
                            @endphp

                            <table width="100%" cellpadding="8" cellspacing="0" style="font-size: 14px;">
                                @if( $adultCount > 0)
                                <tr>
                                    <td>Adult ({{ $adultCount }})</td>
                                    <td align="right">${{ $adultTotal }}</td>
                                </tr>
                                @endif
                                @if( $childCount > 0)
                                <tr>
                                    <td>Child ({{ $childCount }})</td>
                                    <td align="right">${{ $childTotal }}</td>
                                </tr>
                                @endif
                                @if( $infantCount > 0)
                                <tr>
                                    <td>Infant ({{ $infantCount }})</td>
                                    <td align="right">${{ $infantTotal }}</td>
                                </tr>
                                @endif
                                <tr style="border-top: 1px solid #ccc; font-weight: bold;">
                                    <td>Total Amount</td>
                                    <td align="right">${{ $totalAmount }}</td>
                                </tr>
                            </table>
                            <p style="margin-top: 10px; font-size: 12px; color: #888;">All prices are in USD and include
                                applicable taxes and fees.</p>
                        </td>
                    </tr>

                    <!-- Support -->
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 30px; text-align: center;">
                            <p style="margin: 0 0 10px 0; font-size: 14px;">Need Any Help?</p>
                            <a href="tel:+1111111111"
                                style="color: #4B45FF; text-decoration: none; font-weight: bold; font-size: 16px;">Call
                                Now:
                                +1-111-111-1111</a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px; font-size: 12px; text-align: center; color: #999;">
                            This is an automated confirmation email. Please do not reply.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
