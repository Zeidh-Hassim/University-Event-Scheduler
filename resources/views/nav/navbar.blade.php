<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>event_schedule | @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom Styles -->
    <style>
        .top-center {
            color: rgb(0, 0, 0);
            text-align: center;
            background-color: rgb(255, 255, 255);
        }
        body {
            background-color: #670047; /* Change this to any color */
            font-family: Arial, sans-serif;
        }
        .highlightnav {
        background-color:rgba(103, 0, 71, 0.1);
; /* white with 50% opacity */
        padding: 20px;
        border-radius: 8px;
    }
    </style>
</head>
<body>
    @yield('content')

    <!-- Footer -->
    <footer class="text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2025 Group 7. All Rights Reserved.</p>
            <p class="mb-0">
                <a href="#" class="text-white text-decoration-none">Privacy Policy</a> |
                <a href="#" class="text-white text-decoration-none">Terms of Service</a> |
                <a href="#" class="text-white text-decoration-none">Contact Us</a>
            </p>
        </div>
    </footer>


     {{-- <footer class="text-white text-center py-3 mt-5 bg-dark">
    <div class="container">
        <p class="mb-0">&copy; 2025 University of Vavuniya. All Rights Reserved.</p>
        <p class="mb-0">
            <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#teamModal">
                Meet the Team
            </button>
        </p>
    </div>
    </footer>



<!-- Meet the Team Modal -->
<div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
    <div class="modal-content shadow-lg rounded-4">
<div class="modal-header rounded-top-4 text-center" style="background-color: #670047;">
  <h5 class="modal-title fw-bold text-white mx-auto" id="teamModalLabel">Meet the Team</h5>
</div>

      <div class="modal-body bg-light text-center">

        <div class="mb-4 highlightnav ">
          <h6 class="fw-bold">Project Supervisor</h6>
          <p class="mb-1"><strong>Dr.T.Kartheeswaran</strong></p>
        </div>

        <div class="mb-4 highlightnav">
          <h6 class="fw-bold">Lead Developer & Project Coordinator</h6>
          <p class="mb-1"><strong>Zeidh H.M</strong> – 2020/ASP/52</p>
        </div>

<div class="mb-3 highlightnav">
  <h6 class="fw-bold">Contributing Team Members</h6>
  <ul class="mx-auto px-0" style="max-width: 500px; list-style: none;">
    <li class="text-center py-1">
      <strong>Wijesooriya W.A.D.S.S.</strong> – 2020/ASP/28
    </li>
    <li class="text-center py-1">
      <strong>Sathursha</strong> – 2020/ASP/35
    </li>
    <li class="text-center py-1">
      <strong>Krishnarathna V.S.M.</strong> – 2020/ASP/54
    </li>
    <li class="text-center py-1">
      <strong>Thirunilavan T</strong> – 2020/ASP/64
    </li>
    <li class="text-center py-1">
      <strong>Abeysinghe D.D</strong> – 2020/ASP/95
    </li>
  </ul>
</div>

      </div>
      <div class="modal-footer rounded-bottom-4">
      </div>
    </div>
  </div>
</div>  --}}
















    <!-- Bootstrap 5.3.3 JS Bundle (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>
</html>
