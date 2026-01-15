<?php
session_start();
// if (!isset($_SESSION['user'])) { header("Location: login.php"); }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelanggan - VoltAdmin</title>

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

        .modal-animate {
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
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
                <p class="px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Main Menu</p>
                <a href="dashboard.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
                <a href="user.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-people"></i> Manajemen User
                </a>
                <a href="tarif.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-tag"></i> Data Tarif
                </a>
                <a href="pelanggan.php" class="flex items-center gap-3 px-4 py-2.5 bg-indigo-50 text-primary rounded-lg font-semibold transition-all">
                    <i class="bi bi-person-badge-fill"></i> Pelanggan
                </a>

                <p class="px-4 text-[11px] font-bold uppercase tracking-wider text-slate-400 mt-6 mb-2">Transaksi</p>
                <a href="tagihan.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
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

        <div class="flex-1 flex flex-col h-full overflow-hidden">

            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center justify-between px-8 shrink-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden p-2 text-slate-500 hover:bg-slate-50 rounded-lg">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                    <nav class="flex text-sm text-slate-400" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">Data Master</li>
                            <li><i class="bi bi-chevron-right text-[10px] mx-1"></i></li>
                            <li class="text-slate-900 font-semibold">Pelanggan</li>
                        </ol>
                    </nav>
                </div>
                <div class="flex items-center gap-3 pl-4 border-l border-slate-100">
                    <div class="h-8 w-8 bg-indigo-50 rounded-full flex items-center justify-center text-primary">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-700">Administrator</span>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 lg:p-10">

                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Database Pelanggan</h1>
                        <p class="text-slate-500 text-sm mt-1">Total 1,250 pelanggan terdaftar dalam sistem.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <div class="relative group">
                            <input type="text" placeholder="Cari ID atau nama..." class="pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-primary/5 focus:border-primary w-full sm:w-64 transition-all">
                            <i class="bi bi-search absolute left-3.5 top-2.5 text-slate-400 group-focus-within:text-primary"></i>
                        </div>
                        <button onclick="toggleModal('modalTambah')" class="bg-primary hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 shadow-lg shadow-primary/20 transition-all active:scale-95">
                            <i class="bi bi-plus-circle-fill"></i>
                            Tambah Pelanggan
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] font-extrabold border-b border-slate-50 bg-slate-50/50">
                                    <th class="px-8 py-4 w-16 text-center">No</th>
                                    <th class="px-8 py-4">Data Pelanggan</th>
                                    <th class="px-8 py-4">Informasi KWH</th>
                                    <th class="px-8 py-4">Alamat</th>
                                    <th class="px-8 py-4">Kategori Daya</th>
                                    <th class="px-8 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-sm font-medium">
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-5 text-center text-slate-300 font-mono">01</td>
                                    <td class="px-8 py-5">
                                        <div class="flex flex-col">
                                            <span class="text-slate-900 font-bold">Budi Santoso</span>
                                            <span class="text-[11px] text-primary font-semibold">@budisantoso</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 font-mono text-slate-600 bg-slate-50/50">5482910293</td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-2 text-slate-500">
                                            <i class="bi bi-geo-alt text-slate-300"></i>
                                            <span class="truncate max-w-[180px]">Jl. Merpati No. 45, Jaksel</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-indigo-50 text-primary border border-indigo-100">
                                            900 VA
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="h-8 w-8 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-indigo-50 rounded-lg transition-all"><i class="bi bi-pencil-square"></i></button>
                                            <button class="h-8 w-8 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-5 text-center text-slate-300 font-mono">02</td>
                                    <td class="px-8 py-5">
                                        <div class="flex flex-col">
                                            <span class="text-slate-900 font-bold">Siti Aminah</span>
                                            <span class="text-[11px] text-primary font-semibold">@sitiaminah</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 font-mono text-slate-600 bg-slate-50/50">1239847562</td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-2 text-slate-500">
                                            <i class="bi bi-geo-alt text-slate-300"></i>
                                            <span class="truncate max-w-[180px]">Griya Indah Blok A2</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-100">
                                            450 VA
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="h-8 w-8 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-indigo-50 rounded-lg transition-all"><i class="bi bi-pencil-square"></i></button>
                                            <button class="h-8 w-8 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-8 py-4 border-t border-slate-50 bg-slate-50/30 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Menampilkan 1-2 dari 50 pelanggan</span>
                        <div class="flex items-center gap-1">
                            <button class="p-2 text-slate-400 hover:text-primary disabled:opacity-30"><i class="bi bi-chevron-left"></i></button>
                            <button class="w-8 h-8 rounded-lg bg-primary text-white text-xs font-bold shadow-md shadow-primary/20">1</button>
                            <button class="w-8 h-8 rounded-lg text-slate-500 hover:bg-white hover:shadow-sm text-xs font-bold transition-all">2</button>
                            <button class="p-2 text-slate-400 hover:text-primary"><i class="bi bi-chevron-right"></i></button>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <div id="modalTambah" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="fixed inset-0 bg-dark/40 backdrop-blur-sm transition-opacity" onclick="toggleModal('modalTambah')"></div>

            <div class="relative inline-block w-full max-w-lg bg-white rounded-3xl shadow-2xl p-8 border border-slate-100 text-left align-middle modal-animate">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Tambah Pelanggan Baru</h3>
                        <p class="text-xs text-slate-400 mt-1">Sistem secara otomatis akan menggenerate ID pelanggan.</p>
                    </div>
                    <button onclick="toggleModal('modalTambah')" class="h-8 w-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:text-rose-500 transition-all">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <form action="proses_tambah_pelanggan.php" method="POST" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Username</label>
                            <input type="text" name="username" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary focus:bg-white transition-all text-sm" placeholder="User ID" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Password</label>
                            <input type="password" name="password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary focus:bg-white transition-all text-sm" placeholder="••••••" required>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Nomor KWH (Meteran)</label>
                        <input type="number" name="nomor_kwh" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary focus:bg-white transition-all text-sm font-mono" placeholder="10 Digit Nomor Meter" required>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap Pelanggan</label>
                        <input type="text" name="nama_pelanggan" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary focus:bg-white transition-all text-sm" placeholder="Nama sesuai KTP" required>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Alamat Pemasangan</label>
                        <textarea name="alamat" rows="2" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary focus:bg-white transition-all text-sm" placeholder="Alamat detail lokasi pemasangan..."></textarea>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Pilih Golongan Tarif</label>
                        <select name="id_tarif" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary focus:bg-white transition-all text-sm font-semibold text-slate-700 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%23cbd5e1%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25rem] bg-[right_0.75rem_center] bg-no-repeat">
                            <option value="">-- Pilih Daya --</option>
                            <option value="1">R1 - 450 VA</option>
                            <option value="2">R1 - 900 VA</option>
                            <option value="3">R1 - 1300 VA</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" onclick="toggleModal('modalTambah')" class="px-5 py-2.5 text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">Batal</button>
                        <button type="submit" class="px-6 py-2.5 text-xs font-bold text-white bg-primary hover:bg-indigo-700 rounded-xl shadow-lg shadow-primary/20 transition-all uppercase tracking-widest">Simpan Pelanggan</button>
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