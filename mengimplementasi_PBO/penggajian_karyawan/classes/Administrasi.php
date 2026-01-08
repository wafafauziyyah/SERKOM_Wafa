<?php
namespace Classes;

use Core\pegawai;

class Administrasi extends pegawai
{
    private float $tunjangan = 0;

    private function hitungTunjangan(): float
    {
        $lamaKerja = $this->getLamaKerja();

        if ($lamaKerja >= 5) {
            return 0.03 * $this->gajiPokok;
        } elseif ($lamaKerja >= 3) {
            return 0.01 * $this->gajiPokok;
        }
        return 0;
    }

    public function hitungGajiAkhir(): float
    {
        $this->tunjangan = $this->hitungTunjangan();
        return $this->gajiPokok + $this->tunjangan;
    }
}
