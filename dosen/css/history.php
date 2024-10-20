<?php
include('koneksi.php'); // Menghubungkan dengan database

// Variabel untuk menyimpan pesan alert
$alertMessage = '';
$alertType = '';

if (isset($_POST['upload'])) {
    $nim = $_POST['nim'];
    $buktiBayar = $_FILES['bukti_bayar']['name'];
    $tmpName = $_FILES['bukti_bayar']['tmp_name'];
    $fileSize = $_FILES['bukti_bayar']['size'];
    $fileType = $_FILES['bukti_bayar']['type'];

    // Maksimal ukuran file 1 MB (1048576 bytes)
    $maxSize = 1048576; // 1MB

    // Direktori tempat menyimpan bukti pembayaran
    $uploadDir = "uploads/";
    $uploadFile = $uploadDir . basename($buktiBayar);

    // Validasi tipe file (hanya JPG dan PNG)
    $allowedTypes = ['image/jpeg', 'image/png'];

    // Cek tipe file dan ukuran file
    if (in_array($fileType, $allowedTypes)) {
        if ($fileSize <= $maxSize) {
            // Memindahkan file yang diupload ke folder 'uploads'
            if (move_uploaded_file($tmpName, $uploadFile)) {
                // Simpan informasi bukti pembayaran ke database
                $query = "INSERT INTO bukti_pembayaran (nim, bukti_bayar) VALUES ('$nim', '$buktiBayar')";
                $result = mysqli_query($koneksi, $query);

                if ($result) {
                    $alertMessage = "Bukti pembayaran berhasil diunggah!";
                    $alertType = "success"; // Jenis alert berhasil
                } else {
                    $alertMessage = "Nim tidak terdaftar.";
                    $alertType = "danger"; // Jenis alert gagal
                }
            } else {
                $alertMessage = "Gagal mengunggah bukti pembayaran.";
                $alertType = "danger"; // Jenis alert gagal
            }
        } else {
            $alertMessage = "Ukuran file terlalu besar. Maksimal 1MB.";
            $alertType = "danger"; // Jenis alert gagal
        }
    } else {
        $alertMessage = "Format file tidak didukung. Hanya JPG atau PNG yang diperbolehkan.";
        $alertType = "danger"; // Jenis alert gagal
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSAKSI</title>
    <link rel="icon" href="/sppiab/img/avatar/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .alert {
            font-size: 0.9rem; /* Mengubah ukuran font alert */
            position: absolute; /* Mengatur posisi */
            top: 20px; /* Jarak dari atas */
            left: 50%; /* Mengatur posisi horizontal ke tengah */
            transform: translateX(-50%); /* Menyelaraskan posisi ke tengah */
            z-index: 1000; /* Membawa alert ke depan */
        }
    </style>
</head>
<body>

<?php
include('tampilan/header.php');
include('tampilan/footer.php');
include('tampilan/sidebar.php');
?>

<!-- main content -->
<div class="main-content bg-primary">
    <section class="section">
        <div class="section-header">
            <h1>Upload Bukti Pembayaran</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Upload Bukti Pembayaran SPP</h4>
                    </div>

                    <div class="card-body">
                        <!-- Menampilkan alert jika ada pesan -->
                        <?php if ($alertMessage): ?>
                            <div class="alert alert-<?= $alertType; ?> alert-dismissible fade show" role="alert">
                                <?= $alertMessage; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <!-- Form Upload -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control" name="nim" placeholder="Masukkan NIM" required>
                            </div>

                            <div class="form-group">
                                <label for="bukti_bayar">Upload Bukti Pembayaran (JPG/PNG maks. 1MB)</label>
                                <input type="file" class="form-control" name="bukti_bayar" accept="image/jpeg, image/png" required>
                            </div>

                            <button type="submit" name="upload" class="btn btn-primary">Upload Bukti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <h1>HISTORY</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="history.php">History</a></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>History Pembayaran</h4>
                    </div>
                    <form action="" method="get">
                        <table class="table">
                            <tr>
                                <td>NIM</td>
                                <td>:</td>
                                <td>
                                    <input class="form-control" type="text" name="nim" placeholder="--Masukan NIM--">
                                </td>
                                <td>
                                    <button class="btn btn-success" type="submit" name="cari">Cari</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php 
                    if (isset($_GET['nim']) && $_GET['nim'] != '') {
                        // Query untuk mendapatkan data siswa beserta nama kelas
                        $query = mysqli_query($koneksi, "
                            SELECT siswa.nim, siswa.nama, kelas.nama_kelas 
                            FROM siswa 
                            JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                            WHERE siswa.nim = '$_GET[nim]'
                        ");
                        
                        // Ambil data hasil query
                        $data = mysqli_fetch_array($query);
                        $nisn = $data['nim'];
                    ?>

                    <h4>DATA MAHASISWA</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">NIM</th>
                                    <th scope="col">NAMA SISWA</th>
                                    <th scope="col">PRODI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $data['nim']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['nama_kelas']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h4>DATA SPP MAHASISWA</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead> 
                                <tr>
                                    <th scope="col">Nama Petugas</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Tgl Bayar</th>
                                    <th scope="col">Tahun Bayar</th>
                                    <th scope="col">Jenis Pembayaran</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = mysqli_query($koneksi, "
                                SELECT pembayaran.*, petugas.nama_petugas 
                                FROM pembayaran 
                                JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
                                WHERE pembayaran.nim = '$data[nim]' 
                                ORDER BY pembayaran.bulan_dibayar ASC
                                ");
                                
                                while ($data = mysqli_fetch_array($query)) {
                                    echo "<tr>
                                            <td>$data[nama_petugas]</td>
                                            <td>$data[nim]</td>
                                            <td>$data[tgl_bayar]</td>
                                            <td>$data[tahun_dibayar]</td>
                                            <td>$data[jenis_bayar]</td>
                                            <td>$data[jumlah_bayar]</td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                        
                    <?php 
                    }
                    ?>
