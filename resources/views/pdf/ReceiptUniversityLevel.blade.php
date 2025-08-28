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
            position: relative;
            font-size: 14px;
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

        th, td {
            padding: 8px 10px;
            text-align: left;
            border: none;
        }

        th {
            background-color: black;
            color: white;
        }

        .cardmy {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px 20px;
            margin: 25px 0;
            /* background-color: #f9f9f9; */
        }

        .header-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-container img {
            max-height: 100px;
        }

        .signature-table {
            width: 100%;
            margin-top: 50px;
        }

        .signature-table td {
            text-align: center;
            padding: 30px;
        }

        .footer-note {
            text-align: center;
            font-style: italic;
            font-size: 12px;
            margin-top: 60px;
            color: #555;
        }

        .header-container h1,
        .header-container h2,
        .header-container h3 {
            margin: 5px 0; /* reduce vertical spacing */
            line-height: 1.2; /* tighter line spacing */
        }

    </style>
</head>
<body>

    <!-- Logos Header Section -->
    <div class="header-container">
        <img src="{{ public_path('img/cropped-UoV_Logo.png') }}" alt="University of Vavuniya Logo"><br>
        <h1>University of Vavuniya</h1>
        <h2>Event Scheduling System</h2>
        <h3>Event Receipt</h3>
        
    </div>

    <!-- Event Details -->
    <div class="cardmy">
        <h3>Event Details</h3>
        <table>
            <colgroup>
                <col class="label-col">
                <col class="value-col">
            </colgroup>
            <tr><td><strong>Event ID: </strong></td><td>{{ $event->id }}</td></tr>
            <tr><td><strong>Event Name (Title): </strong></td><td>{{ $event->event_name }}</td></tr>
            <tr><td><strong>Event Type: </strong></td><td>{{ $event->event_Type }}</td></tr>
            <tr><td><strong>Date: </strong></td><td>{{ $event->date }}</td></tr>
            <tr><td><strong>Venue: </strong></td><td>{{ $event->venue }}</td></tr>
            <tr><td><strong>Time: </strong></td><td>{{ $event->start_time }} - {{ $event->end_time }}</td></tr>
            <tr><td><strong>Participants: </strong></td><td>{{ $event->participants }}</td></tr>
        </table>
    </div>

    <!-- Person Details -->
    <div class="cardmy">
        <h3>Person Details</h3>
        <table>
            <colgroup>
                <col class="label-col">
                <col class="value-col">
            </colgroup>
            <tr><td><strong>Society: </strong></td><td>{{ $event->society }}</td></tr>
            <tr><td><strong>Name (President/Secretary): </strong></td><td>{{ $event->applicant }}</td></tr>
            <tr><td><strong>Registration No: </strong></td><td>{{ $event->registration_number }}</td></tr>
            <tr><td><strong>Contact: </strong></td><td>{{ $event->contact }}</td></tr>
            <tr><td><strong>Email: </strong></td><td>{{ $event->email }}</td></tr>
        </table>
    </div>

    <!-- Signature Section -->
    {{-- <table class="signature-table">
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
    </table> --}}

    <!-- Footer Note -->
<div class="footer-note">
    This is a computer-generated document and does not require a physical signature.<br>
    Generated on {{ $event->created_at->format('Y-m-d') }}
</div>


</body>
</html>
