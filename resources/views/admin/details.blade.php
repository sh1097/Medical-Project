<!DOCTYPE html>
<html>
<head>
    <title>Clinic Application Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Application Details for {{ $application->name }}</h1>

        <ul class="list-group">
            <li class="list-group-item"><strong>Clinic Name:</strong> {{ $application->name }}</li>
            <li class="list-group-item"><strong>Application Date:</strong> {{ $application->created_at }}</li>
            <li class="list-group-item"><strong>Contact Email:</strong> {{ $application->email }}</li>
            <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($application->approved) }}</li>
                
            </li>
            <li class="list-group-item"><strong>Additional Notes:</strong> {{ $application->notes ?? 'N/A' }}</li>
        </ul>

        <div class="mt-4">
            <form action="{{ route('admin.applications.verify', $application->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Approve Clinic</button>
            </form>

         

            <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</body>
</html>
