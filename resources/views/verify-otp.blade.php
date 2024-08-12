<form action="{{ route('verify.otp.post', ['patient' => $patient->id]) }}" method="POST">
    @csrf
 
    <label for="otp">Enter OTP:</label>
    <input type="text" id="otp" name="otp" maxlength="6" required>

    <button type="submit">Verify OTP</button>
</form>