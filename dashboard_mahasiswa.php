<?php
session_start();
include('koneksi.php');

// Cek apakah user sudah login
if (!isset($_SESSION['nim'])) {
    header("Location: index.php?pesan=belummasuk");
    exit();
}

// Tampilkan data mahasiswa dari session
$nim = $_SESSION['nim'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];

// Variabel untuk menyimpan pesan alert
$alertMessage = '';
$alertType = '';

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $alertMessage = "Bukti pembayaran berhasil diunggah!";
            $alertType = "success";
            break;
        case 'error':
            $alertMessage = "Gagal menyimpan bukti pembayaran.";
            $alertType = "danger";
            break;
        case 'filesize':
            $alertMessage = "Ukuran file terlalu besar. Maksimal 1MB.";
            $alertType = "danger";
            break;
        case 'filetype':
            $alertMessage = "Format file tidak didukung. Hanya JPG atau PNG yang diperbolehkan.";
            $alertType = "danger";
            break;
        case 'uploadfail':
            $alertMessage = "Gagal mengunggah bukti pembayaran.";
            $alertType = "danger";
            break;
    }
}

if (isset($_POST['upload'])) {
    $jenisBayar = $_POST['jenis_bayar'];
    $buktiBayar = $_FILES['bukti_bayar']['name'];
    $tmpName = $_FILES['bukti_bayar']['tmp_name'];
    $fileSize = $_FILES['bukti_bayar']['size'];
    $fileType = $_FILES['bukti_bayar']['type'];
    
    $maxSize = 1048576; // 1MB
    $uploadDir = "uploads/";
    $uploadFile = $uploadDir . basename($buktiBayar);
    $allowedTypes = ['image/jpeg', 'image/png'];

    if (in_array($fileType, $allowedTypes)) {
        if ($fileSize <= $maxSize) {
            if (move_uploaded_file($tmpName, $uploadFile)) {
                $stmt = $koneksi->prepare("INSERT INTO bukti_pembayaran (nim, bukti_bayar, jenis_bayar) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nim, $buktiBayar, $jenisBayar);

                if ($stmt->execute()) {
                    header("Location: dashboard_mahasiswa.php?status=success");
                    exit();
                } else {
                    header("Location: dashboard_mahasiswa.php?status=error");
                    exit();
                }
            } else {
                header("Location: dashboard_mahasiswa.php?status=uploadfail");
                exit();
            }
        } else {
            header("Location: dashboard_mahasiswa.php?status=filesize");
            exit();
        }
    } else {
        header("Location: dashboard_mahasiswa.php?status=filetype");
        exit();
    }
}
?>
<?php include('tamp/sidebar.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link rel="icon" href="/sppiab/img/avatar/favicon.ico" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: #007bff;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: 600;
        }
        .container {
            max-width: 900px;
        }
        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: auto;
            max-width: 500px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 1.5rem;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
        .table {
            margin-top: 2rem;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 123, 255, 0.05);
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }
        h2, p {
            font-weight: 400;
        }
    </style>

    <script>
        function hideAlert() {
            const alert = document.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 2000);
            }
        }
        document.addEventListener("DOMContentLoaded", hideAlert);
    </script>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Selamat datang, <?php echo htmlspecialchars($nama); ?></h2>
    <p class="text-center">NIM: <?php echo htmlspecialchars($nim); ?></p>
    <p class="text-center">Program Studi: <?php echo htmlspecialchars($prodi); ?></p>

    <?php if (!empty($alertMessage)): ?>
        <div class="alert alert-<?= htmlspecialchars($alertType); ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($alertMessage); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Form Upload Bukti Pembayaran</h5>
        </div>
        <form action="" method="POST" enctype="multipart/form-data" class="p-3">
            <div class="form-group mb-3">
                <label for="jenis_bayar">Jenis Pembayaran</label>
                <select name="jenis_bayar" class="form-select" required>
                    <option value="" disabled selected>Pilih Jenis Pembayaran</option>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM spp");
                    while ($data = mysqli_fetch_array($query)) {
                        echo "<option value='" . htmlspecialchars($data['jenis_bayar']) . "'>" . htmlspecialchars($data['jenis_bayar']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="bukti_bayar">Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_bayar" class="form-control" required>
            </div>
            <button type="submit" name="upload" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <div class="table-responsive">
        <h6 class="text-center" style="font-size: 14px;">Riwayat Pembayaran</h6>
        <table class="table table-striped table-hover text-center" style="width: 80%; margin: auto;">
            <thead>
                <tr>
                    <th scope="col">Tgl Bayar</th>
                    <th scope="col">Jenis Pembayaran</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Status</th>
                </tr>
                <style>
                    .table th, table td {
                        white-space: nowrap;
                    }
                    </style>
            </thead>
            <tbody>
                <?php 
                $query = mysqli_query($koneksi, "
                    SELECT pembayaran.*, petugas.nama_petugas 
                    FROM pembayaran 
                    JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
                    WHERE pembayaran.nim = '$nim' 
                    ORDER BY pembayaran.tgl_bayar ASC
                ");

                if ($query === false) {
                    echo "<tr><td colspan='4'>Error dalam query: " . mysqli_error($koneksi) . "</td></tr>";
                } else {
                    while ($data = mysqli_fetch_array($query)) {
                        echo "<tr>
                                <td>" . date('d-M-Y', strtotime($data['tgl_bayar'])) . "</td>
                                <td>" . htmlspecialchars($data['jenis_bayar']) . "</td>
                                <td>" . htmlspecialchars($data['jumlah_bayar']) . "</td>
                                <td>" . (isset($data['status']) ? htmlspecialchars($data['status']) : 'Status tidak tersedia') . "</td>
                            </tr>";
                    }
                } 
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
