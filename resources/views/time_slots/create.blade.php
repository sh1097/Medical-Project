<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Time Slot</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Create Time Slot</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('time.slots.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="clinic_id">Select Clinic:</label>
                <select name="clinic_id" id="clinic_id" class="form-control" required>
                    @foreach($clinics as $clinic)
                        <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                    @endforeach
                </select>
           
            </div>
            <div class="form-group">
                <label for="start_time">Start Time:</label>
                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}" required>
                @error('start_time')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}" required>
                @error('end_time')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="available">Available:</label>
                <select name="available" id="available" class="form-control" required>
                    <option value="1" {{ old('available') == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('available') == '0' ? 'selected' : '' }}>No</option>
                </select>
                @error('available')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Time Slot</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
