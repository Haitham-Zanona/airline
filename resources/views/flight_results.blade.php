<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Flight Offers</title>
</head>

<body>
    <h1>Flight Offers</h1>

    @if(!empty($flights) && count($flights['data']) > 0)
    <table>
        <thead>
            <tr>
                <th>Flight</th>
                <th>Price</th>
                <th>Departure</th>
                <th>Arrival</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($flights['data'] as $flight)
            <tr>
                <td>{{ $flight['itineraries'][0]['segments'][0]['flightSegment']['carrierCode'] }} {{
                    $flight['itineraries'][0]['segments'][0]['flightSegment']['flightNumber'] }}</td>
                <td>{{ $flight['price']['total'] }}</td>
                <td>{{ $flight['itineraries'][0]['segments'][0]['departure']['at'] }}</td>
                <td>{{ $flight['itineraries'][0]['segments'][0]['arrival']['at'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No flight offers found.</p>
    @endif
</body>

</html>
