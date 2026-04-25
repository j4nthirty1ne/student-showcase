@extends('layouts.admin')

@section('title', 'Admin Dashboard — Student Showcase')

@section('admin-content')
<div class="ad-wrap min-h-screen py-12 px-6">
<div class="max-w-6xl mx-auto">

    {{-- ── Header ──────────────────────────────────────────── --}}
    <div class="mb-10">
        <p class="text-xs font-black uppercase tracking-widest mb-2" style="color:#2dd4bf;">Admin Panel</p>
        <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-2 ad-heading">Dashboard</h1>
        <p class="text-sm font-medium ad-muted">System overview and quick actions.</p>
    </div>

    {{-- ── Stats grid ───────────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

        {{-- Total Users --}}
        <div class="ad-card rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:rgba(13,148,136,.15);border:1px solid rgba(13,148,136,.25);">
                <i data-lucide="users" class="w-5 h-5" style="color:#2dd4bf;"></i>
            </div>
            <div>
                <p class="text-2xl font-black ad-heading">{{ $totalUsers }}</p>
                <p class="text-xs font-bold uppercase tracking-widest ad-muted">Total Users</p>
            </div>
        </div>

        {{-- Total Students --}}
        <div class="ad-card rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);">
                <i data-lucide="graduation-cap" class="w-5 h-5" style="color:#4ade80;"></i>
            </div>
            <div>
                <p class="text-2xl font-black ad-heading">{{ $totalStudents }}</p>
                <p class="text-xs font-bold uppercase tracking-widest ad-muted">Students</p>
            </div>
        </div>

        {{-- Total Admins --}}
        <div class="ad-card rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:rgba(124,58,237,.12);border:1px solid rgba(124,58,237,.2);">
                <i data-lucide="shield-check" class="w-5 h-5" style="color:#a78bfa;"></i>
            </div>
            <div>
                <p class="text-2xl font-black ad-heading">{{ $totalAdmins }}</p>
                <p class="text-xs font-bold uppercase tracking-widest ad-muted">Admins</p>
            </div>
        </div>

        {{-- Active Users --}}
        <div class="ad-card rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:rgba(251,191,36,.1);border:1px solid rgba(251,191,36,.2);">
                <i data-lucide="activity" class="w-5 h-5" style="color:#fbbf24;"></i>
            </div>
            <div>
                <p class="text-2xl font-black ad-heading">{{ $activeUsers }}</p>
                <p class="text-xs font-bold uppercase tracking-widest ad-muted">Active</p>
            </div>
        </div>
    </div>

    {{-- ── Quick actions ────────────────────────────────────── --}}
    <div class="ad-card rounded-2xl p-6 mb-8">
        <h2 class="text-base font-black ad-heading mb-5">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.03]"
               style="background:linear-gradient(135deg,#0d9488,#0f766e);color:#fff;box-shadow:0 4px 16px rgba(13,148,136,.3);">
                <i data-lucide="users" class="w-4 h-4"></i> Manage Users
            </a>
            <a href="{{ route('admin.projects.index') }}"
               class="ad-btn-ghost inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.03]">
                <i data-lucide="folder-open" class="w-4 h-4"></i> View Projects
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="ad-btn-ghost inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.03]">
                <i data-lucide="tag" class="w-4 h-4"></i> Categories
            </a>
        </div>
    </div>

    {{-- ── System status ────────────────────────────────────── --}}
    <div class="ad-card rounded-2xl p-6">
        <h2 class="text-base font-black ad-heading mb-5">System Status</h2>
        <div class="flex items-center gap-3">
            <div class="w-2.5 h-2.5 rounded-full" style="background:#4ade80;box-shadow:0 0 8px #4ade80;"></div>
            <p class="text-sm font-bold ad-heading">All systems operational</p>
        </div>
    </div>

</div>
</div>

<style>
    /* ── Cards ─────────────────────────────────────────────── */
    .ad-card {
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.1);
        backdrop-filter: blur(12px);
    }

    /* ── Typography ─────────────────────────────────────────── */
    .ad-heading { color: #ffffff; }
    .ad-muted   { color: rgba(148,163,184,.7); }

    /* ── Ghost button ───────────────────────────────────────── */
    .ad-btn-ghost {
        background: rgba(255,255,255,.06);
        color: rgba(255,255,255,.7);
        border: 1px solid rgba(255,255,255,.1);
    }
    .ad-btn-ghost:hover { background: rgba(255,255,255,.1); color: #fff; }

    /* ══ LIGHT MODE ════════════════════════════════════════════ */
    html.light .ad-card {
        background: rgba(255,255,255,.85);
        border-color: rgba(13,148,136,.12);
        box-shadow: 0 4px 20px rgba(13,148,136,.07);
    }
    html.light .ad-heading { color: #0c2926; }
    html.light .ad-muted   { color: #64748b; }
    html.light .ad-btn-ghost {
        background: rgba(13,148,136,.07);
        color: #0f766e;
        border-color: rgba(13,148,136,.2);
    }
    html.light .ad-btn-ghost:hover { background: rgba(13,148,136,.14); color: #0d9488; }
</style>
@endsection
