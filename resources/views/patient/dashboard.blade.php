@extends('layouts.app')
@section('content')
<div id="app">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                   
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('appointments.create') }}">Book Your Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('add-prescription') }}">Add Prescriptions
                            </a>
                        </li>
                        <li class="nav-item">
    <a class="nav-link" href="{{ route('appointments.history') }}"> Appointments Histroy</a>
</li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('patient.register.form') }}">Clinic Registration</a>

                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Patient Dashboard</h1>
                </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            <h2>Patients List</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($patients as $patient)
                                     {{-- < ?php echo"<pre>";print_r($patient);die("ll");?> --}}

                                        <tr>
                                            <td>{{ $patient->first_name  }}  {{ $patient->last_name  }}</td>
                                            <td>{{ $patient->email }}</td>
                                            <td>{{ $patient->phone_number }}</td>
                                            <td>
                                                <a href="{{ route('registration.show', $patient->id) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm">Edit</a>
 
                                                <a href="{{ route('patients.prescription', $patient->id) }}" class="btn btn-success btn-sm">Prescriptions</a>
                                                <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                

                <!-- Router view for dynamic content -->
                <router-view></router-view>
            </main>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Load Bootstrap JavaScript -->
<script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
@endpush
