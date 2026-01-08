<?php 
session_start();
include '../services/koneksi.php';

$id_pelanggan = $_POST['id_pelanggan'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$meter_awal = $_POST['meter_awal'];
$meter_akhir = $_POST['meter_akhir'];

// Hitung Jumlah Meter
$jumlah_meter = $meter_akhir - $meter_awal;
if($jumlah_meter < 0){
    header("location:../tagihan.php?pesan=gagal_meter");
    exit;
}

$query = "INSERT INTO tagihan (id_pelanggan, bulan, tahun, meter_awal, meter_akhir, jumlah_meter, status) 
          VALUES ('$id_pelanggan', '$bulan', '$tahun', '$meter_awal', '$meter_akhir', '$jumlah_meter', 'Belum Bayar')";

$exec = mysqli_query($koneksi, $query);

if($exec){
    header("location:../tagihan.php?pesan=simpan_sukses");
} else {
    header("location:../tagihan.php?pesan=gagal");
}
?>