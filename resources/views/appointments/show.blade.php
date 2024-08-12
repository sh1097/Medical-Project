<!-- resources/views/appointments/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            padding: 20px;
            border-radius: 8px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h2 class="card-title">Appointment Details</h2>

            <p><strong>ID:</strong> {{ $appointment->id }}</p>
            <p><strong>User:</strong> {{ $appointment->user->name }}</p>
            <p><strong>Time Slot:</strong> {{ $appointment->timeSlot->start_time }} - {{ $appointment->timeSlot->end_time }}</p>
            <p><strong>Date:</strong> {{ $appointment->date }}</p>
            <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>

            <a href="{{ route('appointments.index') }}" class="btn btn-custom">Back to Appointments</a>
        </div>
    </div>

    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
