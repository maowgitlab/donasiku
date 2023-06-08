<?php
$donasiID = $_GET['id'];
$dataDonasi = mysqli_query($conn, "SELECT * FROM donasi WHERE status = 'pending' AND id ='$donasiID'");

if (mysqli_num_rows($dataDonasi) > 0) {
  $donasi = mysqli_fetch_assoc($dataDonasi);
  $nominal = $donasi['nominal'];
  $komunitas = $donasi['id_komunitas'];
  $id_user = $donasi['id_user'];
  $updateKomunitas = mysqli_query($conn, "UPDATE komunitas SET jumlah_donasi = jumlah_donasi + $nominal WHERE id = '$komunitas'");
  $updateDonasi = mysqli_query($conn, "UPDATE donasi SET status = 'terverifikasi' WHERE id = '$donasiID'");
  echo "<script>alert('Status sudah terverifikasi'); window.location.href='?halaman=detail_donatur&id={$id_user}';</script>";
} else {
  echo "<script>alert('Status gagal diubah'); window.location.href='?halaman=detail_donatur&id={$id_user}';</script>";
}
