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


  <!-- Buttons -->
  <div class="button-container">
    <a href="{{ route('sheduler') }}" class="btn">Shedule Event</a>
    <a href="{{ route('loginpage') }}" class="btn">Admin</a>
    <a href="{{ route('scheduled-events') }}" class="btn">Scheduled Events</a>

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
