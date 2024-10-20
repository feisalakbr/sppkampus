<?php
include('koneksi.php'); // Menghubungkan ke database
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSAKSI</title>
    <link rel="icon" href="/img/avatar/favicon.ico" type="image/x-icon">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .main-content {
            padding: 20px;
        }

        .section-header {
            margin-bottom: 20px;
        }

        .section-header h1 {
            font-size: 2rem;
            color: #007bff;
        }

        .input-group-text {
            background-color: #007bff;
            color: white;
        }

        .card {
            margin-top: 20px;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        @media (max-width: 768px) {
            input[name="nim"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <?php
    include('tampilan/header.php');
    include('tampilan/footer.php');
    include('tampilan/sidebar_admin.php');
    ?>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>TRANSAKSI</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3>TRANSAKSI PEMBAYARAN</h3>
                        </div>
                        <div class="card-body">
                            <form action="proses_transaksi.php" method="post">
                                <!-- Dropdown Nama Petugas -->
                                <div class="mb-3">
                                    <label for="id_petugas" class="form-label">Nama Petugas</label>
                                    <select name="id_petugas" id="id_petugas" class="form-select" required>
                                        <option selected disabled>-- Pilih Petugas --</option>
                                        <?php
                                        // Query untuk mengambil data petugas dari tabel petugas
                                        $query_petugas = mysqli_query($koneksi, "SELECT id_petugas, nama_petugas FROM petugas");
                                        while ($row = mysqli_fetch_assoc($query_petugas)) {
                                            echo "<option value='{$row['id_petugas']}'>{$row['nama_petugas']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Input NIM -->
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" name="nim" id="nim" class="form-control" placeholder="NIM" required>
                                </div>

                                <!-- Input Tanggal Bayar -->
                                <div class="mb-3">
                                    <label for="tgl_bayar" class="form-label">Tanggal Bayar</label>
                                    <input type="date" name="tgl_bayar" id="tgl_bayar" class="form-control" required>
                                </div>

                                <!-- Dropdown Bulan Bayar -->
                                <div class="mb-3">
                                    <label for="bulan_dibayar" class="form-label">Bulan Bayar</label>
                                    <select class="form-select" name="bulan_dibayar" id="bulan_dibayar" required>
                                        <option selected disabled>-- Pilih Bulan --</option>
                                        <option value="januari">Januari</option>
                                        <option value="februari">Februari</option>
                                        <option value="maret">Maret</option>
                                        <option value="april">April</option>
                                        <option value="mei">Mei</option>
                                        <option value="juni">Juni</option>
                                        <option value="juli">Juli</option>
                                        <option value="agustus">Agustus</option>
                                        <option value="september">September</option>
                                        <option value="oktober">Oktober</option>
                                        <option value="november">November</option>
                                        <option value="desember">Desember</option>
                                    </select>
                                </div>

                                <!-- Dropdown Tahun Bayar -->
                                <div class="mb-3">
                                    <label for="tahun_dibayar" class="form-label">Tahun Bayar</label>
                                    <select class="form-select" name="tahun_dibayar" id="tahun_dibayar" required>
                                        <option selected disabled>-- Pilih Tahun --</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                </div>

                                <!-- Dropdown Jenis Pembayaran -->
                                <div class="mb-3">
                                    <label for="jenis_bayar" class="form-label">Jenis Pembayaran</label>
                                    <select name="jenis_bayar" id="jenis_bayar" class="form-select" required>
                                        <?php
                                        // Query untuk mengambil semua jenis pembayaran dari database
                                        $query = mysqli_query($koneksi, "SELECT * FROM spp");
                                        while ($data = mysqli_fetch_array($query)) {
                                            echo "<option value='{$data['jenis_bayar']}'>{$data['jenis_bayar']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Input Jumlah Bayar -->
                                <div class="mb-3">
                                    <label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
                                    <input type="text" name="jumlah_bayar" id="jumlah_bayar" class="form-control" placeholder="Jumlah Bayar" required>
                                </div>

                                <!-- Dropdown Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status" required>
                                        <option selected disabled>-- Pilih Status --</option>
                                        <option value="Lunas">Lunas</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success">Bayar</button>
                                </div>
                            </form>

                            <br/>

                            <form action="" method="get">
                                <h4>DATA BAYAR MAHASISWA SESUAI NIM</h4>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" name="nim" placeholder="Masukkan NIM" required>
                                    <button class="btn btn-success" type="submit" name="cari">Cari</button>
                                </div>
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
                                if ($data) {
                                    $nim = $data['nim'];
                            ?>

                            <h4>DATA MAHASISWA</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">NIM</th>
                                        <th scope="col">NAMA MAHASISWA</th>
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

                            <h4>DATA SPP MAHASISWA</h4>
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Petugas</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Tgl Bayar</th>
                                        <th scope="col">Bulan Bayar</th>
                                        <th scope="col">Tahun Bayar</th>
                                        <th scope="col">Jenis Pembayaran</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Status</th>
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

                                    while ($pembayaran = mysqli_fetch_array($query)) {
                                        echo "<tr>
                                                <td>{$pembayaran['nama_petugas']}</td>
                                                <td>{$pembayaran['nim']}</td>
                                                <td>{$pembayaran['tgl_bayar']}</td>
                                                <td>{$pembayaran['bulan_dibayar']}</td>
                                                <td>{$pembayaran['tahun_dibayar']}</td>
                                                <td>{$pembayaran['jenis_bayar']}</td>
                                                <td>{$pembayaran['jumlah_bayar']}</td>
                                                <td>{$pembayaran['status']}</td>
                                            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>  
                            <?php 
                                } else {
                                    echo "<p class='text-danger'>Data mahasiswa tidak ditemukan.</p>";
                                }
                            }
                            ?>      
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
