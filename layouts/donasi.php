<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Donasi cepat</h1>
<div class="row mb-3">
  <div class="col-lg">
    <?php
    $query = "SELECT * FROM komunitas WHERE status = 'terverifikasi'";
    $result = mysqli_query($conn, $query);
    ?>
    <?php if (mysqli_num_rows($result) == 0) : ?>
      <div class="alert alert-warning" role="alert">
        <?= "Komunitas belum tersedia"; ?>
      </div>
    <?php else : ?>
      <form method="POST" action="?halaman=proses_donasi">
        <div class="form-group">
          <label for="komunitas">Komunitas:</label>
          <select class="form-control" id="komunitas" name="komunitas">
            <?php
            // Ambil daftar komunitas dari database
            $query = "SELECT nama,id FROM komunitas";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
              $namaKomunitas = $row['nama'];
              $idKomunitas   = $row['id'];
              echo "<option value='$idKomunitas'>$namaKomunitas</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="nominal">Nominal:</label>
          <input type="number" class="form-control" id="nominal" name="nominal">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-sm btn-primary">Donasi</button>
        </div>
      </form>
    <?php endif; ?>
  </div>
</div>
<h1 class="h3 mb-4 text-gray-800">Riwayat Donasi</h1>
<b>Catatan:</b>
<div class="d-block mb-2">
  <span class="badge badge-pill badge-danger">pending</span> sedang tahap pengecekan <br>
  <span class="badge badge-pill badge-success">terverifikasi</span> donasi sudah disalurkan
</div>

<div class="row mb-3">
  <div class="col-lg">
    <?php
    $userID = $_SESSION['id_user'];
    $DonasiKomunitas = mysqli_query($conn, "SELECT donasi.*, komunitas.nama AS nama_komunitas, user.nama AS nama_user FROM donasi JOIN komunitas JOIN user WHERE donasi.id_komunitas = komunitas.id AND donasi.id_user = user.id AND donasi.id_user = '$userID' ORDER BY donasi.id DESC");
    $no = 1;
    ?>
    <div class="table-responsive">
      <table class="table" id="dataDonasiUser">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Komunitas</th>
            <th scope="col">Nominal</th>
            <th scope="col">Status</th>
            <th scope="col">Bukti</th>
            <th scope="col">Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($DonasiKomunitas) == 0) : ?>
            <tr>
              <td colspan="7" class="text-muted font-weight-bold text-center">Riwayat donasi masih kosong.</td>
            </tr>
          <?php else : ?>
            <?php foreach ($DonasiKomunitas as $data) : ?>
              <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $data['nama_user']; ?></td>
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
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>