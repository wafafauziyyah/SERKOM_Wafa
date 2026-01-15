<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - VoltAdmin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#4f46e5',
                        dark: '#0f172a',
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .bg-mesh {
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(79, 70, 229, 0.05) 0px, transparent 50%);
        }
    </style>
</head>

<body class="bg-mesh min-h-screen flex items-center justify-center p-6 font-sans antialiased">

    <div class="w-full max-w-[440px]">

        <div class="flex flex-col items-center mb-10">
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-primary to-indigo-400 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white p-3 rounded-2xl shadow-xl flex items-center justify-center">
                    <i class="bi bi-lightning-charge-fill text-3xl text-primary"></i>
                </div>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight mt-6">Volt<span class="text-primary">Admin</span></h1>
            <div class="h-1 w-8 bg-primary/20 rounded-full mt-2"></div>
        </div>

        <div class="glass-card rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] overflow-hidden">

            <div class="p-8 md:p-12">
                <div class="mb-10 text-center">
                    <h2 class="text-2xl font-bold text-slate-900">Login Admin</h2>
                    <p class="text-slate-500 text-sm mt-2">Masukkan kredensial Anda untuk akses sistem</p>
                </div>

                <form action="dashboard.php" method="POST" class="space-y-5">

                    <div class="space-y-2">
                        <label for="username" class="block text-[11px] font-bold text-slate-400 uppercase tracking-[0.15em] ml-1">Username</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary transition-colors">
                                <i class="bi bi-person text-xl"></i>
                            </div>
                            <input type="text"
                                id="username"
                                name="username"
                                class="w-full pl-12 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-primary/5 focus:border-primary focus:bg-white transition-all duration-200 placeholder-slate-300 text-slate-700 font-medium"
                                placeholder="Username"
                                required>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between ml-1">
                            <label for="password" class="block text-[11px] font-bold text-slate-400 uppercase tracking-[0.15em]">Password</label>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-primary transition-colors">
                                <i class="bi bi-lock text-xl"></i>
                            </div>
                            <input type="password"
                                id="password"
                                name="password"
                                class="w-full pl-12 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-primary/5 focus:border-primary focus:bg-white transition-all duration-200 placeholder-slate-300 text-slate-700 font-medium"
                                placeholder="••••••••"
                                required>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-indigo-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-primary/20 transition-all duration-300 transform active:scale-[0.98] flex items-center justify-center gap-3 tracking-wide mt-8">
                        MASUK KE PANEL
                        <i class="bi bi-arrow-right text-lg"></i>
                    </button>

                </form>
            </div>

            <div class="bg-slate-50/80 px-8 py-5 border-t border-slate-100 text-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
                    &copy; 2026 VoltApp Ecosystem • Secure Access
                </p>
            </div>

        </div>

        <div class="flex items-center justify-center gap-4 mt-8">
            <a href="#" class="text-slate-400 hover:text-primary text-xs font-semibold transition-colors flex items-center gap-1">
                <i class="bi bi-question-circle"></i> Bantuan IT
            </a>
            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
            <a href="#" class="text-slate-400 hover:text-primary text-xs font-semibold transition-colors">Kebijakan Privasi</a>
        </div>

    </div>

</body>

</html>