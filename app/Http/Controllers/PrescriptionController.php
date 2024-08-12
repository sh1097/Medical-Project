<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
class PrescriptionController extends Controller
{
    public function index()
    { 
  
        return Prescription::all();
    }
    public function showForms()
    {      $clinicId = Auth::user()->id;
        $patients = Patient::where('clinic_id', $clinicId)->get();

        return view('add-prescription', compact('patients'));
    }

    public function store(Request $request)
    {
        
        // Validate the request
        $request->validate([
          
            'medication' => 'required|string|max:255',
            'dosage_instructions' => 'required|string',
            'prescription_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('prescription_file')) {
            $file = $request->file('prescription_file');
            $path = $file->store('prescriptions', 'public'); // Store in 'storage/app/public/prescriptions'
        } else {
            return response()->json(['message' => 'No file uploaded.'], 400);
        }

        // Create a new prescription record in the database
        Prescription::create([
            'patient_id' => $request->input('patient_name'),
            'patient_name' => $request->input('patient_name'),

            'medication' => $request->input('medication'),
            'dosage_instructions' => $request->input('dosage_instructions'),
            'file_path' => $path,
        ]);

        // Return a success response
        return response()->json(['message' => 'Prescription file uploaded successfully!']);
    }

 

 
}
