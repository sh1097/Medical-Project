<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
      
        // echo"<pre>";print_r("jj");die;
       
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;

            // Redirect based on role_id
            if ($role_id == 1) {
                $id = Auth::user()->id;
                $patients = Patient::where('patient_id', $id)->get();
                // echo"<pre>";print_r($patients);die;
                return view('patient.dashboard', compact('patients'));
            } elseif ($role_id === 2) {

                $id = Auth::user()->id;
                $patient = Patient::where('clinic_id', $id)->get();
                // $patient = Patient::all();
                        // echo"<pre>";print_r($patients);die;

                if($patient){
                   
                    return view('clinic.dashboard', compact('patient'));                }
             else{
                return redirect()->route('admin.dashboard');

             }
                    // Redirect to the 'registration.create' route
      

            }
        }
    }
    public function index()
    {
        // Retrieve patients associated with the logged-in clinic
        $clinicId = Auth::user()->clinic_id;
        $patients = Patient::where('clinic_id', $clinicId)->get();
        return view('clinic.dashboard', compact('patients'));
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patient.show', compact('patient'));
    }

   

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully.');
    }

    public function showPatientPrescriptions(Patient $patient)
    {
        // Fetch all prescriptions for the patient
        $prescriptions = $patient->prescriptions()->get();
        
        // Pass data to the view
        return view('patient.prescriptions', compact('patient', 'prescriptions'));
    }
    public function showPrescriptions(Patient $patient)
    {
        // echo"<pre>";print_r($patient);die;
        // Fetch prescriptions related to the patient
        $prescriptions = $patient->prescriptions;

        // Pass the data to the view
        return view('patient.prescriptions', compact('prescriptions', 'patient'));
    }

    public function edit($id)
{
    $patient = Patient::find($id);

    if (!$patient) {
        return redirect()->route('patients.dashboard')->withErrors('Patient not found.');
    }

    return view('patient.edit', compact('patient'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'location' => 'required|string',
        'registration_date_time' => 'required|date',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'address' => 'required|string',
        'address_line_2' => 'nullable|string',
        'city' => 'required|string',
        'phone_number' => 'required|string',
        'email' => 'required|email',
        'gender' => 'required|string',
        'marital_status' => 'required|string',
        'province' => 'required|string',
        'emergency_contact_first_name' => 'required|string',
        'emergency_contact_last_name' => 'required|string',
        'emergency_contact_relationship' => 'required|string',
        'emergency_contact_phone_number' => 'required|string',
        'family_doctor_first_name' => 'required|string',
        'family_doctor_last_name' => 'required|string',
        'family_doctor_phone_number' => 'required|string',
        'reason_for_registration' => 'required|string',
    ]);

    $patient = Patient::find($id);

    if (!$patient) {
        return redirect()->route('patients.dashboard')->withErrors('Patient not found.');
    }

    $patient->update($request->all());

    return redirect()->route('patient.dashboard')->with('success', 'Patient updated successfully.');
}
}

