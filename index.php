<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Masuk &mdash; Web Pembayaran SPP</title>
     <link rel="icon" href="/img/avatar/favicon.ico" type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/components.css">
</head>
<body class="bg-light">
  <style>.bg-light { background-color: #ffffff !important; }</style>

    <?php 
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                      <strong>Perhatian!</strong> Mohon Cek Kembali Username/NIM dan Password Anda.
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>";
        }
        if ($_GET['pesan'] == "belummasuk") {
            echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                      <strong>Perhatian!</strong> Username/NIM dan Password Anda Belum Terdaftar.
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button>
                    </div>";
        }
    }
    ?>

    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="img/avatar/iaib.jpeg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-info">
                            <div class="card-header"><h4>Silahkan Masuk</h4></div>

                            <div class="card-body">
                                <form action="cek_login.php" method="post">
                                    <div class="form-group">
                                        <label>Username/NIM</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                            <input type="text" name="username_nim" class="form-control" placeholder="Masukkan Username atau NIM" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                                            </div>
                                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="bootstrap/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="bootstrap/jquery.nicescroll.min.js"></script>
    <script src="bootstrap/moment.min.js"></script>
    <script src="bootstrap/stisla.js"></script>

    <!-- Template JS File -->
    <script src="bootstrap/scripts.js"></script>
    <script src="bootstrap/custom.js"></script>
</body>
</html>
