<?php
include('koneksi.php'); // Koneksi ke database
include('tampilan/header.php');
include('tampilan/sidebar.php');
include('tampilan/footer.php');

// Menentukan status pencarian
$status = isset($_POST['status']) ? $_POST['status'] : 'all'; // Default ke 'all'

// Query untuk menghitung total siswa, lunas, dan belum lunas
$query = "
    SELECT 
        (SELECT COUNT(*) FROM siswa) AS total_siswa,
        (SELECT COUNT(DISTINCT nim) FROM pembayaran) AS total_lunas
";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
$totalSiswa = $data['total_siswa'];
$totalLunas = $data['total_lunas'];
$totalBelumLunas = $totalSiswa - $totalLunas;

// Query berdasarkan status
$siswaQuery = ""; // Inisialisasi variabel
if ($status == 'lunas') {
    $siswaQuery = "
        SELECT s.nim, s.nama, k.nama_kelas, 
               SUM(p.jumlah_bayar) AS jumlah_bayar, 
               GROUP_CONCAT(p.jenis_bayar SEPARATOR ', ') AS jenis_bayar
        FROM siswa s
        JOIN pembayaran p ON s.nim = p.nim
        JOIN kelas k ON s.id_kelas = k.id_kelas
        GROUP BY s.nim
    ";
} elseif ($status == 'belum') {
    $siswaQuery = "
        SELECT s.nim, s.nama, k.nama_kelas 
        FROM siswa s
        LEFT JOIN pembayaran p ON s.nim = p.nim
        JOIN kelas k ON s.id_kelas = k.id_kelas
        WHERE p.nim IS NULL
    ";
}

// Jalankan query jika status bukan 'all'
if ($status !== 'all') {
    $siswaResult = mysqli_query($koneksi, $siswaQuery);
}
?>

<!-- Main Content -->
<div class="main-content bg-primary">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">DATA MAHASISWA</div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $totalSiswa; ?></div>
                                <div class="card-stats-item-label">Mahasiswa</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $totalLunas; ?></div>
                                <div class="card-stats-item-label">Bayar</div>
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-count"><?php echo $totalBelumLunas; ?></div>
                                <div class="card-stats-item-label">Belum Bayar</div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .card .card-stats .card-stats-item .card-stats-item-label {
        font-size: 12px;
        letter-spacing: .0px;
        margin-top: 4px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap; }
                    </style>
                    <div class="card-icon shadow-info bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <!-- Form Pencarian -->
            <div class="table">
                
                    <div class="table">
                    <h4 class="text-white">Pencarian Status Pembayaran</h4>

                    
                    <div class="table">
                        <form method="post" action="">
                            <div class="form-group">
                                <label class="text-white"for="status">Pilih Status Pembayaran:</label>
                                <select name="status" id="status" class="form-control">
                                    <!-- <option value="all" <?php if($status == 'all') echo 'selected'; ?>>Reset</option> -->
                                    <option value="lunas" <?php if($status == 'lunas') echo 'selected'; ?>>Sudah Bayar</option>
                                    <option value="belum" <?php if($status == 'belum') echo 'selected'; ?>>Belum Bayar</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                    </div>
                </div>

                <!-- Tabel Siswa berdasarkan Pencarian -->
                <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $status != 'all'): ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Mahasiswa</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                    <th scope="col">NIM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Prodi</th>
                                        <?php if ($status == 'lunas'): ?>
                                            <th scope="col">Jumlah Bayar</th>
                                            <th scope="col">Jenis Bayar</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($siswaResult)): ?>
                                        <tr>
                                            <td><?php echo $row['nim']; ?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['nama_kelas']; ?></td>
                                            <?php if ($status == 'lunas'): ?>
                                                <td><?php echo number_format($row['jumlah_bayar'] ?? 0, 0, ',', '.'); ?></td>
                                                <td><?php echo $row['jenis_bayar'] ?? 'Belum Lunas'; ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

