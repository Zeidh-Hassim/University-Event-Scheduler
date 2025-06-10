<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Details</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2, h3 {
            text-align: center;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        col.label-col {
            width: 30%;
        }

        col.value-col {
            width: 70%;
        }

        table, th, td {
            border: 1px solid black;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        th {
            background-color: black;
            color: white;
        }

        .cardmy {
            border: 2px solid black;
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
        }

        .header-container {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .header-left,
        .header-right {
            display: table-cell;
            vertical-align: middle;
            width: 50%;
        }

        .header-left img,
        .header-right img {
            max-height: 100px;
        }

        .header-right {
            text-align: right;
        }

        .signature-table {
            position: fixed;
            bottom: 30mm;
            width: 100%;
        }

        .signature-table td {
            text-align: center;
            padding: 20px;
        }

    </style>
</head>
<body>

    <!-- Logos Header Section -->
    <div class="header-container">
        <div class="header-left">
            <img src="{{ public_path('img/cropped-UoV_Logo.png') }}" alt="University Logo">
        </div>
        <div class="header-right">
            <img src="{{ public_path('img/logo.png') }}" alt="QR Code">
        </div>
    </div>

    <!-- Event Details -->
    <div class="cardmy">
        <h3><u>Event Details</u></h3>
        <table>
            <colgroup>
                <col class="label-col">
                <col class="value-col">
            </colgroup>
            <tr><td><strong>Event Name (Title):</strong></td><td>{{ $event->event_name }}</td></tr>
            <tr><td><strong>Event Type:</strong></td><td>{{ $event->event_Type }}</td></tr>
            <tr><td><strong>Faculty:</strong></td><td>{{ $event->faculty }}</td></tr>
            <tr><td><strong>Date:</strong></td><td>{{ $event->date }}</td></tr>
            <tr><td><strong>Venue:</strong></td><td>{{ $event->venue }}</td></tr>
            <tr><td><strong>Time:</strong></td><td>{{ $event->start_time }} - {{ $event->end_time }}</td></tr>
            <tr><td><strong>Participants:</strong></td><td>{{ $event->participants }}</td></tr>
        </table>
    </div>

    <!-- Person Details -->
    <div class="cardmy">
        <h3><u>Person Details</u></h3>
        <table>
            <colgroup>
                <col class="label-col">
                <col class="value-col">
            </colgroup>
            <tr><td><strong>Society:</strong></td><td>{{ $event->society }}</td></tr>
            <tr><td><strong>Name (President/Secretary):</strong></td><td>{{ $event->applicant }}</td></tr>
            <tr><td><strong>Registration No:</strong></td><td>{{ $event->registration_number }}</td></tr>
            <tr><td><strong>Contact:</strong></td><td>{{ $event->contact }}</td></tr>
            <tr><td><strong>Email:</strong></td><td>{{ $event->email }}</td></tr>
        </table>
    </div>

    <!-- Signature Section at Bottom -->
    <table class="signature-table">
        <tr>
            <td>
                ________________________<br>
                Approval Signature
            </td>
            <td>
                ________________________<br>
                Date
            </td>
        </tr>
    </table>

</body>
</html>
