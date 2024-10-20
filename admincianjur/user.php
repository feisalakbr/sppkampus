<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>DATA PENGGUNA</title>
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
            <h1>DATA PENGGUNA</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item text-primary">Data pengguna</div>
            </div>
          </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>LIST PENGGUNA</h4>
                    <div class="card-header-form">
                      <form>
                      <?php
// Inisialisasi variabel dengan nilai default kosong jika tidak ada pencarian
$s_keyword = isset($_GET['s_keyword']) ? $_GET['s_keyword'] : '';
?>
    <div class="input-group">
    <input type="text" placeholder="Cari" name="s_keyword" id="s_keyword" class="form-control" value="<?php echo $s_keyword; ?>">
      <div class="input-group-btn">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        <a href="tambah_user.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
      </div>
    
</div>
                      </form>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
                       <thead>
                          <tr>
                          <th>NO</th>
                          <th>NIM</th>
                          <th>NAMA</th>
                          <th>PASSWORD</th>
                          <th>PRODI</th>
                          <th>USERNAME</th>
                        </tr>
                        </thead>
                         <tbody>
                         <?php
// Mengambil nilai dari parameter GET untuk pencarian
$s_keyword = isset($_GET['s_keyword']) ? $_GET['s_keyword'] : '';

// Jalankan query untuk menampilkan data pengguna, dengan pencarian
$query = "SELECT * FROM mahasiswa"; // Dasar query

// Jika ada keyword, tambahkan kondisi pencarian
if (!empty($s_keyword)) {
    $s_keyword = mysqli_real_escape_string($koneksi, $s_keyword); // Amankan input dari SQL injection
    $query .= " WHERE nim LIKE '%$s_keyword%' 
                 OR password LIKE '%$s_keyword%' 
                 OR nama LIKE '%$s_keyword%' 
                 OR prodi LIKE '%$s_keyword%' 
                 OR username LIKE '%$s_keyword%'";
}

// Tambahkan urutan hasil
$query .= " ORDER BY id ASC";

// Eksekusi query
$result = mysqli_query($koneksi, $query);

// Mengecek apakah ada error ketika menjalankan query
if (!$result) {
    die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
}

// Buat perulangan untuk elemen tabel dari data pengguna
$no = 1; // Variabel untuk membuat nomor urut
// Hasil query akan disimpan dalam variabel $data dalam bentuk array
// Kemudian dicetak dengan perulangan while
while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $row['nim']; ?></td>
        <td><?php echo $row['nama']; ?></td>
        <td><?php echo $row['password']; ?></td>
        <td><?php echo $row['prodi']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td>
                          <a href="edit_user.php?id=<?php echo $row['id']; ?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                          <a href="proses_hapususer.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onClick="return confirm('Anda yakin akan menghapus data ini?')"><i class="fas fa-trash"></i></a>
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
        </section>
      </div>
    </div>
  </div>
</body>
</html>