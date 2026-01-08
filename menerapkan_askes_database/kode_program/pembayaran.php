<?php
session_start();
// if (!isset($_SESSION['user'])) { header("Location: login.php"); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembayaran - Listrik Pascabayar</title>
    
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
                    <a href="tagihan.php" class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-gray-50 hover:text-slate-900 rounded-lg font-medium transition-colors">
                        <i class="bi bi-receipt"></i> Tagihan
                    </a>
                    <a href="pembayaran.php" class="flex items-center gap-3 px-4 py-3 bg-primary/10 text-primary rounded-lg font-medium transition-colors">
                        <i class="bi bi-wallet2"></i> Pembayaran
                    </a>
                </nav>
            </div>
            <div class="p-4 border-t border-gray-100">
                <a href="login.php" class="flex items-center gap-3 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg font-medium transition-colors text-sm">
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
                    <h2 class="font-semibold text-lg text-slate-800">Transaksi & Laporan</h2>
                </div>
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 bg-slate-200 rounded-full flex items-center justify-center text-slate-500">
                        <i class="bi bi-person-fill text-xl"></i>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 lg:p-10">
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Riwayat Pembayaran</h1>
                        <p class="text-slate-500 mt-1 text-sm">Data transaksi masuk dan cetak bukti pembayaran.</p>
                    </div>
                    <div class="flex gap-3">
                        <div class="relative">
                            <input type="text" placeholder="ID Transaksi / Nama" class="pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 w-full sm:w-64">
                            <i class="bi bi-search absolute left-3 top-3 text-slate-400 text-sm"></i>
                        </div>
                        <button onclick="toggleModal('modalBayar')" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 shadow-lg shadow-emerald-500/20 transition-all">
                            <i class="bi bi-cash-stack"></i>
                            <span>Entri Pembayaran</span>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                                    <th class="px-6 py-4">ID Transaksi</th>
                                    <th class="px-6 py-4">Tanggal Bayar</th>
                                    <th class="px-6 py-4">Pelanggan / Tagihan</th>
                                    <th class="px-6 py-4 text-right">Biaya Admin</th>
                                    <th class="px-6 py-4 text-right">Total Bayar</th>
                                    <th class="px-6 py-4">Petugas</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm text-slate-700">
                                
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-mono text-slate-600 font-medium">#TRX-9981</td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-800">20 Jan 2025</div>
                                        <div class="text-xs text-slate-400">14:30 WIB</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">Budi Santoso</div>
                                        <div class="text-xs text-slate-500">Tagihan Jan 2025</div>
                                    </td>
                                    <td class="px-6 py-4 text-right font-mono text-slate-500">Rp 2.500</td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="font-bold font-mono text-emerald-600">Rp 205.000</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded text-xs font-medium bg-gray-100 text-slate-600">
                                            <i class="bi bi-person"></i> Admin
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="text-primary hover:text-indigo-800 text-xs font-semibold flex items-center justify-center gap-1 border border-primary/20 hover:border-primary rounded px-2 py-1 transition-all mx-auto">
                                            <i class="bi bi-printer"></i> Cetak Struk
                                        </button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-mono text-slate-600 font-medium">#TRX-9980</td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-800">19 Jan 2025</div>
                                        <div class="text-xs text-slate-400">09:15 WIB</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">Siti Aminah</div>
                                        <div class="text-xs text-slate-500">Tagihan Des 2024</div>
                                    </td>
                                    <td class="px-6 py-4 text-right font-mono text-slate-500">Rp 2.500</td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="font-bold font-mono text-emerald-600">Rp 150.000</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded text-xs font-medium bg-gray-100 text-slate-600">
                                            <i class="bi bi-person"></i> Petugas1
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="text-primary hover:text-indigo-800 text-xs font-semibold flex items-center justify-center gap-1 border border-primary/20 hover:border-primary rounded px-2 py-1 transition-all mx-auto">
                                            <i class="bi bi-printer"></i> Cetak Struk
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <div id="modalBayar" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" onclick="toggleModal('modalBayar')"></div>
        
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-2xl bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-100">
            
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-100 p-2 rounded-lg text-emerald-600">
                        <i class="bi bi-cart-check-fill text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Entri Pembayaran</h3>
                        <p class="text-xs text-slate-500">Formulir pembayaran tagihan listrik</p>
                    </div>
                </div>
                <button onclick="toggleModal('modalBayar')" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
            </div>
            
            <form action="proses_bayar.php" method="POST" class="p-6">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Pilih Tagihan Pending</label>
                    <select name="id_tagihan" class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none text-sm bg-white">
                        <option value="">-- Cari Pelanggan / ID Tagihan --</option>
                        <option value="TAG-003">Budi Santoso - Jan 2025 (Rp 205.000)</option>
                        <option value="TAG-004">Ahmad Fauzi - Jan 2025 (Rp 350.000)</option>
                    </select>
                </div>

                <div class="bg-slate-50 rounded-lg p-4 border border-slate-100 mb-6">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="block text-slate-400 text-xs">ID Pelanggan</span>
                            <span class="font-medium text-slate-700">PLG-2023001</span>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs">Periode</span>
                            <span class="font-medium text-slate-700">Januari 2025</span>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs">Pemakaian</span>
                            <span class="font-medium text-slate-700">150 kWh</span>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs">Tarif / Daya</span>
                            <span class="font-medium text-slate-700">R1 / 900 VA</span>
                        </div>
                    </div>
                    <div class="border-t border-slate-200 my-3"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600 font-medium">Tagihan Listrik</span>
                        <span class="font-mono font-medium">Rp 202.500</span>
                    </div>
                    <div class="flex justify-between items-center mt-1">
                        <span class="text-slate-600 font-medium">Biaya Admin</span>
                        <span class="font-mono font-medium">Rp 2.500</span>
                    </div>
                    <div class="flex justify-between items-center mt-3 pt-3 border-t border-slate-200">
                        <span class="text-slate-800 font-bold text-lg">Total Bayar</span>
                        <span class="font-mono font-bold text-xl text-emerald-600">Rp 205.000</span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Uang Diterima (Cash)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-slate-500 font-medium">Rp</span>
                        <input type="number" name="bayar" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 outline-none font-mono text-lg" placeholder="Masukan nominal..." required>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" onclick="toggleModal('modalBayar')" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-lg shadow-emerald-500/30 transition-colors flex items-center gap-2">
                        <i class="bi bi-check-lg"></i> Proses Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
    </script>
</body>
</html>