<?php
include 'koneksi.php';

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=data-transaksi.doc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Kwitansi Pembayaran SPP Institut Agama Islam Bogor</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST['daritanggal'])) {
        $daritanggal = $_POST['daritanggal'];
        $sampaitanggal = $_POST['sampaitanggal'];

        echo "<p align='center'>DATA TRANSAKSI PEMBAYARAN SPP</p>";
        echo "<p align='center'>INSTITUT AGAMA ISLAM BOGOR</p>";
        echo "<p align='center'>DARI TANGGAL $daritanggal SAMPAI TANGGAL $sampaitanggal</p>";
        echo "<p>&nbsp;</p>";

        // Query untuk mengambil data transaksi berdasarkan tanggal
        $query = "
            SELECT pembayaran.*, siswa.nama, kelas.nama_kelas, petugas.nama_petugas 
            FROM pembayaran 
            JOIN siswa ON pembayaran.nim = siswa.nim 
            JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
            JOIN kelas ON siswa.id_kelas = kelas.id_kelas  -- Join dengan tabel kelas
            WHERE pembayaran.tgl_bayar BETWEEN '$daritanggal' AND '$sampaitanggal'
            ORDER BY pembayaran.tgl_bayar ASC
        ";

        $result = mysqli_query($koneksi, $query);

        if (!$result) {
            die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
        }
    ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">NIM</th>
                    <th scope="col">NAMA MAHASISWA</th>
                    <th scope="col">PRODI</th>
                    <th scope="col">JENIS BAYAR</th>
                    <th scope="col">PETUGAS</th>
                    <th scope="col">TGL BAYAR</th>
                    <th scope="col">JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Perulangan untuk menampilkan data transaksi
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$data['nim']}</td>
                        <td>{$data['nama']}</td>
                        <td>{$data['nama_kelas']}</td> <!-- Ambil nama kelas dari tabel kelas -->
                        <td>{$data['jenis_bayar']}</td>
                        <td>{$data['nama_petugas']}</td>
                        <td>{$data['tgl_bayar']}</td>
                        <td>{$data['jumlah_bayar']}</td> <!-- perbaiki 'jumlah bayar' menjadi 'jumlah_bayar' -->
                    </tr>";
                }
                ?>
            </tbody>
        </table>

    <?php
    } else {
        echo "<p>Tanggal tidak ditentukan.</p>";
    }
    ?>
</body>
</html>
