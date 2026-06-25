<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klasifikasi Teks</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="{{ asset('css/user/teks.css') }}">
</head>

<body>

    <div class="card">

        <h1>📄 Identifikasi Ciri Tumbuhan</h1>

        <p class="subtitle">
            Pilih ciri-ciri tumbuhan untuk mengetahui jenisnya.
        </p>

        <!-- INFO BOX -->
        <div class="info-box">
            <h3>Panduan Pengisian:</h3>

            <ul>
                <li>Pilih ciri tumbuhan yang sesuai dengan tanaman yang diamati.</li>
                <li>Bentuk daun dapat berupa sejajar, menyirip, atau menjari.</li>
                <li>Jenis akar dapat berupa serabut atau tunggang.</li>
                <li>Jenis batang dapat berupa beruas, berkayu, atau lunak.</li>
                <li>Anda dapat memilih satu atau lebih ciri sesuai kondisi tumbuhan.</li>
            </ul>
        </div>

        <div id="customAlert" class="custom-alert">
            ⚠️ Silakan pilih minimal satu ciri tumbuhan terlebih dahulu.
        </div>

        <!-- FORM -->
        <form id="formKlasifikasi" action="{{ url('/klasifikasi/proses-teks') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="daun">Bentuk Daun</label>
                <select name="daun" id="daun">
                    <option value="">-- Pilih Bentuk Daun --</option>
                    <option value="daun sejajar">Sejajar</option>
                    <option value="daun menyirip">Menyirip</option>
                    <option value="daun menjari">Menjari</option>
                </select>
            </div>

            <div class="form-group">
                <label for="akar">Jenis Akar</label>
                <select name="akar" id="akar">
                    <option value="">-- Pilih Jenis Akar --</option>
                    <option value="akar serabut">Serabut</option>
                    <option value="akar tunggang">Tunggang</option>
                </select>
            </div>

            <div class="form-group">
                <label for="batang">Jenis Batang</label>
                <select name="batang" id="batang">
                    <option value="">-- Pilih Jenis Batang --</option>
                    <option value="batang beruas">Beruas</option>
                    <option value="batang berkayu">Berkayu</option>
                    <option value="batang lunak">Lunak</option>
                </select>
            </div>

            <!-- BUTTON AREA -->
            <div class="form-actions">

                <a href="{{ url('/klasifikasi') }}"
                   class="btn-back">
                    ← Kembali
                </a>

                <button type="submit"
                        class="submit-btn">
                    Identifikasi Ciri
                </button>

            </div>

        </form>

    </div>

    <script>
    document.getElementById('formKlasifikasi')
    .addEventListener('submit', function(e){

        const daun = document.getElementById('daun').value;
        const akar = document.getElementById('akar').value;
        const batang = document.getElementById('batang').value;

        const alertBox =
            document.getElementById('customAlert');

        if(!daun && !akar && !batang){

            e.preventDefault();

            alertBox.style.display = 'block';

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            return false;
        }

        alertBox.style.display = 'none';
    });
    </script>

</body>

</html>