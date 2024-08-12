<!DOCTYPE html>
<html>
<head>
    <title>Patient Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .container {
            max-width: 800px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-body {
            font-size: 1rem;
        }
        .card-body dt {
            font-weight: bold;
        }
        .card-body dd {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Patient Details</h1>

        <div class="card">
            <div class="card-header">
                Patient Information
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Location</dt>
                    <dd class="col-sm-8">{{ $patient->location }}</dd>

                    <dt class="col-sm-4">Registration Date and Time</dt>
                    <dd class="col-sm-8">{{ $patient->registration_date_time }}</dd>

                    <dt class="col-sm-4">First Name</dt>
                    <dd class="col-sm-8">{{ $patient->first_name }}</dd>

                    <dt class="col-sm-4">Last Name</dt>
                    <dd class="col-sm-8">{{ $patient->last_name }}</dd>

                    <dt class="col-sm-4">Address</dt>
                    <dd class="col-sm-8">{{ $patient->address }}</dd>

                    <dt class="col-sm-4">Address Line 2</dt>
                    <dd class="col-sm-8">{{ $patient->address_line_2 }}</dd>

                    <dt class="col-sm-4">City</dt>
                    <dd class="col-sm-8">{{ $patient->city }}</dd>

                    <dt class="col-sm-4">Phone Number</dt>
                    <dd class="col-sm-8">{{ $patient->phone_number }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $patient->email }}</dd>

                    <dt class="col-sm-4">Gender</dt>
                    <dd class="col-sm-8">{{ $patient->gender }}</dd>

                    <dt class="col-sm-4">Marital Status</dt>
                    <dd class="col-sm-8">{{ $patient->marital_status }}</dd>

                    <dt class="col-sm-4">Province</dt>
                    <dd class="col-sm-8">{{ $patient->province }}</dd>

                    <dt class="col-sm-4">Emergency Contact First Name</dt>
                    <dd class="col-sm-8">{{ $patient->emergency_contact_first_name }}</dd>

                    <dt class="col-sm-4">Emergency Contact Last Name</dt>
                    <dd class="col-sm-8">{{ $patient->emergency_contact_last_name }}</dd>

                    <dt class="col-sm-4">Emergency Contact Relationship</dt>
                    <dd class="col-sm-8">{{ $patient->emergency_contact_relationship }}</dd>

                    <dt class="col-sm-4">Emergency Contact Phone Number</dt>
                    <dd class="col-sm-8">{{ $patient->emergency_contact_phone_number }}</dd>

                    <dt class="col-sm-4">Family Doctor First Name</dt>
                    <dd class="col-sm-8">{{ $patient->family_doctor_first_name }}</dd>

                    <dt class="col-sm-4">Family Doctor Last Name</dt>
                    <dd class="col-sm-8">{{ $patient->family_doctor_last_name }}</dd>

                    <dt class="col-sm-4">Family Doctor Phone Number</dt>
                    <dd class="col-sm-8">{{ $patient->family_doctor_phone_number }}</dd>

                    <dt class="col-sm-4">Reason for Registration</dt>
                    <dd class="col-sm-8">{{ $patient->reason_for_registration }}</dd>
                </dl>
            </div>
        </div>

        <a href="{{ route('patient.dashboard') }}" class="btn btn-primary">Back to Patient List</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
