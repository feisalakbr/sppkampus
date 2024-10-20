<?php
session_start();
include 'koneksi.php'; // Masukkan file koneksi ke database

$username_nidn = $_POST['username_nim'];
$password = $_POST['password'];

// Query untuk cek apakah dosen terdaftar dengan username/nim dan password yang sesuai
$query = mysqli_query($koneksi, "SELECT * FROM dosen WHERE username_nidn='$username_nim' AND password='$password'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    // Jika username/nim dan password cocok, buat session
    $_SESSION['username_nim'] = $username_nim;
    $_SESSION['status'] = "login";
    
    // Redirect ke halaman dashboard atau halaman lain setelah login
    header("location:dashboard.php");
} else {
    // Jika login gagal, kembali ke halaman login dengan pesan error
    header("location:login.php?pesan=gagal");
}
?>
