<?php
// Ambil data dari form update profile
$email = $_POST['email'];
$nama = $_POST['nama'];
$password = $_POST['password'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// Validasi email kosong
if (empty($email)) {
  // Tampilkan pesan "Email harus diisi"
  echo "<script>alert('Email harus diisi'); window.location.href='?halaman=settings';</script>";
  exit;
}

// Validasi nama kosong
if (empty($nama)) {
  // Tampilkan pesan "Nama harus diisi"
  echo "<script>alert('Nama harus diisi'); window.location.href='?halaman=settings';</script>";
  exit;
}

// Cek apakah email adalah email resmi UNISKA Banjarmasin
if (!preg_match("/@uniska-bjm.ac.id$/", $email)) {
  // Tampilkan pesan "Email harus email resmi UNISKA Banjarmasin"
  echo "<script>alert('Email harus email resmi UNISKA Banjarmasin'); window.location.href='?halaman=settings';</script>";
  exit;
}

// Update data pada database
$userId = $_SESSION['id_user'];
$query = "SELECT * FROM user WHERE id = '$userId'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $hashedPassword = $row['password'];

  // Jika password baru diisi
  if (!empty($password) || !empty($konfirmasi_password)) {
    // Validasi apakah password baru dan konfirmasi password sama
    if ($password != $konfirmasi_password) {
      // Tampilkan pesan "Password dan konfirmasi password harus sama"
      echo "<script>alert('Password dan konfirmasi password harus sama'); window.location.href='?halaman=settings';</script>";
      exit;
    }
    // Enkripsi password baru menggunakan hashing dan salting
    $salt = "donasiku";
    $password = hash('sha256', $salt . $password);

    // Validasi apakah password baru berbeda dengan password lama
    if ($password == $hashedPassword) {
      // Tampilkan pesan "Password baru tidak boleh sama dengan password lama"
      echo "<script>alert('Password baru tidak boleh sama dengan password lama'); window.location.href='?halaman=settings';</script>";
      exit;
    }
  } else {
    // Jika password tidak diubah, gunakan password lama
    $password = $hashedPassword;
  }

  // Update email, nama, dan password pada database
  $query = "UPDATE user SET email='$email', nama='$nama', password='$password' WHERE id='$userId'";

  // Jalankan query update
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Tampilkan pesan "Update profile berhasil"
    echo "<script>alert('Update profile berhasil');</script>";
    echo "<script>alert('Silahkan login ulang...'); window.location.href='proses/logout.php';</script>";
  } else {
    // Tampilkan pesan "Update profile gagal"
    echo "<script>alert('Update profile gagal'); window.location.href='?halaman=settings';</script>";
  }
} else {
  // Tampilkan pesan "User tidak ditemukan"
  echo "<script>alert('User tidak ditemukan'); window.location.href='?halaman=settings';</script>";
}
