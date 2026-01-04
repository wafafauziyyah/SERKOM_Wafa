import os

NAMA_FILE = "hasil_urut.txt"
NAMA_FOLDER = "J.620100.017.02_pemrograman_terstruktur"
PATH_LENGKAP = os.path.join(NAMA_FOLDER, NAMA_FILE)

def urutkan_bubble_sort(angka_list):
    """Mengurutkan list angka menggunakan algoritma bubble sort."""
    n = len(angka_list)
    for i in range(n):
        for j in range(0, n - i - 1):
            if angka_list[j] > angka_list[j + 1]:
                angka_list[j], angka_list[j + 1] = angka_list[j + 1], angka_list[j]
    return angka_list

def simpan_ke_file(data_angka):
    """Menangani logika penyimpanan data ke dalam folder dan file."""
    try:
        if not os.path.exists(NAMA_FOLDER):
            os.makedirs(NAMA_FOLDER)

        with open(PATH_LENGKAP, "w") as file:
            data_string = ", ".join(map(str, data_angka))
            file.write(data_string)
        return True
    except IOError as e:
        print(f"Kesalahan sistem saat menulis file: {e}")
        return False

def ambil_data_dari_file():
    """Membaca isi file dan mengembalikan string atau None jika gagal."""
    if not os.path.exists(PATH_LENGKAP):
        return None
    try:
        with open(PATH_LENGKAP, "r") as file:
            return file.read().strip()
    except IOError:
        return None

def bersihkan_layar():
    """Membersihkan terminal sesuai OS."""
    os.system('cls' if os.name == 'nt' else 'clear')

def menu_input_angka():
    """Proses input user, pengurutan, hingga penyimpanan."""
    bersihkan_layar()
    print("=== INPUT DATA ANGKA ===")
    try:
        jumlah = int(input("Masukkan jumlah angka: "))
        kumpulan_angka = []
        
        for i in range(jumlah):
            nilai = int(input(f"Angka ke-{i + 1}: "))
            kumpulan_angka.append(nilai)
            
        data_terurut = urutkan_bubble_sort(kumpulan_angka)
        
        if simpan_ke_file(data_terurut):
            print("\n[Berhasil] Data diurutkan dan disimpan ke file.")
        
    except ValueError:
        print("\n[Error] Input harus berupa angka bulat!")
    
    input("\nTekan Enter untuk kembali ke menu...")

def menu_tampilkan_hasil():
    """Menampilkan hasil pengurutan yang tersimpan di file."""
    bersihkan_layar()
    print("=== HASIL PENGURUTAN TERAKHIR ===")
    print("-" * 33)
    
    isi_data = ambil_data_dari_file()
    if isi_data:
        print(f"Data Terurut : {isi_data}")
    else:
        print("Data tidak ditemukan. Silakan input data terlebih dahulu.")
        
    print("-" * 33)
    input("\nTekan Enter untuk kembali...")

def main():
    """Entry point utama aplikasi."""
    while True:
        bersihkan_layar()
        print("=== APLIKASI PENGOLAH ANGKA ===")
        print("1. Input & Urutkan Angka")
        print("2. Tampilkan Hasil")
        print("3. Keluar")
        
        pilihan = input("\nPilih Menu [1/2/3]: ")
        
        if pilihan == '1':
            menu_input_angka()
        elif pilihan == '2':
            menu_tampilkan_hasil()
        elif pilihan == '3':
            print("Program dihentikan. Sampai jumpa!")
            break
        else:
            input("Pilihan tidak valid! Tekan Enter untuk mengulangi...")

if __name__ == "__main__":
    main()