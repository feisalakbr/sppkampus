<?php
session_start();
include('koneksi.php'); // Hubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_nim = $_POST['username_nim'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah username atau NIM ada di database
    $stmt = $koneksi->prepare("SELECT * FROM mahasiswa WHERE (username = ? OR nim = ?) AND password = ?");
    $stmt->bind_param("sss", $username_nim, $username_nim, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika ada, ambil data mahasiswa
        $data = $result->fetch_assoc();
        
        // Simpan data ke session
        $_SESSION['nim'] = $data['nim'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['prodi'] = $data['prodi'];
        
        // Redirect ke dashboard
        header("Location: dashboard_mahasiswa.php");
        exit();
    } else {
        // Jika tidak ada, redirect kembali dengan pesan error
        header("Location: index.php?pesan=gagal");
        exit();
    }
} else {
    // Redirect jika tidak menggunakan POST
    header("Location: index.php?pesan=belummasuk");
    exit();
}
