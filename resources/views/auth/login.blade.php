<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
</head>

<body>

<div class="login-container">

    <div class="login-box">

        <div class="login-header">
            <h2>Login Admin</h2>
            <p>Silakan masuk untuk mengelola data dan hasil identifikasi tumbuhan.</p>
        </div>

        @if(session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="input-group">
                <label>Nama Pengguna</label>
                <input type="text" name="username" placeholder="Masukkan Nama Pengguna" required>
            </div>

            <div class="input-group">
                <label>Kata Sandi</label>
                <input type="password" name="password" placeholder="Masukkan Kata Sandi" required>
            </div>

            <button type="submit">Masuk</button>

        </form>

        <div class="footer">
            © 2026 Kamus Digital Taksonomi Tumbuhan
        </div>

    </div>

</div>

</body>
</html>