<?php
// Memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

// Membuat variabel untuk menampung data dari form
$id = $_POST['id'];
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$password = $_POST['password'];
$prodi = $_POST['prodi'];
$username = $_POST['username']; // Tambahkan tanda titik koma (;) di akhir baris ini

// Jalankan query UPDATE berdasarkan ID
$query = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', password = '$password', prodi = '$prodi', username = '$username' WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

// Periksa apakah query berhasil dijalankan
if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
} else {
    // Tampilkan alert dan redirect ke halaman user.php
    echo "<script>alert('Data berhasil diubah.');window.location='user.php';</script>";
}
?>
