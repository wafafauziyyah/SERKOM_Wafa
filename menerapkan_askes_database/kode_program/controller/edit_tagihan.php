<?php 
session_start();
include '../services/koneksi.php';

$id_tagihan = $_POST['id_tagihan'];
$meter_awal = $_POST['meter_awal'];
$meter_akhir = $_POST['meter_akhir'];

// Hitung Ulang Jumlah Meter
$jumlah_meter = $meter_akhir - $meter_awal;

if($jumlah_meter < 0){
    header("location:../tagihan.php?pesan=gagal_meter");
    exit;
}

$query = "UPDATE tagihan SET 
          meter_awal='$meter_awal', 
          meter_akhir='$meter_akhir', 
          jumlah_meter='$jumlah_meter' 
          WHERE id_tagihan='$id_tagihan'";

$exec = mysqli_query($koneksi, $query);

if($exec){
    header("location:../tagihan.php?pesan=edit_sukses");
} else {
    header("location:../tagihan.php?pesan=gagal");
}
?>