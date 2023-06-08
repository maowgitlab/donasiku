<?php
if (!isset($_SESSION['email'])) {
  // Tampilkan pesan "Anda harus login terlebih dahulu"
  echo "<script>alert('Anda harus login terlebih dahulu'); window.location.href='login.php';</script>";
} else {
  // Ambil data donasi dari form
  $komunitas = $_POST['komunitas'];
  $nominal = $_POST['nominal'];

  // Cek apakah komunitas atau organisasi penerima donasi terdaftar dan terverifikasi
  $query = "SELECT * FROM komunitas WHERE id = '$komunitas' AND status = 'terverifikasi'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 0) {
    // Tampilkan pesan "Komunitas atau organisasi penerima donasi tidak valid"
    echo "<script>alert('Komunitas atau organisasi penerima donasi tidak valid'); window.location.href='?halaman=informasi';</script>";
  } else {
    // Cek apakah nominal donasi valid
    if ($nominal <= 0 || $nominal % 1000 != 0) {
      // Tampilkan pesan "Nominal donasi harus positif dan kelipatan 1000"
      echo "<script>alert('Nominal donasi harus positif dan kelipatan 1000'); window.location.href='?halaman=donasi_informasi&id={$komunitas}';</script>";
    } else {
      // Simpan informasi donasi ke database
      $id_user = $_SESSION['id_user'];

      // Periksa apakah pengguna sudah pernah melakukan donasi ke komunitas tertentu
      $query = "SELECT * FROM donasi WHERE id_user = '$id_user' AND id_komunitas = '$komunitas'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        // Jika pengguna sudah pernah melakukan donasi ke komunitas ini sebelumnya, jumlah_donatur tetap sama

        // Check if bukti donasi file is uploaded
        if ($_FILES['bukti']['error'] === UPLOAD_ERR_OK) {
          $buktiName = $_FILES['bukti']['name'];
          $buktiTmpName = $_FILES['bukti']['tmp_name'];
          $buktiSize = $_FILES['bukti']['size'];
          $buktiError = $_FILES['bukti']['error'];

          // Generate random filename
          $buktiExtension = pathinfo($buktiName, PATHINFO_EXTENSION);
          $buktiRandomName = md5(uniqid(rand(), true)) . '.' . $buktiExtension;

          $buktiDestination = "uploads/" . $buktiRandomName;
          move_uploaded_file($buktiTmpName, $buktiDestination);

          // Update donasi with bukti file and waktu_donasi
          $updateQuery = "UPDATE komunitas SET jumlah_donasi = jumlah_donasi + 0 WHERE id = '$komunitas'";
          $updateResult = mysqli_query($conn, $updateQuery);

          if ($updateResult) {
            // Get current timestamp
            $currentTimestamp = time();

            // Insert new donation to donasi table with waktu_donasi
            $insertQuery = "INSERT INTO donasi (id_user, id_komunitas, nominal, bukti, status, waktu_donasi) VALUES ('$id_user', '$komunitas', $nominal, '$buktiDestination', 'pending', $currentTimestamp)";
            $insertResult = mysqli_query($conn, $insertQuery);

            if ($insertResult) {
              // Tampilkan pesan "Donasi berhasil"
              echo "<script>alert('Donasi berhasil dan sedang diperiksa'); window.location.href='?halaman=detail_informasi&id={$komunitas}';</script>";
            } else {
              // Tampilkan pesan "Donasi gagal"
              echo "<script>alert('Donasi gagal'); window.location.href='?halaman=detail_informasi&id={$komunitas}';</script>";
            }
          } else {
            // Tampilkan pesan "Donasi gagal"
            echo "<script>alert('Donasi gagal'); window.location.href='?halaman=detail_informasi&id={$komunitas}';</script>";
          }
        } else {
          // Tampilkan pesan "Harap unggah file bukti donasi"
          echo "<script>alert('Harap unggah file bukti donasi'); window.location.href='?halaman=detail_informasi&id={$komunitas}';</script>";
        }
      } else {
        // Jika pengguna belum pernah melakukan donasi ke komunitas ini sebelumnya, tambahkan donasi baru dan update jumlah_donatur pada tabel komunitas

        // Check if bukti donasi file is uploaded
        if ($_FILES['bukti']['error'] === UPLOAD_ERR_OK) {
          $buktiName = $_FILES['bukti']['name'];
          $buktiTmpName = $_FILES['bukti']['tmp_name'];
          $buktiSize = $_FILES['bukti']['size'];
          $buktiError = $_FILES['bukti']['error'];

          // Generate random filename
          $buktiExtension = pathinfo($buktiName, PATHINFO_EXTENSION);
          $buktiRandomName = md5(uniqid(rand(), true)) . '.' . $buktiExtension;

          $buktiDestination = "uploads/" . $buktiRandomName;
          move_uploaded_file($buktiTmpName, $buktiDestination);

          // Get current timestamp
          $currentTimestamp = time();

          // Insert new donation to donasi table with waktu_donasi
          $insertQuery = "INSERT INTO donasi (id_user, id_komunitas, nominal, bukti, status, waktu_donasi) VALUES ('$id_user', '$komunitas', $nominal, '$buktiDestination', 'pending', $currentTimestamp)";
          $insertResult = mysqli_query($conn, $insertQuery);

          if ($insertResult) {
            // Update jumlah_donasi and jumlah_donatur in komunitas table
            $updateQuery = "UPDATE komunitas SET jumlah_donasi = jumlah_donasi + 0, jumlah_donatur = jumlah_donatur + 1 WHERE id = '$komunitas'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
              // Tampilkan pesan "Donasi berhasil"
              echo "<script>alert('Donasi berhasil dan sedang diperika'); window.location.href='?halaman=detail_informasi&id={$komunitas}';</script>";
            } else {
              // Tampilkan pesan "Donasi gagal"
              echo "<script>alert('Donasi gagal'); window.location.href='?halaman=detail_informasi&id={$komunitas}';</script>";
            }
          } else {
            // Tampilkan pesan "Donasi gagal"
            echo "<script>alert('Donasi gagal'); window.location.href='?halaman=detail_informasi&id={$komunitas}';</script>";
          }
        } else {
          // Tampilkan pesan "Harap unggah file bukti donasi"
          echo "<script>alert('Harap unggah file bukti donasi'); window.location.href='?halaman=detail_informasi&id={$komunitas}';</script>";
        }
      }
    }
  }
}
