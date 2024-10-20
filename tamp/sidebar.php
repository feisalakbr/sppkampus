<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link rel="icon" href="/sppiab/img/avatar/favicon.ico" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }

        /* Sidebar Styles */
        .sidebar {
            height: 100vh;
            background-color: #007bff;
            padding: 15px;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1000;
            transition: transform 0.3s ease-in-out;
        }

        @media (min-width: 1024px) {
            .sidebar {
                transform: translateX(0);
            }
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-250px);
            }

            .sidebar.visible {
                transform: translateX(0);
            }
        }

        .sidebar .nav-link {
            color: white;
            margin: 10px 0;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(0, 86, 245, 0.7);
            border-radius: 5px;
        }

        /* Overlay Styles */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .overlay.visible {
            display: block;
        }

        /* Konten Utama */
        .content {
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.3s ease-in-out;
        }

        @media (max-width: 1024px) {
            .content {
                margin-left: 0;
            }

            .content.shifted {
                margin-left: 250px;
            }
        }

        /* Navbar Styles */
        .navbar {
            background-color: #f5f7fa;
            padding: 10px;
            color: white;
        }

        .menu-toggle {
            cursor: pointer;
            font-size: 20px;
            color: white;
            margin-left: 15px;
        }

        .logo-img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto 20px;
        }

        /* Logout Icon */
        .logout-icon {
            width: 20px;
            height: auto;
            margin-right: 8px;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<!-- Navbar dan Tombol Toggle -->
<nav class="navbar d-flex align-items-center justify-content-between">
    <span class="menu-toggle" onclick="toggleSidebar()">&#9776;</span>
    <span style="font-size: 12px;">Institut Agama Islam Bogor Kampus Cianjur</span>
</nav>

<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<div class="sidebar d-flex flex-column" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo mb-4">
        <!-- <img src="img/avatar/avatar-1.png" alt="Logo" class="logo-img"> -->
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="dashboard_mahasiswa.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="comingsoon.html">Tahap Perkembangan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="comingsoon.html">Tahap Perkembangan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php" style="color: white">
                <img src="img/logout.png" alt="Logout Icon" class="logout-icon">
                Logout
            </a>
        </li>
    </ul>
</div>

<!-- Konten Utama -->
<div class="content" id="content">
    <!-- Konten dinamis atau lainnya di sini -->
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script untuk toggle sidebar -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const content = document.getElementById('content');
        
        sidebar.classList.toggle('visible');
        overlay.classList.toggle('visible');
        content.classList.toggle('shifted');
    }

    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const content = document.getElementById('content');
        
        if (window.innerWidth > 1024) {
            sidebar.classList.remove('visible');
            overlay.classList.remove('visible');
            content.classList.remove('shifted');
        }
    });
</script>

</body>
</html>
