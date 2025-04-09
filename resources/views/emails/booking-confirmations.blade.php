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
                                                    target="_blank"><img
                                                        src="{{ asset('assets/images/airplane-pass.webp') }}" alt=""
                                                        style="width:50px" border="0"></a>
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
                                                <img src="{{ asset('assets/images/phone-call-purple.webp') }}"
                                                    width="50px"><a href="tel:+1-234-567-890" target="_blank"
                                                    style="text-decoration: none;">+1-234-567-89</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"
                                                style="line-height:15px;font-family:Arial,Helvetica,sans-serif;color:#143ca1;font-weight:bold;font-size:20px">
                                                <img src="{{ asset('assets/images/whatsapp.webp') }}" width="50px"
                                                    alt=""><a href="https://wa.me/966501234567"
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
                        <td align="center" style="background-color: #e6f4ea; padding: 35px 30px;">
                            <img src="{{ asset('assets/images/check-mark.png') }}" width="50" height="50"
                                alt="Success Icon" style="display: block; margin-bottom: 15px;" />
                            <h2 style="color: #2e7d32; margin: 0; font-size: 24px;">Booking Confirmation</h2>
                            <p style="color: #4f4f4f; font-size: 14px; margin-top: 10px;">Thank you for booking with us.
                                Below are your flight and payment details.</p>
                        </td>
                    </tr>

                    <!-- Intro Message -->
                    <tr>
                        <td style="padding: 0 20px;">
                            <p style="font-size: 14px; color: #4f4f4f;">
                                Thank you for choosing Farebuddies as a preferred travel partner. Your booking is not
                                confirmed yet and is under process, we will reach you soon via Phone or e-mail for
                                further confirmation, In case you are not contacted within 4-24 hours, feel free to give
                                us a call back on our Toll-free number.
                            </p>
                            <p>Please find the below the travel details.</p>
                        </td>
                    </tr>

                    <!-- Flight Info -->
                    <tr>
                        <strong>OurAgent's Booking ID: 54648864 |</strong><span>|
                            Booked on 2025-09-10</span>
                    </tr>

                    <!-- Flight Summary -->
                    <tr>
                        <td>
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="background-color:#5a5a5a; padding: 20px; font-family: Arial, sans-serif;">
                                <tr>
                                    <td style="color:#fff; font-size:16px; font-weight:bold; padding-bottom:15px;">
                                        Flight Details</td>
                                </tr>

                                <!-- Departure -->
                                <tr>
                                    <td style="background-color:#fff; padding:15px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td colspan="2"
                                                    style="font-size:16px; font-weight:bold; padding-bottom:10px;">
                                                    Departure</td>
                                                <td align="right" colspan="2" style="font-size:14px; font-weight:bold;">
                                                    Flight Duration <span style="margin-left:5px;">3:04</span></td>
                                            </tr>
                                            <tr>
                                                <!-- Airline Info -->
                                                <td width="25%" valign="top">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Frontier_Airlines_logo.svg"
                                                        alt="Frontier" width="80" style="margin-bottom:5px;"><br>
                                                    <span style="font-size:14px;">Frontier Airlines<br>F9 -
                                                        1810<br>Operated By:<br>Frontier
                                                        Airlines</span>
                                                </td>

                                                <!-- Departure Time & Airport -->
                                                <td width="25%" valign="top">
                                                    <span style="font-size:14px;">10 Apr 2025
                                                        <strong>07:25</strong><br>Miami Intl. Arpt.
                                                        (MIA)</span>
                                                </td>

                                                <!-- Arrival Time & Airport -->
                                                <td width="25%" valign="top">
                                                    <span style="font-size:14px;">10 Apr 2025
                                                        <strong>10:29</strong><br>John F Kennedy Intl
                                                        (JFK)</span>
                                                </td>

                                                <!-- Cabin Class -->
                                                <td width="25%" valign="top">
                                                    <span style="font-size:14px;">Cabin
                                                        Class<br><strong>Economy</strong></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Spacer -->
                                <tr>
                                    <td style="height:20px;"></td>
                                </tr>

                                <!-- Round Trip -->
                                <tr>
                                    <td style="background-color:#fff; padding:15px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td colspan="2"
                                                    style="font-size:16px; font-weight:bold; padding-bottom:10px;">Round
                                                    Trip</td>
                                                <td align="right" colspan="2" style="font-size:14px; font-weight:bold;">
                                                    Flight Duration <span style="margin-left:5px;">3:13</span></td>
                                            </tr>
                                            <tr>
                                                <!-- Airline Info -->
                                                <td width="25%" valign="top">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Frontier_Airlines_logo.svg"
                                                        alt="Frontier" width="80" style="margin-bottom:5px;"><br>
                                                    <span style="font-size:14px;">Frontier Airlines<br>F9 -
                                                        1809<br>Operated By:<br>Frontier
                                                        Airlines</span>
                                                </td>

                                                <!-- Departure Time & Airport -->
                                                <td width="25%" valign="top">
                                                    <span style="font-size:14px;">17 Apr 2025
                                                        <strong>11:30</strong><br>John F Kennedy Intl
                                                        (JFK)</span>
                                                </td>

                                                <!-- Arrival Time & Airport -->
                                                <td width="25%" valign="top">
                                                    <span style="font-size:14px;">17 Apr 2025
                                                        <strong>14:43</strong><br>Miami Intl. Arpt.
                                                        (MIA)</span>
                                                </td>

                                                <!-- Cabin Class -->
                                                <td width="25%" valign="top">
                                                    <span style="font-size:14px;">Cabin
                                                        Class<br><strong>Economy</strong></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 14px;"><strong>Seats Remaining:</strong> 9</p>
                            <p style="font-size: 14px;"><strong>Last Ticket Date:</strong> 2028-5-5</p>
                            <p style="font-size: 14px;"><strong>Checked Bags:</strong> 1</p>
                            <p style="font-size: 14px;"><strong>Cabin Bags:</strong> 0</p>
                        </td>
                    </tr>

                    <!-- Passenger Info -->
                    <tr>
                        <td style="padding: 0 30px 35px 30px;">
                            <!-- Passenger Info -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="background-color:#5c5c5c;padding:20px 0">
                                <tr>
                                    <td align="center">
                                        <table width="90%" cellpadding="10" cellspacing="0"
                                            style="background-color:#ffffff;font-family:Arial, sans-serif;border-collapse:collapse;">
                                            <tr style="background-color:#f9f9f9;">
                                                <th align="left" style="border-bottom:1px solid #ddd;">Name</th>
                                                <th align="left" style="border-bottom:1px solid #ddd;">Date of Birth
                                                </th>
                                                <th align="left" style="border-bottom:1px solid #ddd;">Pax Type</th>
                                            </tr>
                                            <tr>
                                                <td>Mr Haitham Mohamed abdel majed Abo Zanona</td>
                                                <td>24 Sep 1999</td>
                                                <td>Adult</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Payment Info -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="background-color:#5c5c5c;padding:0 0 20px 0">
                                <tr>
                                    <td align="center">
                                        <table width="90%" cellpadding="10" cellspacing="0"
                                            style="background-color:#ffffff;font-family:Arial, sans-serif;border-collapse:collapse;">
                                            <tr>
                                                <td><strong>Method :</strong></td>
                                                <td>Maestro ending in xxxxxxxxxxxx5959</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Phone :</strong></td>
                                                <td>0592235375</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email :</strong></td>
                                                <td><a href="mailto:hythamzanona@gmail.com"
                                                        style="color:#007bff;text-decoration:none;">hythamzanona@gmail.com</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" style="padding-top:15px;">
                                                    <strong>Flight Price Details</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Adult Ticket</td>
                                                <td align="right">$170.78</td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" align="right"
                                                    style="background-color:#f7275c;color:#ffffff;font-weight:bold;font-size:16px;padding:10px;">
                                                    Total Charge : $170.78
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Payment Summary -->
                    <tr>
                        <td style="padding: 0 30px 35px 30px;">
                            <h3
                                style="margin-bottom: 15px; font-size: 18px; border-bottom: 1px solid #ddd; padding-bottom: 8px;">
                                Payment Summary</h3>



                            {{-- <table width="100%" cellpadding="8" cellspacing="0" style="font-size: 14px;">
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
                            </table> --}}
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
