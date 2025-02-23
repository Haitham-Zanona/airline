<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتائج البحث</title>
</head>

<body>
    <h1>الرحلات المتاحة</h1>

    @if(count($flights) > 0)
    <ul>
        @foreach($flights as $flight)
        <li>
            {{ $flight['airline']['name'] }}: رحلة {{ $flight['flight']['iata'] }} من {{ $flight['departure']['airport']
            }} إلى {{ $flight['arrival']['airport'] }} في {{ $flight['departure']['estimated_runway_time'] ?? 'Time not
            available' }}
        </li>
        @endforeach
    </ul>
    @else
    <p>لا توجد رحلات متاحة لبحثك.</p>
    @endif
</body>

</html>