<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Kamus Digital Tumbuhan</title>

    {{-- font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    {{-- css --}}
    <link rel="stylesheet"
          href="{{ asset('css/user/splash.css') }}">

    {{-- redirect --}}
    <script>

        setTimeout(() => {

            window.location.href = "/home";

        }, 2000);

    </script>

</head>

<body>

    <div class="splash-container">

        {{-- logo --}}
        <div class="logo">

            🌿

        </div>

        {{-- judul --}}
        <h1 class="title">

            Kamus Digital Tumbuhan

        </h1>

        {{-- subtitle --}}
        <p class="subtitle">

            Menyiapkan sistem...
        </p>

        {{-- loading --}}
        <div class="loader"></div>

    </div>

</body>
</html>