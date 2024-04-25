<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <p>Halo {{ $user->name }},</p>
    <p>Kami menerima permintaan untuk mereset password akun Anda.</p>
    <p>Silakan klik link di bawah ini untuk mereset password Anda:</p>
    <a href="{{ route('password.reset', $user->reset_password_token) }}">Reset Password</a>
    <p>Jika Anda tidak membuat permintaan ini, abaikan saja email ini.</p>
    <p>Terima kasih.</p>
</body>
</html>
