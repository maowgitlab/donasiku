<h1 class="h3 mb-4 text-gray-800">Detail data donatur</h1>
<?php
$userID = $_GET['id'];
$userData = mysqli_query($conn, "SELECT nama, email FROM user WHERE id = '$userID'");
$userHistori = mysqli_query($conn, "SELECT donasi.*, komunitas.nama AS nama_komunitas FROM donasi JOIN komunitas JOIN user WHERE donasi.id_komunitas = komunitas.id AND donasi.id_user = user.id AND donasi.id_user = '$userID' ORDER BY donasi.id DESC");
$user = mysqli_fetch_assoc($userData);
$no = 1;
?>
<div class="row">
  <div class="col-lg">
    <div class="card shadow mb-4 h-100">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail data donatur</h6>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label for="user">Nama user:</label>
          <input type="text" class="form-control" value="<?= $user['nama']; ?>" readonly>
        </div>
        <div class="form-group">
          <label for="email">Email user:</label>
          <input type="text" class="form-control" value="<?= $user['email']; ?>" readonly>
        </div>
        <h2>Histori donasi</h2>
        <div class="table-responsive">
          <table class="table" id="dataDonaturAdmin">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Komunitas</th>
                <th scope="col">Nominal</th>
                <th scope="col">Status</th>
                <th scope="col">Bukti</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Verif</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($userHistori) == 0) : ?>
              <tr>
                <td colspan="7" class="text-muted font-weight-bold text-center">Riwayat donasi masih kosong.</td>
              </tr>
              <?php else : ?>
              <?php foreach ($userHistori as $data) : ?>
              <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $data['nama_komunitas']; ?></td>
                <td>Rp. <?= number_format($data['nominal'], 0, '.', '.'); ?></td>
                <?php if ($data['status'] == 'pending') : ?>
                <td><span class="badge badge-pill badge-danger"><?= $data['status']; ?></span></td>
                <?php else : ?>
                <td><span class="badge badge-pill badge-success"><?= $data['status']; ?></span></td>
                <?php endif; ?>
                <td class="zoom-image">
                  <div class="overlay">
                    <img src="<?= $data['bukti']; ?>">
                  </div>
                  <img src="<?= $data['bukti']; ?>" width="200px" height="120px">
                </td>
                <td><?= date('d F Y H:i:s', $data['waktu_donasi']); ?></td>
                <td>
                  <?php if ($data['status'] == 'pending') : ?>
                  <a href="?halaman=verifikasi_donasi&id=<?= $data['id']; ?>" class="btn btn-sm btn-success"
                    onclick="return confirm('Verifikasi data yang dipilih ini?')"><i class="fas fa-check"></i></a>
                  <?php else : ?>
                  <i class='fa fa-heart text-danger'></i>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>