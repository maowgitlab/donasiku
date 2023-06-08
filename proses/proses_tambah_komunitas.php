<?php
// Ambil data dari form input
$nama = $_POST['nama'];
$profil = $_FILES['profil']['name'];
$visi = $_POST['visi'];
$misi = $_POST['misi'];
$laporan_keuangan = $_POST['laporan_keuangan'];
$laporan_kegiatan = $_POST['laporan_kegiatan'];
$jumlah_penerima_manfaat = $_POST['jumlah_penerima_manfaat'];
$status = $_POST['status'];

// Validasi data kosong
if (empty($nama) || empty($profil) || empty($visi) || empty($misi) || empty($laporan_keuangan) || empty($laporan_kegiatan) || empty($jumlah_penerima_manfaat) || empty($status)) {
  // Tampilkan pesan "Data harus diisi semua"
  echo "<script>alert('Data harus diisi semua'); window.location.href='?halaman=tambah_komunitas';</script>";
  exit;
}

// Upload gambar profil
$target_dir = "uploads/komunitas/";
$target_file = $target_dir . basename($_FILES["profil"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Cek apakah file gambar
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["profil"]["tmp_name"]);
  if ($check !== false) {
    $uploadOk = 1;
  } else {
    // Tampilkan pesan "File bukan gambar"
    echo "<script>alert('File bukan gambar'); window.location.href='?halaman=tambah_komunitas';</script>";
    exit;
  }
}

// Cek apakah file sudah ada
if (file_exists($target_file)) {
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

  // Simpan data komunitas ke database dengan nama file baru
  $query = "INSERT INTO komunitas (nama, profil, visi, misi, laporan_keuangan, laporan_kegiatan, jumlah_penerima_manfaat, status) VALUES ('$nama', '$nama_baru', '$visi', '$misi', '$laporan_keuangan', '$laporan_kegiatan', '$jumlah_penerima_manfaat', '$status')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Pindahkan file yang diupload dengan nama baru ke folder
    if (move_uploaded_file($_FILES["profil"]["tmp_name"], $target_file_baru)) {
      // Tampilkan pesan sukses
      echo "<script>alert('Data komunitas berhasil ditambahkan'); window.location.href='?halaman=data_komunitas';</script>";
    } else {
      // Tampilkan pesan gagal
      echo "<script>alert('File gagal diupload'); window.location.href='?halaman=tambah_komunitas';</script>";
    }
  } else {
    // Tampilkan pesan gagal
    echo "<script>alert('Data komunitas gagal ditambahkan'); window.location.href='?halaman=tambah_komunitas';</script>";
  }
} else {
  // Batasi ukuran file gambar
  if ($_FILES["profil"]["size"] > 50000000) {
    // Tampilkan pesan "Ukuran file terlalu besar"
    echo "<script>alert('Ukuran file terlalu besar'); window.location.href='?halaman=tambah_komunitas';</script>";
    $uploadOk = 0;
  }

  // Hanya terima format gambar tertentu (contoh: JPG, JPEG, PNG)
  if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
    // Tampilkan pesan "Format gambar tidak valid"
    echo "<script>alert('Format gambar tidak valid'); window.location.href='?halaman=tambah_komunitas';</script>";
    $uploadOk = 0;
  }

  // Cek jika $uploadOk = 0, artinya file gagal diupload
  if ($uploadOk == 0) {
    // Tampilkan pesan "File gagal diupload"
    echo "<script>alert('File gagal diupload'); window.location.href='?halaman=tambah_komunitas';</script>";
    exit;
  } else {
    // Jika semua validasi berhasil, upload file gambar dengan nama asli
    if (move_uploaded_file($_FILES["profil"]["tmp_name"], $target_file)) {
      // Simpan data komunitas ke database
      $query = "INSERT INTO komunitas (nama, profil, visi, misi, laporan_keuangan, laporan_kegiatan, jumlah_penerima_manfaat, status) VALUES ('$nama', '$profil', '$visi', '$misi', '$laporan_keuangan', '$laporan_kegiatan', '$jumlah_penerima_manfaat', '$status')";
      $result = mysqli_query($conn, $query);

      if ($result) {
        // Tampilkan pesan "Data komunitas berhasil ditambahkan"
        echo "<script>alert('Data komunitas berhasil ditambahkan'); window.location.href='?halaman=data_komunitas';</script>";
      } else {
        // Tampilkan pesan "Data komunitas gagal ditambahkan"
        echo "<script>alert('Data komunitas gagal ditambahkan'); window.location.href='?halaman=tambah_komunitas';</script>";
      }
    } else {
      // Tampilkan pesan "File gagal diupload"
      echo "<script>alert('File gagal diupload'); window.location.href='?halaman=tambah_komunitas';</script>";
      exit;
    }
  }
}
