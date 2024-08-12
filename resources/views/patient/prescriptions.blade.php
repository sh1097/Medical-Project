<!DOCTYPE html>
{{-- < ?php echo"<pre>";print_r($patient);die;?> --}}
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $patient->first_name }} {{$patient->last_name}}'s Prescriptions</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h1 {
    margin-top: 0;
    font-size: 28px;
    color: #333;
}

/* Table Styles */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.table th {
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
}

.table tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Button Styles */
.btn {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 14px;
    color: #fff;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
}

.btn-warning {
    background-color: #ffc107;
    border: none;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}

form {
    display: inline;
}

button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    font: inherit;
}

button:hover {
    text-decoration: underline;
}
/* Prescription Details Styles */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.table th {
    background-color: #007bff;
    color: #fff;
    font-size: 16px;
}

.table tr:nth-child(even) {
    background-color: #f9f9f9;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $patient->first_name }}'s Prescriptions</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Medication</th>
                    <th>Dosage Instructions</th>
                    <th>File</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prescriptions as $prescription)
                    <tr>
                        <td>{{ $prescription->id }}</td>
                        <td>{{ $prescription->medication }}</td>
                        <td>{{ $prescription->dosage_instructions }}</td>
                        <td><a href="{{ Storage::url($prescription->file_path) }}" target="_blank">View File</a></td>
                        <td>{{ $prescription->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
