<!-- resources/views/appointments/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
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
        .form-group label {
            font-weight: bold;
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
            <h2 class="card-title">Book an Appointment</h2>
            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf

                <!-- Select Time Slot -->
                <div class="form-group">
                    <label for="time_slot_id">Select Time Slot:</label>
                    <select id="time_slot_id" name="time_slot_id" class="form-control" required>
                        @foreach($timeSlots as $timeSlot)
                            <option value="{{ $timeSlot->id }}">
                                {{ $timeSlot->start_time }} - {{ $timeSlot->end_time }} ({{ $timeSlot->date }})
                            </option>
                        @endforeach
                    </select>
                </div>
                

                <button type="submit" class="btn btn-custom">Book Appointment</button>
            </form>
        </div>
    </div>

    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
