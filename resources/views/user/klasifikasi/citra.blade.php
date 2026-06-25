<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Klasifikasi Citra Daun</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="{{ asset('css/user/citra.css') }}">
</head>

<body>

<div class="container">

    <div class="card">

        <h1>🍃 Identifikasi Foto Daun</h1>

        <p class="subtitle">
            Unggah foto atau ambil langsung menggunakan kamera untuk mengenali jenis daun secara otomatis.
        </p>

        <!-- INFO -->
        <div class="info-box">
            <h3>Panduan Penggunaan:</h3>
                <ul>
                    <li>Gunakan foto daun yang jelas dan tidak blur</li>
                    <li>Pastikan satu daun terlihat penuh dalam gambar</li>
                    <li>Hindari latar belakang yang terlalu ramai agar hasil lebih akurat</li>
                    <li>Bisa unggah foto dari galeri atau langsung ambil foto dengan kamera</li>
                    <li>Format gambar yang didukung: JPG, JPEG, dan PNG</li>
                </ul>
        </div>

        <div id="customAlert" class="custom-alert">
            ⚠️ Silakan unggah gambar atau ambil foto terlebih dahulu.
        </div>

        <form action="{{ url('/klasifikasi/proses-citra') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- UPLOAD -->
            <div class="upload-box">
                <label class="upload-label">📁 Unggah Gambar</label>

                <input type="file"
                       name="gambar"
                       id="fileInput"
                       accept="image/*">

                <p class="upload-hint">
                    Pilih gambar dari perangkat kamu
                </p>
            </div>

            <!-- CAMERA -->
            <div class="upload-box">

                <label class="upload-label">📷 Ambil Foto dengan Kamera</label>

                <!-- CAMERA PREVIEW -->
                <div class="camera-preview">

                    <video id="camera"
                           autoplay
                           playsinline
                           style="display:none;"></video>

                    <img id="preview"
                         style="display:none;"
                         alt="preview">

                    <div id="previewPlaceholder" class="preview-placeholder">
                        Belum ada gambar
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="camera-buttons">

                    <button type="button"
                            id="cameraButton"
                            class="camera-btn"
                            onclick="handleCamera()">
                        Buka Kamera
                    </button>

                </div>

                <canvas id="canvas" style="display:none;"></canvas>

                <input type="hidden"
                       name="gambar_camera"
                       id="gambar_camera">

            </div>

            <!-- BUTTON AREA -->
            <div class="form-actions">

                <a href="/klasifikasi"
                   class="btn-back">
                    ← Kembali
                </a>

                <button type="submit"
                        class="submit-btn">
                    Deteksi Jenis Daun
                </button>

            </div>

        </form>

    </div>

</div>

<script>
const fileInput = document.getElementById('fileInput');
const cameraInput = document.getElementById('gambar_camera');
const cameraButton = document.getElementById('cameraButton');
const alertBox = document.getElementById('customAlert');

// 📁 Kalau user upload file
fileInput.addEventListener('change', function () {

    if (fileInput.files.length > 0) {

        // reset kamera
        cameraInput.value = "";

        // disable kamera
        cameraButton.disabled = true;
        cameraButton.style.opacity = "0.5";

    } else {

        // enable kamera lagi kalau file dihapus
        cameraButton.disabled = false;
        cameraButton.style.opacity = "1";
    }
});


// 📷 Kalau user pakai kamera (dipanggil setelah foto jadi)
function setCameraImage(base64Image) {

    cameraInput.value = base64Image;

    // reset file upload
    fileInput.value = "";

    // disable upload visual (optional)
    fileInput.disabled = true;
}

// 📷 buka kamera (punyamu sudah ada, tinggal pastikan ini dipanggil)
function handleCamera() {

    if (fileInput.files.length > 0) {

        alert("⚠️ Kamu sudah upload gambar. Hapus upload dulu kalau mau pakai kamera.");
        return;
    }

    // lanjut logic kamera kamu
}
</script>

<script>

let stream = null;
let cameraOpened = false;
let photoTaken = false;

function handleCamera() {

    const button = document.getElementById('cameraButton');
    const video = document.getElementById('camera');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('previewPlaceholder');

    // =========================
    // 1. OPEN CAMERA
    // =========================
    if (!cameraOpened) {

        navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: "environment"
            },
            audio: false
        })
        .then(function(mediaStream) {

            stream = mediaStream;
            video.srcObject = stream;

            video.style.display = 'block';
            placeholder.style.display = 'none';

            cameraOpened = true;

            button.innerHTML = '📸 Ambil Foto';
        })
        .catch(function(error) {

            console.log(error);

            alert('Kamera gagal diakses: ' + error.name +
                  '\nPastikan pakai HTTPS / localhost dan izin kamera sudah diaktifkan.');
        });

        return;
    }

    // =========================
    // 2. TAKE PHOTO
    // =========================
    if (cameraOpened && !photoTaken) {

        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        ctx.drawImage(video, 0, 0);

        const imageData = canvas.toDataURL('image/png');

        document.getElementById('gambar_camera').value = imageData;

        preview.src = imageData;
        preview.style.display = 'block';

        video.style.display = 'none';

        stream.getTracks().forEach(track => track.stop());

        photoTaken = true;

        button.innerHTML = '🔄 Foto Ulang';

        return;
    }

    // =========================
    // 3. RESET
    // =========================
    if (photoTaken) {

        preview.style.display = 'none';
        placeholder.style.display = 'block';

        cameraOpened = false;
        photoTaken = false;

        button.innerHTML = '📷 Ambil Foto';

        handleCamera();
    }
}
</script>

<!-- form kamu di atas -->
</form>

<script>
    const fileInput = document.querySelector('input[name="gambar"]');
    const cameraInput = document.querySelector('input[name="gambar_camera"]');

    fileInput.onchange = () => {
        cameraInput.value = "";
    };

    cameraInput.oninput = () => {
        fileInput.value = "";
    };
</script>

</body>
</html>