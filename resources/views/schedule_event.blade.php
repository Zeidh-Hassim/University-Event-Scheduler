<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Event</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h2>Schedule Event Date</h2>
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{route('schedule-event')}}" method="POST">
        @csrf
        <label>Date:</label>
        <input type="date" name="date" required><br>

        <label>Venue:</label>
        <input type="text" name="venue" required><br>

        <label>Time:</label>
        <input type="time" name="time" required><br>

        <h3>Booking Person Details:</h3>

        <label>ID:</label>
        <input type="text" name="person_id" required><br>

        <label>Contact:</label>
        <input type="text" name="contact" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Reg No:</label>
        <input type="text" name="reg_no" required><br>

        <label>Faculty:</label>
        <input type="text" name="faculty" required><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
