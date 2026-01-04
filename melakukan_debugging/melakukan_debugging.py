import os

NAMA_FILE = "hasil_urut.txt"
NAMA_FOLDER = "melakukan_debugging"
PATH_LENGKAP = os.path.join(NAMA_FOLDER, NAMA_FILE)

def urutkan_bubble_sort(kumpulan_angka):
    """
    Mengurutkan list angka secara ascending.
    Menggunakan logika penukaran posisi (swapping) yang efisien.
    """
    n = len(kumpulan_angka)
    for i in range(n):
        for j in range(0, n - i - 1):
            if kumpulan_angka[j] > kumpulan_angka[j + 1]:
                kumpulan_angka[j], kumpulan_angka[j + 1] = kumpulan_angka[j + 1], kumpulan_angka[j]
    return kumpulan_angka

def simpan_ke_file(data_angka):
    """Menangani persistensi data ke dalam file teks."""
    try:
        if not os.path.exists(NAMA_FOLDER):
            os.makedirs(NAMA_FOLDER)

        with open(PATH_LENGKAP, "w") as file:
            konten = ", ".join(map(str, data_angka))
            file.write(konten)
        return True
    except IOError as e:
        print(f"\n[Error] Gagal menyimpan file: {e}")
        return False

def muat_data_dari_file():
    """Membaca data dari file jika file tersebut ada."""
    if not os.path.exists(PATH_LENGKAP):
        return None
    try:
        with open(PATH_LENGKAP, "r") as file:
            return file.read().strip()
    except IOError:
        return None

def bersihkan_layar():
    """Membersihkan konsol terminal."""
    os.system('cls' if os.name == 'nt' else 'clear')

def menu_input_data():
    """Alur interaksi input data dari pengguna."""
    bersihkan_layar()
    print("=== INPUT DATA ANGKA ===")
    print("-" * 30)
    try:
        jumlah = int(input("Masukkan jumlah angka yang akan diinput : "))
        data_angka = []
        
        print("\nInput angka secara acak:")
        for i in range(jumlah):
            nilai = int(input(f"Angka {i + 1} : "))
            data_angka.append(nilai)
            
        hasil_urut = urutkan_bubble_sort(data_angka)
        
        if simpan_ke_file(hasil_urut):
            print(f"\n[Sukses] Data tersimpan di folder '{NAMA_FOLDER}'")
        
        input("\nTekan ENTER untuk kembali ke menu awal...")
    except ValueError:
        print("\n[Error] Input harus berupa bilangan bulat!")
        input("Tekan ENTER untuk kembali...")

def menu_tampilkan_hasil():
    """Menampilkan hasil pengurutan yang sudah disimpan."""
    bersihkan_layar()
    print("=== TAMPIL HASIL PENGURUTAN ===")
    print("-" * 30)
    
    isi_file = muat_data_dari_file()
    
    if isi_file:
        print(f"Nilai Tugas : {isi_file}")
    else:
        print(f"File tidak ditemukan atau kosong di '{NAMA_FOLDER}'.")
        print("Silakan input data terlebih dahulu!")
        
    print("-" * 30)
    input("\nTekan Enter untuk kembali ke Menu Awal...")

def main():
    """Titik masuk utama (Main Entry Point) aplikasi."""
    while True:
        bersihkan_layar()
        print("=== MENU UTAMA ===")
        print("1. Input Angka")
        print("2. Tampil Hasil Pengurutan")
        print("3. Selesai")
        
        pilihan = input("\nMasukkan Pilihan [1/2/3] : ")
        
        if pilihan == '1':
            menu_input_data()
        elif pilihan == '2':
            menu_tampilkan_hasil()
        elif pilihan == '3':
            print("Program Selesai. Sampai jumpa!")
            break
        else:
            input("Pilihan tidak valid. Tekan Enter untuk ulangi!")

if __name__ == "__main__":
    main()