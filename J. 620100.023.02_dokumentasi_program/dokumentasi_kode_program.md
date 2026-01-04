# DOKUMENTASI TEKNIS KODE PROGRAM
**Kode Unit:** J.620100.023.02 
**Judul Unit:** Membuat Dokumen Kode Program

---

## BAB 1. IDENTIFIKASI KODE PROGRAM

### 1.1 Identifikasi Modul
Program ini terdiri dari satu modul utama (script) dan menggunakan dua modul pustaka standar Python:
1.  **Modul Utama (`main script`):** Mengatur alur logika program mulai dari input pengguna, pemrosesan data (sorting), hingga penyimpanan output.
2.  **Library `os`:** Digunakan untuk interaksi dengan sistem operasi, seperti memanipulasi path folder (`os.path.join`), membuat direktori (`os.makedirs`), dan membersihkan layar konsol.
3.  **Library `time`:** Digunakan untuk fitur pengukuran performansi, yaitu menghitung durasi waktu eksekusi algoritma pengurutan (`time.perf_counter`).

### 1.2 Identifikasi Parameter
Parameter yang digunakan dalam fungsi-fungsi program ini meliputi:
* **List (Array):** Variabel `data_angka` digunakan untuk menampung sekumpulan bilangan bulat.
* **Integer:** Variabel `indeks1`, `indeks2`, `i`, `j`, dan `n` digunakan sebagai penunjuk posisi iterasi dalam algoritma.
* **String:** Konstanta `NAMA_FILE` dan `NAMA_FOLDER` sebagai parameter lokasi penyimpanan.

### 1.3 Cara Kerja Algoritma (Bubble Sort)
Algoritma yang digunakan adalah **Bubble Sort** dengan metode pengurutan **Ascending** (kecil ke besar). Berikut langkah kerjanya:
1.  Program menerima input array berisi $n$ angka.
2.  Program melakukan perulangan (loop) sebanyak $n$ kali.
3.  Di dalam perulangan tersebut, terdapat perulangan kedua untuk membandingkan elemen saat ini ($j$) dengan elemen di sebelahnya ($j+1$).
4.  Jika elemen kiri lebih besar dari elemen kanan (`data[j] > data[j+1]`), maka posisi keduanya ditukar.
5.  Langkah ini diulang terus-menerus hingga seluruh array terurut dan tidak ada lagi pertukaran yang terjadi.

---

## BAB 2. DOKUMENTASI FUNGSI DAN PROSEDUR

Tabel berikut menjelaskan rincian fungsi, parameter, kegunaan, dan kemungkinan eksepsi (error handling) yang diterapkan.

| Nama Fungsi | Tipe | Parameter | Deskripsi Kegunaan | Kemungkinan Eksepsi (Exception) |
| :--- | :--- | :--- | :--- | :--- |
| `tukar_data` | Fungsi | `data` (list), `indeks1` (int), `indeks2` (int) | Menukar posisi dua nilai di dalam list berdasarkan indeks yang diberikan. | `IndexError`: Jika indeks yang diminta melebihi panjang array. |
| `urutkan_angka` | Prosedur | `data_angka` (list) | Mengimplementasikan logika Bubble Sort untuk mengurutkan list secara ascending. | - |
| `simpan_file` | Prosedur | `data_angka` (list) | Menyimpan hasil list yang sudah terurut ke dalam file `.txt` di folder yang ditentukan. | `IOError`: Gagal menulis file (disk penuh/permission).<br>`OSError`: Gagal membuat direktori. |
| `baca_file` | Prosedur | - | Membaca file hasil simpanan dari disk dan menampilkannya ke layar konsol. | `FileNotFoundError`: File belum ada karena user belum melakukan input. |
| `input_data` | Prosedur | - | Menangani antarmuka input user, memanggil fungsi sorting, dan mengukur waktu eksekusi. | `ValueError`: Pengguna memasukkan karakter huruf saat diminta angka. |

---

## BAB 3. KODE SUMBER (SOURCE CODE)
Berikut adalah kode program lengkap yang telah dilengkapi komentar (docstrings) untuk memudahkan pembacaan oleh pihak lain.

