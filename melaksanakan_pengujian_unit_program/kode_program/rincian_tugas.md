# Laporan Prosedur Uji Coba Aplikasi (Software Testing Documentation)

**Nama Aplikasi:** Listrik Pascabayar  
**Versi:** 1.0  
**Tanggal Dokumen:** 8 Januari 2026  

---

## 1. Tentukan Kebutuhan Uji Coba dalam Pengembangan

### a. Identifikasi Prosedur Uji Coba sesuai SDLC
Pengujian dilakukan pada tahap **Testing** dalam siklus hidup pengembangan perangkat lunak (*Software Development Life Cycle* / SDLC) model Waterfall/Agile.
* **Unit Testing:** Dilakukan oleh developer saat pembuatan modul fungsi perhitungan (White Box).
* **System Testing:** Dilakukan setelah integrasi modul (Black Box) untuk memvalidasi alur fungsi dari Login hingga Pembayaran.
* **User Acceptance Testing (UAT):** Simulasi penggunaan oleh end-user (Admin/Petugas).

### b. Tentukan Tools Uji Coba
Alat bantu yang digunakan dalam proses pengujian:
1.  **PHPUnit (v9.6):** Untuk pengujian otomatis unit program (logika perhitungan).
2.  **Browser (Chrome/Edge):** Untuk pengujian antarmuka dan fungsionalitas (Black Box).
3.  **Laragon/MySQL:** Untuk memvalidasi integritas data di database.
4.  **Visual Studio Code:** Editor kode untuk debugging.

### c. Identifikasi Standar dan Kondisi Uji Coba
* **Standar Valid:**
    * Sistem mampu menghitung tagihan dengan akurasi 100% sesuai rumus: `(Meter Akhir - Meter Awal) * Tarif`.
    * Sistem mampu menyimpan data ke database tanpa redundansi.
* **Kondisi Pengujian:**
    * **Normal:** Input data sesuai format (Angka untuk meteran, String untuk nama).
    * **Abnormal (Negative):** Input data tidak valid (Meter akhir < Meter awal, Username kosong).
    * **Boundary (Batas):** Input nilai 0 atau nilai sangat besar.

---

## 2. Persiapkan Dokumentasi Uji Coba

### Kebutuhan Uji Coba
Fokus utama pengujian adalah **Modul Transaksi Tagihan**, karena merupakan inti bisnis aplikasi yang melibatkan perhitungan uang.

### Skenario Uji Coba (Test Scenarios)
1.  **Skenario Login:** Memastikan keamanan akses.
2.  **Skenario Input Tagihan:** Memastikan logika meteran listrik valid.
3.  **Skenario Edit & Hapus:** Memastikan integritas data (tidak bisa hapus jika sudah lunas).

---

## 3. Persiapkan Data Uji

### a. Identifikasi Data Uji Unit Tes
Data uji disiapkan untuk mewakili kondisi tarif subsidi (R1) dan non-subsidi, serta kondisi error.

### b. Bangkitkan Data Uji (Test Data Generation)

<p><strong>Tabel Data Uji Unit (Logika Perhitungan):</strong></p>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>ID Data</th>
            <th>Meter Awal</th>
            <th>Meter Akhir</th>
            <th>Tarif (Rp)</th>
            <th>Ekspektasi Hasil</th>
            <th>Kategori</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>DT-U1</td>
            <td>1000</td>
            <td>1200</td>
            <td>1500</td>
            <td>300.000</td>
            <td>Normal</td>
        </tr>
        <tr>
            <td>DT-U2</td>
            <td>2500</td>
            <td>2510</td>
            <td>415</td>
            <td>4.150</td>
            <td>Normal (Kecil)</td>
        </tr>
        <tr>
            <td>DT-U3</td>
            <td>2000</td>
            <td>1000</td>
            <td>1500</td>
            <td><i>Exception Error</i></td>
            <td>Abnormal (Mustahil)</td>
        </tr>
    </tbody>
</table>

<p><strong>Tabel Data Uji Black Box (Fungsional):</strong></p>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>ID Data</th>
            <th>Username</th>
            <th>Password</th>
            <th>Ekspektasi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>DT-B1</td>
            <td>admin</td>
            <td>admin</td>
            <td>Login Sukses</td>
        </tr>
        <tr>
            <td>DT-B2</td>
            <td>admin</td>
            <td>salah123</td>
            <td>Login Gagal</td>
        </tr>
    </tbody>
</table>

---

## 4. Laksanakan Prosedur Uji Coba

### a. Desain Skenario Uji Coba
* **Tujuan:** Memvalidasi file `test/hitung_tagihan.php` dan `test/TagihanTest.php`.
* **Langkah:**
    1.  Siapkan object calculator.
    2.  Masukkan nilai awal, akhir, dan tarif.
    3.  Bandingkan hasil return function dengan hasil hitungan manual.

### b. Desain Prosedur Uji Coba dalam Algoritma
Algoritma yang diuji pada Unit Test:
```text
IF Meter_Akhir < Meter_Awal THEN
    RETURN Error "Meteran Mundur"
ELSE
    Jumlah_Meter = Meter_Akhir - Meter_Awal
    Total_Bayar = Jumlah_Meter * Tarif
    RETURN Jumlah_Meter, Total_Bayar
END IF