<?php 
session_start();
include '../services/koneksi.php';

$id = $_GET['id'];

// Cek dulu apakah statusnya sudah lunas
$cek = mysqli_query($koneksi, "SELECT status FROM tagihan WHERE id_tagihan='$id'");
$data = mysqli_fetch_assoc($cek);

if($data['status'] == 'Lunas'){
    header("location:../tagihan.php?pesan=gagal_hapus_lunas");
    exit;
}

$query = "DELETE FROM tagihan WHERE id_tagihan='$id'";
$exec = mysqli_query($koneksi, $query);

if($exec){
    header("location:../tagihan.php?pesan=hapus_sukses");
} else {
    header("location:../tagihan.php?pesan=gagal");
}
?>