<?php
  // Memanggil file koneksi.php untuk membuat koneksi
  include 'koneksi.php';

  // Mengecek apakah di URL ada nilai GET id
  if (isset($_GET['id'])) {
      // Ambil nilai id dari URL dan simpan dalam variabel $id
      $id = $_GET["id"];

      // Menampilkan data dari database yang mempunyai id=$id
      $query = "SELECT * FROM mahasiswa WHERE id = ?";
      $stmt = mysqli_prepare($koneksi, $query);
      mysqli_stmt_bind_param($stmt, 'i', $id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      // Jika data gagal diambil maka akan tampil error berikut
      if (!$result) {
          die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
      }
      
      // Mengambil data dari database
      $data = mysqli_fetch_assoc($result);
      if (!$data) {
          echo "<script>alert('Data tidak ditemukan pada database');window.location='petugas.php';</script>";
          exit();
      }
  } else {
      // Apabila tidak ada data GET id pada URL, redirect ke user.php
      echo "<script>alert('Masukkan data id.');window.location='user.php';</script>";
      exit();
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
</head>
<body>

<?php
  include('tampilan/header.php');
  include('tampilan/sidebar.php');
  include('tampilan/footer.php');
?>

<div class="main-content bg-primary">
    <section class="section">
        <div class="section-header">
            <h1>Edit Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="petugas.php">Data Pengguna</a></div>
                <div class="breadcrumb-item text-primary">Edit Pengguna</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-primary">
                        <div class="row mt-4">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="wizard-steps">
                                    <div class="wizard-step wizard-step-active">
                                        <div class="wizard-step-icon">
                                            <i class="fas fa-school"></i>
                                        </div>
                                        <div class="wizard-step-label">Formulir Pengguna</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form class="wizard-content mt-2" method="post" action="proses_edituser.php">
                            <input name="id" value="<?php echo htmlspecialchars($data['id']); ?>" hidden />

                            <div class="form-group row align-items-center">
                                <label class="col-md-4 text-md-right text-white">NIM</label>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" name="nim" value="<?php echo htmlspecialchars($data['nim']); ?>" required/>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label class="col-md-4 text-md-right text-white">Nama</label>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required/>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label class="col-md-4 text-md-right text-white">Password</label>
                                <div class="col-lg-4 col-md-6">
                                    <input type="password" name="password" value="<?php echo htmlspecialchars($data['password']); ?>" required/>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label class="col-md-4 text-md-right text-white">Username</label>
                                <div class="col-lg-4 col-md-6">
                                    <input type="username" name="username" value="<?php echo htmlspecialchars($data['username']); ?>" required/>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label class="col-md-4 text-md-right text-white">Prodi</label>
                                <div class="col-lg-4 col-md-6">
                                    <input type="text" name="prodi" value="<?php echo htmlspecialchars($data['prodi']); ?>" required/>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label class="col-md-4 text-md-right text-white">Username</label>
                                <div class="col-lg-4 col-md-6">
                                    <input type="username" name="username" value="<?php echo htmlspecialchars($data['username']); ?>" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-lg-4 col-md-6 text-right">
                                    <button type="submit" class="btn btn-icon icon-right btn-primary">Ubah Pengguna<i class="fas fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
