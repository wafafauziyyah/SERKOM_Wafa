<?php
require_once 'Interfaces/Ui_penggajian.php';
require_once 'Core/Pegawai.php';
require_once 'Classes/Satpam.php';
require_once 'Classes/Sales.php';
require_once 'Classes/Administrasi.php';
require_once 'Classes/Manajer.php';
require_once 'Entity/SlipGaji.php';

use Classes\Satpam;
use Classes\Sales;
use Classes\Administrasi;
use Classes\Manajer;
use Entity\SlipGaji;

$pegawaiList = [
    new Satpam("001", "Seli", 2024, 3000000, 10),
    new Sales("002", "Doni", 2020, 3500000, 8),
    new Administrasi("003", "Cia", 2020, 4000000),
    new Manajer("004", "Seni", 2019, 7000000, 12)
];

// Header Tabel
echo "\n";
echo "========================================================================\n";
echo "                    PT ARGO INDUSTRI - PAYROLL REPORT                   \n";
echo "========================================================================\n";
printf("| %-6s | %-15s | %-12s | %-15s | %-12s |\n", "NIP", "NAMA", "JABATAN", "TANGGAL", "TOTAL GAJI");
echo "------------------------------------------------------------------------\n";

foreach ($pegawaiList as $pegawai) {
    // Hitung Gaji
    $gajiAkhir = $pegawai->hitungGajiAkhir();
    $jabatan = (new ReflectionClass($pegawai))->getShortName();

    printf(
        "| %-6s | %-15s | %-12s | %-15s | Rp %9s |\n", 
        $pegawai->getNip(), 
        $pegawai->getNama(), 
        $jabatan,
        date('d-m-Y'),
        number_format($gajiAkhir, 0, ',', '.')
    );
}

echo "========================================================================\n\n";