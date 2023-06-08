<?php
// Koneksi ke database
include "config.php";

// Ambil data dari form registrasi
$email = $_POST['email'];
$nama = $_POST['nama'];
$password = $_POST['password'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// Validasi email kosong
if (empty($email)) {
  // Tampilkan pesan "Email harus diisi"
  echo "<script>alert('Email harus diisi'); window.location.href='../registrasi.php';</script>";
  exit;
}

// Validasi nama kosong
if (empty($nama)) {
  // Tampilkan pesan "Nama harus diisi"
  echo "<script>alert('Nama harus diisi'); window.location.href='../registrasi.php';</script>";
  exit;
}

// Validasi password kosong
if (empty($password)) {
  // Tampilkan pesan "Password harus diisi"
  echo "<script>alert('Password harus diisi'); window.location.href='../registrasi.php';</script>";
  exit;
}

// Validasi konfirmasi password kosong
if (empty($konfirmasi_password)) {
  // Tampilkan pesan "Konfirmasi password harus diisi"
  echo "<script>alert('Konfirmasi password harus diisi'); window.location.href='../registrasi.php';</script>";
  exit;
}

// Cek apakah email sudah terdaftar di database
$query = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  // Tampilkan pesan "Email sudah terdaftar"
  echo "<script>alert('Email sudah terdaftar'); window.location.href='../registrasi.php';</script>";
} else {
  // Cek apakah email adalah email resmi UNISKA Banjarmasin
  if (!preg_match("/@uniska-bjm.ac.id$/", $email)) {
    // Tampilkan pesan "Email harus email resmi UNISKA Banjarmasin"
    echo "<script>alert('Email harus email resmi UNISKA Banjarmasin'); window.location.href='../registrasi.php';</script>";
  } else {
    // Cek apakah password sama dengan konfirmasi password
    if ($password != $konfirmasi_password) {
      // Tampilkan pesan "Password dan konfirmasi password harus sama"
      echo "<script>alert('Password dan konfirmasi password harus sama'); window.location.href='../registrasi.php';</script>";
    } else {
      // Enkripsi password menggunakan hashing dan salting
      $salt = "donasiku";
      $password = hash('sha256', $salt . $password);

      // Simpan email, nama, dan password terenkripsi ke database
      $query = "INSERT INTO user (email, nama, password) VALUES ('$email', '$nama', '$password')";
      $result = mysqli_query($conn, $query);

      if ($result) {
        // Tampilkan pesan "Registrasi berhasil"
        echo "<script>alert('Registrasi berhasil'); window.location.href='../login.php';</script>";
      } else {
        // Tampilkan pesan "Registrasi gagal"
        echo "<script>alert('Registrasi gagal'); window.location.href='../registrasi.php';</script>";
      }
    }
  }
}