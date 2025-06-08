@extends('nav.navbar')
<head>
    <meta charset="UTF-8">
    <title>Scheduled</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fff;
            color: #2d3c2d;
        }

        .schedule-title {
            font-weight: bold;
            text-align: center;
            margin: 40px 0 10px;
        }

        .filter-select {
            margin-bottom: 20px;
            font-size: 14px;
            color: #2d3c2d;
        }

        .event-item {
            border-top: 1px solid #4c5c4c;
            padding: 15px 0;
        }

        .event-time {
            font-size: 14px;
            color: #2d3c2d;
            width: 180px;
        }

        .event-title {
            font-weight: bold;
            font-size: 16px;
        }

        .event-location {
            font-size: 14px;
            color: #6c757d;
        }

        .day-header {
            border-bottom: 2px solid #4c5c4c;
            margin: 30px 0 10px;
            padding-bottom: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        .btn-tickets {
            background-color: #4c5c4c;
            color: white;
            border-radius: 10px;
            padding: 8px 18px;
            margin-bottom: 30px;
        }

        .btn-tickets:hover {
            background-color: #3b4b3b;
        }

        .schedule-wrapper {
            background-color: white;
            max-width: 900px;
            margin: 50px auto;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        a.btn.custom {
            background-color: white !important;
            color: black !important;
            padding: 15px 30px !important;
            font-size: 18px !important;
            border: none !important;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        a.btn.custom:hover {
            background-color: lightgray !important;
        }
    </style>
</head>
<body>
    <div class="container">
                <h1 class="text-center mb-3 text-white">Schedule</h1>
        <div class="schedule-wrapper">
            <div class="container">

                {{-- <h1 class="schedule-title">Schedule</h1> --}}
                {{-- <div class="text-center">
                    <button class="btn btn-tickets">Get Tickets</button>
                </div> --}}

                <div class="filter-select mb-4">
                    <form method="GET" action="{{ route('schedule') }}">
                        <label for="status">Filter By Status: </label>
                        <select name="status" class="form-select d-inline w-auto" onchange="this.form.submit()">
                            <option value="all" {{ ($status ?? '') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="pending" {{ ($status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ ($status ?? '') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ ($status ?? '') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </form>
                </div>

                <!-- Event Items -->
                @if($events->count())
                    @foreach($events as $event)
                        <div class="event-item d-flex align-items-center">
                            <div class="pe-4 text-nowrap">
                                <div class="event-date">{{ \Carbon\Carbon::parse($event->date)->format('D, M d Y') }}</div>
                                <div class="event-time">{{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}</div>
                            </div>
                            <div>
                                <div class="event-title">{{ $event->event_name }}</div>
                                <div class="event-location">📍 {{ $event->venue }}</div>
                                <div class="text-muted small">Status: {{ ucfirst($event->status) }}</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">No events found.</p>
                @endif

            </div>
        </div>

        <div class="text-center mt-5">
            <button type="button" class="btn btn-secondary" onclick="history.back()">Back</button>
        </div>
    </div>

</body>
</html>