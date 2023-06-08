<?php
$komunitasID = $_GET['id'];

// Ambil nama file profil berdasarkan ID komunitas
$query = "SELECT profil FROM komunitas WHERE id = '$komunitasID'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$profilFile = $row['profil'];

// Hapus data komunitas dari database
$data = mysqli_query($conn, "DELETE FROM komunitas WHERE id = '$komunitasID'");

if ($data) {
  // Hapus file profil jika ada
  if (!empty($profilFile)) {
    $profilPath = "uploads/komunitas/" . $profilFile;
    if (file_exists($profilPath)) {
      unlink($profilPath);
    }
  }

  echo "<script>alert('Data komunitas berhasil dihapus'); window.location.href='?halaman=data_komunitas';</script>";
} else {
  echo "<script>alert('Data komunitas gagal dihapus'); window.location.href='?halaman=data_komunitas';</script>";
}
