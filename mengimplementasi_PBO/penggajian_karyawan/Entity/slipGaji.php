<?php
namespace Entity;

class SlipGaji
{
    private string $nip;
    private string $nama;
    private string $tanggal;
    private float $gajiAkhir;

    public function __construct(
        string $nip,
        string $nama,
        string $tanggal,
        float $gajiAkhir
    ) {
        $this->nip = $nip;
        $this->nama = $nama;
        $this->tanggal = $tanggal;
        $this->gajiAkhir = $gajiAkhir;
    }

    public function cetakSlip(): void
    {
        echo "<hr>";
        echo "NIP        : {$this->nip}<br>";
        echo "Nama       : {$this->nama}<br>";
        echo "Tanggal    : {$this->tanggal}<br>";
        echo "Gaji Akhir : Rp " . number_format($this->gajiAkhir, 0, ',', '.') . "<br>";
    }

    public function getGajiAkhir(): float
    {
        return $this->gajiAkhir;
    }
}
