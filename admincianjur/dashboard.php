<?php
include('koneksi.php');
include('tampilan/header.php');
include('tampilan/sidebar_admin.php');
include('tampilan/footer.php');

$status = isset($_POST['status']) ? $_POST['status'] : 'all';

$query = "
    SELECT 
        (SELECT COUNT(*) FROM siswa) AS total_siswa,
        (SELECT COUNT(DISTINCT nim) FROM pembayaran) AS total_lunas
";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}

$data = mysqli_fetch_assoc($result);
$totalSiswa = $data['total_siswa'];
$totalLunas = $data['total_lunas'];
$totalBelumLunas = $totalSiswa - $totalLunas;

$siswaQuery = "";
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
        SELECT 
            s.nim, 
            s.nama, 
            k.nama_kelas,
            sp.jenis_bayar AS jenis_bayar,
            sp.nominal AS total_bayar,
            (sp.nominal - IFNULL(SUM(p.jumlah_bayar), 0)) AS sisa_pembayaran,
            GROUP_CONCAT(p.jenis_bayar SEPARATOR ', ') AS jenis_bayar_dibayar,
            IFNULL(SUM(p.jumlah_bayar), 0) AS total_dibayar
        FROM 
            siswa s
        JOIN 
            kelas k ON s.id_kelas = k.id_kelas
        JOIN 
            spp sp ON 1=1
        LEFT JOIN 
            pembayaran p ON s.nim = p.nim AND p.id_spp = sp.id_spp
        GROUP BY 
            s.nim, s.nama, k.nama_kelas, sp.jenis_bayar, sp.nominal
        HAVING 
            (sp.nominal - IFNULL(SUM(p.jumlah_bayar), 0)) > 0
            AND sp.jenis_bayar NOT IN (SELECT DISTINCT p.jenis_bayar FROM pembayaran p WHERE p.nim = s.nim);
    ";
}

if ($status !== 'all') {
    $siswaResult = mysqli_query($koneksi, $siswaQuery);
    
    if (!$siswaResult) {
        die("Query Error: " . mysqli_error($koneksi));
    }
}
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Data Mahasiswa</h5>
                        <div class="row">
                            <div class="col text-center">
                                <h6>Total Mahasiswa</h6>
                                <p class="fs-3"><?php echo $totalSiswa; ?></p>
                            </div>
                            <div class="col text-center">
                                <h6>Sudah Bayar</h6>
                                <p class="fs-3"><?php echo $totalLunas; ?></p>
                            </div>
                            <div class="col text-center">
                                <h6>Belum Bayar</h6>
                                <p class="fs-3"><?php echo $totalBelumLunas; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Pencarian -->
            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Pencarian Status Pembayaran</h4>
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="status" class="form-label">Pilih Status Pembayaran:</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="lunas" <?php if($status == 'lunas') echo 'selected'; ?>>Sudah Bayar</option>
                                    <option value="belum" <?php if($status == 'belum') echo 'selected'; ?>>Belum Bayar</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Siswa -->
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && $status != 'all'): ?>
        <div class="card mt-4">
            <div class="card-header">
                <h4>Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Prodi</th>
                                <?php if ($status == 'lunas'): ?>
                                    <th scope="col">Jumlah Bayar</th>
                                    <th scope="col">Jenis Bayar</th>
                                <?php elseif ($status == 'belum'): ?>
                                    <th scope="col">Yang Belum Dibayar</th>
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
                                <?php elseif ($status == 'belum'): ?>
                                    <td><?php echo number_format($row['sisa_pembayaran'] ?? 0, 0, ',', '.'); ?></td>
                                    <td><?php echo $row['jenis_bayar'] ?? 'Belum Dibayar'; ?></td>
                                <?php endif; ?>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </section>
</div>
