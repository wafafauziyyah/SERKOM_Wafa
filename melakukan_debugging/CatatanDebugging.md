# Laporan Debugging Program - Unit J.620100.025.02

**Nama Folder:** melakukan_debugging
**Target File:** melakukan_debugging.py

---

### Kesalahan 1: Parameter Fungsi len()
#### Tahap 1: Pencatatan Kesalahan
* **Jenis:** Runtime Error (Semantic).
* **Pesan:** `TypeError: len() takes exactly one argument (0 given)`.
* **Baris:** 13 (dalam fungsi `urutkan_angka`).
* **Penyebab:** Fungsi `len()` dipanggil tanpa argumen, sehingga program tidak tahu panjang data mana yang harus dihitung.

#### Tahap 2: Perbaiki Program
* **Analisis:** Fungsi `len()` membutuhkan objek (dalam hal ini list `data_angka`) untuk menghitung jumlah elemennya.
* **Solusi:** Menambahkan variabel `data_angka` ke dalam kurung `len()`.
* **Eksekusi:** Mengubah `n = len()` menjadi `n = len(data_angka)`.

---

### Kesalahan 2: Parameter Fungsi simpan_ke_file()
#### Tahap 1: Pencatatan Kesalahan
* **Jenis:** Runtime Error (TypeError).
* **Pesan:** `TypeError: simpan_ke_file() takes 0 positional arguments but 1 was given`.
* **Baris:** 63 (dalam fungsi `menu_input_data`).
* **Penyebab:** Fungsi `simpan_ke_file` dipanggil dengan argumen `hasil_urut`, tetapi definisi fungsi tersebut tidak memiliki parameter untuk menerima data.

#### Tahap 2: Perbaiki Program
* **Analisis:** Agar fungsi dapat menyimpan data hasil pengurutan, fungsi tersebut harus didefinisikan untuk menerima satu input (list).
* **Solusi:** Menambahkan parameter pada definisi fungsi `simpan_ke_file`.
* **Eksekusi:** Mengubah `def simpan_ke_file():` menjadi `def simpan_ke_file(data_angka):`.

---

### Verifikasi Akhir
Setelah perbaikan dilakukan, program dijalankan kembali (F5). Hasil pengujian menunjukkan:
1. Input data angka berhasil diterima.
2. Proses pengurutan (sorting) berjalan tanpa error.
3. Data berhasil disimpan ke dalam file `hasil_urut.txt` di folder tujuan.