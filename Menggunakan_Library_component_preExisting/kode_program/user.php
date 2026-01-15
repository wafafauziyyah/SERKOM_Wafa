<?php
session_start();
// if (!isset($_SESSION['user'])) { header("Location: login.php"); }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - VoltAdmin</title>

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

        .avatar-gradient-1 {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        }

        .avatar-gradient-2 {
            background: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
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
                <a href="user.php" class="flex items-center gap-3 px-4 py-2.5 bg-indigo-50 text-primary rounded-lg font-semibold transition-all">
                    <i class="bi bi-people-fill"></i> Manajemen User
                </a>
                <a href="tarif.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-tag"></i> Data Tarif
                </a>
                <a href="pelanggan.php" class="flex items-center gap-3 px-4 py-2.5 text-slate-500 hover:text-primary hover:bg-slate-50 rounded-lg font-medium transition-all group">
                    <i class="bi bi-person-badge"></i> Pelanggan
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

        <div class="flex-1 flex flex-col h-full overflow-hidden relative">

            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center justify-between px-8 shrink-0 z-10">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden p-2 text-slate-500 hover:bg-slate-50 rounded-lg">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                    <div class="flex items-center gap-2 text-slate-400 text-xs font-bold uppercase tracking-widest">
                        <i class="bi bi-shield-check text-primary"></i> Akses Kontrol
                    </div>
                </div>
                <div class="flex items-center gap-3 pl-4 border-l border-slate-100">
                    <div class="h-8 w-8 bg-purple-50 rounded-full flex items-center justify-center text-purple-600">
                        <i class="bi bi-lock"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-700">Privileged Account</span>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 lg:p-10">

                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Akun Petugas</h1>
                        <p class="text-slate-500 text-sm mt-1">Otorisasi dan pengaturan hak akses tim operasional.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <div class="relative group">
                            <input type="text" placeholder="Cari nama atau user..." class="pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-primary/5 focus:border-primary w-full sm:w-64 transition-all">
                            <i class="bi bi-search absolute left-3.5 top-2.5 text-slate-400 group-focus-within:text-primary transition-colors"></i>
                        </div>
                        <button onclick="toggleModal('modalTambahUser')" class="bg-primary hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 shadow-lg shadow-primary/20 transition-all active:scale-95">
                            <i class="bi bi-plus-circle-fill"></i>
                            Tambah Akun Baru
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] font-extrabold border-b border-slate-50 bg-slate-50/50">
                                    <th class="px-8 py-4 w-20 text-center">No</th>
                                    <th class="px-8 py-4">Informasi Profil</th>
                                    <th class="px-8 py-4">Kredensial</th>
                                    <th class="px-8 py-4">Level Akses</th>
                                    <th class="px-8 py-4 text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-sm font-medium">

                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-5 text-center text-slate-300 font-mono text-xs">01</td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl avatar-gradient-1 flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-200">A</div>
                                            <div>
                                                <div class="text-slate-900 font-bold">Administrator Utama</div>
                                                <div class="text-[10px] text-emerald-500 font-bold uppercase tracking-tighter">● Online</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="text-slate-500 font-mono bg-slate-100 px-2 py-1 rounded text-xs italic">@admin</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] font-bold bg-purple-50 text-purple-600 border border-purple-100 uppercase tracking-widest">
                                            <i class="bi bi-shield-lock-fill"></i> Administrator
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="h-8 w-8 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-indigo-50 rounded-lg transition-all"><i class="bi bi-pencil-square"></i></button>
                                            <button class="h-8 w-8 flex items-center justify-center text-slate-200 cursor-not-allowed" disabled><i class="bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-5 text-center text-slate-300 font-mono text-xs">02</td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl avatar-gradient-2 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-200">B</div>
                                            <div>
                                                <div class="text-slate-900 font-bold">Budi Loket 1</div>
                                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter italic">Offline</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="text-slate-500 font-mono bg-slate-100 px-2 py-1 rounded text-xs italic">@petugas1</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100 uppercase tracking-widest">
                                            <i class="bi bi-person-badge"></i> Petugas
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="h-8 w-8 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-indigo-50 rounded-lg transition-all"><i class="bi bi-pencil-square"></i></button>
                                            <button class="h-8 w-8 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all"><i class="bi bi-trash"></i></button>
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

    <div id="modalTambahUser" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div class="fixed inset-0 bg-dark/40 backdrop-blur-sm transition-opacity" onclick="toggleModal('modalTambahUser')"></div>

            <div class="relative inline-block w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 border border-slate-100 text-left align-middle transition-all transform scale-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Registrasi Akun Petugas</h3>
                        <p class="text-xs text-slate-400 mt-1">Pastikan kredensial login sudah sesuai standar keamanan.</p>
                    </div>
                    <button onclick="toggleModal('modalTambahUser')" class="h-8 w-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:text-rose-500 transition-all">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <form action="proses_tambah_user.php" method="POST" class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="nama_admin" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary font-bold text-slate-700 text-sm" placeholder="Contoh: Ahmad Subardjo" required>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Username Login</label>
                        <div class="relative">
                            <span class="absolute left-4 top-2.5 text-slate-300 text-sm">@</span>
                            <input type="text" name="username" class="w-full pl-8 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary font-bold text-slate-700 text-sm" placeholder="username" required>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary font-bold text-slate-700 text-sm" placeholder="••••••••" required>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Role / Hak Akses</label>
                        <select name="id_level" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary font-bold text-slate-700 text-sm appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%23cbd5e1%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-[length:1.25rem] bg-[right_0.75rem_center] bg-no-repeat">
                            <option value="1">Administrator (Full Access)</option>
                            <option value="2">Petugas Lapangan (Limited)</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-6">
                        <button type="button" onclick="toggleModal('modalTambahUser')" class="px-5 py-2 text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition-all">Batal</button>
                        <button type="submit" class="px-6 py-2.5 text-xs font-bold text-white bg-dark hover:bg-slate-800 rounded-xl shadow-lg shadow-slate-900/10 transition-all active:scale-95 uppercase tracking-widest">Aktivasi Akun</button>
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