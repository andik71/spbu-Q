<?php
include 'koneksi.php';

$query = $conn->query("SELECT * FROM user");
$row = $query->fetch_assoc();

$nama = $row['nama'];
?>

<!-- Horizontal Navbar -->
<div class="horizontal-navbar" id="navbar">
    <nav class="navbar navbar-expand-lg justify-content-start navbar-dark bg-dark fixed-top">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php">SPBU-Q</a>
        <!-- Toggler -->
        <button id="sidebarCollapse" type="button" class="btn btn-warning btn-sm d-inline">
            <i class="fa fa-bars mr-2"></i></button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown mx-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <?= $nama ?>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-user-circle text-warning"></i>
                            Lihat Profi
                        </a>
                        <div class="dropdown-divider text-warning"></div>
                        <a class="dropdown-item" href="logout.php">
                            <i class="fa fa-arrow-left"></i>
                            Log Out
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>

<!-- vertical navbar -->
<div class="vertical-nav bg-dark mt-5" id="sidebar">

    <div class="container-fluid p-0 mt-4 d-inline d-block">
        <!-- DASHBOARD -->
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-3 mb-0 d-inline d-block">Dashboard</p>
        <ul class="nav flex-column bg-white mb-3">
            <li class="nav-item">
                <a href="index.php" class="nav-link text-warning bg-dark">
                    <i class="fa fa-th-large mr-3 fa-fw"></i>Home</a>
            </li>
        </ul>
        <!-- KELOLA DATA -->
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-3 mb-0 d-inline d-block">Master Data</p>
        <ul class="nav flex-column bg-white mb-3">
            <!-- <li class="nav-item">
                <a href="pemetaan.php" class="nav-link text-warning bg-dark">
                    <i class="fa fa-globe mr-3 fa-fw"></i>Pemetaan</a>
            </li> -->
            <li class="nav-item">
                <a href="kecamatan.php" class="nav-link text-warning bg-dark">
                    <i class="fa fa-plus mr-3 fa-fw"></i>
                    Data Kecamatan
                </a>
            </li>
            <li class="nav-item">
                <a href="spbu.php" class="nav-link text-warning bg-dark">
                    <i class="fa fa-desktop mr-3 fa-fw"></i>
                    Data SPBU
                </a>
            </li>
        </ul>
        <!-- KELOLA USER -->
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-3 mb-0 d-inline d-block">User</p>
        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="user.php" class="nav-link text-warning bg-dark">
                    <i class="fa fa-user-circle mr-3 fa-fw"></i>
                    Kelola Profil
                </a>
            </li>
        </ul>
    </div>


</div>