<?php
namespace App\Http\Controllers;

use App\Models\OTPVerification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Carbon\Carbon;
use Illuminate\Support\Str;
class OTPVerificationController extends Controller
{
    public function generateOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Generate OTP
        $otp = Str::random(6); // Generate a 6-character OTP

        // Store OTP in database
        OTPVerification::updateOrCreate(
            ['email' => $request->email],
            ['otp' => $otp, 'expires_at' => Carbon::now()->addMinutes(5)]
        );

        // Send OTP via email
        Mail::to($request->email)->send(new OTPMail());

        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string'
        ]);

        // Check if OTP exists and is valid
        $otpVerification = OTPVerification::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->where('verified', false)
            ->first();

        if ($otpVerification) {
            // Mark OTP as verified
            $otpVerification->verified = true;
            $otpVerification->save();

            return response()->json(['message' => 'OTP verified successfully']);
        }

        return response()->json(['error' => 'Invalid OTP or OTP expired'], 422);
    }
}
