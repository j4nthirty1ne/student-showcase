<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student Project Showcase')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700;14..32,800;14..32,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Theme init before render (no flash) --}}
    <script>
        (function () {
            const t = localStorage.getItem('theme');
            if (t === 'dark') {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
            }
        })();
    </script>

    <style>
        html.light body { background-color: #f0f7f6; }
        html.dark  body { background-color: #040d12; }
    </style>
</head>

{{-- Body inherits only font & transition; bg set above by JS-class ──────────────────── --}}
<body class="font-sans antialiased min-h-screen relative overflow-x-hidden transition-colors duration-500">

    {{-- ───────── LIGHT BACKGROUND CANVAS ──────────────────────────────────────────────── --}}
    <div class="light-only fixed inset-0 -z-10 pointer-events-none overflow-hidden">
        <div class="absolute inset-0" style="background:#f0f7f6;"></div>
        <div class="absolute top-[-5%]  left-[-5%]  w-[50vw] h-[50vw] rounded-full blur-[120px]" style="background:rgba(13,148,136,.12);"></div>
        <div class="absolute bottom-[0%]  right-[-5%] w-[40vw] h-[40vw] rounded-full blur-[100px]" style="background:rgba(8,145,178,.08);"></div>
        <div class="absolute top-[40%]  left-[30%]  w-[30vw] h-[30vw] rounded-full blur-[80px]"  style="background:rgba(15,118,110,.07);"></div>
    </div>

    {{-- ───────── DARK BACKGROUND CANVAS ───────────────────────────────────────────────── --}}
    <div class="dark-only fixed inset-0 -z-10 pointer-events-none overflow-hidden">
        <div class="absolute inset-0" style="background:#040d12;"></div>
        <div class="absolute top-[-5%]  left-[-5%]  w-[55vw] h-[55vw] rounded-full blur-[130px]" style="background:rgba(13,148,136,.1);"></div>
        <div class="absolute bottom-[0%]  right-[-5%] w-[45vw] h-[45vw] rounded-full blur-[110px]" style="background:rgba(8,145,178,.07);"></div>
        <div class="absolute top-[35%]  left-[25%]  w-[30vw] h-[30vw] rounded-full blur-[90px]"  style="background:rgba(15,118,110,.08);"></div>
    </div>

    <div id="app" class="relative z-10">
        <x-navbar />
        <main>
            @yield('content')
        </main>
    </div>

    {{-- ── SIGN OUT CONFIRMATION MODAL ── --}}
    <div id="logout-modal"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 hidden"
         onclick="if(event.target===this) closeLogoutModal()">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/40 dark:bg-black/60 backdrop-blur-sm"></div>

        {{-- Modal card --}}
        <div id="logout-modal-card"
             class="relative w-full max-w-sm rounded-2xl border p-8 text-center
                    bg-white/70 dark:bg-white/[0.07]
                    backdrop-blur-2xl
                    border-white/70 dark:border-white/10
                    shadow-[0_24px_60px_rgba(0,0,0,0.15)] dark:shadow-[0_24px_60px_rgba(0,0,0,0.6)]
                    scale-95 opacity-0 transition-all duration-200">

            {{-- Icon --}}
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-5
                        bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20">
                <i data-lucide="log-out" class="w-6 h-6 text-red-500 dark:text-red-400"></i>
            </div>

            <h2 class="text-lg font-black text-slate-800 dark:text-white tracking-tight">Sign out?</h2>
            <p class="text-sm text-slate-500 dark:text-white/40 font-medium mt-2 leading-relaxed">
                Are you sure you want to sign out of your account?
            </p>

            {{-- Buttons --}}
            <div class="flex gap-3 mt-7">
                <button onclick="closeLogoutModal()"
                        class="flex-1 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.02] active:scale-95
                               bg-slate-100/80 dark:bg-white/[0.08] hover:bg-slate-200/80 dark:hover:bg-white/[0.12]
                               text-slate-600 dark:text-white/60 border border-slate-200/60 dark:border-white/10">
                    Cancel
                </button>
                <button onclick="document.getElementById('logout-form').submit()"
                        class="flex-1 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.02] active:scale-95
                               bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/25">
                    Sign out
                </button>
            </div>
        </div>
    </div>

    {{-- ── FLOATING THEME TOGGLE ── --}}
    <button onclick="toggleTheme()"
            title="Toggle theme"
            class="fixed bottom-6 right-6 z-50 w-10 h-10 rounded-full flex items-center justify-center
                   bg-white/60 dark:bg-white/[0.08]
                   backdrop-blur-xl
                   border border-white/70 dark:border-white/10
                   shadow-[0_4px_20px_rgba(99,102,241,0.2)] dark:shadow-[0_4px_20px_rgba(0,0,0,0.4)]
                   hover:scale-110 active:scale-95 transition-all duration-200">
        <i id="theme-sun"  data-lucide="sun"  class="w-4 h-4 text-amber-500 hidden"></i>
        <i id="theme-moon" data-lucide="moon" class="w-4 h-4 text-indigo-500"></i>
    </button>

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // ── Logout Modal ──────────────────────────────────────────────────────────
        function showLogoutModal() {
            const modal = document.getElementById('logout-modal');
            const card  = document.getElementById('logout-modal-card');
            modal.classList.remove('hidden');
            // Trigger animation on next frame
            requestAnimationFrame(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            });
            document.body.style.overflow = 'hidden';
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logout-modal');
            const card  = document.getElementById('logout-modal-card');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }, 200);
        }

        // Close on Escape key
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeLogoutModal();
        });

        // ── Theme helpers ──────────────────────────────────────────────────────────
        function applyTheme(theme) {
            const html = document.documentElement;
            if (theme === 'dark') {
                html.classList.add('dark');
                html.classList.remove('light');
            } else {
                html.classList.add('light');
                html.classList.remove('dark');
            }
            // Show/hide canvas layers
            document.querySelectorAll('.light-only').forEach(el => el.style.display = theme === 'dark' ? 'none' : '');
            document.querySelectorAll('.dark-only').forEach(el => el.style.display = theme === 'dark' ? '' : 'none');
            updateThemeBtn(theme);
        }

        function toggleTheme() {
            const current = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
            const next = current === 'dark' ? 'light' : 'dark';
            localStorage.setItem('theme', next);
            applyTheme(next);
        }

        function updateThemeBtn(theme) {
            const sun  = document.getElementById('theme-sun');
            const moon = document.getElementById('theme-moon');
            if (!sun || !moon) return;
            if (theme === 'dark') { sun.classList.remove('hidden'); moon.classList.add('hidden'); }
            else                  { moon.classList.remove('hidden'); sun.classList.add('hidden'); }
        }

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            const theme = localStorage.getItem('theme') || 'dark';
            applyTheme(theme);
        });
    </script>
</body>
</html>
