<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Calendar Page</title>
  <style>
    body {
      background-color: #670047;
      color: white;
      font-family: Arial, sans-serif;
      padding: 20px;
    }

    .calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 10px;
      margin: 30px auto;
      max-width: 600px;
      background: white;
      padding: 20px;
      border-radius: 10px;
      color: black;
    }

    .calendar .day {
      text-align: center;
      padding: 15px;
      border-radius: 8px;
      font-weight: bold;
    }

    .calendar .header {
      background-color: #f0f0f0;
      font-weight: bold;
    }

    .today {
      background-color: #4CAF50 !important;
      color: white !important;
    }

    .event-day {
      background-color: #d32f2f !important;
      color: white !important;
    }

    .btn {
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="text-center">
    <h2>{{ \Carbon\Carbon::parse($today)->format('F Y') }} Calendar</h2>
    <p class="text-light">Today: {{ \Carbon\Carbon::parse($today)->format('j M Y') }}</p>
  </div>

  <div class="calendar">
    @php
      use Carbon\Carbon;

      $startOfMonth = Carbon::parse($today)->startOfMonth();
      $endOfMonth = Carbon::parse($today)->endOfMonth();
      $startDayOfWeek = $startOfMonth->dayOfWeekIso; // Monday = 1
      $totalDays = $endOfMonth->day;
      $currentDay = Carbon::parse($today)->format('Y-m-d');
    @endphp

    <!-- Days of the week -->
    @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
      <div class="day header">{{ $day }}</div>
    @endforeach

    <!-- Empty cells for offset -->
    @for ($i = 1; $i < $startDayOfWeek; $i++)
      <div class="day"></div>
    @endfor

    <!-- Fill the days -->
    @for ($day = 1; $day <= $totalDays; $day++)
      @php
        $date = Carbon::parse($startOfMonth)->day($day)->format('Y-m-d');
        $isToday = $date === $currentDay;
        $hasEvent = in_array($date, $eventDates);
        $class = $isToday ? 'today' : ($hasEvent ? 'event-day' : '');
      @endphp
      <div class="day {{ $class }}">{{ $day }}</div>
    @endfor
  </div>

  <div class="text-center mt-4">
    <div class="button-container d-flex justify-content-center gap-3 flex-wrap">
      <div class="dropdown btn-secondary">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Schedule Event
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('schedule.university') }}">University Level Union/Society</a></li>
          <li><a class="dropdown-item" href="{{ route('schedule.union') }}">Faculty Union</a></li>
          <li><a class="dropdown-item" href="{{ route('schedule.society') }}">Faculty Level Society</a></li>
          <li><a class="dropdown-item" href="{{ route('schedule.batch') }}">Faculty Level Batch</a></li>
        </ul>
      </div>
      <a href="{{ route('loginpage') }}" class="btn btn-secondary">Admin</a>
      <a href="{{ route('scheduled-events') }}" class="btn btn-secondary">Scheduled Events</a>
    </div>
  </div>

</body>
</html>
