import os
import time

NAMA_FILE = "hasil_urut.txt"
NAMA_FOLDER = "coding_guidelines_best_practice"
PATH_LENGKAP = os.path.join(NAMA_FOLDER, NAMA_FILE)

def urutkan_bubble_sort(kumpulan_angka):
    """Mengurutkan list angka secara ascending menggunakan Bubble Sort."""
    n = len(kumpulan_angka)
    for i in range(n):
        sudah_terurut = True
        for j in range(0, n - i - 1):
            if kumpulan_angka[j] > kumpulan_angka[j + 1]:
                kumpulan_angka[j], kumpulan_angka[j + 1] = kumpulan_angka[j + 1], kumpulan_angka[j]
                sudah_terurut = False
        if sudah_terurut:
            break
    return kumpulan_angka

def simpan_data_ke_file(data_angka):
    """Menangani proses penulisan data ke dalam file fisik."""
    try:
        if not os.path.exists(NAMA_FOLDER):
            os.makedirs(NAMA_FOLDER)

        with open(PATH_LENGKAP, "w") as file:
            konten = ", ".join(map(str, data_angka))
            file.write(konten)
        return True
    except IOError as e:
        print(f"\n[Error] Gagal menulis file: {e}")
        return False

def muat_data_dari_file():
    """Mengambil konten dari file jika tersedia."""
    if not os.path.exists(PATH_LENGKAP):
        return None
    try:
        with open(PATH_LENGKAP, "r") as file:
            return file.read().strip()
    except IOError:
        return None

def bersihkan_layar():
    """Membersihkan tampilan terminal."""
    os.system('cls' if os.name == 'nt' else 'clear')

def menu_input_proses():
    """Menangani alur input user, proses sorting, dan statistik waktu."""
    bersihkan_layar()
    print("=== FORM INPUT ANGKA ===")
    
    try:
        jumlah = int(input("Banyak angka yang ingin diinput: "))
        data_input = []
        
        print(f"\nSilakan masukkan {jumlah} angka secara acak:")
        for i in range(jumlah):
            nilai = int(input(f"Data ke-{i + 1}: "))
            data_input.append(nilai)
            
        print("\nSedang memproses pengurutan...")
        waktu_mulai = time.perf_counter()
        
        hasil_urut = urutkan_bubble_sort(data_input)
        
        waktu_selesai = time.perf_counter()
        durasi = waktu_selesai - waktu_mulai
        
        if simpan_data_ke_file(hasil_urut):
            print("=" * 35)
            print(f"Status: Berhasil Disimpan")
            print(f"Durasi: {durasi:.6f} detik")
            print("=" * 35)
            
    except ValueError:
        print("\n[Error] Input harus berupa bilangan bulat!")
    
    input("\nTekan ENTER untuk kembali ke menu utama...")

def menu_tampilkan_data():
    """Menampilkan data yang tersimpan di dalam file."""
    bersihkan_layar()
    print("=== HASIL PENGURUTAN TERAKHIR ===")
    print("-" * 35)
    
    konten = muat_data_dari_file()
    
    if konten:
        print(f"Nilai Tugas: {konten}")
    else:
        print("Data tidak ditemukan atau file masih kosong.")
        print("Silakan lakukan input data terlebih dahulu.")
        
    print("-" * 35)
    input("\nTekan ENTER untuk kembali...")

def main():
    """Titik masuk utama program (Main Entry Point)."""
    while True:
        bersihkan_layar()
        print("=== APLIKASI PENGURUT DATA (BUBBLE SORT) ===")
        print("1. Input & Olah Data")
        print("2. Tampilkan Hasil Terakhir")
        print("3. Keluar")
        
        pilihan = input("\nPilih menu [1-3]: ")
        
        if pilihan == '1':
            menu_input_proses()
        elif pilihan == '2':
            menu_tampilkan_data()
        elif pilihan == '3':
            print("Program dihentikan. Terima kasih!")
            break
        else:
            input("Pilihan tidak valid! Tekan ENTER untuk coba lagi...")

if __name__ == "__main__":
    main()