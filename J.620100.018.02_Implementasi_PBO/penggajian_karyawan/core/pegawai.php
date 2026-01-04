<?php
namespace Core;

use Interfaces\Ui_penggajian;

abstract class Pegawai implements Ui_penggajian
{
    protected string $nip;
    protected string $nama;
    protected int $tahunMasuk;
    protected float $gajiPokok;

    public function __construct(
        string $nip,
        string $nama,
        int $tahunMasuk,
        float $gajiPokok
    ) {
        $this->nip = $nip;
        $this->nama = $nama;
        $this->tahunMasuk = $tahunMasuk;
        $this->gajiPokok = $gajiPokok;
    }

    public function getNip(): string
    {
        return $this->nip;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getTahunMasuk(): int
    {
        return $this->tahunMasuk;
    }

    public function getGajiPokok(): float
    {
        return $this->gajiPokok;
    }

    public function getLamaKerja(): int
    {
        return date('Y') - $this->tahunMasuk;
    }

    abstract public function hitungGajiAkhir(): float;
}
