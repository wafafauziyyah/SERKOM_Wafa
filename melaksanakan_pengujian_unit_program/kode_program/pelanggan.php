<?php
session_start();


if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php?pesan=belum_login");
    exit;
}

include 'services/koneksi.php';

// --- LOGIKA PENCARIAN ---
$where = " WHERE 1=1 ";
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $where .= " AND (nama_pelanggan LIKE '%$cari%' OR nomor_kwh LIKE '%$cari%' OR alamat LIKE '%$cari%')";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelanggan - Listrik Pascabayar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#64748B'
                    }
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
                    <a href="pelanggan.php" class="flex items-center gap-3 px-4 py-3 bg-primary/10 text-primary rounded-lg font-medium transition-colors">
                        <i class="bi bi-person"></i> Pelanggan
                    </a>
                    <a href="tagihan.php" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-gray-50 hover:text-slate-900 rounded-lg font-medium transition-colors">
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
                    <h2 class="font-semibold text-lg text-slate-800">Manajemen Pelanggan</h2>
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

                <?php if (isset($_GET['pesan'])) { ?>
                    <div class="mb-4">
                        <?php
                        if ($_GET['pesan'] == "simpan_sukses") echo '<div class="bg-emerald-100 text-emerald-700 px-4 py-3 rounded border border-emerald-200 text-sm">Data pelanggan berhasil disimpan.</div>';
                        elseif ($_GET['pesan'] == "edit_sukses") echo '<div class="bg-blue-100 text-blue-700 px-4 py-3 rounded border border-blue-200 text-sm">Data pelanggan berhasil diupdate.</div>';
                        elseif ($_GET['pesan'] == "hapus_sukses") echo '<div class="bg-red-100 text-red-700 px-4 py-3 rounded border border-red-200 text-sm">Data pelanggan berhasil dihapus.</div>';
                        elseif ($_GET['pesan'] == "gagal") echo '<div class="bg-red-100 text-red-700 px-4 py-3 rounded border border-red-200 text-sm">Gagal memproses data. Cek koneksi atau data duplikat.</div>';
                        ?>
                    </div>
                <?php } ?>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Data Pelanggan</h1>
                        <p class="text-slate-500 mt-1 text-sm">Kelola data pelanggan, meteran, dan daya listrik.</p>
                    </div>
                    <div class="flex gap-3">
                        <form action="" method="GET" class="relative">
                            <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" placeholder="Cari nama / ID..." class="pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 w-full sm:w-64">
                            <i class="bi bi-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                        </form>

                        <button onclick="toggleModal('modalTambah')" class="bg-primary hover:bg-indigo-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 shadow-lg shadow-indigo-500/20 transition-all">
                            <i class="bi bi-plus-lg"></i>
                            <span>Tambah Baru</span>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                                    <th class="px-6 py-4 w-16 text-center">No</th>
                                    <th class="px-6 py-4">ID Pelanggan</th>
                                    <th class="px-6 py-4">No. Meter</th>
                                    <th class="px-6 py-4">Nama Lengkap</th>
                                    <th class="px-6 py-4">Alamat</th>
                                    <th class="px-6 py-4">Daya (VA)</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm text-slate-700">
                                <?php
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM pelanggan JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif $where ORDER BY id_pelanggan DESC");

                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <tr class="hover:bg-gray-50 transition-colors group">
                                        <td class="px-6 py-4 text-center text-slate-500"><?php echo $no++; ?></td>
                                        <td class="px-6 py-4 font-mono text-slate-500">PLG-<?php echo $row['id_pelanggan']; ?></td>
                                        <td class="px-6 py-4 font-mono font-medium"><?php echo $row['nomor_kwh']; ?></td>
                                        <td class="px-6 py-4 font-medium text-slate-900"><?php echo $row['nama_pelanggan']; ?></td>
                                        <td class="px-6 py-4 truncate max-w-xs"><?php echo $row['alamat']; ?></td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                <i class="bi bi-lightning-fill"></i> <?php echo $row['daya']; ?> VA
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button onclick="bukaModalEdit(<?php echo htmlspecialchars(json_encode($row)); ?>)" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <a href="controller/hapus_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus" onclick="return confirm('Yakin hapus data ini? Semua tagihan terkait juga akan terhapus.')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php if (mysqli_num_rows($query) == 0) { ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-6 text-slate-400">Data tidak ditemukan.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <div id="modalTambah" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="toggleModal('modalTambah')"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-xl shadow-2xl p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800">Tambah Pelanggan Baru</h3>
                <button onclick="toggleModal('modalTambah')" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
            </div>

            <form action="controller/tambah_pelanggan.php" method="POST" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                        <input type="text" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 text-sm" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Meter (KWH)</label>
                    <input type="number" name="nomor_kwh" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 text-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 text-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 text-sm"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Daya / Tarif</label>
                    <select name="id_tarif" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 text-sm bg-white" required>
                        <option value="">-- Pilih Daya --</option>
                        <?php
                        $q_tarif = mysqli_query($koneksi, "SELECT * FROM tarif ORDER BY daya ASC");
                        while ($t = mysqli_fetch_array($q_tarif)) {
                            echo "<option value='$t[id_tarif]'>$t[golongan] - $t[daya] VA</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="toggleModal('modalTambah')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-gray-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-indigo-700 rounded-lg">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalEdit" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="toggleModal('modalEdit')"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-white rounded-xl shadow-2xl p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800">Edit Data Pelanggan</h3>
                <button onclick="toggleModal('modalEdit')" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
            </div>

            <form action="controller/proses_edit_pelanggan.php" method="POST" class="space-y-4">
                <input type="hidden" name="id_pelanggan" id="edit_id_pelanggan">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                        <input type="text" name="username" id="edit_username" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Password Baru</label>
                        <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" placeholder="Kosongkan jika tidak diganti">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Meter (KWH)</label>
                    <input type="number" name="nomor_kwh" id="edit_nomor_kwh" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" id="edit_nama_pelanggan" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" id="edit_alamat" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Daya / Tarif</label>
                    <select name="id_tarif" id="edit_id_tarif" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white" required>
                        <option value="">-- Pilih Daya --</option>
                        <?php
                        $q_tarif2 = mysqli_query($koneksi, "SELECT * FROM tarif ORDER BY daya ASC");
                        while ($t2 = mysqli_fetch_array($q_tarif2)) {
                            echo "<option value='$t2[id_tarif]'>$t2[golongan] - $t2[daya] VA</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="toggleModal('modalEdit')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-gray-100 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            modal.classList.toggle('hidden');
        }

        function bukaModalEdit(data) {
            document.getElementById('edit_id_pelanggan').value = data.id_pelanggan;
            document.getElementById('edit_username').value = data.username;
            document.getElementById('edit_nomor_kwh').value = data.nomor_kwh;
            document.getElementById('edit_nama_pelanggan').value = data.nama_pelanggan;
            document.getElementById('edit_alamat').value = data.alamat;
            document.getElementById('edit_id_tarif').value = data.id_tarif;

            toggleModal('modalEdit');
        }
    </script>
</body>

</html>