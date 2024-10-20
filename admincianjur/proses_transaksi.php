<?php
include('koneksi.php');
// membuat variabel untuk menampung data dari form
  $id_petugas    = $_POST['id_petugas'];
  $nim           = $_POST['nim'];
  $tgl_bayar     = $_POST['tgl_bayar'];
  $bulan_dibayar = $_POST['bulan_dibayar'];
  $tahun_dibayar = $_POST['tahun_dibayar'];
  $jenis_bayar        = isset($_POST['jenis_bayar']) ? $_POST['jenis_bayar'] : null;
  $jumlah_bayar  = $_POST['jumlah_bayar'];
  $status           =$_POST['status'];

  // Mengecek apakah id_spp ada di tabel siswa
  $cek_spp = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nim = '$nim'");
  if (mysqli_num_rows($cek_spp) == 0) {
      die("Error: id_spp tidak valid, tidak ditemukan di tabel siswa.");
  }

  // Query untuk memasukkan data pembayaran
  $query = "INSERT INTO pembayaran (id_petugas, nim, tgl_bayar, bulan_dibayar, tahun_dibayar, jenis_bayar, jumlah_bayar, status) 
            VALUES ('$id_petugas', '$nim', '$tgl_bayar', '$bulan_dibayar', '$tahun_dibayar', '$jenis_bayar', '$jumlah_bayar', '$status')";
  
  $result = mysqli_query($koneksi, $query);

  // periksa query apakah ada error
  if(!$result){
      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
  } else {
      echo "<script>alert('Data berhasil ditambah.');window.location='transaksi.php';</script>";
  }
?>