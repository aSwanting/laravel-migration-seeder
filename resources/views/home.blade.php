<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trains</title>
    @vite('resources/js/app.js')
</head>

<body>
    <main class="p-5">
        <h1 class="text-center mb-5">Trains Trains Trains</h1>
        <table class="table">
            <tr>
                <th>Train Company</th>
                <th>Departure Station</th>
                <th>Arrival Station</th>
                <th>Departure Date</th>
                <th>Departure Time</th>
                <th>Arrival Date</th>
                <th>Arrival Time</th>
                <th>Train Number</th>
                <th>Carriages</th>
                <th>On Time</th>
            </tr>
            @foreach ($trains as $train)
                <tr @class([$train->cancelled ? 'cancelled' : ''])>
                    <td>{{ $train->train_company }}</td>
                    <td>{{ $train->departure_station }}</td>
                    <td>{{ $train->arrival_station }}</td>
                    <td>{{ $train->departure_date }}</td>
                    <td>{{ $train->departure_time }}</td>
                    <td>{{ $train->arrival_date }}</td>
                    <td>{{ $train->arrival_time }}</td>
                    <td>{{ $train->train_number }}</td>
                    <td>{{ $train->carriage_number }}</td>
                    <td>{{ $train->on_time ? 'on time' : 'delayed' }}</td>
                </tr>
            @endforeach
        </table>
    </main>
</body>

</html>
