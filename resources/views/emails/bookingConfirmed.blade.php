<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background: #212529;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .body {
            padding: 30px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .footer {
            background: #f8f9fa;
            padding: 15px;
            text-align: center;
            color: #666;
        }

        .badge {
            background: #198754;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🎉 Booking Confirmed!</h2>
        </div>
        <div class="body">
            <p>Hi <strong>{{ $booking->user->name }}</strong>,</p>
            <p>Your booking has been confirmed! Here are your details:</p>

            <div class="detail-row">
                <span>📅 Event</span>
                <strong>{{ $booking->event->title }}</strong>
            </div>
            <div class="detail-row">
                <span>📍 Location</span>
                <strong>{{ $booking->event->location }}</strong>
            </div>
            <div class="detail-row">
                <span>🗓️ Event Date</span>
                <strong>{{ \Carbon\Carbon::parse($booking->event->event_date)->format('d M Y, h:i A') }}</strong>
            </div>
            <div class="detail-row">
                <span>💺 Seats Booked</span>
                <strong>{{ $booking->seats_booked }}</strong>
            </div>
            <div class="detail-row">
                <span>📋 Status</span>
                <span class="badge">Confirmed</span>
            </div>

            <p style="margin-top: 20px;">Thank you for booking with us! </p>
        </div>
        <div class="footer">
            <p>Event Booking System</p>
        </div>
    </div>
</body>
</html>s
