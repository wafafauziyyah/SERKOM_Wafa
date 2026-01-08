<?php
namespace Classes;

use Core\pegawai;

class satpam extends pegawai
{
    private int $jamLembur;

    // Overloading (default parameter)
    public function __construct(
        string $nip,
        string $nama,
        int $tahunMasuk,
        float $gajiPokok,
        int $jamLembur = 0
    ) {
        parent::__construct($nip, $nama, $tahunMasuk, $gajiPokok);
        $this->jamLembur = $jamLembur;
    }

    public function hitungGajiAkhir(): float
    {
        return $this->gajiPokok + ($this->jamLembur * 20000);
    }
}
