<?php
include('koneksi.php'); // Menghubungkan dengan database
include('tampilan/header.php');
include('tampilan/sidebar.php');
include('tampilan/footer.php');

// Mengatur zona waktu ke Jakarta
date_default_timezone_set('Asia/Jakarta');

// Proses update status pembayaran
if (isset($_POST['update_status'])) {
    $id = $_POST['id'] ?? null;
    $nim = $_POST['nim'] ?? null; // Pastikan NIM dikirim dalam form
    $status = $_POST['status'] ?? 'pending'; // Default ke 'pending' jika tidak ada
    $komentar = $_POST['komentar'] ?? ''; // Default menjadi string kosong jika tidak ada

    // Update status pembayaran di tabel bukti_pembayaran
    $query = "UPDATE bukti_pembayaran SET status = '$status', komentar = '$komentar' WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    // Jika status 'diterima', perbarui status di tabel pembayaran juga
    if ($status == 'diterima') {
        $updatePembayaranQuery = "UPDATE pembayaran SET status = 'Lunas' WHERE nim = '$nim'";
        mysqli_query($koneksi, $updatePembayaranQuery);
    }

    if ($result) {
        echo "<div id='alert-success' class='alert alert-success'>Status pembayaran berhasil diperbarui!</div>";
    } else {
        echo "<div id='alert-danger' class='alert alert-danger'>Gagal memperbarui status pembayaran!</div>";
    }
}

// Hapus bukti pembayaran
if (isset($_POST['hapus_bukti'])) {
    $id = $_POST['id'] ?? null; // Cek jika id terdefinisi
    $deleteQuery = "DELETE FROM bukti_pembayaran WHERE id = '$id'";
    if (mysqli_query($koneksi, $deleteQuery)) {
        echo "<div id='alert-success' class='alert alert-success'>Bukti pembayaran berhasil dihapus!</div>";
    } else {
        echo "<div id='alert-danger' class='alert alert-danger'>Gagal menghapus bukti pembayaran!</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Bukti Pembayaran</title>
    <style>
        .alert {
            padding: 5px;
            font-size: 12px;
            width: 50%;
            margin: 10px auto;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .btn-sm {
            font-size: 12px;
        }

        .aksi-col {
            width: 300px; /* Lebar kolom aksi agar lebih lebar */
            text-align: center; /* Meratakan isi kolom */
        }

        .form-inline {
            display: flex;
            align-items: center; /* Vertikal sejajar */
            justify-content: center; /* Horizontal sejajar */
        }

        .form-inline .form-control {
            margin-right: 10px; /* Jarak antara dropdown dan tombol */
            min-width: 150px; /* Lebar minimum untuk dropdown */
        }

        .form-inline .btn {
            margin-left: 10px; /* Jarak antar tombol */
        }
    </style>
</head>
<body>

<div class="main-content bg-primary">
    <section class="section">
        <div class="section-header">
            <h1>Verifikasi Bukti Pembayaran SPP</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Bukti Pembayaran</h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Jenis Pembayaran</th>
                                    <th scope="col">Bukti Pembayaran</th>
                                    <th scope="col">Tanggal Upload</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
    // Ambil data bukti pembayaran dari database
    $query = "
        SELECT bp.id, bp.nim, bp.jenis_bayar, bp.bukti_bayar, bp.tanggal_upload, bp.status, s.nama 
        FROM bukti_pembayaran bp
        JOIN siswa s ON bp.nim = s.nim
        ORDER BY bp.tanggal_upload DESC
    ";
    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['nim']}</td>";
        echo "<td>{$row['nama']}</td>";
        echo "<td>{$row['jenis_bayar']}</td>";
        echo "<td><a href='uploads/{$row['bukti_bayar']}' target='_blank'>Lihat Bukti</a></td>";

        // Mengubah format tanggal upload dari UTC ke Jakarta
        $tanggalUpload = new DateTime($row['tanggal_upload'], new DateTimeZone('UTC')); // Waktu di UTC
        $tanggalUpload->setTimezone(new DateTimeZone('Asia/Jakarta')); // Ubah ke Jakarta
        echo "<td>" . $tanggalUpload->format('d-m-Y H:i:s') . "</td>"; // Format tanggal dan waktu
        
        echo "<td>{$row['status']}</td>";
        echo "<td class='aksi-col'>
            <div class='form-inline'>
                <!-- Form untuk Update Status -->
                <form method='POST' action='' class='d-inline'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <input type='hidden' name='nim' value='{$row['nim']}'>
                    <select name='status' class='form-control form-control-sm' required>
                        <option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option>
                        <option value='diterima' " . ($row['status'] == 'diterima' ? 'selected' : '') . ">Diterima</option>
                        <option value='ditolak' " . ($row['status'] == 'ditolak' ? 'selected' : '') . ">Ditolak</option>
                    </select>
                    <button type='submit' name='update_status' class='btn btn-primary btn-sm ml-2'>Update</button>
                    <button type='submit' name='hapus_bukti' class='btn btn-danger btn-sm ml-2'>Hapus</button>
                </form>
            </div>
        </td>";
        echo "</tr>";
    }
    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Menghilangkan alert setelah 3 detik
    setTimeout(function() {
        var successAlert = document.getElementById('alert-success');
        var dangerAlert = document.getElementById('alert-danger');
        if (successAlert) {
            successAlert.style.display = 'none';
        }
        if (dangerAlert) {
            dangerAlert.style.display = 'none';
        }
    }, 2000); // 2000 ms = 2 detik
</script>

</body>
</html>
