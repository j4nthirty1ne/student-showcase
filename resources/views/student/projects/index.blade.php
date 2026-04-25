@extends('layouts.student')

@section('title', 'My Projects — Student Showcase')

@section('student-content')
<div class="mp-wrap min-h-screen py-12 px-6">
<div class="max-w-6xl mx-auto">

    {{-- ── Page header ─────────────────────────────────────── --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-5 mb-10">
        <div>
            <p class="text-xs font-black uppercase tracking-widest mb-2" style="color:#2dd4bf;">My Work</p>
            <h1 class="text-3xl md:text-4xl font-black tracking-tight mp-heading">My Projects</h1>
            <p class="text-sm font-medium mt-1 mp-muted">{{ $projects->total() }} project{{ $projects->total() !== 1 ? 's' : '' }} total</p>
        </div>
        <a href="{{ route('student.projects.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-sm font-black text-white transition-all hover:scale-[1.03] hover:shadow-xl flex-shrink-0"
           style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 24px rgba(13,148,136,.35);">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            New Project
        </a>
    </div>

    @if ($projects->count())
        {{-- ── Project grid ─────────────────────────────────── --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
            <div class="mp-card rounded-2xl overflow-hidden flex flex-col transition-all duration-300 hover:translate-y-[-4px] hover:shadow-2xl group">

                {{-- Cover image --}}
                <div class="relative h-48 overflow-hidden flex-shrink-0"
                     style="background:linear-gradient(135deg,#042f2e,#0f3d35);">
                    @if ($project->cover_image)
                        <img src="{{ Storage::url($project->cover_image) }}"
                             alt="{{ $project->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i data-lucide="image-off" class="w-10 h-10" style="color:rgba(45,212,191,.25);"></i>
                        </div>
                    @endif

                    {{-- Status badge overlay --}}
                    <div class="absolute top-3 left-3">
                        @if (in_array($project->status, ['published', 'completed']))
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-black"
                                  style="background:rgba(34,197,94,.2);color:#4ade80;border:1px solid rgba(34,197,94,.3);backdrop-filter:blur(8px);">
                                <i data-lucide="check-circle-2" class="w-3 h-3"></i>
                                {{ ucfirst($project->status) }}
                            </span>
                        @elseif ($project->status === 'pending')
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-black"
                                  style="background:rgba(251,191,36,.15);color:#fbbf24;border:1px solid rgba(251,191,36,.3);backdrop-filter:blur(8px);">
                                <i data-lucide="clock" class="w-3 h-3"></i>
                                Pending
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-black"
                                  style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.6);border:1px solid rgba(255,255,255,.15);backdrop-filter:blur(8px);">
                                <i data-lucide="file-edit" class="w-3 h-3"></i>
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        @endif
                    </div>

                    {{-- Category badge --}}
                    @if ($project->category)
                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wide"
                              style="background:rgba(13,148,136,.2);color:#2dd4bf;border:1px solid rgba(13,148,136,.3);backdrop-filter:blur(8px);">
                            {{ $project->category->name }}
                        </span>
                    </div>
                    @endif
                </div>

                {{-- Card body --}}
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="text-base font-black mp-heading mb-1 line-clamp-1">{{ $project->title }}</h3>
                    <p class="text-sm mp-muted mb-4 line-clamp-2 leading-relaxed flex-1">
                        {{ $project->description ?: 'No description provided.' }}
                    </p>

                    {{-- Technologies --}}
                    @if ($project->technologies && count($project->technologies) > 0)
                    <div class="flex flex-wrap gap-1.5 mb-4">
                        @foreach (array_slice($project->technologies, 0, 4) as $tech)
                        <span class="px-2 py-0.5 rounded-md text-[11px] font-bold mp-tech">{{ $tech }}</span>
                        @endforeach
                        @if (count($project->technologies) > 4)
                        <span class="px-2 py-0.5 rounded-md text-[11px] font-bold mp-tech">+{{ count($project->technologies) - 4 }}</span>
                        @endif
                    </div>
                    @endif

                    {{-- Actions --}}
                    <div class="flex gap-2 pt-4 mp-border-top">
                        <a href="{{ route('project.show', $project) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-black transition-all hover:scale-[1.04]"
                           style="background:rgba(13,148,136,.12);color:#2dd4bf;border:1px solid rgba(13,148,136,.2);">
                            <i data-lucide="eye" class="w-3.5 h-3.5"></i> View
                        </a>
                        <a href="{{ route('student.projects.edit', $project) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-black transition-all hover:scale-[1.04] mp-btn-ghost">
                            <i data-lucide="pencil" class="w-3.5 h-3.5"></i> Edit
                        </a>
                        <form action="{{ route('student.projects.destroy', $project) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Delete \'{{ addslashes($project->title) }}\'? This cannot be undone.')"
                                    class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-black transition-all hover:scale-[1.04]"
                                    style="background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.2);">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($projects->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $projects->links('pagination::tailwind') }}
        </div>
        @endif

    @else
        {{-- ── Empty state ──────────────────────────────────── --}}
        <div class="mp-card rounded-2xl py-24 px-6 text-center">
            <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-5"
                 style="background:rgba(13,148,136,.1);border:1px solid rgba(13,148,136,.2);">
                <i data-lucide="folder-plus" class="w-9 h-9" style="color:rgba(45,212,191,.6);"></i>
            </div>
            <h2 class="text-2xl font-black mp-heading tracking-tight mb-2">No projects yet</h2>
            <p class="text-sm mp-muted mb-8 max-w-sm mx-auto">
                Start building! Submit your first project and share it with the world.
            </p>
            <a href="{{ route('student.projects.create') }}"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-2xl text-sm font-black text-white transition-all hover:scale-[1.04]"
               style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 28px rgba(13,148,136,.4);">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                Create Your First Project
            </a>
        </div>
    @endif

</div>
</div>

<style>
    /* ── Card ───────────────────────────────────────────────── */
    .mp-card {
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.09);
        backdrop-filter: blur(14px);
        box-shadow: 0 4px 24px rgba(0,0,0,.25);
    }
    .mp-card:hover { box-shadow: 0 20px 60px rgba(13,148,136,.18); border-color: rgba(13,148,136,.25); }

    /* ── Typography ─────────────────────────────────────────── */
    .mp-heading { color: #ffffff; }
    .mp-muted   { color: rgba(148,163,184,.75); }

    /* ── Tech badge ─────────────────────────────────────────── */
    .mp-tech {
        background: rgba(13,148,136,.12);
        color: #5eead4;
        border: 1px solid rgba(13,148,136,.2);
    }

    /* ── Ghost button ───────────────────────────────────────── */
    .mp-btn-ghost {
        background: rgba(255,255,255,.06);
        color: rgba(255,255,255,.65);
        border: 1px solid rgba(255,255,255,.1);
    }
    .mp-btn-ghost:hover { background: rgba(255,255,255,.1); color: #fff; }

    /* ── Divider ────────────────────────────────────────────── */
    .mp-border-top { border-top: 1px solid rgba(255,255,255,.07); }

    /* ══ LIGHT MODE ════════════════════════════════════════════ */
    html.light .mp-card {
        background: rgba(255,255,255,.88);
        border-color: rgba(13,148,136,.1);
        box-shadow: 0 4px 24px rgba(13,148,136,.08);
    }
    html.light .mp-card:hover { box-shadow: 0 20px 50px rgba(13,148,136,.14); border-color: rgba(13,148,136,.22); }
    html.light .mp-heading { color: #0c2926; }
    html.light .mp-muted   { color: #64748b; }
    html.light .mp-tech {
        background: rgba(13,148,136,.1);
        color: #0d7a6e;
        border-color: rgba(13,148,136,.18);
    }
    html.light .mp-btn-ghost {
        background: rgba(13,148,136,.06);
        color: #0f766e;
        border-color: rgba(13,148,136,.15);
    }
    html.light .mp-btn-ghost:hover { background: rgba(13,148,136,.12); color: #0d9488; }
    html.light .mp-border-top { border-color: rgba(13,148,136,.1); }
</style>

@endsection
