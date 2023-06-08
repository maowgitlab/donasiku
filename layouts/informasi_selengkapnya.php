<?php
$dataInformasiID = $_GET['id'];
$dataKomunitas = mysqli_query($conn, "SELECT * FROM komunitas WHERE id = '$dataInformasiID'");
$data = mysqli_fetch_assoc($dataKomunitas);
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Informasi lengkap komunitas <?= $data['nama']; ?></h1>
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Jumlah Donatur</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['jumlah_donatur']; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Jumlah Penerima Manfaat</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['jumlah_penerima_manfaat']; ?>
              (orang)</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Target Donasi</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <?php

                // Query untuk mengambil data laporan_keuangan dan jumlah_donasi
                $query = "SELECT laporan_keuangan, jumlah_donasi FROM komunitas WHERE id = '$dataInformasiID'"; // Ubah '1' dengan ID komunitas yang sesuai
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                // Mengambil data laporan_keuangan dan jumlah_donasi dari database
                $laporanKeuangan = $row['laporan_keuangan'];
                $jumlahDonasi = $row['jumlah_donasi'];
                $targetDonasi = $laporanKeuangan; // Target pencapaian donasi

                // Menghitung persentase pencapaian donasi
                $persentaseDonasi = ($jumlahDonasi / $targetDonasi) * 100;
                $persentaseDonasi = min($persentaseDonasi, 100); // Batasi maksimum persentase menjadi 100%

                $formattedJumlahDonasi = number_format($jumlahDonasi);
                $formattedTargetDonasi = number_format($targetDonasi);
                $persentaseDonasi = ($jumlahDonasi / $targetDonasi) * 100;
                $textColor = '';

                if ($persentaseDonasi >= 100) {
                  $textColor = 'text-success'; // Donasi mencapai atau melebihi target
                } elseif ($persentaseDonasi >= 50) {
                  $textColor = 'text-warning'; // Donasi di atas 50%
                } else {
                  $textColor = 'text-danger'; // Donasi di bawah 50%
                }

                // Tampilkan tampilan jumlah donasi dan progress bar
                echo "<div class='h5 mb-0 mr-3 font-weight-bold {$textColor}'>Rp. $formattedJumlahDonasi / Rp. $formattedTargetDonasi</div>";
                ?>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $persentaseDonasi; ?>%" aria-valuenow="<?php echo $persentaseDonasi; ?>" aria-valuemin="0" aria-valuemax="100">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Komunitas <?= $data['nama']; ?></h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <img class="img-fluid mt-3 mb-4" style="width: 100rem;" src="uploads/komunitas/<?= $data['profil']; ?>" alt="<?= $data['profil']; ?>">
          </div>
          <div class="col-lg-3">
            <b>VISI</b>
            <p style="text-align: justify;">
              <?= nl2br($data['visi']); ?>
            </p>
          </div>
          <div class="col-lg-3">
            <b>MISI</b>
            <p style="text-align: justify;">
              <?= nl2br($data['misi']); ?>
            </p>
          </div>
        </div>
        <b>Laporan Kegiatan</b>
        <p style="text-align: justify;">
          <?= nl2br($data['laporan_kegiatan']); ?>
        </p>
        <a href="?halaman=informasi" class="btn btn-sm btn-secondary">
          <i class="fas fa-arrow-left"></i> Kembali</a>
        <?php if (isset($_SESSION['email'])) : ?>
          <?php if ($_SESSION['email'] != 'adminganteng') : ?>
            <a href="?halaman=donasi_informasi&id=<?= $data['id']; ?>" class="btn btn-sm btn-primary">Donasi</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>