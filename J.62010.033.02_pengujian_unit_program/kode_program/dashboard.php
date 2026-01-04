<?php
session_start();

// Cek apakah user sudah login, jika belum lempar ke login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php?pesan=belum_login");
    exit;
}

include 'services/koneksi.php';

// --- DATA STATISTIK ---

// Hitung Total Pelanggan
$q_pelanggan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pelanggan");
$d_pelanggan = mysqli_fetch_assoc($q_pelanggan);

// Hitung Tagihan Lunas
$q_lunas = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tagihan WHERE status='Lunas'");
$d_lunas = mysqli_fetch_assoc($q_lunas);

//Hitung Tagihan Belum Bayar
$q_belum = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tagihan WHERE status='Belum Bayar'");
$d_belum = mysqli_fetch_assoc($q_belum);

// Hitung Total Pendapatan
$q_duit = mysqli_query($koneksi, "SELECT SUM(total_bayar) as total FROM pembayaran");
$d_duit = mysqli_fetch_assoc($q_duit);
$pendapatan = $d_duit['total'] ?: 0;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Listrik Pascabayar</title>
    
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
                    <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 bg-primary/10 text-primary rounded-lg font-medium transition-colors">
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
                    <h2 class="font-semibold text-lg text-slate-800">Overview</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-slate-800">
                            <?php echo isset($_SESSION['nama_admin']) ? $_SESSION['nama_admin'] : 'Admin'; ?>
                        </p>
                        <p class="text-xs text-slate-500">
                            <?php echo (isset($_SESSION['id_level']) && $_SESSION['id_level'] == 1) ? 'Administrator' : 'Petugas'; ?>
                        </p>
                    </div>
                    <div class="h-10 w-10 bg-slate-200 rounded-full flex items-center justify-center text-slate-500">
                        <i class="bi bi-person-fill text-xl"></i>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 lg:p-10">
                
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900">Dashboard</h1>
                    <p class="text-slate-500 mt-1">Ringkasan data pembayaran listrik bulan ini.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                                <i class="bi bi-people text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-medium">Total Pelanggan</p>
                                <p class="text-2xl font-bold text-slate-800">
                                    <?php echo number_format($d_pelanggan['total']); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                                <i class="bi bi-check-circle text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-medium">Tagihan Lunas</p>
                                <p class="text-2xl font-bold text-slate-800">
                                    <?php echo number_format($d_lunas['total']); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-rose-50 text-rose-600 rounded-lg">
                                <i class="bi bi-x-circle text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-medium">Belum Bayar</p>
                                <p class="text-2xl font-bold text-slate-800">
                                    <?php echo number_format($d_belum['total']); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                                <i class="bi bi-cash text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-medium">Pendapatan</p>
                                <p class="text-xl font-bold text-slate-800">
                                    Rp <?php echo number_format($pendapatan, 0, ',', '.'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-bold text-slate-800">Tagihan Terbaru</h3>
                        <a href="tagihan.php" class="text-sm text-primary font-medium hover:underline">Lihat Semua</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-gray-100">
                                    <th class="px-6 py-4 w-16 text-center">No</th>
                                    <th class="px-6 py-4">ID Pelanggan</th>
                                    <th class="px-6 py-4">Nama</th>
                                    <th class="px-6 py-4">Est. Tagihan</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                <?php
                                $q_table = "SELECT tagihan.*, pelanggan.nama_pelanggan, pelanggan.nomor_kwh, tarif.tarifperkwh 
                                            FROM tagihan 
                                            JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan 
                                            JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif 
                                            ORDER BY tagihan.id_tagihan DESC LIMIT 5";
                                $exec_table = mysqli_query($koneksi, $q_table);
                                $no = 1;

                                while($row = mysqli_fetch_assoc($exec_table)) {
                                    $est_harga = $row['jumlah_meter'] * $row['tarifperkwh'];
                                    $badge_color = ($row['status'] == 'Lunas') 
                                        ? 'bg-emerald-100 text-emerald-700 border-emerald-200' 
                                        : 'bg-rose-100 text-rose-700 border-rose-200';
                                ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-center text-slate-500"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 font-medium text-slate-700">
                                        <?php echo $row['nomor_kwh']; ?>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        <?php echo $row['nama_pelanggan']; ?>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-slate-800">
                                        Rp <?php echo number_format($est_harga, 0, ',', '.'); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold border <?php echo $badge_color; ?>">
                                            <?php echo $row['status']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="tagihan.php" class="text-primary hover:text-indigo-700 font-medium text-sm transition-colors">Detail</a>
                                    </td>
                                </tr>
                                <?php } ?>

                                <?php if(mysqli_num_rows($exec_table) == 0) { ?>
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                                            Belum ada data tagihan.
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>
</body>
</html>