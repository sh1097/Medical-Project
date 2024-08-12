<?php
namespace App\Http\Controllers;
error_reporting(E_ALL);

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Patient;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use App\Models\User;    
use Hash;
class RegistrationController extends Controller
{
    use AuthenticatesUsers;

    public function create()
    {
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;

            // Redirect based on role_id
            if ($role_id === 1) {
                return view('patient.dashboard');
            } elseif ($role_id === 2) {
                return view('registration.create');
            }
        }
      
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'location' => 'required|string|max:255',
            'registration_date_time' => 'required|date',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password'=>['required','nullable'],
            'address' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
            'marital_status' => 'required|string|in:Single,Married,Divorced,Widowed',
            'province' => 'required|string|max:255',
            'emergency_contact_first_name' => 'nullable|string|max:255',
            'emergency_contact_last_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'emergency_contact_phone_number' => 'nullable|string|max:20',
            'family_doctor_first_name' => 'nullable|string|max:255',
            'family_doctor_last_name' => 'nullable|string|max:255',
            'family_doctor_phone_number' => 'nullable|string|max:20',
            'reason_for_registration' => 'nullable|string',
        ]);
        $otp = Str::random(6);
        // Create a new patient record
        $patient = new Patient();
        $patient->location = $validatedData['location'];
        $patient->registration_date_time = $validatedData['registration_date_time'];
        $patient->first_name = $validatedData['first_name'];
        $patient->last_name = $validatedData['last_name'];
        $patient->address = $validatedData['address'];
        $patient->address_line_2 = $validatedData['address_line_2'];
        $patient->city = $validatedData['city'];
        $patient->phone_number = $validatedData['phone_number'];
        $patient->email = $validatedData['email'];
        $patient->gender = $validatedData['gender'];
        $patient->marital_status = $validatedData['marital_status'];
        $patient->province = $validatedData['province'];
        $patient->emergency_contact_first_name = $validatedData['emergency_contact_first_name'];
        $patient->emergency_contact_last_name = $validatedData['emergency_contact_last_name'];
        $patient->emergency_contact_relationship = $validatedData['emergency_contact_relationship'];
        $patient->emergency_contact_phone_number = $validatedData['emergency_contact_phone_number'];
        $patient->family_doctor_first_name = $validatedData['family_doctor_first_name'];
        $patient->family_doctor_last_name = $validatedData['family_doctor_last_name'];
        $patient->family_doctor_phone_number = $validatedData['family_doctor_phone_number'];
        $patient->reason_for_registration = $validatedData['reason_for_registration'];
        $role_id = Auth::user()->role_id;

        // Redirect based on role_id
        //  if ($role_id === 2) {
        //     $patient->clinic_id = Auth::user()->id;     
        //    }
  
       $user = User::create([
            'name' => $validatedData['first_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make( $validatedData['password']),
            'role_id'=> 1,
        ]);

    
        $patient->patient_id=$user->id;
      
        // $patient->otp = $otp;
        $patient->save();
        $patient = Patient::where('email', $validatedData['email'])->first();
          
        // echo"<pre>";print_r($patient);die;
        // Mail::to($patient->email)->send(new OTPMail($otp));
        // echo"<pre>";print_r(Mail::to($patient->email)->send(new OTPMail()));die;
       
        // Optionally, you can redirect to a success page or return a response
        return redirect()->route('verify.otp', ['patient' => $patient->id])->with('success', 'Patient registered successfully!');
    }
    public function show($id)
{
    $patient = Patient::findOrFail($id);
    return view('patient.show', compact('patient'));
}

public function index()
{
    $patients = Patient::all();
   
    return view('patient.index', compact('patients'));
}
public function destroy($id){
    $patient = Patient::findOrFail($id);
    $patient->delete();
}
public function edit($id){
    $patients = Patient::findOrFail($id);
    return view('patient.edit', compact('patients'));
}

public function loginsubmit(Request $request)
{
    // Validate the form data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to log the user in
    if ($this->attemptLogin($request)) {
        return $this->sendLoginResponse($request);
    }

    // Redirect back if login fails
    return $this->sendFailedLoginResponse($request);
}
public function update(Request $request, $id)
{
    
    $request->validate([
        'location' => 'required|string|max:255',
        'registration_date_time' => 'required|date',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'address_line_2' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'gender' => 'required|string|in:Male,Female,Other',
        'marital_status' => 'required|string|in:Single,Married,Divorced,Widowed',
        'province' => 'required|string|max:255',
        'emergency_contact_first_name' => 'nullable|string|max:255',
        'emergency_contact_last_name' => 'nullable|string|max:255',
        'emergency_contact_relationship' => 'nullable|string|max:255',
        'emergency_contact_phone_number' => 'nullable|string|max:20',
        'family_doctor_first_name' => 'nullable|string|max:255',
        'family_doctor_last_name' => 'nullable|string|max:255',
        'family_doctor_phone_number' => 'nullable|string|max:20',
        'reason_for_registration' => 'nullable|string',
    ]);
    $patient = Patient::findOrFail($id);
   

    $patient->fill($request->all());
    $patient->update();

    return redirect()->route('registration.show', $patient->id)->with('success', 'Patient details updated successfully.');
}
public function verifyOtp(Patient $patient)
{
 
    return view('verify-otp', compact('patient'));
}

public function postVerifyOtp(Request $request, Patient $patient)
{
    $patient = Patient::all();
    // $request->validate([
    //     'otp' => 'required|string|min:6|max:6',
    // ]);

    // if ($request->otp === $patient->otp) {
    //     // OTP matched, proceed with whatever action you need
    //     // For example, mark patient as verified
    //     $patient->otp_verified_at = now(); // Assuming you have a 'otp_verified_at' column in your patients table
    //     $patient->save();
        // Auth::login($patient);
        return view('clinic.dashboard', compact('patient'))->with('success','OTP Verified Successfully');
    // }

    // If OTP does not match, redirect back with error
    // return back()->with('error', 'Invalid OTP. Please try again.');
}
}
