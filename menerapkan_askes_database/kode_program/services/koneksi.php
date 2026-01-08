<?php
// Konfigurasi Database
$host       = "localhost";
$user       = "root";  
$password   = ""; 
$database   = "serkom";


$koneksi = mysqli_connect($host, $user, $password, $database);


if (!$koneksi) {

    die("Koneksi Database Gagal: " . mysqli_connect_error());
}

$base_url = "http://j.620100.021.02_menerapkan_askes_database.test/kode_program/login.php";
?>