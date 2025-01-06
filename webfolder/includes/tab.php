<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tab</title>
    <style>
     .tab {
    display: flex;
    justify-content: center;
    position: fixed; /* Tetap berada di posisi tetap */
    bottom: 60px; /* Jarak dari tepi bawah */
    left: 0; /* Mulai dari sisi kiri */
    right: 0; /* Sampai ke sisi kanan */
    background: white; /* Tambahkan background putih */
    border-radius: 10px; /* Membuat sudut melengkung */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan di atas elemen */
    padding: 9px 0.05px; /* Tambahkan padding untuk jarak dalam tab */
    width: fit-content; /* Menyesuaikan lebar dengan konten */
    margin-left: auto; /* Posisi tengah secara horizontal */
    margin-right: auto; /* Posisi tengah secara horizontal */
    outline: 2px solid #E6E6E6; /* Tambahkan outline */
    z-index: 1000; /* Pastikan tab selalu di atas elemen lain */
    
}


        .tab button {
            margin: 0 10px;
            padding: 3px 20px;
            font-size: 14px;
            border: 1.5px solid black;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family:"Plus Jakarta Sans", sans-serif;
            font-weight: 200;
        }

        .tab button.active {
            background-color: black;
            color: white;
        }

        .tab button:focus {
            outline: none;  /* Hapus outline default saat tab dipilih */
        }

        /* Hover hanya untuk tombol yang tidak aktif */
        .tab button:not(.active):hover {
        background-color: #E6E6E6; /* Warna abu-abu saat hover */
        }
    </style>
</head>
<body>

    <div class="tab">
        <!-- Menambahkan fungsi untuk mengarahkan ke dashboard.php saat ditekan -->
        <button id="consultationHistoryTab" onclick="setActiveTab(event, 'consultationHistory'); navigateToDashboard()">Consultation History</button>
        <button id="myDeviceTab" onclick="setActiveTab(event, 'myDevice'); navigateToDevice()">My Device</button>
        <button id="profileTab" onclick="setActiveTab(event, 'profile'); navigateToProfile()">Profile</button>
    </div>

    <script>
    // Fungsi untuk mengubah status tab yang aktif
    function setActiveTab(event, tabName) {
        // Mengambil semua tombol tab
        const tabs = document.querySelectorAll('.tab button');

        // Menghapus kelas 'active' dari semua tab
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });

        // Menambahkan kelas 'active' pada tab yang diklik
        event.target.classList.add('active');
        
        // Menyimpan tab yang dipilih di localStorage
        localStorage.setItem('activeTab', tabName);
        
        // Optional: Anda bisa menambahkan logika untuk menampilkan konten terkait tab yang dipilih
        console.log(tabName + " tab is selected");
    }

    // Fungsi untuk mengarahkan ke halaman Dashboard
    function navigateToDashboard() {
        window.location.href = 'dashboard.php';  // Menggunakan JavaScript untuk navigasi
    }

    // Fungsi untuk mengarahkan ke halaman My Device
    function navigateToDevice() {
        window.location.href = 'mydevice.php';  // Menggunakan JavaScript untuk navigasi
    }

    // Fungsi untuk mengarahkan ke halaman Profile
    function navigateToProfile() {
        window.location.href = 'profil.php';  // Menggunakan JavaScript untuk navigasi
    }

    // Menyimpan status tab aktif saat halaman pertama kali dimuat
    window.onload = function() {
        const activeTab = localStorage.getItem('activeTab');

        // Cek jika halaman yang sedang dibuka adalah dashboard.php
        if (window.location.pathname.includes('dashboard.php')) {
            // Aktifkan tab Consultation History
            document.getElementById('consultationHistoryTab').classList.add('active');
        }
        // Jika ada tab yang disimpan di localStorage, aktifkan tab tersebut
        else if (activeTab) {
            const activeButton = document.getElementById(activeTab + 'Tab');
            if (activeButton) {
                activeButton.classList.add('active');
            }
        } else {
            // Jika tidak ada tab yang disimpan, aktifkan tab pertama (Consultation History)
            document.getElementById('consultationHistoryTab').classList.add('active');
        }
    }
</script>

</body>
</html>
