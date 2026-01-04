<?php
session_start();
// if (!isset($_SESSION['user'])) { header("Location: login.php"); }
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
                    <h2 class="font-semibold text-lg text-slate-800">Manajemen Tagihan</h2>
                </div>
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 bg-slate-200 rounded-full flex items-center justify-center text-slate-500">
                        <i class="bi bi-person-fill text-xl"></i>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 lg:p-10">
                
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Data Tagihan & Penggunaan</h1>
                        <p class="text-slate-500 mt-1 text-sm">Input meteran dan kelola status pembayaran.</p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <select class="px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 text-slate-600">
                            <option>Bulan Ini</option>
                            <option>Januari</option>
                            <option>Februari</option>
                            </select>
                        <select class="px-3 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 text-slate-600">
                            <option>2025</option>
                            <option>2024</option>
                        </select>

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
                                    <th class="px-6 py-4">Jumlah Meter</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm text-slate-700">
                                
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">#TAG-001</div>
                                        <div class="text-xs text-slate-500 mt-0.5">Januari 2025</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900">Budi Santoso</div>
                                        <div class="text-xs text-slate-500">PLG-2023001</div>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-slate-600 text-xs">
                                        <div>Awal : 01200</div>
                                        <div>Akhir: 01350</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-slate-800">150</span> kWh
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-600 border border-rose-100">
                                            <i class="bi bi-hourglass-split"></i> Belum Bayar
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Meteran">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <a href="pembayaran.php?id=TAG-001" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors font-medium text-xs flex items-center gap-1 border border-transparent hover:border-emerald-200">
                                                <i class="bi bi-cash"></i> Bayar
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">#TAG-002</div>
                                        <div class="text-xs text-slate-500 mt-0.5">Januari 2025</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-900">Siti Aminah</div>
                                        <div class="text-xs text-slate-500">PLG-2023002</div>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-slate-600 text-xs">
                                        <div>Awal : 00500</div>
                                        <div>Akhir: 00580</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-slate-800">80</span> kWh
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                            <i class="bi bi-check-circle-fill"></i> Lunas
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="text-primary hover:text-indigo-800 text-xs font-medium">Cetak Struk</button>
                                    </td>
                                </tr>

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
                <h3 class="text-lg font-bold text-slate-800">Input Pemakaian Listrik</h3>
                <button onclick="toggleModal('modalInputTagihan')" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
            </div>
            
            <form action="proses_tambah_tagihan.php" method="POST" class="space-y-4">
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Cari Pelanggan</label>
                    <select name="id_pelanggan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none text-sm bg-white">
                        <option value="">-- Pilih ID Pelanggan / Nama --</option>
                        <option value="1">PLG-001 - Budi Santoso</option>
                        <option value="2">PLG-002 - Siti Aminah</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Bulan</label>
                        <select name="bulan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none text-sm bg-white">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tahun</label>
                        <input type="number" name="tahun" value="2025" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-500 mb-1">Meter Awal</label>
                        <input type="number" name="meter_awal" class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm text-slate-500 cursor-not-allowed font-mono" value="01200" readonly>
                        <p class="text-[10px] text-slate-400 mt-1">*Otomatis dari bulan lalu</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Meter Akhir</label>
                        <input type="number" name="meter_akhir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none text-sm font-mono font-bold text-slate-800" placeholder="00000" required>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" onclick="toggleModal('modalInputTagihan')" class="px-4 py-2 text-sm font-medium text-slate-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-indigo-700 rounded-lg shadow-lg shadow-indigo-500/30 transition-colors">Simpan Tagihan</button>
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