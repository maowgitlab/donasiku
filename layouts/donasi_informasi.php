<?php
$dataInformasiID = $_GET['id'];
$dataKomunitas = mysqli_query($conn, "SELECT * FROM komunitas WHERE id = '$dataInformasiID'");
$data = mysqli_fetch_assoc($dataKomunitas);
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Donasi untuk komunitas <b><?= $data['nama']; ?></b></h1>
<div class="row">
  <div class="col-lg">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Donasi</h6>
      </div>
      <div class="card-body">
        <form method="POST" action="?halaman=proses_donasi">
          <input type="hidden" class="form-control" value="<?= $data['id']; ?>" id="komunitas" name="komunitas" required
            readonly>
          <div class="form-group">
            <label for="nominal">Nominal:</label>
            <input type="number" class="form-control" id="nominal" name="nominal">
          </div>
          <a href="?halaman=detail_informasi&id=<?= $data['id']; ?>" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali</a>
          <button type="submit" class="btn btn-sm btn-primary">Donasi</button>
        </form>
      </div>
    </div>
  </div>
</div>