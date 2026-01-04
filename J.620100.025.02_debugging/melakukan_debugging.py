import os

NAMA_FILE = "hasil_urut.txt"
NAMA_FOLDER = "J.620100.025.02_debugging"


def tukar_data(data, indeks1, indeks2):
    temp = data[indeks1]
    data[indeks1] = data[indeks2]
    data[indeks2] = temp

def urutkan_angka(data_angka):
    n = len()
    for i in range(n):
        for j in range(0, n - i - 1):
            if data_angka[j] > data_angka[j + 1]:
                tukar_data(data_angka, j, j + 1)

def simpan_file(data_angka):
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
            
        urutkan_angka(data_angka)
        simpan_file(data_angka)
        input("\nData Berhasil diurutkan dan disimpan. Tekan ENTER untuk kembali ke menu awal..")
    except ValueError:
        print("Input harus berupa angka bilangan bulat !")
        input("Tekan ENTER untuk kembali...")

def main():
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