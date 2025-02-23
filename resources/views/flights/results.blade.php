<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Results</title>
</head>

<body>
    {{-- <h1>Flight Search Results</h1>

    @if (isset($flights) && count($flights) > 0)
    <ul>
        @foreach ($flights as $flight)
        <li>
            {{ $flight['airline']['name'] }} flight {{ $flight['flight']['iata'] }} from {{
            $flight['departure']['airport'] }} ({{ $flight['departure']['iata'] }}) to {{ $flight['arrival']['airport']
            }} ({{ $flight['arrival']['iata'] }}) is in the air.
        </li>
        @endforeach
    </ul>
    @else
    <p>No flights found matching your criteria.</p>
    @endif --}}


    <h2>نتائج البحث</h2>
    <ul>
        @foreach ($flights as $flight)
        <li>
            الرحلة من {{ $flight['departure']['airport'] }} إلى {{ $flight['arrival']['airport'] }}
            على متن شركة {{ $flight['airline']['name'] }}
            بسعر {{ $flight['price'] ?? 'غير متاح' }} $
        </li>
        @endforeach
    </ul>

</body>

</html>