<?php
session_start();
// if (!isset($_SESSION['user'])) { header("Location: login.php"); }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tagihan - VoltAdmin</title>

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

        .status-pulse {
            position: relative;
        }

        .status-pulse::after {
            content: '';
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: currentColor;
            left: -12px;
            top: 50%;
            transform: translateY(-50%);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
                transform: translateY(-50%) scale(1);
            }

            100% {
                opacity: 0;
                transform: translateY(-50%) scale(2.5);
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
                <a href="dashboard.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
                <a href="user.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-people"></i> Manajemen User
                </a>
                <a href="tarif.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-tag"></i> Data Tarif
                </a>
                <a href="pelanggan.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-person-badge"></i> Pelanggan
                </a>

                <p class="px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400 mt-6 mb-2">Transaksi</p>
                <a href="tagihan.php" class="flex items-center gap-3 px-4 py-2.5 bg-indigo-50 text-primary rounded-lg font-semibold transition-all">
                    <i class="bi bi-receipt-cutoff"></i> Data Tagihan
                </a>
                <a href="pembayaran.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-wallet2"></i> Riwayat Bayar
                </a>
            </nav>

            <div class="p-4 border-t border-slate-50">
                <a href="login.php" class="flex items-center gap-3 px-4 py-2 text-slate-400 hover:text-rose-500 rounded-lg font-medium transition-all">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-full overflow-hidden relative">

            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center justify-between px-8 shrink-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden p-2 text-slate-500 hover:bg-slate-50 rounded-lg">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                    <div class="flex items-center gap-2 text-slate-400 text-sm">
                        <i class="bi bi-calendar3"></i>
                        <span class="font-medium"><?php echo date('F Y'); ?></span>
                    </div>
                </div>
                <div class="flex items-center gap-3 pl-4 border-l border-slate-100">
                    <div class="h-8 w-8 bg-indigo-50 rounded-full flex items-center justify-center text-primary border border-indigo-100">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-700">Billing Manager</span>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 lg:p-10">

                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Billing & Usage</h1>
                        <p class="text-slate-500 text-sm mt-1">Kelola pencatatan meteran dan monitoring status tagihan.</p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <div class="flex bg-white p-1 rounded-xl border border-slate-200 shadow-sm">
                            <select class="px-3 py-1.5 bg-transparent text-xs font-bold text-slate-600 focus:outline-none border-r border-slate-100 cursor-pointer">
                                <option>Semua Bulan</option>
                                <option>Januari</option>
                            </select>
                            <select class="px-3 py-1.5 bg-transparent text-xs font-bold text-slate-600 focus:outline-none cursor-pointer">
                                <option>2026</option>
                                <option>2025</option>
                            </select>
                        </div>

                        <button onclick="toggleModal('modalInputTagihan')" class="bg-primary hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 shadow-lg shadow-primary/20 transition-all active:scale-95">
                            <i class="bi bi-plus-circle-fill"></i>
                            Entry Tagihan Baru
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] font-extrabold border-b border-slate-50 bg-slate-50/50">
                                    <th class="px-8 py-4">ID & Periode</th>
                                    <th class="px-8 py-4">Nama Pelanggan</th>
                                    <th class="px-8 py-4">Indikator Meter (kWh)</th>
                                    <th class="px-8 py-4">Konsumsi</th>
                                    <th class="px-8 py-4">Status</th>
                                    <th class="px-8 py-4 text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-sm font-medium">

                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="text-primary font-bold font-mono text-xs">#TAG-001</div>
                                        <div class="text-[10px] font-bold text-slate-400 mt-0.5">Januari 2026</div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="text-slate-900 font-bold uppercase text-[13px]">Budi Santoso</div>
                                        <div class="text-[11px] text-slate-400 font-mono">PLG-2023001</div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[11px] font-mono text-slate-400">1200</span>
                                            <div class="h-1 w-8 bg-slate-100 rounded-full relative overflow-hidden">
                                                <div class="absolute inset-0 bg-primary/30 w-full"></div>
                                            </div>
                                            <span class="text-[11px] font-mono text-primary font-bold">1350</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-base font-extrabold text-slate-900">150</span>
                                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">kWh</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-100 uppercase tracking-wider ml-3 status-pulse">
                                            UNPAID
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="h-8 w-8 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-indigo-50 rounded-lg transition-all"><i class="bi bi-pencil"></i></button>
                                            <a href="pembayaran.php?id=TAG-001" class="px-3 py-1.5 bg-emerald-500 text-white hover:bg-emerald-600 rounded-lg transition-all font-bold text-[10px] flex items-center gap-1.5 shadow-md shadow-emerald-500/20 uppercase tracking-widest">
                                                <i class="bi bi-wallet2"></i> Bayar
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="text-primary font-bold font-mono text-xs">#TAG-002</div>
                                        <div class="text-[10px] font-bold text-slate-400 mt-0.5">Januari 2026</div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="text-slate-900 font-bold uppercase text-[13px]">Siti Aminah</div>
                                        <div class="text-[11px] text-slate-400 font-mono">PLG-2023002</div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[11px] font-mono text-slate-400">500</span>
                                            <div class="h-1 w-8 bg-slate-100 rounded-full relative"></div>
                                            <span class="text-[11px] font-mono text-primary font-bold">580</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-base font-extrabold text-slate-900">80</span>
                                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">kWh</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 uppercase tracking-wider">
                                            <i class="bi bi-check2-circle mr-1"></i> Lunas
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <button class="px-3 py-1.5 text-[10px] font-bold text-slate-500 hover:text-primary border border-slate-200 hover:border-primary rounded-lg transition-all uppercase tracking-widest">Invoice</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <div id="modalInputTagihan" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="fixed inset-0 bg-dark/40 backdrop-blur-sm transition-opacity" onclick="toggleModal('modalInputTagihan')"></div>

            <div class="relative inline-block w-full max-w-lg bg-white rounded-3xl shadow-2xl p-8 border border-slate-100 text-left align-middle transition-all transform scale-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Pencatatan Meteran</h3>
                        <p class="text-xs text-slate-400 mt-1">Input angka meteran baru untuk generate tagihan.</p>
                    </div>
                    <button onclick="toggleModal('modalInputTagihan')" class="h-8 w-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:text-rose-500 transition-all">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <form action="proses_tambah_tagihan.php" method="POST" class="space-y-5">

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Pelanggan</label>
                        <select name="id_pelanggan" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary font-bold text-slate-700 text-sm appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%23cbd5e1%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25rem] bg-[right_0.75rem_center] bg-no-repeat cursor-pointer">
                            <option value="">Cari ID atau Nama...</option>
                            <option value="1">PLG-001 - Budi Santoso</option>
                            <option value="2">PLG-002 - Siti Aminah</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Bulan</label>
                            <select name="bulan" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary text-sm font-semibold text-slate-700 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%23cbd5e1%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25rem] bg-[right_0.75rem_center] bg-no-repeat">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Tahun</label>
                            <input type="number" name="tahun" value="2026" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary text-sm font-semibold text-slate-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-300 uppercase tracking-widest ml-1">Meter Awal</label>
                            <div class="relative">
                                <input type="number" name="meter_awal" class="w-full px-4 py-3 bg-slate-100/50 border border-slate-100 rounded-xl text-sm font-bold font-mono text-slate-400 cursor-not-allowed" value="1200" readonly>
                                <i class="bi bi-lock-fill absolute right-3 top-3 text-[10px] text-slate-300"></i>
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-primary uppercase tracking-widest ml-1">Meter Akhir</label>
                            <input type="number" name="meter_akhir" class="w-full px-4 py-3 bg-white border-2 border-primary/20 rounded-xl focus:outline-none focus:border-primary text-xl font-extrabold font-mono text-slate-900" placeholder="0000" required>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-6">
                        <button type="button" onclick="toggleModal('modalInputTagihan')" class="px-5 py-2.5 text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">Batal</button>
                        <button type="submit" class="px-8 py-2.5 text-xs font-bold text-white bg-primary hover:bg-indigo-700 rounded-xl shadow-lg shadow-primary/20 transition-all active:scale-95 uppercase tracking-widest">Simpan & Generate</button>
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