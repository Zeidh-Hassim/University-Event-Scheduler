<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS and Popper (required for dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Buttons Page</title>
  <style>
    body {
      background-color: #670047;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .calendar-icon {
      width: 100px;
      height: 100px;
      background-color: white;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      margin-bottom: 40px;
      position: relative;
    }

    .calendar-header {
      background-color: #d32f2f;
      color: white;
      padding: 5px 0;
      font-weight: bold;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      font-size: 14px;
    }

    .calendar-date {
      font-size: 50px;
      font-weight: bold;
      color: #333;
      margin-top: 10px;
    }

    .calendar-year {
      font-size: 12px;
      color: #666;
    }

    .button-container {
      display: flex;
      gap: 20px;
    }

    .btn {
      background-color: white;
      color: black;
      padding: 15px 30px;
      font-size: 18px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }

    .btn:hover {
      background-color: lightgray;
    }
  </style>
</head>
<body>

  <!-- Calendar Box -->
  {{-- <div class="calendar-icon">
    <div class="calendar-header" id="calendar-month">---</div>
    <div class="calendar-date" id="calendar-day">--</div>
    <div class="calendar-year" id="calendar-year">----</div>
  </div> --}}

    <div class="calendar-icon">
        <div class="calendar-header" id="calendar-full-date">---</div>
        <div class="calendar-date">{{ $eventCount }}</div>
        {{-- <div class="calendar-year">zeidh</div> --}}
    </div>


  <div class="button-container">
    <div class="dropdown  btn-secondary">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Schedule Event
        </a>
        <ul class="dropdown-menu ">
            <li><a class="dropdown-item" href="{{ route('schedule.university') }}">University Level Union/Society</a></li>
            <li><a class="dropdown-item" href="{{ route('schedule.union') }}">Faculty Union</a></li>
            <li><a class="dropdown-item" href="{{ route('schedule.society') }}">Faculty Level Society</a></li>
            <li><a class="dropdown-item" href="{{ route('schedule.batch') }}">Faculty Level Batch</a></li>
        </ul>
    </div>
    <a href="{{ route('loginpage') }}" class="btn btn-secondary">Admin</a>
    <a href="{{ route('scheduled-events') }}" class="btn btn-secondary">Scheduled Events</a>
</div>


  <!-- JavaScript to Set Dynamic Date -->
  <script>
    const today = new Date(@json($today)); // Laravel passed date

    // document.getElementById("calendar-month").textContent = today.toLocaleString('default', { month: 'short' }).toUpperCase();
    // document.getElementById("calendar-day").textContent = today.getDate();
    // document.getElementById("calendar-year").textContent = today.getFullYear();
document.getElementById("calendar-full-date").textContent = `${today.getDate()} ${today.toLocaleString('default', { month: 'short' }).toUpperCase()} ${today.getFullYear()}`;
</script>


</body>
</html>
