<!-- resources/views/calendar.blade.php -->
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Calendar</title>
  <style>
    body {
      background-color: #670047;
      color: white;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    .calendar-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 24px;
      margin-top: 32px;
    }

    .month-block {
      background-color: #fff;
      color: #000;
      padding: 18px 12px 12px 12px;
      border-radius: 12px;
      min-width: 260px;
      max-width: 320px;
      flex: 1 1 260px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.10);
      margin-bottom: 16px;
    }

    .month-title {
      text-align: center;
      font-weight: bold;
      font-size: 18px;
      margin-bottom: 10px;
      letter-spacing: 1px;
    }

    table.month-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
      background: transparent;
    }

    table.month-table th,
    table.month-table td {
      text-align: center;
      color: #000;
      padding: 4px;
      height: 28px;
      border-radius: 4px;
    }

    table.month-table th {
      background: #f3e6f5;
      font-weight: 600;
      font-size: 13px;
    }

    table.month-table td.has-meeting {
      background-color: #d32f2f;
      color: #fff;
      cursor: pointer;
      font-weight: bold;
    }

    table.month-table td.today {
      /* background-color: #4CAF50;
      color: #fff;
      font-weight: bold;
      border: 2px solid #fff; */


      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
      font-weight: bold;
    }

    /* Optional: you can add custom styles to Bootstrap tooltips here */
    .tooltip-inner {
  background-color: #fff !important;
  color: #000 !important;
  border: 1px solid #ccc;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  font-size: 13px;
  text-align: left;
  padding: 6px 10px;
  border-radius: 6px;
}

.bs-tooltip-top .tooltip-arrow::before,
.bs-tooltip-bottom .tooltip-arrow::before,
.bs-tooltip-start .tooltip-arrow::before,
.bs-tooltip-end .tooltip-arrow::before {
  border-top-color: #fff !important;
  border-bottom-color: #fff !important;
  border-left-color: #fff !important;
  border-right-color: #fff !important;
}

