
<div>

    <p>Thank you for registering. Use the following OTP to verify your email:</p>

    <h1 style="letter-spacing: 4px; color: #2d3748;">
        {{ $otp }}
    </h1>

    <p>This OTP will expire in 10 minutes.</p>

    <p>If you did not request this, please ignore this email.</p>

    <br>
    <p>Regards,<br>{{ config('app.name') }}</p>
</div>
