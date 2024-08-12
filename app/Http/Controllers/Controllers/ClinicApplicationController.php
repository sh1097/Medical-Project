<?php
namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicApplicationController extends Controller
{
    public function index()
    {
        // Retrieve all clinic applications (clinics pending approval)
        $clinics = Clinic::where('approved', false)->get();
        
        return view('clinics.index', compact('clinics'));
    }

    public function approve($clinicId)
    {
        // Find the clinic by ID
        $clinic = Clinic::findOrFail($clinicId);

        // Approve the clinic application
        $clinic->update(['approved' => true]);

        return redirect()->route('clinics.index')->with('success', 'Clinic approved successfully.');
    }
}
