<?php
// Memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

// Memeriksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Membuat variabel untuk menampung data dari form
    $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $prodi = isset($_POST['prodi']) ? $_POST['prodi'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    // Validasi input untuk memastikan tidak ada yang kosong
    if (empty($nim) || empty($nama) || empty($password) || empty($prodi) || empty($username)) {
        die("Semua field harus diisi.");
    }

    // Query untuk menyimpan data ke tabel mahasiswa
    $query = "INSERT INTO mahasiswa (nim, nama, password, prodi, username) VALUES ('$nim', '$nama', '$password', '$prodi', '$username')";
    $result = mysqli_query($koneksi, $query);

    // Periksa query apakah ada error
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
        // Tampilkan alert dan redirect ke halaman user.php
        echo "<script>alert('Data berhasil ditambah.');window.location='user.php';</script>";
    }
} else {
    die("Tidak ada data yang dikirim.");
}
?>
