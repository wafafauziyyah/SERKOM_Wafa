<?php 
session_start();
include '../services/koneksi.php';

$daya = $_POST['daya'];
$tarif = $_POST['tarifperkwh'];


if($daya <= 900){
    $golongan = "R1";
} elseif($daya <= 2200) {
    $golongan = "R1M"; 
} else {
    $golongan = "R2"; 
}


$query = "INSERT INTO tarif (golongan, daya, tarifperkwh) VALUES ('$golongan', '$daya', '$tarif')";
$exec = mysqli_query($koneksi, $query);

if($exec){
    header("location:../tarif.php?pesan=simpan_sukses");
} else {
    header("location:../tarif.php?pesan=gagal");
}
?>