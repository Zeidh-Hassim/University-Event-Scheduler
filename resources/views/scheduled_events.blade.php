@extends('nav.navbar')
<head>
  <meta charset="UTF-8">
  <title>Scheduled</title>
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
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

  </style>
</head>
<body>

    <div class="container">
        <div class="d-flex justify-content-center align-items-center vh-0.025">
         <div class="card shadow-lg p-0.25 col-md-5 m-4 mt-1 text-center">
             <h1>Schedule</h1>
         </div>
     </div>

    <div class="schedule-wrapper">

        <div class="container">

            {{-- <h1 class="schedule-title">Schedule</h1> --}}
          
            {{-- <div class="text-center">
              <button class="btn btn-tickets">Get Tickets</button>
            </div> --}}
          
            <div class="filter-select">
              Filter By: <select class="form-select d-inline w-auto" aria-label="Filter Places">
                <option selected>All Places</option>
                <option value="1">Main Stage</option>
                <option value="2">Sinclair Room</option>
              </select>
            </div>
          
            <div class="day-header">Sat., May 01</div>
          
            <!-- Event Items -->
            <div class="event-item d-flex">
              <div class="event-time">7:00 p.m. - 7:45 p.m.</div>
              <div>
                <div class="event-title">Opening Session: Global Outlook</div>
                <div class="event-location">📍 Main Stage</div>
              </div>
            </div>
          
            <div class="event-item d-flex">
              <div class="event-time">7:00 p.m. - 7:45 p.m.</div>
              <div>
                <div class="event-title">Ask the Experts</div>
                <div class="event-location">📍 Sinclair Room</div>
              </div>
            </div>
          
            <div class="event-item d-flex">
              <div class="event-time">8:00 p.m. - 9:30 p.m.</div>
              <div>
                <div class="event-title">The Future of Solar Roofing</div>
                <div class="event-location">📍 Sinclair Room</div>
              </div>
            </div>
          
            <div class="event-item d-flex">
              <div class="event-time">8:00 p.m. - 8:45 p.m.</div>
              <div>
                <div class="event-title">Offshore Wind Farms</div>
                <div class="event-location">📍 Main Stage</div>
              </div>
            </div>
          
          </div>
          
      
      </div>
      



</body>
</html>
