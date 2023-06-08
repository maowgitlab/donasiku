          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Proses donasi</h1>
          <div class="row">
            <div class="col-lg">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Proses Donasi</h6>
                </div>
                <div class="card-body">
                  <?php

                  // Cek apakah pengguna sudah login
                  if (!isset($_SESSION['email'])) {
                    // Tampilkan pesan "Anda harus login terlebih dahulu"
                    echo "<script>alert('Anda harus login terlebih dahulu'); window.location.href='login.php';</script>";
                  } else {
                    // Ambil data dari form donasi
                    $komunitas = $_POST['komunitas'];
                    $nominal = $_POST['nominal'];

                    // Cek apakah komunitas atau organisasi penerima donasi terdaftar dan terverifikasi
                    $query = "SELECT * FROM komunitas WHERE id = '$komunitas' AND status = 'terverifikasi'";
                    $result = mysqli_query($conn, $query);
                    $namaKomunitas = mysqli_fetch_assoc($result)['nama'];


                    if (mysqli_num_rows($result) == 0) {
                      // Tampilkan pesan "Komunitas atau organisasi penerima donasi tidak valid"
                      // echo "<script>alert('Komunitas atau organisasi penerima donasi tidak valid'); window.location.href='?halaman=informasi';</script>";
                    } else {
                      // Cek apakah nominal donasi valid
                      if (empty($nominal)) {
                        echo "<script>alert('Silahkan input nominal terlebih dahulu'); window.location.href='?halaman=donasi_informasi&id={$komunitas}';</script>";
                      } elseif ($nominal <= 0 || $nominal % 1000 != 0) {
                        // Tampilkan pesan "Nominal donasi harus positif dan kelipatan 1000"
                        echo "<script>alert('Nominal donasi harus positif dan kelipatan 1000'); window.location.href='?halaman=donasi_informasi&id={$komunitas}';</script>";
                      } else {
                        // Tampilkan rekening bank yang ditunjuk oleh tim DonasiKu untuk pembayaran donasi
                        echo "<div class='container'>";
                        echo "<p>Silakan transfer donasi Anda untuk komunitas <b>{$namaKomunitas}</b> sebesar Rp. <b class='text-danger'>" . number_format($nominal, 0, '.', '.') . "</b> ke rekening bank berikut:</p>";
                        echo "<p>Bank BNI: 1234567890 a.n. DonasiKu</p>";
                        echo "<p>Bank BRI: 0987654321 a.n. DonasiKu</p>";
                        echo "<p>Bank Mandiri: 1122334455 a.n. DonasiKu</p>";
                        echo "<p>Bank BCA: 5566778899 a.n. DonasiKu</p>";
                        echo "<p>Setelah melakukan transfer, silakan unggah bukti transfer Anda ke website DonasiKu. Pastikan juga nominal yang ditransfer susuai dengan yang dinputkan, jika tidak sistem akan menyalurkan dana sesuai inputan anda dan menganggap uang lebihan anda sebagai jasa donasi tambahan.</p>";
                        echo "<form action='?halaman=verifikasi' method='post' enctype='multipart/form-data'>";
                        echo "<input type='hidden' name='komunitas' value='$komunitas'>";
                        echo "<input type='hidden' name='nominal' value='$nominal'>";
                        echo "<input type='file' name='bukti' accept='image/*'>";
                        echo "<input type='submit' name='submit' value='Unggah'>";
                        echo "</form>";
                        echo "</div>";
                      }
                    }
                  }
                  ?>
                  <div class="my-2">
                    <a href="?halaman=informasi" class="btn btn-sm btn-secondary">
                      <i class="fas fa-arrow-left"></i> Kembali awal</a>
                  </div>
                </div>
              </div>
            </div>
          </div>