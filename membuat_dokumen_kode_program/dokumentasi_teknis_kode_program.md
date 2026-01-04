# DOKUMENTASI TEKNIS KODE PROGRAM

**Kode Unit:** J.620100.023.02  
**Judul Unit:** Membuat Dokumen Kode Program

---

## BAB 1. IDENTIFIKASI KODE PROGRAM

### 1.1 Identifikasi Modul

Program ini terdiri dari satu modul utama (script) dan menggunakan dua modul pustaka standar Python:

- **Modul Utama (main script):**  
  Mengatur alur logika program mulai dari input pengguna, pemrosesan data (sorting), hingga penyimpanan output.
- **Library `os`:**  
  Digunakan untuk interaksi dengan sistem operasi, seperti memanipulasi path folder (`os.path.join`), membuat direktori (`os.makedirs`), dan membersihkan layar konsol.
- **Library `time`:**  
  Digunakan untuk fitur pengukuran performansi, yaitu menghitung durasi waktu eksekusi algoritma pengurutan (`time.perf_counter`).

### 1.2 Identifikasi Parameter

Parameter yang digunakan dalam fungsi-fungsi program ini meliputi:

- **List (Array):** Variabel `data_angka` digunakan untuk menampung sekumpulan bilangan bulat.
- **Integer:** Variabel `indeks1`, `indeks2`, `i`, `j`, dan `n` digunakan sebagai penunjuk posisi iterasi.
- **String:** Konstanta `NAMA_FILE` dan `NAMA_FOLDER` sebagai parameter lokasi penyimpanan.

### 1.3 Cara Kerja Algoritma (Bubble Sort)

Algoritma yang digunakan adalah **Bubble Sort** dengan metode pengurutan **Ascending (kecil ke besar)**:

1. Program menerima input array berisi *n* angka.
2. Program melakukan perulangan sebanyak *n* kali.
3. Di dalam perulangan, dilakukan perbandingan elemen ke-*j* dengan elemen ke-*j+1*.
4. Jika `data[j] > data[j+1]`, maka kedua elemen ditukar.
5. Proses diulang hingga seluruh array terurut.

---

## BAB 2. DOKUMENTASI FUNGSI DAN PROSEDUR

<table>
<thead>
<tr>
<th>Nama Fungsi</th>
<th>Tipe</th>
<th>Parameter</th>
<th>Deskripsi Kegunaan</th>
<th>Kemungkinan Eksepsi</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>tukar_data</code></td>
<td>Fungsi</td>
<td><code>data</code> (list), <code>indeks1</code> (int), <code>indeks2</code> (int)</td>
<td>Menukar posisi dua nilai di dalam list.</td>
<td><code>IndexError</code></td>
</tr>
<tr>
<td><code>urutkan_angka</code></td>
<td>Prosedur</td>
<td><code>data_angka</code> (list)</td>
<td>Mengurutkan list secara ascending menggunakan Bubble Sort.</td>
<td>-</td>
</tr>
<tr>
<td><code>simpan_file</code></td>
<td>Prosedur</td>
<td><code>data_angka</code> (list)</td>
<td>Menyimpan data terurut ke file <code>.txt</code>.</td>
<td><code>IOError</code>, <code>OSError</code></td>
</tr>
<tr>
<td><code>baca_file</code></td>
<td>Prosedur</td>
<td>-</td>
<td>Membaca file hasil pengurutan dan menampilkannya.</td>
<td><code>FileNotFoundError</code></td>
</tr>
<tr>
<td><code>input_data</code></td>
<td>Prosedur</td>
<td>-</td>
<td>Menangani input user dan mengukur waktu eksekusi sorting.</td>
<td><code>ValueError</code></td>
</tr>
</tbody>
</table>

---

## BAB 3. KODE SUMBER (SOURCE CODE)

```python
import os
import time

NAMA_FILE = "hasil_urut.txt"
NAMA_FOLDER = "J.620100.016.01_coding_guidelines"

def tukar_data(data, indeks1, indeks2):
    temp = data[indeks1]
    data[indeks1] = data[indeks2]
    data[indeks2] = temp

def urutkan_angka(data_angka):
    n = len(data_angka)
    for i in range(n):
        for j in range(0, n - i - 1):
            if data_angka[j] > data_angka[j + 1]:
                tukar_data(data_angka, j, j + 1)

def simpan_file(data_angka):
    path_lengkap = os.path.join(NAMA_FOLDER, NAMA_FILE)
    if not os.path.exists(NAMA_FOLDER):
        os.makedirs(NAMA_FOLDER)
    with open(path_lengkap, "w") as file:
        file.write(", ".join(map(str, data_angka)))

def baca_file():
    path_lengkap = os.path.join(NAMA_FOLDER, NAMA_FILE)
    with open(path_lengkap, "r") as file:
        print(file.read())

def input_data():
    jumlah = int(input("Masukkan jumlah angka: "))
    data_angka = [int(input(f"Angka {i+1}: ")) for i in range(jumlah)]
    start = time.perf_counter()
    urutkan_angka(data_angka)
    end = time.perf_counter()
    simpan_file(data_angka)
    print(f"Waktu eksekusi: {end - start:.6f} detik")

def main():
    input_data()

if __name__ == "__main__":
    main()
```

---

## BAB 4. GENERATE DOKUMENTASI (HTML)

### 4.1 Identifikasi Tools

- **Nama Tool:** `pydoc`  
- **Fungsi:** Menghasilkan dokumentasi HTML dari docstring Python.

### 4.2 Langkah Generate

```bash
python -m pydoc -w coding_guidelines
```

### 4.3 Troubleshooting

- **No module named ...**  
  Pastikan nama file tidak mengandung spasi.
- **Python tidak dikenali**  
  Pastikan Python sudah ditambahkan ke *Environment Variables*.
