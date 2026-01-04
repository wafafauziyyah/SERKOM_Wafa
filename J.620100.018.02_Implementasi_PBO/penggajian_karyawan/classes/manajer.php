<?php
namespace Classes;

use Core\pegawai;

class manajer extends pegawai
{
    private float $persenKenaikanPenjualan;

    public function __construct(
        string $nip,
        string $nama,
        int $tahunMasuk,
        float $gajiPokok,
        float $persen
    ) {
        parent::__construct($nip, $nama, $tahunMasuk, $gajiPokok);
        $this->persenKenaikanPenjualan = $persen;
    }

    private function hitungBonus(): float
    {
        if ($this->persenKenaikanPenjualan > 10) {
            return 0.10 * $this->gajiPokok;
        } elseif ($this->persenKenaikanPenjualan >= 6) {
            return 0.05 * $this->gajiPokok;
        } elseif ($this->persenKenaikanPenjualan >= 1) {
            return 0.02 * $this->gajiPokok;
        }
        return 0;
    }

    public function hitungGajiAkhir(): float
    {
        return $this->gajiPokok + $this->hitungBonus();
    }
}
