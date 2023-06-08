<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Kelola data komunitas</h1>
<div class="row mb-3">
  <div class="col-lg">
    <a href="?halaman=tambah_komunitas" class="btn btn-sm btn-primary mb-3">Tambah data komunitas</a>
    <div class="table-responsive">
      <table class="table" id="dataKomunitas">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Komunitas</th>
            <th scope="col">Laporan kegiatan</th>
            <th scope="col">Target Donasi</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <?php
        $dataKomunitas = mysqli_query($conn, "SELECT * FROM komunitas");
        $no = 1;
        ?>
        <tbody>
          <?php if (mysqli_num_rows($dataKomunitas) == 0) : ?>
          <tr>
            <td colspan="6" class="text-muted font-weight-bold text-center">Data Komunitas masih kosong.</td>
          </tr>
          <?php else : ?>
          <?php foreach ($dataKomunitas as $data) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nama']; ?></td>
            <td style="text-align: justify;">
              <?php
                  $laporanKegiatan = $data['laporan_kegiatan'];
                  $maxLength = 200; // Batasan jumlah karakter yang diinginkan

                  if (strlen($laporanKegiatan) > $maxLength) {
                    $laporanKegiatan = substr($laporanKegiatan, 0, $maxLength) . '...';
                  }

                  echo nl2br($laporanKegiatan);
                  ?>
            </td>
            <td>Rp. <?= number_format($data['laporan_keuangan'], 0, '.', '.'); ?></td>
            <?php if ($data['status'] == 'terverifikasi') : ?>
            <td><span class="badge badge-pill badge-success"><?= $data['status']; ?></span></td>
            <?php else : ?>
            <td><span class="badge badge-pill badge-danger"><?= $data['status']; ?></span></td>
            <?php endif; ?>
            <td>
              <a href="?halaman=edit_komunitas&id=<?= $data['id']; ?>" class="btn btn-sm btn-warning"><i
                  class="fas fa-edit"></i></a>
              <a href="?halaman=proses_hapus_komunitas&id=<?= $data['id']; ?>" class="btn btn-sm btn-danger"
                onclick="return confirm('Anda yakin ingin menghapus data komunitas ini?')"><i
                  class="fas fa-trash"></i></a>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>