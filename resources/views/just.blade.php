
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Details</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; position: relative; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: rgb(0, 0, 0); color: white; }
        .header-img { width: 100%; max-height: 200px; object-fit: cover; }
        .sign-section { position: absolute; right: 20px; bottom: 20px; text-align: right; }
        .treasurer-sign { position: absolute; left: 20px; bottom: 20px; text-align: left; }
        
        .cardmy {
            border: 2px solid black; /* 2px width, solid style, black color */
            border-radius: 10px; /* Optional: Rounds the corners */
            padding: 20px; /* Keeps spacing inside the card */
        }
        
        /* Positioning the QR code */
        .qr-code {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <!-- QR Code in top right corner -->
    <img src="qr-code.png" alt="QR Code" class="qr-code">

    <div class="card shadow-lg p-5 col-md-7 m-4"><h2>University of Vavuniya Event Schedule</h2></div>

    <div class="cardmy">
        <h3>Event Details</h3>
        <div class="cardmy">
            <table>
                <tr>
                    <td><strong>Date</strong></td>
                    <td>{{ $event['date'] }}</td>
                </tr>
                <tr>
                    <td><strong>Venue</strong></td>
                    <td>{{ $event['venue'] }}</td>
                </tr>
                <tr>
                    <td><strong>Time</strong></td>
                    <td>{{ $event['time'] }}</td>
                </tr>
            </table>
        </div>
        
        <h3>Person Details</h3>
        <div class="cardmy">
            <table>
                <tr>
                    <td><strong>ID</strong></td>
                    <td>{{ $event['person_id'] }}</td>
                </tr>
                <tr>
                    <td><strong>Contact</strong></td>
                    <td>{{ $event['contact'] }}</td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{ $event['email'] }}</td>
                </tr>
                <tr>
                    <td><strong>Reg No</strong></td>
                    <td>{{ $event['reg_no'] }}</td>
                </tr>
                <tr>
                    <td><strong>Faculty</strong></td>
                    <td>{{ $event['faculty'] }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="sign-section">
        <p>________________________</p>
        <p>Date</p>
    </div>
    
    <div class="treasurer-sign">
        <p>________________________</p>
        <p>Approval Signature</p>
    </div>
</body>
</html>