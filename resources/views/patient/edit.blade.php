<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .container {
            max-width: 800px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Patient</h1>

        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $patient->location) }}">
            </div>

            <div class="form-group">
                <label for="registration_date_time">Registration Date and Time</label>
                <input type="datetime-local" class="form-control" id="registration_date_time" name="registration_date_time" value="{{ old('registration_date_time', $patient->registration_date_time) }}">
            </div>

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $patient->first_name) }}">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $patient->last_name) }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $patient->address) }}">
            </div>

            <div class="form-group">
                <label for="address_line_2">Address Line 2</label>
                <input type="text" class="form-control" id="address_line_2" name="address_line_2" value="{{ old('address_line_2', $patient->address_line_2) }}">
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $patient->city) }}">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $patient->phone_number) }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $patient->email) }}">
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="Male" {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', $patient->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="marital_status">Marital Status</label>
                <select class="form-control" id="marital_status" name="marital_status">
                    <option value="Single" {{ old('marital_status', $patient->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Married" {{ old('marital_status', $patient->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                    <option value="Divorced" {{ old('marital_status', $patient->marital_status) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                    <option value="Widowed" {{ old('marital_status', $patient->marital_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="province">Province</label>
                <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $patient->province) }}">
            </div>

            <div class="form-group">
                <label for="emergency_contact_first_name">Emergency Contact First Name</label>
                <input type="text" class="form-control" id="emergency_contact_first_name" name="emergency_contact_first_name" value="{{ old('emergency_contact_first_name', $patient->emergency_contact_first_name) }}">
            </div>

            <div class="form-group">
                <label for="emergency_contact_last_name">Emergency Contact Last Name</label>
                <input type="text" class="form-control" id="emergency_contact_last_name" name="emergency_contact_last_name" value="{{ old('emergency_contact_last_name', $patient->emergency_contact_last_name) }}">
            </div>

            <div class="form-group">
                <label for="emergency_contact_relationship">Emergency Contact Relationship</label>
                <input type="text" class="form-control" id="emergency_contact_relationship" name="emergency_contact_relationship" value="{{ old('emergency_contact_relationship', $patient->emergency_contact_relationship) }}">
            </div>

            <div class="form-group">
                <label for="emergency_contact_phone_number">Emergency Contact Phone Number</label>
                <input type="text" class="form-control" id="emergency_contact_phone_number" name="emergency_contact_phone_number" value="{{ old('emergency_contact_phone_number', $patient->emergency_contact_phone_number) }}">
            </div>

            <div class="form-group">
                <label for="family_doctor_first_name">Family Doctor First Name</label>
                <input type="text" class="form-control" id="family_doctor_first_name" name="family_doctor_first_name" value="{{ old('family_doctor_first_name', $patient->family_doctor_first_name) }}">
            </div>

            <div class="form-group">
                <label for="family_doctor_last_name">Family Doctor Last Name</label>
                <input type="text" class="form-control" id="family_doctor_last_name" name="family_doctor_last_name" value="{{ old('family_doctor_last_name', $patient->family_doctor_last_name) }}">
            </div>

            <div class="form-group">
                <label for="family_doctor_phone_number">Family Doctor Phone Number</label>
                <input type="text" class="form-control" id="family_doctor_phone_number" name="family_doctor_phone_number" value="{{ old('family_doctor_phone_number', $patient->family_doctor_phone_number) }}">
            </div>

            <div class="form-group">
                <label for="reason_for_registration">Reason for Registration</label>
                <textarea class="form-control" id="reason_for_registration" name="reason_for_registration" rows="3">{{ old('reason_for_registration', $patient->reason_for_registration) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('patient.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
