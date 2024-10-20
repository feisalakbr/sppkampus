<?php
// Memulai session
session_start();

// Menghapus semua session
session_destroy();

// Redirect ke halaman login atau halaman utama
header("Location: login_admin.php");
exit;
?>