/* Tooltip background and text */
.tooltip-inner {
  background-color: #ffffff !important;
  color: #000000 !important;
  border: 1px solid #ccc;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}
.tooltip .tooltip-arrow {
  display: none !important;
}




    .button-container {
      margin-top: 32px;
      gap: 16px;
    }

    .dropdown .btn {
      min-width: 180px;
    }

    @media (max-width: 991px) {
      .calendar-container {
        gap: 16px;
      }

      .month-block {
        min-width: 220px;
        max-width: 100%;
      }
    }

    @media (max-width: 767px) {
      .calendar-container {
        flex-direction: column;
        align-items: center;
      }

      .month-block {
        width: 100%;
        min-width: 0;
      }
    }
  </style>
</head>
<body>
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="text-center mb-4">
          <h1 class="fw-bold" style="letter-spacing:1px;">Event Schedule System</h1>
          <h5 class="fw-normal mb-0" style="color:#e0c7e7;">University of Vavuniya</h5>
          <p class="mt-2" style="color:#f5e1ff;">Today: {{ \Carbon\Carbon::parse($today)->format('j M Y') }}</p>
        </div>

        @php
          use Carbon\Carbon;
          $year = Carbon::parse($today)->year;
          $currentMonth = Carbon::parse($today)->month;
          $currentDate = Carbon::parse($today)->format('Y-m-d');
          $monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
          $dayNames = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];

          $monthsToShow = [];

          $prevMonth = $currentMonth - 1;
          $prevYear = $year;
          if ($prevMonth == 0) {
            $prevMonth = 12;
            $prevYear = $year - 1;
          }
          $monthsToShow[] = ['year' => $prevYear, 'month' => $prevMonth];

          $monthsToShow[] = ['year' => $year, 'month' => $currentMonth];

          for ($i = 1; $i <= 4; $i++) {
            $m = $currentMonth + $i;
            $y = $year;
            if ($m > 12) {
              $m -= 12;
              $y += 1;
            }
            $monthsToShow[] = ['year' => $y, 'month' => $m];
          }
        @endphp

        <div class="calendar-container">
          @foreach ($monthsToShow as $item)
            @php
              $displayYear = $item['year'];
              $displayMonth = $item['month'];
            @endphp
            <div class="month-block shadow">
              <div class="month-title">{{ $monthNames[$displayMonth - 1] }} {{ $displayYear }}</div>
              <table class="month-table">
                <thead>
                  <tr>
                    @foreach ($dayNames as $day)
                      <th>{{ $day }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  @php
                    $d = Carbon::create($displayYear, $displayMonth, 1);
                    $firstDay = $d->dayOfWeek;
                    $daysInMonth = $d->daysInMonth;
                    $dayCount = 0;
                  @endphp

                  @for ($i = 0; $i < $firstDay; $i++)
                    <td></td>
                    @php $dayCount++; @endphp
                  @endfor

                  @for ($date = 1; $date <= $daysInMonth; $date++)
                    @php
                      $dateStr = Carbon::create($displayYear, $displayMonth, $date)->format('Y-m-d');
                      $isToday = $dateStr === $currentDate;
                      $hasEvent = in_array($dateStr, $eventDates);
                      $class = $isToday ? 'today' : ($hasEvent ? 'has-meeting' : '');
                      // Prepare tooltip content string with HTML line breaks
                      $tooltipContent = '';
                      if ($hasEvent && isset($eventMap[$dateStr])) {
                        foreach ($eventMap[$dateStr] as $event) {
                          $tooltipContent .= e($event->event_name) . '<br>';
                        }
                      }
                    @endphp

                    {{-- <td
                      class="{{ $class }}"
                      @if ($hasEvent && isset($eventMap[$dateStr]))
                        data-bs-toggle="tooltip"
                        data-bs-html="true"
                        title="{!! $tooltipContent !!}"
                      @endif
                    >
                      {{ $date }}
                    </td> --}}




                    <td class="{{ $class }}"
    @if ($hasEvent && isset($eventMap[$dateStr]))
        data-bs-toggle="tooltip"
        data-bs-html="true"
        title="{!! $tooltipContent !!}"
    @endif
    >
    @if (isset($eventMap[$dateStr]))
        <a href="#" class="text-decoration-none text-reset" data-bs-toggle="modal" data-bs-target="#eventModal{{ $dateStr }}">
            {{ $date }}
        </a>

        <!-- Modal for all events on this date -->
        <div class="modal fade" id="eventModal{{ $dateStr }}" tabindex="-1" aria-labelledby="eventModalLabel{{ $dateStr }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content text-dark">
                    <div class="modal-header justify-content-center">
                        <h5 class="modal-title" id="eventModalLabel{{ $dateStr }}">Events on {{ \Carbon\Carbon::parse($dateStr)->format('F j, Y') }}</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                     <div class="modal-body">
                        @foreach ($eventMap[$dateStr] as $event)
                            <h6 class="mb-2">{{ $event->event_name }} on {{ $event->venue }} at {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }} – {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}</h6>
                        @endforeach
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{ $date }}
    @endif
</td>

















                    @php $dayCount++; @endphp

                    @if ($dayCount % 7 == 0 && $date != $daysInMonth)
                      </tr><tr>
                    @endif
                  @endfor
                  </tr>
                </tbody>
              </table>
            </div>
          @endforeach
        </div>

        <div class="d-flex flex-column align-items-center">
          <div class="button-container d-flex justify-content-center flex-wrap">
            <div class="dropdown me-2 mb-2">
              <a class="btn btn-primary dropdown-toggle text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Schedule Event
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('schedule.university') }}">University Level Union/Society</a></li>
                <li><a class="dropdown-item" href="{{ route('schedule.union') }}">Faculty Union</a></li>
                <li><a class="dropdown-item" href="{{ route('schedule.society') }}">Faculty Level Society</a></li>
                <li><a class="dropdown-item" href="{{ route('schedule.batch') }}">Faculty Level Batch</a></li>
              </ul>
            </div>
            <a href="{{ route('loginpage') }}" class="btn btn-secondary me-2 mb-2">Admin</a>
            <a href="{{ route('scheduled-events') }}" class="btn btn-secondary mb-2">Scheduled Events</a>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })
    });
  </script>
</body>
</html>
