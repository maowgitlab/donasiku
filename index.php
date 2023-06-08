<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DonasiKu</title>

  <!-- Tambahkan link CSS dan JS untuk DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style>
  .zoom-image {
    position: relative;
    display: inline-block;
  }

  .zoom-image img {
    transition: transform 0.3s ease;
  }

  .zoom-image:hover img {
    transform: scale(1.2);
  }

  /* Overlay */
  .overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .overlay img {
    max-width: 75%;
    max-height: 75%;
  }

  .zoom-image:hover .overlay {
    display: flex;
  }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-wallet"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DonasiKu</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <?php if (isset($_SESSION['email'])) : ?>
      <?php if ($_SESSION['email'] == 'adminganteng') : ?>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="?halaman=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Menu Admin
      </div>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=data_komunitas">
          <i class="fas fa-fw fa-edit"></i>
          <span>Data Komunitas</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?halaman=data_donatur">
          <i class="fas fa-fw fa-edit"></i>
          <span>Data Donatur</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Tampilan website
      </div>

      <li class="nav-item">
        <a class="nav-link" href="?halaman=informasi">
          <i class="fas fa-fw fa-users"></i>
          <span>Komunitas</span></a>
      </li>
      <?php else : ?>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>

      <li class="nav-item">
        <a class="nav-link" href="?halaman=informasi">
          <i class="fas fa-fw fa-users"></i>
          <span>Komunitas</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="?halaman=donasi">
          <i class="fas fa-fw fa-money-bill-wave-alt"></i>
          <span>Donasi</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=faq">
          <i class="fas fa-fw fa-question"></i>
          <span>FAQ</span></a>
      </li>
      <?php endif; ?>
      <?php else : ?>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>

      <li class="nav-item">
        <a class="nav-link" href="?halaman=informasi">
          <i class="fas fa-fw fa-users"></i>
          <span>Komunitas</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?halaman=faq">
          <i class="fas fa-fw fa-question"></i>
          <span>FAQ</span></a>
      </li>
      <?php endif; ?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span
                  class="mr-2 d-none d-lg-inline text-gray-600 small"><?= (!isset($_SESSION['nama']) ? 'Anonnim' : $_SESSION['nama']); ?></span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php if (isset($_SESSION['email'])) : ?>
                <?php if ($_SESSION['email'] != 'adminganteng') : ?>
                <a class="dropdown-item" href="?halaman=settings">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <?php endif; ?>
                <?php endif; ?>
                <?php if (!isset($_SESSION['email'])) : ?>
                <a class="dropdown-item" href="login.php">
                  <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Login
                </a>
                <?php else : ?>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                <?php endif; ?>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php
          include 'proses/config.php';
          if (isset($_GET['halaman'])) {
            $halaman = $_GET['halaman'];
            switch ($halaman) {
              case 'informasi':
                include 'layouts/informasi.php';
                break;

              case 'detail_informasi':
                include 'layouts/informasi_selengkapnya.php';
                break;

              case 'donasi_informasi':
                include 'layouts/donasi_informasi.php';
                break;

              case 'proses_donasi':
                include 'layouts/proses_donasi.php';
                break;

              case 'verifikasi':
                include 'proses/verifikasi.php';
                break;

              case 'donasi':
                include 'layouts/donasi.php';
                break;

              case 'dashboard':
                include 'layouts/admin/dashboard.php';
                break;

              case 'faq':
                include 'layouts/faq.php';
                break;

              case 'settings':
                include 'layouts/settings.php';
                break;

              case 'proses_settings':
                include 'proses/proses_settings.php';
                break;

              case 'data_komunitas':
                include 'layouts/admin/data_komunitas.php';
                break;

              case 'data_donatur':
                include 'layouts/admin/data_donatur.php';
                break;

              case 'detail_donatur':
                include 'layouts/admin/detail_donatur.php';
                break;

              case 'tambah_komunitas':
                include 'layouts/admin/tambah_komunitas.php';
                break;

              case 'edit_komunitas':
                include 'layouts/admin/edit_komunitas.php';
                break;

              case 'proses_tambah_komunitas':
                include 'proses/proses_tambah_komunitas.php';
                break;

              case 'proses_edit_komunitas':
                include 'proses/proses_edit_komunitas.php';
                break;

              case 'proses_hapus_komunitas':
                include 'proses/proses_hapus_komunitas.php';
                break;

              case 'verifikasi_donasi':
                include 'proses/verifikasi_donasi.php';
                break;

              default:
                include 'layouts/404.php';
                break;
            }
          } else {
            include 'layouts/informasi.php';
          }
          ?>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; DonasiKu <?= date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ingin Keluar halaman DonasiKu?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih button "logout" untuk keluar dan mengakhiri sesi.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="proses/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script>
  $(document).ready(function() {
    // Inisialisasi DataTables
    $('#dataKomunitas').DataTable();
    $('#dataDonasiUser').DataTable();
    $('#dataDonasiAdmin').DataTable();
    $('#dataDonaturAdmin').DataTable();

  });
  </script>
</body>

</html>