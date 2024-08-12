<?php

// app/Http/Controllers/TimeSlotController.php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimeSlotController extends Controller
{
    public function index()
    {
        // Display all time slots
        $timeSlots = TimeSlot::all();
        return view('time_slots.index', compact('timeSlots'));
    }

    public function create()
    {
        // Show form to create a new time slot
        $clinics = Clinic::all();
        return view('time_slots.create', compact('clinics'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'clinic_id'=>'required|integer',
        'available' => 'required|integer',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'date' => 'required|date', // Added date validation

        
    ]);
        TimeSlot::create($validatedData);

        return redirect()->route('time.slots.index')->with('success', 'Time slot created successfully.');
    }

    public function edit(TimeSlot $timeSlot)
    {
        $clinics = Clinic::all();
        return view('time_slots.edit', compact('timeSlot', 'clinics'));
    }

    public function update(Request $request, TimeSlot $timeSlot)
    {
        $validatedData = $request->validate([
            'clinic_id' => 'required|exists:clinics,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $timeSlot->update($validatedData);

        return redirect()->route('time_slots.index')->with('success', 'Time slot updated successfully.');
    }

    public function destroy(TimeSlot $timeSlot)
    {
        $timeSlot->delete();
        return redirect()->route('time_slots.index')->with('success', 'Time slot deleted successfully.');
    }

    
}
