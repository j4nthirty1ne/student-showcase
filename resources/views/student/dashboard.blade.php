@extends('layouts.student')

@section('title', 'Dashboard — Student Showcase')

@section('student-content')
<div class="sd-wrap min-h-screen py-12 px-6">
<div class="max-w-5xl mx-auto">

    {{-- ── Welcome header ────────────────────────────────────── --}}
    <div class="mb-10">
        <p class="text-xs font-black uppercase tracking-widest mb-2" style="color:#2dd4bf;">Welcome back</p>
        <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-2 sd-heading">
            {{ Auth::user()->name }} 👋
        </h1>
        <p class="text-sm font-medium sd-muted">Manage your projects and profile from here.</p>
    </div>

    {{-- ── Quick stats ──────────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">

        {{-- Projects count --}}
        <div class="sd-card rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:rgba(13,148,136,.15);border:1px solid rgba(13,148,136,.25);">
                <i data-lucide="folder-open" class="w-5 h-5" style="color:#2dd4bf;"></i>
            </div>
            <div>
                <p class="text-2xl font-black sd-heading">{{ Auth::user()->projects()->count() }}</p>
                <p class="text-xs font-bold uppercase tracking-widest sd-muted">Your Projects</p>
            </div>
        </div>

        {{-- Published --}}
        <div class="sd-card rounded-2xl p-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);">
                <i data-lucide="check-circle-2" class="w-5 h-5" style="color:#4ade80;"></i>
            </div>
            <div>
                <p class="text-2xl font-black sd-heading">{{ Auth::user()->projects()->whereIn('status',['published','completed'])->count() }}</p>
                <p class="text-xs font-bold uppercase tracking-widest sd-muted">Published</p>
            </div>
        </div>

        {{-- New project CTA --}}
        <a href="{{ route('student.projects.create') }}"
           class="rounded-2xl p-6 flex items-center gap-4 transition-all duration-200 hover:scale-[1.02] hover:shadow-2xl group"
           style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 24px rgba(13,148,136,.35);">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                <i data-lucide="plus-circle" class="w-5 h-5 text-white"></i>
            </div>
            <div>
                <p class="text-sm font-black text-white">New Project</p>
                <p class="text-xs font-medium text-white/60">Add something new</p>
            </div>
        </a>
    </div>

    {{-- ── Quick links ──────────────────────────────────────── --}}
    <div class="sd-card rounded-2xl p-6 mb-8">
        <h2 class="text-base font-black sd-heading mb-5">Quick Links</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('student.projects.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.03]"
               style="background:rgba(13,148,136,.12);color:#2dd4bf;border:1px solid rgba(13,148,136,.25);">
                <i data-lucide="folder" class="w-4 h-4"></i> My Projects
            </a>
            <a href="{{ route('student.profile.edit') }}"
               class="sd-btn-ghost inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.03]">
                <i data-lucide="pencil" class="w-4 h-4"></i> Edit Profile
            </a>
            <a href="{{ route('home') }}"
               class="sd-btn-ghost inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.03]">
                <i data-lucide="globe" class="w-4 h-4"></i> Browse Showcase
            </a>
        </div>
    </div>

    {{-- ── Recent projects ──────────────────────────────────── --}}
    @php $recent = Auth::user()->projects()->latest()->take(3)->get(); @endphp
    @if ($recent->count() > 0)
    <div class="sd-card rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-base font-black sd-heading">Recent Projects</h2>
            <a href="{{ route('student.projects.index') }}"
               class="text-xs font-bold uppercase tracking-widest transition-all hover:opacity-80"
               style="color:#2dd4bf;">View all →</a>
        </div>
        <div class="space-y-3">
            @foreach ($recent as $project)
            <a href="{{ route('student.projects.edit', $project) }}"
               class="sd-row flex items-center justify-between rounded-xl px-4 py-3 transition-all hover:scale-[1.01]">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
                         style="background:rgba(13,148,136,.12);border:1px solid rgba(13,148,136,.2);">
                        <i data-lucide="code-2" class="w-4 h-4" style="color:#2dd4bf;"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold sd-heading">{{ $project->title }}</p>
                        <p class="text-xs sd-muted">{{ $project->category?->name ?? 'Uncategorized' }}</p>
                    </div>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded-full
                    @if(in_array($project->status,['published','completed'])) " style="background:rgba(34,197,94,.12);color:#4ade80;border:1px solid rgba(34,197,94,.2);">
                    @elseif($project->status === 'pending') " style="background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.2);">
                    @else " style="background:rgba(255,255,255,.07);color:rgba(255,255,255,.45);border:1px solid rgba(255,255,255,.1);">
                    @endif
                    {{ ucfirst($project->status) }}
                </span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
</div>

<style>
    /* ── Base ──────────────────────────────────────────────── */
    .sd-wrap { background: transparent; }

    /* ── Cards ─────────────────────────────────────────────── */
    .sd-card {
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.1);
        backdrop-filter: blur(12px);
    }
    .sd-row {
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.07);
    }
    .sd-row:hover { background: rgba(255,255,255,.07); }

    /* ── Typography ─────────────────────────────────────────── */
    .sd-heading { color: #ffffff; }
    .sd-muted   { color: rgba(148,163,184,.7); }

    /* ── Ghost button ───────────────────────────────────────── */
    .sd-btn-ghost {
        background: rgba(255,255,255,.06);
        color: rgba(255,255,255,.7);
        border: 1px solid rgba(255,255,255,.1);
    }
    .sd-btn-ghost:hover { background: rgba(255,255,255,.1); color: #fff; }

    /* ══ LIGHT MODE ════════════════════════════════════════════ */
    html.light .sd-card {
        background: rgba(255,255,255,.85);
        border-color: rgba(13,148,136,.12);
        box-shadow: 0 4px 20px rgba(13,148,136,.07);
    }
    html.light .sd-row {
        background: rgba(255,255,255,.6);
        border-color: rgba(13,148,136,.08);
    }
    html.light .sd-row:hover { background: rgba(255,255,255,.9); }
    html.light .sd-heading { color: #0c2926; }
    html.light .sd-muted   { color: #64748b; }
    html.light .sd-btn-ghost {
        background: rgba(13,148,136,.07);
        color: #0f766e;
        border-color: rgba(13,148,136,.2);
    }
    html.light .sd-btn-ghost:hover { background: rgba(13,148,136,.14); color: #0d9488; }
</style>
@endsection
