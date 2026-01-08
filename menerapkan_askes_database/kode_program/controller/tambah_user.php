<?php 
session_start();


include '../services/koneksi.php';

$nama_admin = $_POST['nama_admin'];
$username   = $_POST['username'];
$password   = md5($_POST['password']);
$id_level   = $_POST['id_level'];


$query = "INSERT INTO user (username, password, nama_admin, id_level) 
          VALUES ('$username', '$password', '$nama_admin', '$id_level')";

$exec = mysqli_query($koneksi, $query);


if($exec){
    header("location:../user.php?pesan=simpan_sukses");
} else {
    header("location:../user.php?pesan=gagal");
}
?>