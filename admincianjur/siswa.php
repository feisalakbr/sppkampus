<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Data Siswa</title>
    <link rel="icon" href="/img/avatar/favicon.ico" type="image/x-icon">
  
  </head>
<body>

	<?php

  include ('tampilan/header.php');
  include ('tampilan/sidebar_admin.php');
  include ('tampilan/footer.php');
?>
  <!-- Main Content -->
      <div class="main-content bg-primary">
        <section class="section">
          <div class="section-header">
            <h1>DATA MAHASISWA</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></div>
              <div class="breadcrumb-item text-primary">Data Mahasiswa</div>
            </div>
          </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4>LIST MAHASISWA</h4>
                    <div class="card-header-form">
                      <form>
                          
                      <div class="card-header-form">
  <form method="POST" action="" class="form-inline">
    <!-- Search input untuk mencari di semua kolom -->
    <?php
// Inisialisasi variabel dengan nilai default kosong jika tidak ada pencarian
$s_keyword = isset($_GET['s_keyword']) ? $_GET['s_keyword'] : '';
?>
    <div class="input-group">
    <input type="text" placeholder="Cari" name="s_keyword" id="s_keyword" class="form-control" value="<?php echo $s_keyword; ?>">
      <div class="input-group-btn">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        <a href="tambah_siswa.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
      </div>
    </div>

    
    

   
  </form>
</div>
                      </form>
                    </div>
                  </div>
                  <div class="card-body p-0 ">
                  <div class="col-md-12">
                    <div class="table-responsive ">
                      <table class="table table-striped ">
                       <thead>
                          <tr>
                          <th>NO</th>
                          <th>NIM</th>
                          <!-- <th>NIS</th> -->
                          <th>NAMA</th>
                          <th>PRODI</th>
                          <th>ALAMAT</th>
                          <th>NO TELP</th>
                          <th>TAHUN MASUK</th>
                          <th>SMESTER</th>
                          
                           <th>ACTION</th>   
                        </tr>
                        </thead>
                         <tbody>
                         <?php
$s_keyword = isset($_GET['s_keyword']) ? $_GET['s_keyword'] : '';

// jalankan query untuk menampilkan data, dengan pencarian
$query = "SELECT siswa.*, kelas.nama_kelas 
          FROM siswa 
          INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas";

// jika ada keyword, tambahkan kondisi pencarian
if (!empty($s_keyword)) {
    $query .= " WHERE siswa.nim LIKE '%$s_keyword%' 
                OR siswa.nama LIKE '%$s_keyword%' 
                OR kelas.nama_kelas LIKE '%$s_keyword%' 
                OR siswa.alamat LIKE '%$s_keyword%' 
                OR siswa.no_telp LIKE '%$s_keyword%'
                OR siswa.tahun LIKE '%$s_keyword%'
                OR siswa.smt LIKE '%$s_keyword%' ";
               
}

$query .= " ORDER BY siswa.nim ASC";

$result = mysqli_query($koneksi, $query);
//mengecek apakah ada error ketika menjalankan query
if (!$result) {
    die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
}

//buat perulangan untuk element tabel dari data mahasiswa
$no = 1; //variabel untuk membuat nomor urut
// hasil query akan disimpan dalam variabel $data dalam bentuk array
// kemudian dicetak dengan perulangan while
while ($row = mysqli_fetch_assoc($result)) {
?>
                       
                       <tr>  
    <td><?php echo $no; ?></td>
    <td><?php echo $row['nim']; ?></td>
    <td><?php echo $row['nama']; ?></td>
    <td><?php echo $row['nama_kelas']; ?></td>  
    <td><?php echo $row['alamat']; ?></td>
    <td><?php echo $row['no_telp']; ?></td>
    <td><?php echo trim(substr($row['tahun'], 0, 50)); ?></td>
    <td><?php echo $row['smt']; ?></td>
    <td class="text-center">
        <!-- Action buttons -->
        <div class="btn-group">
            <a href="edit_siswa.php?id=<?php echo $row['nim']; ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i>
            </a>
            <a href="proses_hapussiswa.php?id=<?php echo $row['nim']; ?>" class="btn btn-danger btn-sm" onClick="return confirm('Anda yakin akan menghapus data ini?')">
                <i class="fas fa-trash"></i>
            </a>
  </div>
</td>
                        </tr>
                         <?php
                           $no++; //untuk nomor urut terus bertambah 1
                           }
                         ?>
                         </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        </section>
      </div>
</body>
</html>