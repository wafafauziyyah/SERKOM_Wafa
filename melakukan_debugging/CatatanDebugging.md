### Tahap 1 : Pencatatan Kesalahan

Jenis: Runtime Error (Semantic).
Pesan: TypeError: len() takes exactly one argument (0 given).
Baris: 13.
Penyebab: Lupa memasukkan variabel ke dalam kurung len().


### Tahap 2: Perbaiki Program

Analisis: Fungsi len() butuh objek untuk dihitung.
Solusi: Tambahkan variabel data_angka ke dalam kurung len(...).
Eksekusi Perbaikan & Simpan
Edit Kode: Ubah baris 13 dari n = len() menjadi n = len(data_angka).
Simpan: Tekan Ctrl + S.

# Verifikasi Ulang: Jalankan kembali program (F5). Pastikan program sukses membuat file output dan tidak error lagi.