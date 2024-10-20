<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include 'koneksi.php';

	// membuat variabel untuk menampung data dari form
  // $tahun   = $_POST['tahun'];
  $nominal     = $_POST['nominal'];
 $jenis_bayar     =$_POST['jenis_bayar'];


                  $query = "INSERT INTO spp VALUES ('','$nominal', '$jenis_bayar')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    //tampil alert dan akan redirect ke halaman index.php
                    //silahkan ganti index.php sesuai halaman yang akan dituju
                    echo "<script>alert('Data berhasil ditambah.');window.location='spp.php';</script>";
                  }

            ?>