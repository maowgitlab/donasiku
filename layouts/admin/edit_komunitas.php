<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah data komunitas</h1>
<?php
$komunitasID = $_GET['id'];
$dataKomunitas = mysqli_query($conn, "SELECT * FROM komunitas where id = '$komunitasID'");
$data = mysqli_fetch_assoc($dataKomunitas);
?>
<div class="row mb-3">
  <div class="col-lg">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form edit data komunitas</h6>
      </div>
      <div class="card-body">
        <form method="POST" action="?halaman=proses_edit_komunitas&id=<?= $komunitasID; ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nama">Nama komunitas:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>">
          </div>
          <div class="row mb-2">
            <div class="col-md-4">
              <img src="uploads/komunitas/<?= $data['profil']; ?>" alt="<?= $data['profil']; ?>" class="img-thumbnail">
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="profil">Profil:</label>
                <input type="file" class="form-control-file" id="profil" name="profil">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="visi">VISI:</label>
                <textarea class="form-control" id="visi" name="visi" rows="3"><?= $data['visi']; ?></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="misi">MISI:</label>
                <textarea class="form-control" id="misi" name="misi" rows="3"><?= $data['misi']; ?></textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="laporan_keuangan">Target donasi:</label>
            <input type="number" class="form-control" id="laporan_keuangan" name="laporan_keuangan" value="<?= $data['laporan_keuangan'] ?>">
          </div>
          <div class="form-group">
            <label for="laporan_kegiatan">Laporan kegiatan:</label>
            <textarea class="form-control" id="laporan_kegiatan" name="laporan_kegiatan" rows="3"><?= $data['misi']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="jumlah_penerima_manfaat">Jumlah penerima manfaat:</label>
            <input type="number" class="form-control" id="jumlah_penerima_manfaat" name="jumlah_penerima_manfaat" value="<?= $data['jumlah_penerima_manfaat'] ?>">
          </div>
          <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status">
              <option value="terverifikasi" <?= ($data['status'] == 'terverifikasi') ? 'selected' : ''; ?>>Terverifikasi
              </option>
              <option value="pending" <?= ($data['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
            </select>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-sm btn-primary">Edit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>