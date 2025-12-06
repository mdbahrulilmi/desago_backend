<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
</head>
<body>
    <p>Halo,</p>
    <p>Silakan klik tautan di bawah ini untuk memverifikasi akun Anda:</p>
    <a href="{{ $verificationUrl }}" style="display: inline-block; padding: 10px 20px; background-color: blue; color: white; text-decoration: none; border-radius: 5px;">
        Verifikasi Email
    </a>
    <p>Jika Anda tidak mendaftar akun, abaikan email ini.</p>
</body>
</html>
