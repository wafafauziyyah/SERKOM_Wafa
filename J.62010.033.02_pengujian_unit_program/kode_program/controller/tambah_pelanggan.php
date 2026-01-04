<?php 
session_start();
include '../services/koneksi.php';

$username       = $_POST['username'];
$password       = md5($_POST['password']);
$nomor_kwh      = $_POST['nomor_kwh'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$alamat         = $_POST['alamat'];
$id_tarif       = $_POST['id_tarif'];

$query = "INSERT INTO pelanggan (username, password, nomor_kwh, nama_pelanggan, alamat, id_tarif) 
          VALUES ('$username', '$password', '$nomor_kwh', '$nama_pelanggan', '$alamat', '$id_tarif')";

$exec = mysqli_query($koneksi, $query);

if($exec){
    header("location:../pelanggan.php?pesan=simpan_sukses");
} else {
    header("location:../pelanggan.php?pesan=gagal");
}
?>