<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User; // Assuming 'User' model is used for clinics
use Illuminate\Http\Request;
use App\Models\Clinic; 
class PatientClinicController extends Controller
{
    public function registerForm()
    {
        // Get all clinics
        $clinics = Clinic::all();
        $patients=Patient::all();
    //    echo"<pre>";print_r($patients);die;
    return view('patient.register', compact('clinics', 'patients'));
    }

    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'clinic_id' => 'required|exists:clinics,id', // Validate against 'clinics' table, not 'users'
            'patient_id' => 'required|exists:patients,id', // Ensure patient_id is also validated
        ]);
    
        // Get the currently authenticated patient
        $patient = Patient::find($request->input('patient_id')); // Use find() to get the Patient model instance
    //  echo"<pre>";print_r($patient);die;
        if (!$patient) {
            return redirect()->route('patient.register.form')->withErrors('Patient not found.');
        }

        // Update the patient's clinic_id
        $patient->clinic_id = $request->input('clinic_id');
        $patient->save();

        return redirect()->route('patient.register.form')->with('success', 'Successfully registered with the clinic.');
    }
}
