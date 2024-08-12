<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\User; // Assuming User model for admin
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\Facades\Barcode;
// use Zebra\Barcode\Barcode;
use Illuminate\Support\Facades\Storage; // For storing images

use SimpleSoftwareIO\QrCode\Facades\QrCode;


class AdminController extends Controller
{
    public function dashboard()
    {

        if (Auth::check()) {
         
       
            $role_id = Auth::user()->role_id;
            $clinic_id = Auth::id();
            // Redirect based on role_id
            if ($role_id === 1) {
                $patients = Patient::all();
                return view('patient.dashboard', compact('patients'));
            } elseif ($role_id == 2) {
                
                $patient = Patient::where('clinic_id', $clinic_id)->get();
                // echo"<pre>";print_r($patient);die;
             if(count($patient) > 0) {
             
                   
                    return view('clinic.dashboard', compact('patient'));                }
             else{
                return redirect()->route('admin.dashboard');

             }
                    // Redirect to the 'registration.create' route
      

            }
            else{
                $patient = Patient::all();
                return view('admin.dashboard', compact('patient'));
            }
        }    }

    public function pendingClinics()
    {
        $clinics = Clinic::where('approved', false)->get();

        return view('admin.clinics.pending', compact('clinics'));
    }
    public function showPendingApplications()
    {
        $applications = Clinic::where('approved', '0')->get();
        // echo"<pre>";print_r($applications);die;
        return view('admin.pending', compact('applications'));
    }
    public function approveClinic(Clinic $clinic)
    {
        // echo"<pre>";print_r($clinic);die;
        // $this->authorize('approve', Clinic::class); // Ensure admin is authorized to approve

        $clinic->update(['approved' => true]);

        // Optionally, send notification to clinic about approval

        return redirect()->route('admin.pending.clinics')->with('success', 'Clinic approved successfully.');
    }
    public function approvedClinics()
    {
        $clinics = Clinic::where('approved', true)->get();

        return view('admin.clinics.approved', compact('clinics'));
    }
    public function editClinic($id)
    {
        $clinic = Clinic::findOrFail($id);

        return view('admin.clinics.edit', compact('clinic'));
    }
    public function showForms()
    {      $clinicId = Auth::user()->id;
        $patients = Patient::all();

        return view('add-prescription', compact('patients'));
    }
    /**
     * Remove the specified clinic from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteClinic($id)
    {
        $clinic = Clinic::findOrFail($id);
        $clinic->delete();

        return redirect()->route('admin.approved.clinics')->with('success', 'Clinic deleted successfully.');
    }
    public function showApplicationDetails($id)
    {
        $application = Clinic::findOrFail($id);
        // echo"<pre>";print_r($application);die;
        return view('admin.details', compact('application'));
    }

    public function verifyClinicCredentials($id)
    {
        $application = clinic::findOrFail($id);

    
            $application->approved = true;
            $approvalCode = $this->generateApprovalCode($application);
            $application->approved_code = $approvalCode;
            $application->save();

            // Generate QR code
            $qrCode = QrCode::size(300)
                ->generate(route('clinics.show', $application->id));
    
                $fileName = 'qrcode_' . $application->id . '.png';
                $filePath = 'public/qrcodes/' . $fileName;
                Storage::put($filePath, $qrCode);
                $qrCodeUrl = Storage::url($filePath);

                // Save the QR code URL or file path to the database
                $model = Clinic::find($application->id); // Replace with your actual model and finding logic
                $model->qr_code_url = $qrCodeUrl; // Replace 'qr_code_url' with your actual column name
                $model->save();
                return view('admin.qr-code', compact('qrCode'));

           
           
            // echo"<pre>";print_r($qrCodeFilePath);die;

            // $this->notifyClinic($application, $approvalCode);


        // return redirect()->route('admin.dashboard')->with('status', 'Clinic approved!' );
    }
    private function generateApprovalCode($application)
    {
        return strtoupper(substr(md5(uniqid(rand(), true)), 0, 10));
    }
}
