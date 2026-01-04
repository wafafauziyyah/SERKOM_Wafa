# Laporan Uji Kompetensi: Menggunakan Spesifikasi Program

**Unit Kompetensi:** J.620100.009.02  
**Judul:** Menggunakan Spesifikasi Program  
**Bahasa Pemrograman:** PHP  

---

## C. Langkah Kerja

### 1. Gunakan Metode Pengembangan Program

#### a. Definisi metode pengembangan aplikasi
Metode pengembangan aplikasi yang digunakan adalah **Object-Oriented Analysis and Design (OOAD)**. Sistem dimodelkan dalam bentuk objek yang saling berinteraksi seperti Pegawai, SlipGaji, Controller, dan Service sesuai standar UML.

#### b. Metode pengembangan yang dipilih
Model **SDLC Waterfall** dengan pendekatan **Object Oriented Programming (OOP)** digunakan karena kebutuhan sistem sudah jelas dan mendukung pewarisan (*inheritance*) serta *polymorphism* sesuai diagram kelas.

---

### 2. Gunakan Diagram Program dan Deskripsi Program

#### a. Definisi diagram program
Diagram program menggunakan **Unified Modeling Language (UML)** yang terdiri dari:
- Component Diagram
- Class Diagram
- Object Diagram

#### b. Implementasi diagram sesuai spesifikasi

##### 1) Component Diagram
Arsitektur sistem penggajian terdiri dari:
- **UI Input & Cetak**: Input data dan cetak slip gaji
- **GajiController**: Mengatur alur proses penggajian
- **HitungGaji (Service)**: Logika perhitungan gaji
- **Database Penggajian Karyawan (Entity)**: Penyimpanan data

##### 2) Class Diagram
- **Pegawai (Abstract Class)**  
  Atribut umum: nip, nama, tahunMasuk, gajiPokok  
  Method abstrak: hitungGajiAkhir()

- **Satpam**
  Atribut: jamLembur

- **Sales**
  Atribut: jumlahPelanggan

- **Administrasi**
  Atribut: tunjangan

- **Manajer**
  Atribut: persenKenaikanPenjualan, bonus

- **SlipGaji**
  Atribut: tanggal, gajiAkhir  
  Method: cetakSlip(), getGajiAkhir()

---

### 3. Terapkan Hasil Pemodelan dalam Pengembangan Program

#### a. Implementasi sesuai pemodelan
- Atribut pada Pegawai menggunakan **protected**
- Method `hitungGajiAkhir()` bersifat **polymorphism**
- SlipGaji terpisah sebagai entity output

#### b. IDE yang digunakan
Pengembangan dilakukan menggunakan **Visual Studio Code (VS Code)**.

---

## Implementasi Program PHP

```php
<?php

// =======================
// ENTITY
// =======================
class SlipGaji {
    private $tanggal;
    private $gajiAkhir;

    public function __construct($tanggal, $gajiAkhir) {
        $this->tanggal = $tanggal;
        $this->gajiAkhir = $gajiAkhir;
    }

    public function getGajiAkhir() {
        return $this->gajiAkhir;
    }

    public function cetakSlip() {
        echo "Tanggal     : {$this->tanggal}\n";
        echo "Gaji Akhir  : Rp " . number_format($this->gajiAkhir, 0, ',', '.') . "\n\n";
    }
}

// =======================
// SERVICE
// =======================
abstract class Pegawai {
    protected $nip;
    protected $nama;
    protected $tahunMasuk;
    protected $gajiPokok;

    public function __construct($nip, $nama, $tahunMasuk, $gajiPokok) {
        $this->nip = $nip;
        $this->nama = $nama;
        $this->tahunMasuk = $tahunMasuk;
        $this->gajiPokok = $gajiPokok;
    }

    public function getNip() { return $this->nip; }
    public function getNama() { return $this->nama; }

    abstract public function hitungGajiAkhir();
}

class Satpam extends Pegawai {
    private $jamLembur;

    public function __construct($nip, $nama, $tahunMasuk, $gajiPokok, $jamLembur) {
        parent::__construct($nip, $nama, $tahunMasuk, $gajiPokok);
        $this->jamLembur = $jamLembur;
    }

    public function hitungGajiAkhir() {
        return $this->gajiPokok + ($this->jamLembur * 20000);
    }
}

class Sales extends Pegawai {
    private $jumlahPelanggan;

    public function __construct($nip, $nama, $tahunMasuk, $gajiPokok, $jumlahPelanggan) {
        parent::__construct($nip, $nama, $tahunMasuk, $gajiPokok);
        $this->jumlahPelanggan = $jumlahPelanggan;
    }

    public function hitungGajiAkhir() {
        return $this->gajiPokok + ($this->jumlahPelanggan * 50000);
    }
}

class Administrasi extends Pegawai {
    private $tunjangan;

    public function __construct($nip, $nama, $tahunMasuk, $gajiPokok, $tunjangan) {
        parent::__construct($nip, $nama, $tahunMasuk, $gajiPokok);
        $this->tunjangan = $tunjangan;
    }

    public function hitungGajiAkhir() {
        return $this->gajiPokok + $this->tunjangan;
    }
}

class Manajer extends Pegawai {
    private $bonus;

    public function __construct($nip, $nama, $tahunMasuk, $gajiPokok, $bonus) {
        parent::__construct($nip, $nama, $tahunMasuk, $gajiPokok);
        $this->bonus = $bonus;
    }

    public function hitungGajiAkhir() {
        return $this->gajiPokok + $this->bonus;
    }
}

// =======================
// CONTROLLER
// =======================
class GajiController {
    public function proses(Pegawai $pegawai) {
        $gaji = $pegawai->hitungGajiAkhir();
        $slip = new SlipGaji("01-01-2026", $gaji);
        echo "NIP  : {$pegawai->getNip()}\n";
        echo "Nama : {$pegawai->getNama()}\n";
        $slip->cetakSlip();
    }
}

// =======================
// UI
// =======================
$controller = new GajiController();

$controller->proses(new Satpam("001", "Seli", 2024, 3000000, 10));
$controller->proses(new Sales("002", "Donii", 2020, 3500000, 8));
$controller->proses(new Administrasi("003", "Cia", 2020, 4000000, 120000));
$controller->proses(new Manajer("004", "Seni", 2019, 7000000, 700000));
?>
