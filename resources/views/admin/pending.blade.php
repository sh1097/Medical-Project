<!DOCTYPE html>
<html>
<head>
    <title>Pending Clinic Applications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Pending Clinic Applications</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Clinic Name</th>
                    <th>Application Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($applications->isNotEmpty())
                    @foreach ($applications as $application)
                        <tr>
                            <td>{{ $application->name }}</td>
                            <td>{{ $application->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.applications.show', $application->id) }}" class="btn btn-primary">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">No Pending Clinics</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
