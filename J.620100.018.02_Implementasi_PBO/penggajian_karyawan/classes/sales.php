<?php
namespace Classes;

use Core\pegawai;

class sales extends pegawai
{
    private int $jumlahPelanggan;

    public function __construct(
        string $nip,
        string $nama,
        int $tahunMasuk,
        float $gajiPokok,
        int $jumlahPelanggan
    ) {
        parent::__construct($nip, $nama, $tahunMasuk, $gajiPokok);
        $this->jumlahPelanggan = $jumlahPelanggan;
    }

    public function hitungGajiAkhir(): float
    {
        return $this->gajiPokok + ($this->jumlahPelanggan * 50000);
    }
}
