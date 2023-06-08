<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Tambah data komunitas</h1>
<div class="row mb-3">
  <div class="col-lg">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form input data komunitas</h6>
      </div>
      <div class="card-body">
        <form method="POST" action="?halaman=proses_tambah_komunitas" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nama">Nama komunitas:</label>
            <input type="text" class="form-control" id="nama" name="nama" autofocus>
          </div>
          <div class="form-group">
            <label for="profil">Profil:</label>
            <input type="file" class="form-control-file" id="profil" name="profil">
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="visi">VISI:</label>
                <textarea class="form-control" id="visi" name="visi" rows="3"></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="misi">MISI:</label>
                <textarea class="form-control" id="misi" name="misi" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="laporan_keuangan">Target donasi:</label>
            <input type="number" class="form-control" id="laporan_keuangan" name="laporan_keuangan">
          </div>
          <div class="form-group">
            <label for="laporan_kegiatan">Laporan kegiatan:</label>
            <textarea class="form-control" id="laporan_kegiatan" name="laporan_kegiatan" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="jumlah_penerima_manfaat">Jumlah penerima manfaat:</label>
            <input type="number" class="form-control" id="jumlah_penerima_manfaat" name="jumlah_penerima_manfaat">
          </div>
          <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status">
              <option value="terverifikasi">Terverifikasi</option>
              <option value="pending">Pending</option>
            </select>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>