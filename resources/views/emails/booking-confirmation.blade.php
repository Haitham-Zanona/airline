<!-- resources/views/emails/flight_summary.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Flight Booking Summary</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 14px; color: #333; margin: 0; padding: 0;">
    {{-- <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f7f7f7; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; padding: 20px; border-radius: 6px;">
                    <tr>
                        <td style="text-align: center; font-size: 20px; font-weight: bold; padding-bottom: 20px;">
                            Flight Booking Summary
                        </td>
                    </tr>

                    <!-- Flight Info -->
                    <tr>
                        <td style="padding: 10px 0; font-weight: bold; border-bottom: 1px solid #ddd;">
                            Flight Details
                        </td>
                    </tr>
                    @foreach ($selectedFlight['itineraries'][0]['segments'] as $segment)
                    <tr>
                        <td style="padding: 10px 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding: 5px 0;"><strong>From:</strong> {{
                                        $segment['departure']['iataCode'] }} ({{ $segment['departure']['at'] }})</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0;"><strong>To:</strong> {{ $segment['arrival']['iataCode']
                                        }} ({{ $segment['arrival']['at'] }})</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0;"><strong>Airline:</strong> {{ $segment['carrierCode'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0;"><strong>Flight Number:</strong> {{ $segment['number'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0;"><strong>Duration:</strong> {{ $segment['duration'] }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endforeach

                    <tr>
                        <td style="padding: 10px 0; border-top: 1px solid #ddd;">
                            <strong>Seats Remaining:</strong> {{ $selectedFlight['numberOfBookableSeats'] ?? '0' }}<br>
                            <strong>Last Ticket Date:</strong> {{ $selectedFlight['lastTicketingDate'] }}<br>
                            <strong>Checked Bags:</strong>
                            {{
                            $selectedFlight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['quantity']
                            ?? 0 }}<br>
                            <strong>Cabin Bags:</strong>
                            {{
                            $selectedFlight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCabinBags']['quantity']
                            ?? 0 }}
                        </td>
                    </tr>
                    <!-- Passenger Details -->
                    <tr>
                        <td style="padding: 20px 0 10px; font-weight: bold; border-bottom: 1px solid #ddd;">
                            Passengers Details
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
                                <thead>
                                    <tr style="background-color: #f0f0f0;">
                                        <th align="left" style="border: 1px solid #ddd;">#</th>
                                        <th align="left" style="border: 1px solid #ddd;">Title</th>
                                        <th align="left" style="border: 1px solid #ddd;">First Name</th>
                                        <th align="left" style="border: 1px solid #ddd;">Last Name</th>
                                        <th align="left" style="border: 1px solid #ddd;">Gender</th>
                                        <th align="left" style="border: 1px solid #ddd;">DOB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($selectedFlight['passengers'] as $index => $passenger)
                                    <tr>
                                        <td style="border: 1px solid #ddd;">{{ $index + 1 }}</td>
                                        <td style="border: 1px solid #ddd;">{{ $passenger['title'] ?? '' }}</td>
                                        <td style="border: 1px solid #ddd;">{{ $passenger['firstName'] ?? '' }}</td>
                                        <td style="border: 1px solid #ddd;">{{ $passenger['lastName'] ?? '' }}</td>
                                        <td style="border: 1px solid #ddd;">{{ $passenger['gender'] ?? '' }}</td>
                                        <td style="border: 1px solid #ddd;">{{ $passenger['birthDate'] ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <!-- Payment Summary -->
                    <tr>
                        <td style="padding: 20px 0 10px; font-weight: bold; border-bottom: 1px solid #ddd;">
                            Payment Summary
                        </td>
                    </tr>
                    <tr>
                        <td>
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

                            <table width="100%" cellpadding="5" cellspacing="0">
                                @if($adultCount > 0)
                                <tr>
                                    <td>Adult ({{ $adultCount }})</td>
                                    <td align="right">${{ number_format($adultTotal, 2) }}</td>
                                </tr>
                                @endif

                                @if($childCount > 0)
                                <tr>
                                    <td>Child ({{ $childCount }})</td>
                                    <td align="right">${{ number_format($childTotal, 2) }}</td>
                                </tr>
                                @endif

                                @if($infantCount > 0)
                                <tr>
                                    <td>Infant ({{ $infantCount }})</td>
                                    <td align="right">${{ number_format($infantTotal, 2) }}</td>
                                </tr>
                                @endif

                                <tr style="border-top: 1px solid #ccc; font-weight: bold;">
                                    <td>Total Amount</td>
                                    <td align="right">${{ number_format($totalAmount, 2) }}</td>
                                </tr>
                            </table>
                            <p style="margin-top: 5px; font-size: 12px; color: #666;">All prices are in USD and include
                                applicable taxes and
                                fees.</p>
                        </td>
                    </tr>

                    <!-- Support Section -->
                    <tr>
                        <td style="padding: 20px 0; border-top: 1px solid #eee; text-align: center;">
                            <p style="margin: 5px 0;">Need Any Help?</p>
                            <p style="margin: 0; font-weight: bold;"><a href="tel:+1111111111"
                                    style="color: #4B45FF; text-decoration: none;">Call Now: +1-111-111-1111</a></p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top: 20px; font-size: 12px; text-align: center; color: #888;">
                            This is an automated confirmation email. Please do not reply.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table> --}}
    {{-- <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f7f7f7; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; overflow: hidden; font-family: Arial, sans-serif;">
                    <!-- Header with green check icon and Booking Confirmation title -->
                    <tr>
                        <td align="center" style="background-color: #e6f4ea; padding: 30px 20px;">
                            <img src="https://img.icons8.com/ios-filled/50/4CAF50/checked--v1.png" width="50"
                                height="50" alt="Success Icon" style="display: block; margin-bottom: 15px;" />
                            <h2 style="color: #2e7d32; margin: 0; font-size: 24px;">Booking Confirmation</h2>
                            <p style="color: #4f4f4f; font-size: 14px; margin-top: 10px;">Thank you for booking with us.
                                Below are your flight and payment details.</p>
                        </td>
                    </tr>

                    <!-- START Booking Summary (from previous code) -->
                    <tr>
                        <td style="padding: 30px 20px;">
                            <!-- Flight Info -->
                            <h3 style="margin-bottom: 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Flight
                                Details</h3>
                            @foreach ($selectedFlight['itineraries'][0]['segments'] as $segment)
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 15px;">
                                <tr>
                                    <td><strong>From:</strong> {{ $segment['departure']['iataCode'] }} ({{
                                        $segment['departure']['at'] }})</td>
                                </tr>
                                <tr>
                                    <td><strong>To:</strong> {{ $segment['arrival']['iataCode'] }} ({{
                                        $segment['arrival']['at'] }})</td>
                                </tr>
                                <tr>
                                    <td><strong>Airline:</strong> {{ $segment['carrierCode'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Flight Number:</strong> {{ $segment['number'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Duration:</strong> {{ $segment['duration'] }}</td>
                                </tr>
                            </table>
                            @endforeach

                            <p><strong>Seats Remaining:</strong> {{ $selectedFlight['numberOfBookableSeats'] ?? '0' }}
                            </p>
                            <p><strong>Last Ticket Date:</strong> {{ $selectedFlight['lastTicketingDate'] }}</p>
                            <p><strong>Checked Bags:</strong>
                                {{
                                $selectedFlight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['quantity']
                                ?? 0 }}</p>
                            <p><strong>Cabin Bags:</strong>
                                {{
                                $selectedFlight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCabinBags']['quantity']
                                ?? 0 }}</p>
                        </td>
                    </tr>
                    <!-- END Booking Summary -->
                    <!-- Passenger Details -->
                    <tr>
                        <td style="padding: 0 20px 30px 20px;">
                            <h3 style="margin: 0 0 10px 0; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
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
                        <td style="padding: 0 20px 30px 20px;">
                            <h3 style="margin: 0 0 10px 0; border-bottom: 1px solid #ddd; padding-bottom: 5px;">Payment
                                Summary</h3>

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
                                @if($adultCount > 0)
                                <tr>
                                    <td>Adult ({{ $adultCount }})</td>
                                    <td align="right">${{ number_format($adultTotal, 2) }}</td>
                                </tr>
                                @endif
                                @if($childCount > 0)
                                <tr>
                                    <td>Child ({{ $childCount }})</td>
                                    <td align="right">${{ number_format($childTotal, 2) }}</td>
                                </tr>
                                @endif
                                @if($infantCount > 0)
                                <tr>
                                    <td>Infant ({{ $infantCount }})</td>
                                    <td align="right">${{ number_format($infantTotal, 2) }}</td>
                                </tr>
                                @endif
                                <tr style="border-top: 1px solid #ccc; font-weight: bold;">
                                    <td>Total Amount</td>
                                    <td align="right">${{ number_format($totalAmount, 2) }}</td>
                                </tr>
                            </table>
                            <p style="margin-top: 8px; font-size: 12px; color: #888;">All prices are in USD and include
                                applicable taxes and
                                fees.</p>
                        </td>
                    </tr>

                    <!-- Support Section -->
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 30px 20px; text-align: center;">
                            <p style="margin: 0 0 8px 0; font-size: 14px;">Need Any Help?</p>
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
    </table> --}}

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f7f7f7; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 8px; font-family: Arial, sans-serif; overflow: hidden;">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #e6f4ea; padding: 35px 30px;">
                            <img src="https://img.icons8.com/ios-filled/50/4CAF50/checked--v1.png" width="50"
                                height="50" alt="Success Icon" style="display: block; margin-bottom: 15px;" />
                            <h2 style="color: #2e7d32; margin: 0; font-size: 24px;">Booking Confirmation</h2>
                            <p style="color: #4f4f4f; font-size: 14px; margin-top: 10px;">Thank you for booking with us.
                                Below are your flight and payment details.</p>
                        </td>
                    </tr>

                    <!-- Intro Message -->
                    <tr>
                        <td style="padding: 0 30px;">
                            <p style="font-size: 14px; color: #4f4f4f;">
                                Thank you for choosing Farebuddies as a preferred travel partner. Your booking is not
                                confirmed yet and is under process, we will reach you soon via Phone or e-mail for
                                further confirmation, In case you are not contacted within 4-24 hours, feel free to give
                                us a call back on our Toll-free number.
                            </p>
                            <p>Please find the below the travel details.</p>
                        </td>
                    </tr>

                    <!-- Flight Summary -->
                    <tr>
                        <td style="padding: 35px 30px;">
                            <h3
                                style="margin-bottom: 15px; font-size: 18px; border-bottom: 1px solid #ddd; padding-bottom: 8px;">
                                Flight Details</h3>
                            @foreach ($selectedFlight['itineraries'][0]['segments'] as $segment)
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-bottom: 18px; font-size: 14px;">
                                <tr>
                                    <td><strong>From:</strong> {{ $segment['departure']['iataCode'] }} ({{
                                        $segment['departure']['at'] }})</td>
                                </tr>
                                <tr>
                                    <td><strong>To:</strong> {{ $segment['arrival']['iataCode'] }} ({{
                                        $segment['arrival']['at'] }})</td>
                                </tr>
                                <tr>
                                    <td><strong>Airline:</strong> {{ $segment['carrierCode'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Flight Number:</strong> {{ $segment['number'] }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Duration:</strong> {{ $segment['duration'] }}</td>
                                </tr>
                            </table>
                            @endforeach

                            <p style="font-size: 14px;"><strong>Seats Remaining:</strong> {{
                                $selectedFlight['numberOfBookableSeats'] ?? '0' }}</p>
                            <p style="font-size: 14px;"><strong>Last Ticket Date:</strong> {{
                                $selectedFlight['lastTicketingDate'] }}</p>
                            <p style="font-size: 14px;"><strong>Checked Bags:</strong> {{
                                $selectedFlight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCheckedBags']['quantity']
                                ?? 0 }}</p>
                            <p style="font-size: 14px;"><strong>Cabin Bags:</strong> {{
                                $selectedFlight['travelerPricings'][0]['fareDetailsBySegment'][0]['includedCabinBags']['quantity']
                                ?? 0 }}</p>
                        </td>
                    </tr>

                    <!-- Passenger Info -->
                    <tr>
                        <td style="padding: 0 30px 35px 30px;">
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
                        <td style="padding: 0 30px 35px 30px;">
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
                                @if($adultCount > 0)
                                <tr>
                                    <td>Adult ({{ $adultCount }})</td>
                                    <td align="right">${{ number_format($adultTotal, 2) }}</td>
                                </tr>
                                @endif
                                @if($childCount > 0)
                                <tr>
                                    <td>Child ({{ $childCount }})</td>
                                    <td align="right">${{ number_format($childTotal, 2) }}</td>
                                </tr>
                                @endif
                                @if($infantCount > 0)
                                <tr>
                                    <td>Infant ({{ $infantCount }})</td>
                                    <td align="right">${{ number_format($infantTotal, 2) }}</td>
                                </tr>
                                @endif
                                <tr style="border-top: 1px solid #ccc; font-weight: bold;">
                                    <td>Total Amount</td>
                                    <td align="right">${{ number_format($totalAmount, 2) }}</td>
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
