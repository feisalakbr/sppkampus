<?php
// Memulai session
session_start();

// Menghapus semua session
session_destroy();

// Redirect ke halaman login atau halaman utama
header("Location: index.php");
exit;
?>
