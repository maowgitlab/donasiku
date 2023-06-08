<?php
// Koneksi ke database
include "config.php";

// Ambil data dari form login
$email = $_POST['email'];
$password = $_POST['password'];

// Validasi inputan email dan password tidak boleh kosong
if (empty($email) || empty($password)) {
  // Tampilkan pesan "Email dan password harus diisi"
  echo "<script>alert('Email dan password harus diisi'); window.location.href='../login.php';</script>";
} else {
  // Cari email di database
  $query = "SELECT * FROM user WHERE email = '$email'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 0) {
    // Tampilkan pesan "Email tidak terdaftar"
    echo "<script>alert('Email tidak terdaftar'); window.location.href='../login.php';</script>";
  } else {
    // Ambil password terenkripsi yang sesuai dengan email dari database
    $row = mysqli_fetch_assoc($result);
    $password_terenkripsi = $row['password'];

    // Bandingkan password terenkripsi dengan password yang diinputkan dengan hashing dan salting
    $salt = "donasiku";
    $password = hash('sha256', $salt . $password);

    if ($password != $password_terenkripsi) {
      // Tampilkan pesan "Password salah"
      echo "<script>alert('Password salah'); window.location.href='../login.php';</script>";
    } else {
      // Buat sesi login untuk pengguna
      session_start();
      $halaman = '';
      if ($email == 'adminganteng') {
        $_SESSION['email']  = 'adminganteng';
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['id_user'] = $row['id'];
        $halaman = '?halaman=dashboard';
      } else {
        $_SESSION['email'] = $email;
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['id_user'] = $row['id'];
        $halaman = '?halaman=informasi';
      }

      // Tampilkan pesan "Login berhasil" dan arahkan ke halaman yang sesuai
      if ($email == 'adminganteng') {
        echo "<script>alert('Login berhasil, selamat datang {$email}'); window.location.href='../{$halaman}';</script>";
      } else {
        $nama = $_SESSION['nama'];
        echo "<script>alert('Login berhasil, selamat datang {$nama}'); window.location.href='../{$halaman}';</script>";
      }
    }
  }
}
