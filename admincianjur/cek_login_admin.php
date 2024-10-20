<?php 
// mengaktifkan session pada php
session_start();

// Koneksi ke database
include 'koneksi.php'; 

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk menyeleksi petugas/admin
$login_petugas = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");



// menghitung jumlah data yang ditemukan
$cek_petugas = mysqli_num_rows($login_petugas);


// cek apakah username dan password ditemukan pada salah satu tabel
if($cek_petugas > 0) {

    // Mengambil data dari tabel petugas
    $data = mysqli_fetch_assoc($login_petugas);

    // cek jika user login sebagai admin
    if($data['level'] == "admin") {
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";
        // alihkan ke halaman dashboard admin
        header("location:dashboard.php");

    // cek jika user login sebagai petugas
    } else if($data['level'] == "petugas") {
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "petugas";
        // alihkan ke halaman dashboard petugas
        header("location:dashboard.php");

    } else {
        // alihkan ke halaman login kembali jika level tidak sesuai
        header("location:login_admin.php?pesan=gagal");
    }



} else {
    // alihkan ke halaman login kembali jika username atau password salah
    header("location:login_admin.php?pesan=gagal");
}


