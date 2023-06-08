<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Pengaturan akun</h1>
<div class="row">
  <?php
  $userID   = $_SESSION['id_user'];
  $dataUser = mysqli_query($conn, "SELECT * FROM user WHERE id = '$userID'");
  $data     = mysqli_fetch_assoc($dataUser);
  ?>
  <div class="col-lg mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengaturan informasi akun</h6>
      </div>
      <div class="card-body">
        <form method="POST" action="?halaman=proses_settings">
          <div class="form-group">
            <label for="nominal">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $data['email']; ?>">
          </div>
          <div class="form-group">
            <label for="nominal">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>">
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="passwordbaru">Password baru:</label>
                <input type="password" class="form-control" id="passwordaru" name="password">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="konfirmasi_password">konfirmasi password:</label>
                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
              </div>

            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>