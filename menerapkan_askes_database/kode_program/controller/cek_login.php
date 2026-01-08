<?php 
session_start();
include '../services/koneksi.php';
 

$username = $_POST['username'];
$password = $_POST['password']; 
 
$data = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username' AND password='$password'");
 

$cek = mysqli_num_rows($data);
 
if($cek > 0){

    $row = mysqli_fetch_assoc($data);

    $_SESSION['username'] = $username;
    $_SESSION['nama_admin'] = $row['nama_admin'];
    $_SESSION['id_level'] = $row['id_level'];
    $_SESSION['status'] = "login";
    
    header("location:../dashboard.php");
}else{
    header("location:../login.php?pesan=gagal");
}
?>