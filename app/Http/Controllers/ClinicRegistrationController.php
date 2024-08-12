<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;

class ClinicRegistrationController extends Controller
{
    public function create()
    {
       
       $clinics= User::where('role_id', 2)->get();
       
        return view('clinic.register', compact('clinics'));
       
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients',
            'phone' => 'nullable|string|max:15',
            'clinic_id' => 'required|exists:users,id',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.create')->with('success', 'Registration successful.');
    }
    public function getPatients(Clinic $clinic)
    {
        $patients = $clinic->clinic_id; // Fetch all patients for the clinic

        return response()->json($patients);
    }
    public function registerPatient($clinicId)
    {
        $clinic = Clinic::findOrFail($clinicId);

        return view('patient.register', compact('clinic'));
    }
    
}
