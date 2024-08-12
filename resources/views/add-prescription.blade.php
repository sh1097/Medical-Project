<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Prescriptions</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        #successMessage {
            margin-top: 15px;
            color: #28a745;
            font-weight: bold;
        }

        .form-section {
            margin-bottom: 40px;
        }
        #patient_name{
            width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <h2>Add Prescription</h2>
            <form id="addPrescriptionForm" enctype="multipart/form-data">
                <div>
                    <label for="patient">Select Patient:</label>
                    <select id="patient_name" name="patient_name" required>
                        @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                    @endforeach                    </select>
                </div>
                <div>
                    <label for="medication">Medication:</label>
                    <input type="text" id="medication" name="medication" required />
                </div>
                <div>
                    <label for="dosage_instructions">Dosage Instructions:</label>
                    <textarea id="dosage_instructions" name="dosage_instructions" required></textarea>
                </div>
                <div>
                    <label for="prescription_file">Upload Prescription File:</label>
                    <input type="file" id="prescription_file" name="prescription_file" required />
                </div>
                <button type="submit">Add Prescription</button>
            </form>
            <p id="addPrescriptionSuccessMessage"></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const clinicId = 1; // Replace with dynamic clinic ID as needed

            try {
                const response = await fetch(`/clinic/${clinicId}/patients`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const patients = await response.json();
                const patientSelect = document.getElementById('patient');

                patients.forEach(patient => {
                    const option = document.createElement('option');
                    option.value = patient.id;
                    option.textContent = patient.name;
                    patientSelect.appendChild(option);
                });
            } catch (error) {
                console.error('There was a problem with the fetch operation:', error);
            }
        });

        document.getElementById('addPrescriptionForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            
            const formData = new FormData(this); // Use FormData to handle file upload

            try {
                const response = await fetch('/api/prescriptions', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData // Send FormData directly
                });
                
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const result = await response.json();
                document.getElementById('addPrescriptionSuccessMessage').textContent = result.message;
                
                // Clear form fields
                document.getElementById('addPrescriptionForm').reset();
            } catch (error) {
                console.error('There was a problem with the fetch operation:', error);
            }
        });
    </script>
</body>
</html>
