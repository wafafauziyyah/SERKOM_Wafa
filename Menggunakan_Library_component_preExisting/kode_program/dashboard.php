<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - VoltAdmin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#4f46e5',
                        secondary: '#64748b',
                        accent: '#f5f3ff',
                        dark: '#0f172a',
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

        ::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .sidebar-item-active {
            background: linear-gradient(90deg, rgba(79, 70, 229, 0.1) 0%, rgba(79, 70, 229, 0) 100%);
            border-left: 4px solid #4f46e5;
        }
    </style>
</head>

<body class="bg-[#fcfcfd] font-sans text-slate-900 antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-slate-100 hidden lg:flex lg:flex-col shrink-0">
            <div class="p-6 mb-4">
                <a href="#" class="flex items-center gap-2.5 text-slate-900 font-bold text-xl tracking-tight">
                    <div class="bg-primary p-1.5 rounded-lg shadow-lg shadow-primary/30">
                        <i class="bi bi-lightning-charge-fill text-white text-lg"></i>
                    </div>
                    <span>Volt<span class="text-primary">Admin</span></span>
                </a>
            </div>

            <nav class="flex-1 px-3 space-y-1">
                <p class="px-4 text-[11px] font-bold uppercase tracking-[0.1em] text-slate-400 mb-2">Utama</p>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 sidebar-item-active text-primary font-semibold transition-all">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
                <a href="user.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-people group-hover:scale-110 transition-transform"></i> Manajemen User
                </a>
                <a href="tarif.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-tag"></i> Data Tarif
                </a>
                <a href="pelanggan.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-person-badge"></i> Pelanggan
                </a>

                <p class="px-4 text-[11px] font-bold uppercase tracking-[0.1em] text-slate-400 mt-8 mb-2">Transaksi</p>
                <a href="tagihan.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-receipt-cutoff"></i> Data Tagihan
                </a>
                <a href="pembayaran.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-wallet2"></i> Riwayat Bayar
                </a>
            </nav>

            <div class="p-4 border-t border-slate-50">
                <a href="login.php" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-xl font-medium transition-all">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-full overflow-hidden">

            <header class="h-16 bg-white/80 glass-effect border-b border-slate-100 flex items-center justify-between px-8 shrink-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden p-2 text-slate-500 hover:bg-slate-50 rounded-lg transition-colors">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                    <div class="hidden md:block">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Overview</span>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="relative">
                        <i class="bi bi-bell text-slate-400 text-lg hover:text-primary cursor-pointer transition-colors"></i>
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                    </div>
                    <div class="flex items-center gap-3 pl-6 border-l border-slate-100">
                        <div class="text-right">
                            <p class="text-sm font-bold text-slate-900 leading-none">Super Admin</p>
                            <span class="text-[10px] text-emerald-500 font-bold uppercase tracking-tighter">● Online</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Admin&background=4f46e5&color=fff" class="h-9 w-9 rounded-full ring-2 ring-slate-50 shadow-sm" alt="Avatar">
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 lg:p-10">

                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Statistik Overview</h1>
                    <p class="text-slate-500 text-sm">Update terakhir: <?php echo date('d F Y'); ?></p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.04)] group hover:border-primary/20 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-indigo-50 text-primary rounded-xl group-hover:scale-110 transition-transform">
                                <i class="bi bi-people-fill text-xl"></i>
                            </div>
                            <div>
                                <p class="text-[13px] text-slate-500 font-medium">Total Pelanggan</p>
                                <p class="text-2xl font-bold text-slate-900">1,250</p>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-50 flex items-center text-xs">
                            <span class="text-emerald-500 font-bold flex items-center">
                                <i class="bi bi-graph-up-arrow mr-1"></i> +12.5%
                            </span>
                            <span class="text-slate-400 ml-2">dari bulan lalu</span>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.04)] group hover:border-emerald-200 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-emerald-50 text-emerald-500 rounded-xl group-hover:scale-110 transition-transform">
                                <i class="bi bi-check2-circle text-xl"></i>
                            </div>
                            <div>
                                <p class="text-[13px] text-slate-500 font-medium">Tagihan Lunas</p>
                                <p class="text-2xl font-bold text-slate-900">850</p>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-50 flex items-center text-xs">
                            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-emerald-500 h-full w-[68%]"></div>
                            </div>
                            <span class="ml-3 font-bold text-slate-600">68%</span>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.04)] group hover:border-rose-200 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-rose-50 text-rose-500 rounded-xl group-hover:scale-110 transition-transform">
                                <i class="bi bi-exclamation-triangle text-xl"></i>
                            </div>
                            <div>
                                <p class="text-[13px] text-slate-500 font-medium">Belum Bayar</p>
                                <p class="text-2xl font-bold text-slate-900">400</p>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center gap-1 text-[11px] font-bold text-rose-500 px-2 py-1 bg-rose-50 rounded-lg w-fit">
                            <i class="bi bi-clock"></i> Butuh Tindakan
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.04)] group hover:border-amber-200 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-amber-50 text-amber-500 rounded-xl group-hover:scale-110 transition-transform">
                                <i class="bi bi-wallet2 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-[13px] text-slate-500 font-medium">Pendapatan</p>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-sm font-bold text-slate-400">Rp</span>
                                    <p class="text-2xl font-bold text-slate-900">125jt</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between text-[11px]">
                            <span class="text-slate-400">Target: 150jt</span>
                            <span class="text-amber-600 font-bold">83%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="px-8 py-5 border-b border-slate-50 flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-slate-900">Tagihan Terbaru</h3>
                            <p class="text-xs text-slate-400">Monitoring aktivitas pembayaran real-time</p>
                        </div>
                        <a href="tagihan.php" class="px-4 py-2 text-xs text-slate-600 font-bold hover:bg-slate-50 border border-slate-200 rounded-lg transition-all">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-slate-400 text-[11px] uppercase tracking-widest font-bold bg-slate-50/50">
                                    <th class="px-8 py-4">ID Pelanggan</th>
                                    <th class="px-8 py-4">Nama Pelanggan</th>
                                    <th class="px-8 py-4">Total Tagihan</th>
                                    <th class="px-8 py-4">Status</th>
                                    <th class="px-8 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-sm">
                                <tr class="hover:bg-slate-50/30 transition-colors">
                                    <td class="px-8 py-4">
                                        <span class="font-mono text-xs font-semibold text-primary bg-indigo-50 px-2 py-1 rounded">PLG001</span>
                                    </td>
                                    <td class="px-8 py-4 font-semibold text-slate-700">Budi Santoso</td>
                                    <td class="px-8 py-4 font-bold text-slate-900">Rp 250.000</td>
                                    <td class="px-8 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                            LUNAS
                                        </span>
                                    </td>
                                    <td class="px-8 py-4 text-right">
                                        <button class="h-8 w-8 inline-flex items-center justify-center text-slate-400 hover:text-primary hover:bg-indigo-50 rounded-full transition-all">
                                            <i class="bi bi-chevron-right text-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50/30 transition-colors">
                                    <td class="px-8 py-4">
                                        <span class="font-mono text-xs font-semibold text-primary bg-indigo-50 px-2 py-1 rounded">PLG002</span>
                                    </td>
                                    <td class="px-8 py-4 font-semibold text-slate-700">Siti Aminah</td>
                                    <td class="px-8 py-4 font-bold text-slate-900">Rp 180.000</td>
                                    <td class="px-8 py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-100">
                                            PENDING
                                        </span>
                                    </td>
                                    <td class="px-8 py-4 text-right">
                                        <button class="h-8 w-8 inline-flex items-center justify-center text-slate-400 hover:text-primary hover:bg-indigo-50 rounded-full transition-all">
                                            <i class="bi bi-chevron-right text-lg"></i>
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
</body>

</html>