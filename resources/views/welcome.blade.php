<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buttons Page</title>
    <style>
        body {
            background-color: maroon;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
<body style="background-color: #670047;">
    <div class="button-container">
        <a href="{{ route('sheduler') }}" class="btn">Shedule Event</a>
        <a href="{{ route('loginpage') }}" class="btn">Admin</a>
    </div>
</body>
</html>
