<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php?pesan=belum_login");
    exit;
}

include 'services/koneksi.php';

// --- LOGIKA PENCARIAN & FILTER ---
$where = " WHERE 1=1 ";

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $where .= " AND (
        pelanggan.nama_pelanggan LIKE '%$cari%' OR 
        pelanggan.nomor_kwh LIKE '%$cari%' OR 
        tagihan.status LIKE '%$cari%' OR 
        tagihan.jumlah_meter LIKE '%$cari%'
    )";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tagihan - Listrik Pascabayar</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { primary: '#4F46E5', secondary: '#64748B' }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans text-slate-800 antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex md:flex-col justify-between">
            <div>
                <div class="h-16 flex items-center px-6 border-b border-gray-100">
                    <a href="#" class="flex items-center gap-2 text-primary font-bold text-lg">
                        <i class="bi bi-lightning-charge-fill text-2xl"></i>
                        <span>ListrikApp</span>
                    </a>
                </div>
                <nav class="mt-6 px-4 space-y-1">
                    <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-gray-50 hover:text-slate-900 rounded-lg font-medium transition-colors">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                    <a href="user.php" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-gray-50 hover:text-slate-900 rounded-lg font-medium transition-colors">
                        <i class="bi bi-people"></i> User
                    </a>
                    <a href="tarif.php" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-gray-50 hover:text-slate-900 rounded-lg font-medium transition-colors">
                        <i class="bi bi-tag"></i> Tarif
                    </a>
                    <a href="pelanggan.php" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-gray-50 hover:text-slate-900 rounded-lg font-medium transition-colors">
                        <i class="bi bi-person"></i> Pelanggan
                    </a>
                    <a href="tagihan.php" class="flex items-center gap-3 px-4 py-3 bg-primary/10 text-primary rounded-lg font-medium transition-colors">
                        <i class="bi bi-receipt"></i> Tagihan
                    </a>
                    <a href="pembayaran.php" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-gray-50 hover:text-slate-900 rounded-lg font-medium transition-colors">
                        <i class="bi bi-wallet2"></i> Pembayaran
                    </a>
                </nav>
            </div>
            <div class="p-4 border-t border-gray-100">
                <a href="logout.php" class="flex items-center gap-3 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg font-medium transition-colors text-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-full overflow-hidden relative">
            
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 lg:px-10 z-10">
                <div class="md:hidden">
                    <button class="text-slate-500 hover:text-slate-700"><i class="bi bi-list text-2xl"></i></button>
                </div>
                <div class="hidden md:block">
                    <h2 class="font-semibold text-lg text-slate-800">Manajemen Tagihan</h2>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-slate-800"><?php echo $_SESSION['nama_admin']; ?></p>
                        <p class="text-xs text-slate-500"><?php echo ($_SESSION['id_level'] == 1) ? 'Administrator' : 'Petugas'; ?></p>
                    </div>
                    <div class="h-10 w-10 bg-slate-200 rounded-full flex items-center justify-center text-slate-500">
                        <i class="bi bi-person-fill text-xl"></i>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 lg:p-10">
                
                <?php if(isset($_GET['pesan'])){ ?>
                    <div class="mb-4">
                        <?php 
                        if($_GET['pesan'] == "simpan_sukses") echo '<div class="bg-emerald-100 text-emerald-700 px-4 py-3 rounded border border-emerald-200 text-sm">Data tagihan berhasil disimpan.</div>';
                        elseif($_GET['pesan'] == "edit_sukses") echo '<div class="bg-blue-100 text-blue-700 px-4 py-3 rounded border border-blue-200 text-sm">Data tagihan berhasil diupdate.</div>';
                        elseif($_GET['pesan'] == "hapus_sukses") echo '<div class="bg-red-100 text-red-700 px-4 py-3 rounded border border-red-200 text-sm">Data tagihan berhasil dihapus.</div>';
                        elseif($_GET['pesan'] == "gagal") echo '<div class="bg-red-100 text-red-700 px-4 py-3 rounded border border-red-200 text-sm">Terjadi kesalahan sistem.</div>';
                        ?>
                    </div>
                <?php } ?>

                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Data Tagihan & Penggunaan</h1>
                        <p class="text-slate-500 mt-1 text-sm">Input meteran dan kelola status pembayaran.</p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <form action="" method="GET" class="relative">
                            <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" placeholder="Cari Nama / No KWH..." class="pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 w-full sm:w-64">
                            <i class="bi bi-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                        </form>

                        <button onclick="toggleModal('modalInputTagihan')" class="bg-primary hover:bg-indigo-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 shadow-lg shadow-indigo-500/20 transition-all justify-center">
                            <i class="bi bi-plus-lg"></i>
                            <span>Input Tagihan</span>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                                    <th class="px-6 py-4">ID / Periode</th>
                                    <th class="px-6 py-4">Pelanggan</th>
                                    <th class="px-6 py-4">Posisi Meter</th>
                                    <th class="px-6 py-4">Total Penggunaan</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm text-slate-700">
                                <?php 
                                $query = "SELECT tagihan.*, pelanggan.nama_pelanggan, pelanggan.nomor_kwh, pelanggan.alamat, tarif.golongan, tarif.daya, tarif.tarifperkwh 
                                          FROM tagihan 
                                          JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan 
                                          JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif 
                                          $where 
                                          ORDER BY id_tagihan DESC";
                                
                                $result = mysqli_query($koneksi, $query);
                                
                                while($row = mysqli_fetch_array($result)) {
                                    $bulan_tahun = $row['bulan'] . " " . $row['tahun'];

                                    $btn_detail = '<button onclick="bukaModalDetail('.htmlspecialchars(json_encode($row)).')" class="p-2 text-sky-600 hover:bg-sky-50 rounded-lg transition-colors" title="Lihat Detail"><i class="bi bi-eye"></i></button>';

                                    if($row['status'] == 'Lunas'){
                                        $badge = '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100"><i class="bi bi-check-circle-fill"></i> Lunas</span>';
                                        $tombol_aksi = $btn_detail . ' <span class="text-slate-400 text-xs italic ml-2">Selesai</span>';
                                    } else {
                                        $badge = '<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-600 border border-rose-100"><i class="bi bi-hourglass-split"></i> Belum Bayar</span>';
                                        $tombol_aksi = $btn_detail . '
                                        <button onclick="bukaModalEdit('.htmlspecialchars(json_encode($row)).')" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a href="controller/hapus_tagihan.php?id='.$row['id_tagihan'].'" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" onclick="return confirm(\'Yakin ingin menghapus tagihan ini?\')" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </a>';
                                    }
                                ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">#TAG-<?php echo $row['id_tagihan']; ?></div>
                                        <div class="text-xs text-slate-500 mt-0.5"><?php echo $bulan_tahun; ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900"><?php echo $row['nama_pelanggan']; ?></div>
                                        <div class="text-xs text-slate-500"><?php echo $row['nomor_kwh']; ?></div>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-slate-600 text-xs">
                                        <div>Awal : <?php echo $row['meter_awal']; ?></div>
                                        <div>Akhir: <b><?php echo $row['meter_akhir']; ?></b></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800"><?php echo $row['jumlah_meter']; ?> kWh</div>
                                        <div class="text-xs text-emerald-600 font-medium">Rp <?php echo number_format($row['jumlah_meter'] * $row['tarifperkwh'], 0, ',', '.'); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $badge; ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <?php echo $tombol_aksi; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                
                                <?php if(mysqli_num_rows($result) == 0){ ?>
                                    <tr><td colspan="6" class="text-center py-6 text-slate-400">Data tidak ditemukan.</td></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <div id="modalInputTagihan" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="toggleModal('modalInputTagihan')"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-xl shadow-2xl p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800">Input Tagihan Baru</h3>
                <button onclick="toggleModal('modalInputTagihan')" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
            </div>
            
            <form action="controller/tambah_tagihan.php" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Cari Pelanggan</label>
                    <select name="id_pelanggan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 text-sm bg-white" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php 
                        $q_plg = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
                        while($p = mysqli_fetch_array($q_plg)){
                            echo "<option value='$p[id_pelanggan]'>$p[nomor_kwh] - $p[nama_pelanggan]</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Bulan</label>
                        <select name="bulan" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white">
                            <?php 
                            $bulan = ["01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember"];
                            foreach($bulan as $k => $v){
                                echo "<option value='$k'>$v</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tahun</label>
                        <input type="number" name="tahun" value="<?php echo date('Y'); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Meter Awal</label>
                        <input type="number" name="meter_awal" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" placeholder="Contoh: 1200" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Meter Akhir</label>
                        <input type="number" name="meter_akhir" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" placeholder="Contoh: 1350" required>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="toggleModal('modalInputTagihan')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-gray-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-indigo-700 rounded-lg">Simpan Tagihan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalEditTagihan" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="toggleModal('modalEditTagihan')"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-xl shadow-2xl p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800">Edit Data Tagihan</h3>
                <button onclick="toggleModal('modalEditTagihan')" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
            </div>
            
            <form action="controller/edit_tagihan.php" method="POST" class="space-y-4">
                <input type="hidden" name="id_tagihan" id="edit_id_tagihan">
                
                <div>
                    <label class="block text-sm font-medium text-slate-500 mb-1">Pelanggan (Tidak bisa diubah)</label>
                    <input type="text" id="edit_nama_pelanggan" class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm cursor-not-allowed" readonly>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Meter Awal</label>
                        <input type="number" name="meter_awal" id="edit_meter_awal" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Meter Akhir</label>
                        <input type="number" name="meter_akhir" id="edit_meter_akhir" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="toggleModal('modalEditTagihan')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-gray-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalDetailTagihan" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="toggleModal('modalDetailTagihan')"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="bg-slate-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Detail Tagihan</h3>
                <button onclick="toggleModal('modalDetailTagihan')" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
            </div>
            
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span id="detail_status" class="px-3 py-1 rounded-full text-xs font-semibold"></span>
                    <span id="detail_id" class="text-sm font-mono text-slate-500"></span>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-3">Informasi Pelanggan</h4>
                    <div class="grid grid-cols-2 gap-y-2 text-sm">
                        <span class="text-slate-500">Nama:</span>
                        <span class="font-medium text-slate-800 text-right" id="detail_nama"></span>
                        
                        <span class="text-slate-500">No. Meter:</span>
                        <span class="font-medium text-slate-800 text-right font-mono" id="detail_kwh"></span>
                        
                        <span class="text-slate-500">Tarif / Daya:</span>
                        <span class="font-medium text-slate-800 text-right" id="detail_tarif_daya"></span>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-3">Detail Pemakaian</h4>
                    <div class="grid grid-cols-3 gap-2 text-center text-sm">
                        <div class="p-2 bg-gray-50 rounded border border-gray-100">
                            <span class="block text-xs text-slate-500">Awal</span>
                            <span class="font-mono font-medium" id="detail_m_awal"></span>
                        </div>
                        <div class="p-2 bg-gray-50 rounded border border-gray-100">
                            <span class="block text-xs text-slate-500">Akhir</span>
                            <span class="font-mono font-medium" id="detail_m_akhir"></span>
                        </div>
                        <div class="p-2 bg-blue-50 rounded border border-blue-100">
                            <span class="block text-xs text-blue-500">Jumlah</span>
                            <span class="font-bold text-blue-700" id="detail_jumlah"></span>
                        </div>
                    </div>
                </div>

                <div class="border-t-2 border-dashed border-gray-200 pt-4 flex justify-between items-center">
                    <span class="text-slate-600 font-medium">Total Tagihan</span>
                    <span class="text-xl font-bold text-emerald-600" id="detail_total"></span>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-right">
                <button onclick="toggleModal('modalDetailTagihan')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-gray-300 hover:bg-gray-100 rounded-lg">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            modal.classList.toggle('hidden');
        }

        function bukaModalEdit(data) {
            document.getElementById('edit_id_tagihan').value = data.id_tagihan;
            document.getElementById('edit_nama_pelanggan').value = data.nomor_kwh + ' - ' + data.nama_pelanggan;
            document.getElementById('edit_meter_awal').value = data.meter_awal;
            document.getElementById('edit_meter_akhir').value = data.meter_akhir;
            toggleModal('modalEditTagihan');
        }

        function bukaModalDetail(data) {
            document.getElementById('detail_id').innerText = "#TAG-" + data.id_tagihan + " (" + data.bulan + "/" + data.tahun + ")";
            
            const elStatus = document.getElementById('detail_status');
            if(data.status == 'Lunas') {
                elStatus.className = "px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700";
                elStatus.innerText = "LUNAS";
            } else {
                elStatus.className = "px-3 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-700";
                elStatus.innerText = "BELUM BAYAR";
            }

            document.getElementById('detail_nama').innerText = data.nama_pelanggan;
            document.getElementById('detail_kwh').innerText = data.nomor_kwh;
            document.getElementById('detail_tarif_daya').innerText = data.golongan + " / " + data.daya + " VA";

            document.getElementById('detail_m_awal').innerText = data.meter_awal;
            document.getElementById('detail_m_akhir').innerText = data.meter_akhir;
            document.getElementById('detail_jumlah').innerText = data.jumlah_meter + " kWh";

            let total = data.jumlah_meter * data.tarifperkwh;
            let rupiah = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total);
            document.getElementById('detail_total').innerText = rupiah;

            toggleModal('modalDetailTagihan');
        }
    </script>
</body>
</html>