```python
import os   # Modul untuk interaksi dengan Sistem Operasi
import time # Modul untuk fungsi waktu (menghitung durasi eksekusi)

# --- KONSTANTA GLOBAL ---
NAMA_FILE = "hasil_urut.txt"
NAMA_FOLDER = "J.620100.016.01_coding_guidelines"

def tukar_data(data, indeks1, indeks2):
    """
    Fungsi helper untuk menukar posisi dua data dalam list.
    Args:
        data (list): List angka.
        indeks1 (int): Indeks elemen pertama.
        indeks2 (int): Indeks elemen kedua.
    """
    temp = data[indeks1]
    data[indeks1] = data[indeks2]
    data[indeks2] = temp

def urutkan_angka(data_angka):
    """
    Algoritma Bubble Sort untuk mengurutkan data (Ascending).
    Args:
        data_angka (list): List integer yang akan diurutkan.
    """
    n = len(data_angka)
    # Loop untuk setiap pass
    for i in range(n):
        # Loop untuk membandingkan elemen berdekatan
        for j in range(0, n - i - 1):
            if data_angka[j] > data_angka[j + 1]:
                tukar_data(data_angka, j, j + 1)

def simpan_file(data_angka):
    """
    Prosedur untuk menyimpan hasil array ke file dalam folder tujuan.
    Menangani pembuatan folder secara otomatis jika belum ada.
    """
    path_lengkap = os.path.join(NAMA_FOLDER, NAMA_FILE)

    try:
        if not os.path.exists(NAMA_FOLDER):
            os.makedirs(NAMA_FOLDER)

        with open(path_lengkap, "w") as file:
            data_str = ", ".join(map(str, data_angka))
            file.write(data_str)
        print(f"Data berhasil tersimpan di folder '{NAMA_FOLDER}'")
    except IOError:
        print("Gagal menyimpan file")

def baca_file():
    """
    Prosedur membaca file txt dan menampilkan isinya ke layar.
    Menangani error jika file belum dibuat.
    """
    path_lengkap = os.path.join(NAMA_FOLDER, NAMA_FILE)

    print("\nTampil Hasil Pengurutan")
    print("-" * 30)
    try:
        with open(path_lengkap, "r") as file:
            isi = file.read()
            if isi:
                print(f"Nilai Tugas : {isi}")
            else:
                print("File Kosong/data nilai tugas belum diinput")
    except FileNotFoundError:
        print(f"File tidak ditemukan di folder '{NAMA_FOLDER}'.")
        print("Silahkan input data terlebih dahulu!")
    print("-" * 30)
    input("\nTekan Enter untuk kembali ke Menu Awal...")

def input_data():
    """
    Menu input data dan eksekusi pengurutan angka.
    Mencakup fitur pengukuran efisiensi waktu (performance timer).
    """
    os.system('cls' if os.name == 'nt' else 'clear')
    print("INPUT ANGKA")
    print("-" * 30)
    try:
        jumlah = int(input("Masukkan jumlah angka yang akan diinput : "))
        data_angka = []
        
        print("Input angka secara acak \n-------------------------------------------------")
        for i in range(jumlah):
            nilai = int(input(f"Angka {i + 1} : "))
            data_angka.append(nilai)
            
        print("\nMemproses pengurutan...")
        start_time = time.perf_counter() # Mulai Timer
        
        urutkan_angka(data_angka)
        
        end_time = time.perf_counter()   # Stop Timer
        durasi = end_time - start_time
        
        simpan_file(data_angka)
        
        print("-" * 30)
        print(f"Efisiensi Waktu Sorting: {durasi:.6f} detik")
        print("-" * 30)
        
        input("\nData Berhasil diurutkan dan disimpan. Tekan ENTER untuk kembali...")
    except ValueError:
        print("Input harus berupa angka bilangan bulat !")
        input("Tekan ENTER untuk kembali...")

def main():
    """Main Entry Point Program."""
    while True:
        os.system('cls' if os.name == 'nt' else 'clear')
        print("MENU PILIHAN")
        print("1. Input Angka")
        print("2. Tampil Hasil Pengurutan")
        print("3. Selesai")
        
        pilihan = input("Masukkan Pilihan [1/2/3] : ")
        
        if pilihan == '1':
            input_data()
        elif pilihan == '2':
            baca_file()
        elif pilihan == '3':
            print("Program Selesai.")
            break
        else:
            input("Input pilihan tidak valid. Silahkan ulangi!")

if __name__ == "__main__":
    main()

```

## BAB 4. GENERATE DOKUMENTASI (HTML)
Sesuai langkah kerja poin 4, dokumentasi otomatis dapat dibuat menggunakan tools bawaan Python yaitu ```pydoc```

### 4.1 Identifikasi Tools
Nama Tool: ```pydoc (Python Documentation Generator).```
Fungsi: Membaca Docstring ( komentar ```"""..."""``` ) di dalam kode dan mengubahnya menjadi halaman HTML yang rapi.

### 4.2 Langkah Generate Dokumentasi
Buka Terminal atau Command Prompt (CMD).
Arahkan direktori ke folder tempat file Python disimpan.
Jalankan perintah berikut (asumsi nama file adalah ```main.py```):

```Bash
python -m pydoc -w coding_guidelines
```
Jika berhasil, akan muncul pesan wrote coding_guidelines.html.
Buka file ```coding_guidelines.html``` menggunakan browser untuk melihat dokumentasi API program.

### 4.3 Solusi Kendala (Troubleshooting)
Jika proses generate gagal, lakukan langkah perbaikan berikut:
Kendala: ```No module named ...```
Solusi: Pastikan nama file tidak mengandung spasi. Ubah nama ```file.py``` menjadi ```nama_file.py```.
Kendala: Perintah python tidak dikenali.
Solusi: Gunakan perintah ```py`` atau tambahkan Python ke Environment Variables sistem operasi.