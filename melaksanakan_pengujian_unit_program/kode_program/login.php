<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Listrik Pascabayar</title>
    
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
                        primary: '#4F46E5', 
                        secondary: '#64748B',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 font-sans antialiased">

    <div class="w-full max-w-md">
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            
            <div class="p-8 pb-0 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 text-primary mb-4">
                    <i class="bi bi-lightning-charge-fill text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Listrik Pascabayar</h2>
                <p class="text-slate-500 text-sm">Masuk untuk mengelola tagihan & pembayaran.</p>
            </div>

            <div class="p-8 pt-6">
                
                <?php 
                if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == "gagal"){
                        echo '<div class="mb-5 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                                <i class="bi bi-exclamation-circle-fill"></i> Username atau Password salah!
                              </div>';
                    }else if($_GET['pesan'] == "logout"){
                        echo '<div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                                <i class="bi bi-check-circle-fill"></i> Anda berhasil logout.
                              </div>';
                    }else if($_GET['pesan'] == "belum_login"){
                        echo '<div class="mb-5 bg-amber-50 border border-amber-200 text-amber-600 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                                <i class="bi bi-shield-lock-fill"></i> Silakan login terlebih dahulu.
                              </div>';
                    }
                }
                ?>

                <form action="controller/cek_login.php" method="POST" class="space-y-5">
                    
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="bi bi-person"></i>
                            </div>
                            <input type="text" 
                                   id="username" 
                                   name="username" 
                                   class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary focus:bg-white transition-all duration-200 placeholder-gray-400 text-slate-800" 
                                   placeholder="Masukkan username" 
                                   required>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="bi bi-lock"></i>
                            </div>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary focus:bg-white transition-all duration-200 placeholder-gray-400 text-slate-800" 
                                   placeholder="••••••" 
                                   required>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-lg shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                        MASUK APLIKASI
                    </button>

                </form>
            </div>
            
            <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 text-center">
                <p class="text-xs text-slate-400">
                    &copy; 2025 Aplikasi Pembayaran Listrik
                </p>
            </div>

        </div>
        
    </div>

</body>
</html>