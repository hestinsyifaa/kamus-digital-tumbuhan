<div class="sidebar">

    <!-- LOGO -->
    <div class="logo">
        Dashboard Admin
    </div>

    <!-- MENU -->
    <ul class="menu">

        <li>
            <a href="/admin/dashboard"
               class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                Beranda
            </a>
        </li>

        <li>
            <a href="/admin/tumbuhan"
               class="{{ request()->is('admin/tumbuhan*') ? 'active' : '' }}">
                Data Tumbuhan
            </a>
        </li>

        <li>
            <a href="/admin/klasifikasi"
               class="{{ request()->is('admin/klasifikasi*') ? 'active' : '' }}">
                Hasil Identifikasi
            </a>
        </li>

        <li>
            <a href="/admin/validasi"
               class="{{ request()->is('admin/validasi*') ? 'active' : '' }}">
                Validasi Hasil
            </a>
        </li>

        {{-- <li>
            <a href="/admin/models"
               class="{{ request()->is('admin/models*') ? 'active' : '' }}">
                Models AI
            </a>
        </li>

        <li>
            <a href="/admin/log"
               class="{{ request()->is('admin/log*') ? 'active' : '' }}">
                Log Aktivitas
            </a>
        </li> --}}

        <li>
            <a href="#"
               onclick="confirmLogout()">
                Keluar
            </a>
        </li>

    </ul>

</div>

<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function confirmLogout(){

        Swal.fire({

            title: 'Keluar?',
            text: 'Yakin ingin keluar dari sistem?',
            icon: 'question',

            showCancelButton: true,
            focusCancel: true,

            confirmButtonColor: '#2e7d32',
            cancelButtonColor: '#6b7280',

            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal'

        }).then((result) => {

            if(result.isConfirmed){

                window.location.href = "/logout";

            }

        });

    }

</script>