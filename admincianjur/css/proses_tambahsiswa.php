<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';


  // membuat variabel untuk menampung data dari form
  // $nisn      = $_POST['nisn'];
  $nim       = isset($_POST['nim']) ? $_POST['nim'] : null;
  $nama      = $_POST['nama'];
  $id_kelas  = $_POST['id_kelas'];
  $alamat    = $_POST['alamat'];
  $telp      = $_POST['no_telp'];
  $smt = isset($_POST['smt']) ? $_POST['smt'] : null;
 $tahun    = isset($_POST['tahun']) ? $_POST['tahun'] : null;
  

  // Cek apakah id_spp ada di tabel spp
  // $cek_spp = mysqli_query($koneksi, "SELECT * FROM spp WHERE id_spp = '$id_spp'");
  // if (mysqli_num_rows($cek_spp) == 0) {
      // die("Error: id_spp tidak valid, tidak ditemukan di tabel spp.");
  // }

  // Query untuk memasukkan data ke tabel siswa
  $query = 
          "INSERT INTO `siswa`(`nim`, `nama`, `id_kelas`, `alamat`, `no_telp`, `tahun`, `smt`) VALUES ('$nim','$nama','$id_kelas','$alamat','$telp','$tahun','$smt')";
echo $query; // Menampilkan query
$result = mysqli_query($koneksi, $query);

  // periksa apakah query berhasil dijalankan
  if (!$result) {
      die("Query gagal dijalankan: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
  } else {
      echo "<script>alert('Data berhasil ditambah.');window.location='siswa.php';</script>";
  }
?>



          