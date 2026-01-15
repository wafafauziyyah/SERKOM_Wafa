<?php
session_start();
// if (!isset($_SESSION['user'])) { header("Location: login.php"); }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tarif - VoltAdmin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },
                    colors: {
                        primary: '#4f46e5',
                        dark: '#0f172a'
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .card-shimmer {
            background: linear-gradient(90deg, #f8fafc 25%, #f1f5f9 50%, #f8fafc 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
</head>

<body class="bg-[#fcfcfd] font-sans text-slate-900 antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-slate-100 hidden lg:flex lg:flex-col shrink-0">
            <div class="p-6">
                <a href="#" class="flex items-center gap-2.5 text-slate-900 font-bold text-xl tracking-tight">
                    <div class="bg-primary p-1.5 rounded-lg shadow-lg shadow-primary/30">
                        <i class="bi bi-lightning-charge-fill text-white text-lg"></i>
                    </div>
                    <span>Volt<span class="text-primary">Admin</span></span>
                </a>
            </div>

            <nav class="flex-1 px-3 space-y-1">
                <p class="px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Utama</p>
                <a href="dashboard.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all">
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
                <a href="user.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all">
                    <i class="bi bi-people"></i> Manajemen User
                </a>
                <a href="tarif.php" class="flex items-center gap-3 px-4 py-2.5 bg-indigo-50 text-primary rounded-lg font-semibold transition-all">
                    <i class="bi bi-tag-fill"></i> Data Tarif
                </a>
                <a href="pelanggan.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all">
                    <i class="bi bi-person-badge"></i> Pelanggan
                </a>

                <p class="px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400 mt-6 mb-2">Transaksi</p>
                <a href="tagihan.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all">
                    <i class="bi bi-receipt-cutoff"></i> Data Tagihan
                </a>
                <a href="pembayaran.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all">
                    <i class="bi bi-wallet2"></i> Riwayat Bayar
                </a>
            </nav>

            <div class="p-4 border-t border-slate-50">
                <a href="login.php" class="flex items-center gap-3 px-4 py-2 text-slate-400 hover:text-rose-500 rounded-lg font-medium transition-all">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-full overflow-hidden">

            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center justify-between px-8 shrink-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden p-2 text-slate-500 hover:bg-slate-50 rounded-lg transition-colors">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                    <div class="hidden sm:flex items-center gap-2 text-slate-400 text-xs font-semibold uppercase tracking-widest">
                        <i class="bi bi-gear"></i> System Settings
                    </div>
                </div>
                <div class="flex items-center gap-3 pl-4 border-l border-slate-100">
                    <div class="h-8 w-8 bg-indigo-50 rounded-lg flex items-center justify-center text-primary">
                        <i class="bi bi-sliders"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-700">Master Data</span>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 lg:p-10">

                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Master Tarif Listrik</h1>
                        <p class="text-slate-500 text-sm mt-1">Standarisasi harga per kWh berdasarkan golongan daya aktif.</p>
                    </div>
                    <button onclick="toggleModal('modalTambahTarif')" class="bg-primary hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 shadow-lg shadow-primary/20 transition-all active:scale-95 w-fit">
                        <i class="bi bi-plus-circle-fill"></i>
                        Update Tarif Baru
                    </button>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] font-extrabold border-b border-slate-50 bg-slate-50/50">
                                    <th class="px-8 py-4 w-20 text-center">No</th>
                                    <th class="px-8 py-4">Golongan</th>
                                    <th class="px-8 py-4">Kapasitas Daya</th>
                                    <th class="px-8 py-4">Biaya Per kWh</th>
                                    <th class="px-8 py-4 text-center">Kontrol</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-sm font-medium">

                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-5 text-center text-slate-300 font-mono">01</td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white font-bold shadow-sm">R1</div>
                                            <span class="text-slate-400 text-xs font-bold">Rumah Tangga</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-lg font-extrabold text-slate-900">450</span>
                                            <span class="text-[10px] text-slate-400 font-bold tracking-widest">VA</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="bg-emerald-50 w-fit px-4 py-2 rounded-xl border border-emerald-100">
                                            <span class="text-[10px] text-emerald-600 font-bold uppercase block leading-none mb-1">Price / Unit</span>
                                            <span class="font-mono font-extrabold text-emerald-600 text-base">Rp 415</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="h-9 w-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-indigo-50 rounded-xl transition-all"><i class="bi bi-pencil-square text-lg"></i></button>
                                            <button class="h-9 w-9 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-xl transition-all"><i class="bi bi-trash text-lg"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-5 text-center text-slate-300 font-mono">02</td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white font-bold shadow-sm">R1</div>
                                            <span class="text-slate-400 text-xs font-bold">Rumah Tangga</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-lg font-extrabold text-slate-900">900</span>
                                            <span class="text-[10px] text-slate-400 font-bold tracking-widest">VA</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="bg-emerald-50 w-fit px-4 py-2 rounded-xl border border-emerald-100">
                                            <span class="text-[10px] text-emerald-600 font-bold uppercase block leading-none mb-1">Price / Unit</span>
                                            <span class="font-mono font-extrabold text-emerald-600 text-base">Rp 1.352</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="h-9 w-9 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-indigo-50 rounded-xl transition-all"><i class="bi bi-pencil-square text-lg"></i></button>
                                            <button class="h-9 w-9 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-xl transition-all"><i class="bi bi-trash text-lg"></i></button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <div id="modalTambahTarif" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="fixed inset-0 bg-dark/40 backdrop-blur-sm transition-opacity" onclick="toggleModal('modalTambahTarif')"></div>

            <div class="relative inline-block w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 border border-slate-100 text-left align-middle transition-all transform scale-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Input Data Tarif</h3>
                        <p class="text-xs text-slate-400 mt-1">Gunakan angka tarif terbaru sesuai kebijakan.</p>
                    </div>
                    <button onclick="toggleModal('modalTambahTarif')" class="h-8 w-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:text-rose-500 transition-all">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <form action="proses_tambah_tarif.php" method="POST" class="space-y-5">
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Kapasitas Daya</label>
                        <div class="relative group">
                            <input type="number" name="daya" class="w-full pl-4 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary transition-all text-sm font-bold text-slate-700" placeholder="1300" required>
                            <span class="absolute right-4 top-3 text-[10px] font-bold text-slate-400 uppercase group-focus-within:text-primary transition-colors">Volt Ampere</span>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Nilai Tarif (Per kWh)</label>
                        <div class="relative group">
                            <span class="absolute left-4 top-3.5 text-xs font-bold text-slate-400 group-focus-within:text-emerald-500 transition-colors">Rp</span>
                            <input type="number" name="tarifperkwh" class="w-full pl-10 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/5 transition-all text-xl font-extrabold font-mono text-slate-900" placeholder="0" required>
                        </div>
                        <p class="text-[9px] text-slate-400 italic ml-1">*Pencatatan nominal akan otomatis dibulatkan oleh sistem.</p>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" onclick="toggleModal('modalTambahTarif')" class="px-5 py-2.5 text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">Batal</button>
                        <button type="submit" class="px-6 py-2.5 text-xs font-bold text-white bg-dark hover:bg-slate-800 rounded-xl shadow-lg shadow-slate-900/10 transition-all active:scale-95 uppercase tracking-widest">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
</body>

</html>