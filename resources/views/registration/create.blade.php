 @extends('layouts.app') 
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registration Form</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('registration.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="location">Registration Location</label>
                                <input type="text" id="location" name="location" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="registration_date_time">Registration Date & Time</label>
                                <input type="datetime-local" id="registration_date_time" name="registration_date_time" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control">
                                <input type="text" id="address_line_2" name="address_line_2" placeholder="Address Line 2" class="form-control mt-2">
                                <input type="text" id="city" name="city" placeholder="City" class="form-control mt-2">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="tel" id="phone_number" name="phone_number" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                        

                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="">Please select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="marital_status">Marital Status</label>
                                <select id="marital_status" name="marital_status" class="form-control">
                                    <option value="">Please select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="province">Province of Residence</label>
                                <input type="text" id="province" name="province" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="emergency_contact_first_name">Emergency Contact First Name</label>
                                <input type="text" id="emergency_contact_first_name" name="emergency_contact_first_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="emergency_contact_last_name">Emergency Contact Last Name</label>
                                <input type="text" id="emergency_contact_last_name" name="emergency_contact_last_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="emergency_contact_relationship">Relationship with Emergency Contact</label>
                                <input type="text" id="emergency_contact_relationship" name="emergency_contact_relationship" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="emergency_contact_phone_number">Emergency Contact Phone Number</label>
                                <input type="tel" id="emergency_contact_phone_number" name="emergency_contact_phone_number" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="family_doctor_first_name">Family Doctor First Name</label>
                                <input type="text" id="family_doctor_first_name" name="family_doctor_first_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="family_doctor_last_name">Family Doctor Last Name</label>
                                <input type="text" id="family_doctor_last_name" name="family_doctor_last_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="family_doctor_phone_number">Family Doctor Phone Number</label>
                                <input type="tel" id="family_doctor_phone_number" name="family_doctor_phone_number" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="reason_for_registration">Reason for Registration</label>
                                <textarea id="reason_for_registration" name="reason_for_registration" class="form-control" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

