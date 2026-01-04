# Laporan Uji Kompetensi: Menggunakan Spesifikasi Program

**Unit Kompetensi:** J.620100.009.02  
**Judul:** Menggunakan Spesifikasi Program  
**Bahasa Pemrograman:** PHP  

---

## C. Langkah Kerja

### 1. Gunakan Metode Pengembangan Program

#### a. Definisikan metode pengembangan aplikasi (software development)
Metode pengembangan aplikasi yang didefinisikan dalam pengerjaan proyek ini adalah **Object-Oriented Analysis and Design (OOAD)**. Metode ini berfokus pada pemodelan sistem perangkat lunak sebagai kumpulan objek yang saling berinteraksi, di mana setiap objek merepresentasikan entitas nyata (seperti Pegawai, Slip Gaji) yang memiliki atribut data dan perilaku (*method*) tertentu.

#### b. Pilih metode pengembangan aplikasi (software development) sesuai kebutuhan
Berdasarkan spesifikasi kebutuhan PT Argo Industri, saya memilih model **SDLC Waterfall** dengan pendekatan **OOP (Object Oriented Programming)**. Pendekatan ini dipilih karena PHP mendukung konsep *Inheritance* (pewarisan) dan *Polymorphism* serta mendukung implementasi arsitektur MVC sederhana sesuai diagram komponen yang dirancang.

---

### 2. Gunakan Diagram Program dan Deskripsi Program

#### a. Definisikan Diagram program dengan metodologi pengembangan sistem
Diagram program didefinisikan menggunakan standar **UML (Unified Modeling Language)**. Desain ini mencakup *Class Diagram* untuk struktur logika data dan *Component Diagram* untuk alur arsitektur aplikasi.

#### b. Gunakan metode pemodelan, diagram objek dan diagram komponen pada implementasi program sesuai dengan spesifikasi
Pemodelan sistem dirancang sebagai berikut:

1.  **Component Diagram (Arsitektur):** Mengikuti pola input-proses-output yang terstruktur sesuai prinsip MVC:
    * **UI Input:** Bagian eksekusi kode (Form/Input).
    * **Controller:** Mengatur alur data (`PenggajianController`).
    * **Service:** Logika perhitungan gaji (`Pegawai` dan turunannya).
    * **Entity:** Objek hasil data (`SlipGaji`).

2.  **Class Diagram (Struktur Kode):**
    * **Parent Class:** `Pegawai` (Abstract) yang mewariskan properti umum.
    * **Child Classes:** `Satpam`, `Sales`, `Administrasi`, `Manajer` yang memiliki logika perhitungan spesifik.
    * **Output Class:** `SlipGaji` (Class terpisah untuk menangani format cetak).

---

### 3. Terapkan Hasil Pemodelan dalam Pengembangan Program

#### a. Pilih hasil pemodelan yang mendukung kemampuan metodologi sesuai spesifikasi
Hasil pemodelan Class Diagram diimplementasikan secara ketat:
* Atribut `nip`, `nama`, `gajiPokok` di-set sebagai *protected* untuk keamanan data (Encapsulation).
* Metode spesifik seperti `hitungBonus()` pada Manajer dan `hitungTunjangan()` pada Administrasi dibuat terpisah sebelum dijumlahkan ke gaji akhir, sesuai rancangan diagram.

#### b. Hasil pemrograman (IDE) yang mendukung kemampuan metodologi bahasa pemrograman dipilih sesuai spesifikasi
Kode program disusun menggunakan **Visual Studio Code (VS Code)**. Kode dipisahkan berdasarkan layer arsitektur (Logic, Controller, dan Entity).

Berikut adalah implementasi kode program PHP yang **sesuai dengan diagram**:

```php
<?php

// ==========================================
// ENTITY
// ==========================================
class SlipGaji {
    private $tanggal;
    private $gajiAkhir;

    public function __construct($gajiAkhir) {
        $this->tanggal = date("Y-m-d");
        $this->gajiAkhir = $gajiAkhir;
    }

    public function cetakSlip($nip, $nama) {
        echo "---------------------------------\n";
        echo "       SLIP GAJI PEGAWAI         \n";
        echo "---------------------------------\n";
        echo "Tanggal    : " . $this->tanggal . "\n";
        echo "NIP        : " . $nip . "\n";
        echo "Nama       : " . $nama . "\n";
        echo "Gaji Akhir : Rp " . number_format($this->gajiAkhir, 0, ',', '.') . "\n";
        echo "---------------------------------\n\n";
    }
}

// ==========================================
// SERVICE 
// ==========================================
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

    protected function getLamaKerja() {
        return date("Y") - $this->tahunMasuk;
    }

    abstract public function hitungGajiAkhir();
}

class Satpam extends Pegawai {
    private $jamLembur;

    public function __construct($nip, $nama, $thn, $gapok, $jamLembur) {
        parent::__construct($nip, $nama, $thn, $gapok);
        $this->jamLembur = $jamLembur;
    }

    public function hitungGajiAkhir() {
        return $this->gajiPokok + ($this->jamLembur * 20000);
    }
}

class Sales extends Pegawai {
    private $jumlahPelanggan;

    public function __construct($nip, $nama, $thn, $gapok, $jumlahPelanggan) {
        parent::__construct($nip, $nama, $thn, $gapok);
        $this->jumlahPelanggan = $jumlahPelanggan;
    }

    public function hitungGajiAkhir() {
        return $this->gajiPokok + ($this->jumlahPelanggan * 50000);
    }
}

class Administrasi extends Pegawai {
    private function hitungTunjangan() {
        $lama = $this->getLamaKerja();
        if ($lama >= 5) return 0.03 * $this->gajiPokok;
        if ($lama >= 3) return 0.01 * $this->gajiPokok;
        return 0;
    }

    public function hitungGajiAkhir() {
        return $this->gajiPokok + $this->hitungTunjangan();
    }
}

class Manajer extends Pegawai {
    private $persenPeningkatan;

    public function __construct($nip, $nama, $thn, $gapok, $persenPeningkatan) {
        parent::__construct($nip, $nama, $thn, $gapok);
        $this->persenPeningkatan = $persenPeningkatan;
    }

    private function hitungBonus() {
        if ($this->persenPeningkatan > 10) return 0.10 * $this->gajiPokok;
        if ($this->persenPeningkatan >= 6) return 0.05 * $this->gajiPokok;
        if ($this->persenPeningkatan >= 1) return 0.02 * $this->gajiPokok;
        return 0;
    }

    public function hitungGajiAkhir() {
        return $this->gajiPokok + $this->hitungBonus();
    }
}

// ==========================================
// CONTROLLER 
// ==========================================
class PenggajianController {
    public function prosesGaji(Pegawai $pegawai) {
        $totalGaji = $pegawai->hitungGajiAkhir();
        $slip = new SlipGaji($totalGaji);
        $slip->cetakSlip($pegawai->getNip(), $pegawai->getNama());
    }
}

// ==========================================
// UI / MAIN PROGRAM
// ==========================================

$controller = new PenggajianController();

echo "=== APLIKASI PENGGAJIAN PT ARGO INDUSTRI ===\n\n";

// Skenario 1: Satpam
$satpam = new Satpam("S001", "Budi (Satpam)", 2021, 3000000, 5);
$controller->prosesGaji($satpam);

// Skenario 2: Manajer
$manajer = new Manajer("M001", "Susi (Manajer)", 2018, 8000000, 11);
$controller->prosesGaji($manajer);

// Skenario 3: Administrasi
$admin = new Administrasi("A005", "Rina (Admin)", 2019, 4000000);
$controller->prosesGaji($admin);

?>