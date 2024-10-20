<?php
session_start();
if (!isset($_SESSION['username_nidn'])) {
    header("location:login.php?pesan=belummasuk");
    exit();
}

// Ambil data dosen dari session atau database
$username_nim = $_SESSION['username_nidn'];
// Di sini Anda dapat menambahkan kode untuk mengambil data dosen dari database jika diperlukan

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard Dosen &mdash; Sistem Akademik</title>
    <link rel="icon" href="/img/avatar/favicon.ico" type="image/x-icon">
    
    <!-- General CSS Files -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.css">
    
    <!-- Template CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="#" class="navbar-brand">Sistem Akademik</a>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a href="dashboard.php" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="data_mata_kuliah.php" class="nav-link">Data Mata Kuliah</a>
                        </li>
                        <li class="nav-item">
                            <a href="nilai.php" class="nav-link">Input Nilai</a>
                        </li>
                        <li class="nav-item">
                            <a href="jadwal.php" class="nav-link">Jadwal Kuliah</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-right">
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container mt-4">
                <h2>Selamat Datang, <?php echo $username_nim; ?>!</h2>
                <p>Ini adalah dashboard Anda. Silakan pilih menu di atas untuk mengakses fitur yang Anda perlukan.</p>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Informasi Dosen</h4>
                    </div>
                    <div class="card-body">
                        <!-- Anda dapat menambahkan informasi dosen di sini -->
                        <p>Nama: [Nama Dosen]</p>
                        <p>Email: [Email Dosen]</p>
                        <!-- Anda juga dapat menampilkan data lain sesuai kebutuhan -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="bootstrap/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="bootstrap/jquery.nicescroll.min.js"></script>
    <script src="bootstrap/scripts.js"></script>
</body>
</html>
