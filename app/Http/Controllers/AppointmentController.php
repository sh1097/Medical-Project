<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function create()
    {
        // Get available time slots
        $timeSlots = TimeSlot::where('available', 1)
            ->whereDoesntHave('appointments')
            ->where('date', '>=', now()->toDateString()) // Filter by future dates
            ->get();
            // echo"<pre>";print_r($timeSlots->isNotEmpty());die;

            
        if ($timeSlots->isEmpty()) {
            // Return the view with the available time slots
            return view('appointments.create', compact('timeSlots'));
        } else {
            // Redirect if no time slots are available
            return redirect()->route('appointments.index')->with('error', 'No slots are available for appointment.');
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'time_slot_id' => 'required|exists:time_slots,id',
        ]);
        $timeSlot = TimeSlot::findOrFail($request->input('time_slot_id'));
        // Create appointment
        $appointment=   Appointment::create([
            'user_id' => Auth::id(),
            'time_slot_id' => $request->time_slot_id,
            'status' => '1',
        ]);
        $timeSlot->update(['available' => false]);

        return redirect()->route('appointments.create')->with('success', 'Appointment booked successfully.');
    }

    public function index()
    {
        $appointments = Auth::user()->appointments()->with('timeSlot')->get();
        // echo"<pre>";print_r($appointments);die;
        return view('appointments.index', compact('appointments'));
    }
 
    public function show(Appointment $appointment)
    {
        // Fetch the appointment details (optional: eager load related data)
        // Ensure that $appointment is retrieved via route-model binding
        $appointment->load('user', 'timeSlot'); // Assuming you have relationships defined

        // Return the view with the appointment data
        return view('appointments.show', compact('appointment'));
    }

       public function history()
    {
        $id = Auth::user()->id;
        $appointments = Appointment::all();
        //   $appointments = Auth::user()->appointments()->get();
        // echo"<pre>";print_r($appointments);die;
        return view('appointments.index', compact('appointments'));
    }
}

