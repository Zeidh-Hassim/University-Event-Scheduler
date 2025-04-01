<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>event_shedule| @yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
        .top-center {
            color:rgb(0, 0, 0);
            text-align: center; 
            background-color:rgb(255, 255, 255);
            
            
           
        }
        body {
            background-color: #670047; /* Change this to any color */
            font-family: Arial, sans-serif;
        }
    </style>
    </head>
    <body>
        @yield('content')

        <!-- Footer -->
        <footer class=" text-white text-center py-3 mt-5">
            <div class="container">
                <p class="mb-0">&copy; 2025 Group 7. All Rights Reserved.</p>
                <p class="mb-0">
                    <a href="#" class="text-white text-decoration-none">Privacy Policy</a> | 
                    <a href="#" class="text-white text-decoration-none">Terms of Service</a> | 
                    <a href="#" class="text-white text-decoration-none">Contact Us</a>
                </p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
