<?php
// Ambil data dari form input
$komunitasID = $_GET['id'];
$nama = $_POST['nama'];
$profil = $_FILES['profil']['name'];
$visi = $_POST['visi'];
$misi = $_POST['misi'];
$laporan_keuangan = $_POST['laporan_keuangan'];
$laporan_kegiatan = $_POST['laporan_kegiatan'];
$jumlah_penerima_manfaat = $_POST['jumlah_penerima_manfaat'];
$status = $_POST['status'];

// Validasi data kosong
if (empty($nama) || empty($visi) || empty($misi) || empty($laporan_keuangan) || empty($laporan_kegiatan) || empty($jumlah_penerima_manfaat) || empty($status)) {
  // Tampilkan pesan "Data harus diisi semua"
  echo "<script>alert('Data harus diisi semua'); window.location.href='?halaman=edit_komunitas&id={$komunitasID}';</script>";
  exit;
}

// Cek apakah admin mengubah file profil
if ($_FILES['profil']['error'] === 4) {
  // Jika tidak ada file yang diunggah, gunakan profil lama dari database
  $query = "SELECT profil FROM komunitas WHERE id = $komunitasID";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $profil = $row['profil'];
  }
} else {
  // Jika ada file yang diunggah, lakukan proses upload dan ubah nama file
  $target_dir = "uploads/komunitas/";
  $target_file = $target_dir . basename($_FILES["profil"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Cek apakah file gambar
  $check = getimagesize($_FILES["profil"]["tmp_name"]);
  if ($check === false) {
    // Tampilkan pesan "File bukan gambar"
    echo "<script>alert('File bukan gambar'); window.location.href='?halaman=edit_komunitas&id=$komunitasID';</script>";
    exit;
  }

  // Generate nama baru dengan tambahan timestamp
  $timestamp = time();
  $nama_baru = pathinfo($target_file, PATHINFO_FILENAME) . '_' . $timestamp . '.' . $imageFileType;
  $target_file_baru = $target_dir . $nama_baru;

  // Jika nama file baru juga sudah ada, generate nama baru dengan tambahan angka acak
  $counter = 1;
  while (file_exists($target_file_baru)) {
    $nama_baru = pathinfo($target_file, PATHINFO_FILENAME) . '_' . $timestamp . '_' . $counter . '.' . $imageFileType;
    $target_file_baru = $target_dir . $nama_baru;
    $counter++;
  }

  // Upload file gambar dengan nama baru
  if (!move_uploaded_file($_FILES["profil"]["tmp_name"], $target_file_baru)) {
    // Tampilkan pesan gagal
    echo "<script>alert('File gagal diupload'); window.location.href='?halaman=edit_komunitas&id=$komunitasID';</script>";
    exit;
  }

  // Hapus file profil lama jika ada
  $query = "SELECT profil FROM komunitas WHERE id = $komunitasID";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $profil_lama = $row['profil'];
    if ($profil_lama !== null) {
      $path = $target_dir . $profil_lama;
      if (file_exists($path)) {
        unlink($path);
      }
    }
  }

  // Gunakan nama file baru
  $profil = $nama_baru;
}

// Update data komunitas ke database
$query = "UPDATE komunitas SET nama = '$nama', profil = '$profil', visi = '$visi', misi = '$misi', laporan_keuangan = '$laporan_keuangan', laporan_kegiatan = '$laporan_kegiatan', jumlah_penerima_manfaat = '$jumlah_penerima_manfaat', status = '$status' WHERE id = $komunitasID";
$result = mysqli_query($conn, $query);

if ($result) {
  // Tampilkan pesan sukses
  echo "<script>alert('Data komunitas berhasil diperbarui'); window.location.href='?halaman=data_komunitas';</script>";
} else {
  // Tampilkan pesan gagal
  echo "<script>alert('Data komunitas gagal diperbarui'); window.location.href='?halaman=edit_komunitas&id=$komunitasID';</script>";
}
