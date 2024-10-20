<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link rel="icon" href="/sppiab/img/avatar/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa; /* Background lembut */
        }

        /* Sidebar Styles */
        .sidebar {
            height: 100vh;
            background-color: #007bff;
            padding: 15px;
            color: white;
            position: fixed;
            top: 0; /* Posisikan sidebar di atas */
            left: 0; /* Posisikan sidebar di kiri */
            width: 250px; /* Lebar sidebar */
            z-index: 1000; /* Agar sidebar tetap di depan konten lain */
             transition: top 0.5s ease;
        }

        .sidebar .nav-link {
            color: white;
            margin: 10px 0;
        }

        .sidebar .nav-link:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }

        /* Konten Utama */
        .content {
            padding: 20px;
            margin-left: 250px; /* Default margin untuk konten utama di layar besar */
            top: -100vh;
            transition: margin-top 0.5s ease; /* Animasi saat sidebar toggle */
        }

        /* Tombol untuk menampilkan sidebar */
        .menu-toggle {
            display: none; /* Sembunyikan tombol pada layar besar */
            position: fixed;
            top: 10px;
            left: 10px;
            background: white; /* Hapus latar belakang */
            border: blue; /* Hapus border */
            cursor: pointer; /* Tunjukkan pointer saat hover */
            z-index: 1001; /* Agar tombol toggle tetap di depan */
        }

        .menu-toggle .bar {
            display: block;
            width: 30px; /* Lebar garis */
            height: 3px; /* Tinggi garis */
            background-color: #007bff; /* Warna garis */
            margin: 5px auto; /* Jarak antar garis */
            transition: background-color 0.3s ease; /* Transisi warna saat hover */
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .sidebar {
                display: none; /* Sembunyikan sidebar di layar kecil secara default */
            }
            .menu-toggle {
                display: block; /* Tampilkan tombol pada layar kecil */
            }
            .content {
                margin-left: 0; /* Kembali ke margin default pada layar kecil */
            }
        }
    </style>
</head>
<body>

<!-- Tombol Menu Toggle -->
<button class="menu-toggle" onclick="toggleSidebar()">
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div>

    </div>
    <h4  style="padding-top: 35px;">Dashboard Mahasiswa</h4>
    <!-- <p><?php echo htmlspecialchars($nama); ?> (<?php echo htmlspecialchars($nim); ?>)</p> -->
    <!-- <p>Prodi: <?php echo htmlspecialchars($prodi); ?></p> -->

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="dashboard_mahasiswa.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="comingsoon.html">Upload Bukti</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="comingsoon.html">Riwayat Pembayaran</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php" style="color: red;">Logout</a>
        </li>
    </ul>
</div>


<!-- Bootstrap JS dan jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Script untuk toggle sidebar -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.querySelector('.content');

        if (sidebar.style.display === "none" || sidebar.style.display === "") {
            sidebar.style.display = "block"; // Tampilkan sidebar
            content.style.marginLeft = "250px"; // Atur margin konten saat sidebar terbuka
        } else {
            sidebar.style.display = "none"; // Sembunyikan sidebar
            content.style.marginLeft = "0"; // Kembali ke margin default
        }
    }
</script>

</body>
</html>
