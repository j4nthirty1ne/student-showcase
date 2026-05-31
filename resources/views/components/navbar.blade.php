{{-- ═══════════════════════════════════════════════════════════
     NAVBAR  — Glassmorphic sticky navbar matching dark theme
     Used by layouts/app.blade.php via <x-navbar />
═══════════════════════════════════════════════════════════ --}}
<nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    style="background:rgba(10,15,46,.75);backdrop-filter:blur(20px) saturate(180%);border-bottom:1px solid rgba(13,148,136,.12);">

    <div class="max-w-7xl mx-auto px-5 h-16 flex items-center justify-between gap-4">

        {{-- ── Brand ────────────────────────────────────────────────── --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0 group">
            <img src="{{ asset('images/logo.png') }}" alt="ProjectForge logo"
                class="w-10 h-10 object-contain transition-transform duration-200 group-hover:scale-110" />
            <span class="font-black text-white tracking-tight text-base hidden sm:block">
                Project<span style="color:#2dd4bf;">Forge</span>
            </span>
        </a>

        {{-- ── Centre links (desktop) ──────────────────────────────── --}}
        <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('home') }}"
                class="nav-link px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 hover:bg-white/[0.08]"
                style="color:rgba(255,255,255,.7);">
                Explore
            </a>
            <a href="{{ route('home') }}#projects"
                class="nav-link px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 hover:bg-white/[0.08]"
                style="color:rgba(255,255,255,.7);">
                Projects
            </a>
            @auth
                <a href="{{ route('student.projects.index') }}"
                    class="nav-link px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 hover:bg-white/[0.08]"
                    style="color:rgba(255,255,255,.7);">
                    My Projects
                </a>
                <a href="{{ route('student.dashboard') }}"
                    class="nav-link px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 hover:bg-white/[0.08]"
                    style="color:rgba(255,255,255,.7);">
                    Dashboard
                </a>
            @endauth
        </div>

        {{-- ── Right side ──────────────────────────────────────────── --}}
        <div class="flex items-center gap-2 flex-shrink-0">

            @auth
                {{-- User avatar dropdown --}}
                <div class="relative" id="nav-user-menu">
                    <button id="nav-user-btn" onclick="toggleUserMenu()"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-xl transition-all duration-200 hover:bg-white/[0.08]">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-black text-white flex-shrink-0"
                            style="background:linear-gradient(135deg,#0d9488,#0f766e);">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-semibold text-white/80 hidden sm:block max-w-[100px] truncate">
                            {{ Auth::user()->name }}
                        </span>
                        <i data-lucide="chevron-down"
                            class="w-3.5 h-3.5 text-white/40 hidden sm:block transition-transform duration-200"
                            id="nav-chevron"></i>
                    </button>

                    {{-- Dropdown --}}
                    <div id="nav-dropdown" class="absolute right-0 top-full mt-2 w-52 rounded-2xl overflow-hidden hidden"
                        style="background:rgba(10,15,46,.95);border:1px solid rgba(13,148,136,.2);backdrop-filter:blur(24px);box-shadow:0 16px 48px rgba(0,0,0,.5);">
                        <div class="px-4 py-3 border-b" style="border-color:rgba(255,255,255,.06);">
                            <p class="text-xs font-black text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-medium truncate" style="color:rgba(255,255,255,.35);">
                                {{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1.5">
                            <a href="{{ route('student.dashboard') }}"
                                class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium transition-colors hover:bg-white/[0.06]"
                                style="color:rgba(255,255,255,.7);">
                                <i data-lucide="layout-dashboard" class="w-4 h-4" style="color:#2dd4bf;"></i>
                                Dashboard
                            </a>
                            <a href="{{ route('student.projects.index') }}"
                                class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium transition-colors hover:bg-white/[0.06]"
                                style="color:rgba(255,255,255,.7);">
                                <i data-lucide="folder-open" class="w-4 h-4" style="color:#2dd4bf;"></i>
                                My Projects
                            </a>
                            <a href="{{ route('student.profile.show') }}"
                                class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium transition-colors hover:bg-white/[0.06]"
                                style="color:rgba(255,255,255,.7);">
                                <i data-lucide="user-circle" class="w-4 h-4" style="color:#2dd4bf;"></i>
                                Profile
                            </a>
                            <div class="my-1 mx-3" style="border-top:1px solid rgba(255,255,255,.06);"></div>
                            <button onclick="showLogoutModal()"
                                class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm font-medium transition-colors hover:bg-red-500/10 text-left"
                                style="color:rgba(239,68,68,.7);">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Sign out
                            </button>
                        </div>
                    </div>

                    {{-- Hidden logout form --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            @else
                {{-- Guest buttons --}}
                <a href="{{ route('login') }}"
                    class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 hover:bg-white/[0.08]"
                    style="color:rgba(255,255,255,.7);">
                    Sign In
                </a>
                <a href="{{ route('register') }}"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-bold text-white transition-all duration-200 hover:scale-[1.03] hover:shadow-lg"
                    style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 4px 16px rgba(13,148,136,.3);">
                    <i data-lucide="plus-circle" class="w-3.5 h-3.5"></i>
                    Get Started
                </a>

            @endauth

            {{-- Mobile hamburger --}}
            <button id="nav-mobile-btn" onclick="toggleMobileMenu()"
                class="md:hidden p-2 rounded-xl transition-colors hover:bg-white/[0.08]"
                style="color:rgba(255,255,255,.7);">
                <i data-lucide="menu" class="w-5 h-5" id="nav-hamburger-icon"></i>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="nav-mobile-menu" class="md:hidden hidden px-5 pb-4" style="border-top:1px solid rgba(255,255,255,.06);">
        <div class="flex flex-col gap-1 pt-3">
            <a href="{{ route('home') }}"
                class="px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors hover:bg-white/[0.08]"
                style="color:rgba(255,255,255,.7);">Explore</a>
            <a href="{{ route('home') }}#projects"
                class="px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors hover:bg-white/[0.08]"
                style="color:rgba(255,255,255,.7);">Projects</a>
            @auth
                <a href="{{ route('student.dashboard') }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors hover:bg-white/[0.08]"
                    style="color:rgba(255,255,255,.7);">Dashboard</a>
                <a href="{{ route('student.projects.index') }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors hover:bg-white/[0.08]"
                    style="color:rgba(255,255,255,.7);">My Projects</a>
                <a href="{{ route('student.profile.show') }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors hover:bg-white/[0.08]"
                    style="color:rgba(255,255,255,.7);">Profile</a>
                <div class="my-1" style="border-top:1px solid rgba(255,255,255,.06);"></div>
                <button onclick="showLogoutModal()"
                    class="w-full text-left px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors hover:bg-red-500/10"
                    style="color:rgba(239,68,68,.7);">Sign out</button>
            @else
                <div class="flex gap-2 pt-1">
                    <a href="{{ route('login') }}"
                        class="flex-1 text-center py-2.5 rounded-xl text-sm font-bold transition-colors hover:bg-white/[0.08]"
                        style="color:rgba(255,255,255,.7);border:1px solid rgba(255,255,255,.1);">Sign In</a>
                    <a href="{{ route('register') }}"
                        class="flex-1 text-center py-2.5 rounded-xl text-sm font-bold text-white"
                        style="background:linear-gradient(135deg,#0d9488,#0f766e);">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

{{-- Spacer so content doesn't hide under fixed nav --}}
<div class="h-16"></div>

<script>
    // ── Desktop user dropdown ──────────────────────────────────────────────
    function toggleUserMenu() {
        const dropdown = document.getElementById('nav-dropdown');
        const chevron = document.getElementById('nav-chevron');
        const isOpen = !dropdown.classList.contains('hidden');
        dropdown.classList.toggle('hidden', isOpen);
        if (chevron) chevron.style.transform = isOpen ? '' : 'rotate(180deg)';
    }

    // Close dropdown if clicked outside
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('nav-user-menu');
        if (menu && !menu.contains(e.target)) {
            const dropdown = document.getElementById('nav-dropdown');
            const chevron = document.getElementById('nav-chevron');
            if (dropdown) dropdown.classList.add('hidden');
            if (chevron) chevron.style.transform = '';
        }
    });

    // ── Mobile hamburger ──────────────────────────────────────────────────
    function toggleMobileMenu() {
        const menu = document.getElementById('nav-mobile-menu');
        menu.classList.toggle('hidden');
    }

    // ── Nav scroll shrink effect ──────────────────────────────────────────
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('main-nav');
        if (!nav) return;
        if (window.scrollY > 40) {
            nav.style.borderBottomColor = 'rgba(13,148,136,.2)';
            nav.style.background = 'rgba(8,12,38,.92)';
        } else {
            nav.style.borderBottomColor = 'rgba(13,148,136,.12)';
            nav.style.background = 'rgba(10,15,46,.75)';
        }
    });
</script>
