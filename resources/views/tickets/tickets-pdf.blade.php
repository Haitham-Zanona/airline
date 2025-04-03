<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .ticket-box {
            border: 2px solid black;
            padding: 20px;
            margin: 20px;
        }

        h2 {
            color: blue;
        }
    </style>
</head>

<body>
    <div class="ticket-box">
        <h2>{{ $title }}</h2>
        {{-- <p><strong>Name:</strong> {{ $name }}</p> --}}
        {{-- <p><strong>Flight Number:</strong> {{ $flight_number }}</p> --}}
        {{-- <p><strong>Departure:</strong> {{ $departure }}</p> --}}
        {{-- <p><strong>Destination:</strong> {{ $destination }}</p> --}}
        {{-- <p><strong>Date:</strong> {{ $date }}</p> --}}
    </div>
</body>

</html>
