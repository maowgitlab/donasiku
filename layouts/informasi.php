          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Informasi komunitas yang tersedia sekarang.</h1>
          <div class="row">
            <?php
            $dataKomunitas = mysqli_query($conn, "SELECT * FROM komunitas WHERE status = 'terverifikasi' ORDER BY id DESC");
            ?>
            <?php if (mysqli_num_rows($dataKomunitas) == 0) : ?>
              <div class="col-lg-12">
                <div class="alert alert-warning" role="alert">
                  <?= "Komunitas belum tersedia"; ?>
                </div>
              </div>
            <?php else : ?>
              <?php foreach ($dataKomunitas as $data) : ?>
                <div class="col-lg-6 mb-4">
                  <!-- Illustrations -->
                  <div class="card shadow mb-4 h-100">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Komunitas <?= $data['nama']; ?></h6>
                    </div>
                    <div class="card-body">
                      <div class="text-center">
                        <img class="img-fluid mb-3" style="width: 100rem;" src="uploads/komunitas/<?= $data['profil']; ?>" alt="<?= $data['profil']; ?>">
                      </div>
                      <b>Laporan Kegiatan</b>
                      <p style="text-align: justify;">
                        <?php
                        $laporanKegiatan = $data['laporan_kegiatan'];
                        $maxLength = 200; // Batasan jumlah karakter yang diinginkan

                        if (strlen($laporanKegiatan) > $maxLength) {
                          $laporanKegiatan = substr($laporanKegiatan, 0, $maxLength) . '...';
                        }

                        echo nl2br($laporanKegiatan);
                        ?>
                      </p>
                    </div>
                    <div class="card-footer">
                      <a rel="nofollow" href="?halaman=detail_informasi&id=<?= $data['id']; ?>">Lihat Informasi
                        selengkapnya →</a>
                    </div>
                  </div>

                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>