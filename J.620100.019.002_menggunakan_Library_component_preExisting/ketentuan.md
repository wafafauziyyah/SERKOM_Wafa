# Laporan Uji Kompetensi: Menggunakan Library Pre-Existing

**Unit Kompetensi:** J.620100.019.002  
**Judul:** Menggunakan Library atau Komponen Pre-Existing  
**Skenario:** Aplikasi Pembayaran Listrik Pascabayar  
**Library yang Digunakan:** Tailwind CSS (Utility-First CSS Framework)

---

## C. Langkah Kerja

### 1. Lakukan Pemilihan Unit-Unit Reuse yang Potensial

#### a. Identifikasi class unit-unit reuse (dari aplikasi lain) yang sesuai
Untuk mempercepat pengembangan antarmuka (*User Interface*) yang modern dan fleksibel pada halaman Login, Dashboard, dan Transaksi, saya memilih **Tailwind CSS**. Berbeda dengan framework tradisional, Tailwind menyediakan pendekatan *utility-first*.

Saya menggunakan kelas-kelas utilitas siap pakai untuk:
* **Layout:** `flex`, `grid`, `hidden md:block`, `w-64` (untuk sidebar).
* **Typography:** `font-sans` (Inter), `text-slate-800`, `font-bold`.
* **Styling Komponen:** `bg-white`, `rounded-xl`, `shadow-sm`, `border-gray-200`.

#### b. Hitung keuntungan efisiensi dari pemanfaatan komponen reuse
Penggunaan Tailwind CSS memberikan efisiensi yang signifikan dalam hal kustomisasi dan kecepatan *prototyping*:
* **Tanpa Library:** Menulis CSS kustom (*vanilla CSS*) membutuhkan pembuatan nama class yang semantik dan file CSS terpisah, memakan waktu lama untuk *context switching*.
* **Dengan Tailwind:** Styling dilakukan langsung pada file HTML/PHP tanpa perlu berpindah file. Membuat tombol modern cukup dengan: `class="bg-indigo-600 text-white px-4 py-2 rounded-lg"`. Ini mempercepat proses *styling* hingga **50-60%** dan menjaga konsistensi desain sistem.

#### c. Lisensi, Hak cipta dan hak paten tidak dilanggar dalam pemanfaatan komponen reuse tersebut
Tailwind CSS dirilis di bawah lisensi **MIT License**. Lisensi ini bersifat *permissive*, yang artinya kode library boleh digunakan, dimodifikasi, dan didistribusikan untuk keperluan pribadi maupun komersial (aplikasi pembayaran listrik ini) secara gratis dan legal.

---

### 2. Lakukan Integrasi Library atau Komponen Pre-Existing dengan Source Code yang Ada

#### a. Identifikasi ketergantungan antar unit
Untuk tahap pengembangan ini, integrasi dilakukan menggunakan **Play CDN** (Script Tag).
* **Dependencies:** Saya menyisipkan `<script src="https://cdn.tailwindcss.com"></script>` di dalam tag `<head>`.
* **Konfigurasi:** Saya menambahkan script konfigurasi `tailwind.config` di header untuk mendefinisikan *Design Tokens* khusus, seperti jenis font (Inter) dan palet warna kustom (`primary: #4F46E5` / Indigo) agar konsisten di seluruh halaman (`login.php`, `dashboard.php`, dll).

#### b. Hindari penggunaan komponen yang sudah obsolete (usang)
Saya memastikan untuk menggunakan sintaks Tailwind versi terbaru (v3+).
* Saya menghindari penggunaan *utility* yang sudah tidak didukung atau praktik lama (seperti `@apply` berlebihan di file CSS terpisah yang mengurangi manfaat *utility-first*).
* Saya tidak mencampuradukkan class Tailwind dengan class framework lain (seperti Bootstrap) untuk mencegah konflik style (`clashing`).

#### c. Terapkan program yang dihubungkan dengan library
Library diterapkan langsung pada elemen HTML di semua file modul aplikasi (`user.php`, `pelanggan.php`, `tagihan.php`). Contoh penerapan:
* **Sidebar:** Menggunakan `h-screen`, `sticky`, dan `overflow-y-auto`.
* **Tabel:** Menggunakan `w-full`, `text-left`, `border-collapse`.
* **Status Badge:** Menggunakan kombinasi warna `bg-emerald-50` dan `text-emerald-600` untuk status "Lunas".

---

### 3. Lakukan Pembaharuan Library atau Komponen Pre-Existing yang Digunakan

#### a. Identifikasi cara-cara pembaharuan library atau komponen pre-existing
Cara pembaharuan library Tailwind CSS via CDN dilakukan dengan memeriksa dokumentasi resmi di [tailwindcss.com](https://tailwindcss.com/docs/installation/play-cdn) untuk melihat apakah ada perubahan pada URL script CDN atau perubahan sintaks utility (misalnya perubahan nama class warna atau spacing).

#### b. Lakukan pembaharuan library atau komponen pre-existing
Saat ini aplikasi menggunakan versi terbaru yang disediakan oleh CDN Tailwind. Jika di masa depan aplikasi ini di-*deploy* ke production (live server), metode update akan diubah dari CDN menjadi instalasi berbasis **NPM/Node.js** (`npm install tailwindcss`) untuk performa yang lebih baik, dan update dilakukan melalui perintah `npm update tailwindcss`.