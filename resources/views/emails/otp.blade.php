<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <div style="font-family: sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #eee; padding: 20px;">
        <h2>Halo {{ $details['nama'] }}!</h2>
        <p>Terima kasih telah mendaftar. Berikut adalah kode OTP untuk verifikasi akun Anda:</p>

        <div style="background: #f4f4f4; padding: 15px; text-align: center; font-size: 24px; font-weight: bold; letter-spacing: 5px;">
            {{ $details['otp'] }}
        </div>

        <p>Atau, Anda bisa klik tombol di bawah ini untuk verifikasi secara instan:</p>

        <div style="text-align: center; margin: 25px 0;">
            <a href="{{ $details['link'] }}"
               style="background: #007bff; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
                Verifikasi Akun Sekarang
            </a>
        </div>

        <p style="font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 15px;">
            Jika tombol tidak berfungsi, silakan salin dan tempel tautan ke browser Anda:<br>
            <span style="color: #007bff;">{{ $details['link'] }}</span>
        </p>
    </div> </body>
</html>