<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ClinicShopController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\OTPVerificationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClinicRegistrationController;
use App\Http\Controllers\PatientClinicController;

// Route to show appointment registration form
Route::get('/appointments/register', [AppointmentController::class, 'create'])->name('appointments.create')->middleware('auth');

// Route to store the new appointment
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store')->middleware('auth');

// Route to view existing appointments
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index')->middleware('auth');
Route::get('/appointments/history', [AppointmentController::class, 'history'])->name('appointments.history')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('registration/create', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('registration/store', [RegistrationController::class, 'store'])->name('registration.store');



Route::get('registration/show/{id}', [RegistrationController::class,'show'])->name('registration.show');
Route::delete('registration/{id}', [RegistrationController::class, 'destroy'])->name('registration.destroy');
Route::get('registration/{id}', [RegistrationController::class, 'edit'])->name('registration.edit');
Route::put('registration/{id}/update', [RegistrationController::class, 'update'])->name('registration.update');



/** OTP Verification Route */
Route::post('/otp/verify', function (Request $request) {

    $request->validate([
        'email'    => ['required', 'string', 'email', 'max:255'],
        'code'     => ['required', 'string']
    ]);

    $otp = Otp::identifier($request->email)->attempt($request->code);

    if($otp['status'] != Otp::OTP_PROCESSED)
    {
        abort(403, __($otp['status']));
    }

    return $otp['result'];
});


/** OTP Resend Route */
Route::post('/otp/resend', function (Request $request) {

    $request->validate([
        'email'    => ['required', 'string', 'email', 'max:255']
    ]);

    $otp = Otp::identifier($request->email)->update();

    if($otp['status'] != Otp::OTP_SENT)
    {
        abort(403, __($otp['status']));
    }
    return __($otp['status']);
});

Route::get('/verify-otp/{patient}', [RegistrationController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/verify-otp/{patient}', [RegistrationController::class, 'postVerifyOtp'])->name('verify.otp.post');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/loginsubmit', [RegistrationController::class, 'loginsubmit'])->name('registration.loginsubmit');


Route::get('patient/register', [PatientClinicController::class, 'registerForm'])->name('patient.register.form')->middleware('auth');
Route::post('patient/registers', [PatientClinicController::class, 'register'])->name('patient.register')->middleware('auth');

Route::get('/clinic/register', [ClinicRegistrationController::class, 'create'])->name('clinic.register');
Route::post('/clinic/register', [ClinicRegistrationController::class, 'store'])->name('clinic.store');
Route::prefix('clinics/{clinicId}/slots')->group(function () {
    
    // Show the form for creating a new slot
    Route::get('create', [SlotController::class, 'create'])->name('slots.create');

    // Store a newly created slot for the clinic
    Route::post('/', [SlotController::class, 'store'])->name('slots.store');

    // Show the form for editing the specified slot
    Route::get('{slotId}/edit', [SlotController::class, 'edit'])->name('slots.edit');

    // Update the specified slot in storage
    Route::put('{slotId}', [SlotController::class, 'update'])->name('slots.update');

    // Remove the specified slot from storage
    Route::delete('{slotId}', [SlotController::class, 'destroy'])->name('slots.destroy');

    // Show the clinic details (assuming this route already exists)
    Route::get('/show', [SlotController::class, 'show'])->name('clinics.show');
    
});
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Pending Clinics
Route::get('/clinics/pending', [AdminController::class, 'pendingClinics'])->name('admin.pending.clinics');

// Approve Clinic
Route::put('/clinics/{clinic}/approve', [AdminController::class, 'approveClinic'])->name('admin.clinics.approve');

// Approved Clinics
Route::get('/clinics/approved', [AdminController::class, 'approvedClinics'])->name('admin.approved.clinics');

// Edit Clinic
Route::get('/clinics/{clinic}/edit', [AdminController::class, 'editClinic'])->name('admin.clinics.edit');

// Delete Clinic
Route::delete('/clinics/{clinic}/delete', [AdminController::class, 'deleteClinic'])->name('admin.clinic.delete');
Route::get('/clinics/{clinic}/edit', [AdminController::class, 'editClinic'])->name('admin.clinic.edit');


    Route::get('/clinics/{clinic}/shop/edit', [ClinicShopController::class, 'edit'])->name('clinics.shop.edit');
    Route::put('/clinics/{clinic}/shop/update', [ClinicShopController::class, 'update'])->name('clinics.shop.update');
    Route::get('/clinics/{clinic}/shop/create', [ClinicShopController::class, 'create'])->name('clinics.shop.create');
    Route::post('/clinics/{clinic}/shop/store', [ClinicShopController::class, 'store'])->name('clinics.shop.store');
    Route::get('/clinics/{clinic}/shop/show', [ClinicShopController::class, 'show'])->name('clinics.shop.show');
    Route::get('/clinics/{clinic}/shops', [ClinicShopController::class, 'index'])->name('clinics.shop.index');

    use App\Http\Controllers\PatientController;

// Patient routes
Route::resource('patients', PatientController::class)->only([
    'show', 'edit', 'update', 'destroy'
])->middleware('auth');
Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard')->middleware('auth');

// Route for Clinic Dashboard
Route::get('/clinic/dashboard', [ClinicRegistrationController::class, 'dashboard'])->name('clinic.dashboard')->middleware('auth');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\PrescriptionController;

Route::get('prescriptions', [PrescriptionController::class, 'index']);
Route::post('prescriptions', [PrescriptionController::class, 'store']);

Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard')->middleware('auth');


Route::get('/add-prescription', function () {
    return view('add-prescription');
});


Route::get('/add-prescription', [PrescriptionController::class, 'showForms'])->name('add-prescription');
Route::post('/api/prescriptions', [PrescriptionController::class, 'store']);
Route::post('/api/prescriptions/upload', [PrescriptionController::class, 'uploadPrescription']);
Route::get('/patient/{patient}/prescriptions', [PatientController::class, 'showPatientPrescriptions'])
    ->name('patient.prescriptions'); 

// web.php
Route::get('/patients/{patient}/prescriptions', [PatientController::class, 'showPrescriptions'])->name('patients.prescription');
Route::resource('medical_shops', MedicalShopController::class);

// Products Routes
Route::resource('products', ProductController::class);

use App\Http\Controllers\TimeSlotController;

Route::get('time-slots', [TimeSlotController::class, 'index'])->name('time.slots.index');

// Route to show the form
Route::get('time-slots/create', [TimeSlotController::class, 'create'])->name('time.slots.create');

// Route to handle the form submission
Route::post('time-slots', [TimeSlotController::class, 'store'])->name('time.slots.store');
Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::get('/admin/clinic-applications', [AdminController::class, 'showPendingApplications'])
    ->name('admin.applications.index');
    // Route to show details of a specific clinic application
Route::get('/admin/clinic-applications/{id}', [AdminController::class, 'showApplicationDetails'])
->name('admin.applications.show');
Route::post('/admin/clinic-applications/{id}/verify', [AdminController::class, 'verifyClinicCredentials'])
    ->name('admin.applications.verify');
    Route::get('/admin-prescription', [AdminController::class, 'showForms'])->name('admin-prescription');
    Route::get('/clinics/{clinicId}/qr-code', [AdminController::class, 'showQRCode'])->name('clinics.qr-code');
    // Route::get('/clinics/{clinicId}/register', [ClinicRegistrationController::class, 'registerPatient'])->name('clinic.register');
    Route::get('/register-patient/{clinicId}', [ClinicRegistrationController::class, 'registerPatient'])->name('clinic.register');
