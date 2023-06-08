<h1 class="h3 mb-4 text-gray-800">Data donatur</h1>
<div class="row mb-3">
  <?php
  $userDonationsQuery = "
    SELECT user.id AS id_user, user.nama AS nama_user, user.email, 
        COUNT(donasi.id) AS total_donasi, 
        SUM(donasi.nominal) AS total_nominal
    FROM donasi
    JOIN user ON donasi.id_user = user.id
    GROUP BY user.id, user.nama, user.email
";

  $userDonationsResult = mysqli_query($conn, $userDonationsQuery);
  ?>

  <div class="col-lg">
    <table class="table" id="dataDonasiAdmin">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Total Donasi</th>
          <th scope="col">Total Nominal</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($userDonationsResult) == 0) : ?>
          <tr>
            <td colspan="6" class="text-muted font-weight-bold text-center">Tidak ada data donatur</td>
          </tr>
        <?php else : ?>
          <?php $no = 1; ?>
          <?php while ($row = mysqli_fetch_assoc($userDonationsResult)) : ?>
            <tr>
              <th scope='row'><?= $no++; ?></th>
              <td><?= $row['nama_user']; ?></td>
              <td><?= $row['email']; ?></td>
              <td><?= $row['total_donasi']; ?></td>
              <td>Rp. <?= number_format($row['total_nominal'], 0, '.', '.'); ?></td>
              <td><a href="?halaman=detail_donatur&id=<?= $row['id_user']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></td>
            </tr>
          <?php endwhile; ?>
        <?php endif; ?>

      </tbody>
    </table>

  </div>
</div>