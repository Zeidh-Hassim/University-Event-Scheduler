<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Details</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 10px; }
        th { background-color: #a21010; }
    </style>
</head>
<body>
    <h2>Event Booking Details</h2>
    <table>
        <tr>
            <th>Field</th>
            <th>Details</th>
        </tr>
        <tr>
            <td><strong>Date</strong></td>
            <td>{{ $event->date }}</td>
        </tr>
        <tr>
            <td><strong>Venue</strong></td>
            <td>{{ $event->venue }}</td>
        </tr>
        <tr>
            <td><strong>Time</strong></td>
            <td>{{ $event->time }}</td>
        </tr>
        <tr>
            <td><strong>ID</strong></td>
            <td>{{ $event->person_id }}</td>
        </tr>
        <tr>
            <td><strong>Contact</strong></td>
            <td>{{ $event->contact }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $event->email }}</td>
        </tr>
        <tr>
            <td><strong>Reg No</strong></td>
            <td>{{ $event->reg_no }}</td>
        </tr>
        <tr>
            <td><strong>Faculty</strong></td>
            <td>{{ $event->faculty }}</td>
        </tr>
    </table>
</body>
</html>
