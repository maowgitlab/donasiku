<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Selamat Datang di DonasiKu</h1>
<div class="row">
  <?php
  $dataDonatur = mysqli_query($conn, "SELECT COUNT(DISTINCT id_user) AS jumlah_donatur FROM donasi");
  $data1 = mysqli_fetch_assoc($dataDonatur);
  $jumlahDonatur = $data1['jumlah_donatur'];

  $dataKomunitas = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_komunitas FROM komunitas WHERE status = 'terverifikasi'");
  $data2  = mysqli_fetch_assoc($dataKomunitas);
  $jumlahKomunitas = $data2['jumlah_komunitas'];
  ?>
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-lg-6 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">
              <a href="?halaman=data_donatur" class="text-primary">Jumlah donatur</a>
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahDonatur; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-lg-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-uppercase mb-1">
              <a href="?halaman=data_komunitas" class="text-success">Jumlah Komunitas</a>
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahKomunitas; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>