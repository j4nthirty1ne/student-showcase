@extends('layouts.app')

@section('title', $project->title . ' — StudentShowcase')

@section('content')

<div class="ss-detail-wrap min-h-screen">

    {{-- ══ HERO HEADER ══════════════════════════════════════════════════ --}}
    <section class="ss-detail-hero relative w-full overflow-hidden" style="padding: 7rem 1.5rem 5rem;">

        {{-- Background orbs --}}
        <div class="absolute inset-0 -z-10 pointer-events-none">
            <div style="position:absolute;width:600px;height:600px;top:-200px;left:-150px;background:radial-gradient(circle,rgba(13,148,136,.12) 0%,transparent 70%);"></div>
            <div style="position:absolute;width:400px;height:400px;bottom:-100px;right:-100px;background:radial-gradient(circle,rgba(8,145,178,.1) 0%,transparent 70%);"></div>
        </div>

        <div class="max-w-4xl mx-auto">

            {{-- Back link --}}
            <a href="{{ route('home') }}"
               class="ss-back-link inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest mb-10 transition-all"
               style="color:rgba(45,212,191,.7);">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Showcase
            </a>

            {{-- Category badge --}}
            <div class="mb-5">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest"
                      style="background:rgba(13,148,136,.15);border:1px solid rgba(13,148,136,.35);color:#5eead4;">
                    <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                    {{ $project->category ? $project->category->name : 'Uncategorized' }}
                </span>
            </div>

            {{-- Title --}}
            <h1 class="font-black leading-tight tracking-tight text-white mb-5"
                style="font-size:clamp(2.4rem,6vw,4.5rem);text-shadow:0 2px 40px rgba(0,0,0,.5);">
                {{ $project->title }}
            </h1>

            {{-- Meta: author + status --}}
            <div class="flex flex-wrap items-center gap-3 text-sm font-medium" style="color:rgba(255,255,255,.45);">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-black text-white"
                         style="background:linear-gradient(135deg,#0d9488,#0f766e);">
                        {{ strtoupper(substr($project->user?->name ?? 'S', 0, 1)) }}
                    </div>
                    <span>By <strong style="color:#99f6e4;">{{ $project->user?->name ?? 'Student' }}</strong></span>
                </div>
                <span style="color:rgba(255,255,255,.2);">•</span>
                @if ($project->status === 'published')
                    <span class="inline-flex items-center gap-1.5">
                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5" style="color:#34d399;"></i>
                        Published
                        {{ $project->published_at ? \Carbon\Carbon::parse($project->published_at)->format('M d, Y') : $project->updated_at->format('M d, Y') }}
                    </span>
                @elseif ($project->status === 'completed')
                    <span class="inline-flex items-center gap-1.5">
                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5" style="color:#34d399;"></i>
                        Completed
                    </span>
                @elseif ($project->status === 'pending')
                    <span class="inline-flex items-center gap-1.5">
                        <i data-lucide="clock" class="w-3.5 h-3.5" style="color:#fbbf24;"></i>
                        Pending Review
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5">
                        <i data-lucide="file-edit" class="w-3.5 h-3.5" style="color:rgba(255,255,255,.35);"></i>
                        {{ ucfirst($project->status) }}
                    </span>
                @endif
            </div>
        </div>
    </section>


    {{-- ══ MAIN CONTENT ══════════════════════════════════════════════════ --}}
    <div class="max-w-4xl mx-auto px-6 pb-24">

        {{-- Cover image --}}
        @if ($project->cover_image)
        <div class="rounded-2xl overflow-hidden mb-12 shadow-2xl"
             style="border:1px solid rgba(255,255,255,.08);box-shadow:0 24px 80px rgba(0,0,0,.5);">
            <img src="{{ Storage::url($project->cover_image) }}"
                 alt="{{ $project->title }}"
                 class="w-full object-cover"
                 style="max-height:520px;">
        </div>
        @endif

        {{-- CTA Links (Project URL + GitHub) --}}
        @if ($project->url || $project->github_link)
        <div class="flex flex-wrap gap-3 mb-12">
            @if ($project->url)
            <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
               class="ss-btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-white"
               style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 28px rgba(13,148,136,.4);">
                <i data-lucide="external-link" class="w-4 h-4"></i>
                View Live Demo
            </a>
            @endif
            @if ($project->github_link)
            <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer"
               class="ss-btn-outline inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold"
               style="border:1.5px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);backdrop-filter:blur(12px);background:rgba(255,255,255,.06);">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/>
                </svg>
                View on GitHub
            </a>
            @endif
        </div>
        @endif

        {{-- Description --}}
        <div class="rounded-2xl p-8 mb-8"
             style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);backdrop-filter:blur(12px);">
            <h2 class="text-xs font-black uppercase tracking-widest mb-5" style="color:#2dd4bf;">
                About this Project
            </h2>
            <div class="text-base leading-relaxed" style="color:rgba(255,255,255,.65);">
                @if ($project->description)
                    {!! nl2br(e($project->description)) !!}
                @else
                    <p class="italic" style="color:rgba(255,255,255,.3);">No description provided.</p>
                @endif
            </div>
        </div>

        {{-- Technologies --}}
        @if ($project->technologies && count($project->technologies) > 0)
        <div class="rounded-2xl p-8 mb-8"
             style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);backdrop-filter:blur(12px);">
            <h2 class="text-xs font-black uppercase tracking-widest mb-5" style="color:#2dd4bf;">
                Technologies Used
            </h2>
            <div class="flex flex-wrap gap-2.5">
                @foreach ($project->technologies as $tech)
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-sm font-bold"
                      style="background:rgba(13,148,136,.12);border:1px solid rgba(13,148,136,.25);color:#5eead4;">
                    <i data-lucide="code-2" class="w-3.5 h-3.5"></i>
                    {{ $tech }}
                </span>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Project Gallery --}}
        @if ($project->projectImages && $project->projectImages->count() > 0)
        <div class="rounded-2xl p-8 mb-8"
             style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);backdrop-filter:blur(12px);">
            <h2 class="text-xs font-black uppercase tracking-widest mb-6" style="color:#2dd4bf;">
                Project Gallery
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($project->projectImages as $p_image)
                <div class="rounded-xl overflow-hidden"
                     style="border:1px solid rgba(255,255,255,.07);box-shadow:0 8px 32px rgba(0,0,0,.3);">
                    <img src="{{ Storage::url($p_image->image_path) }}"
                         alt="Project screenshot"
                         class="w-full h-auto object-cover hover:scale-105 transition duration-500">
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Footer nav --}}
        <div class="flex items-center justify-between pt-8" style="border-top:1px solid rgba(255,255,255,.07);">
            <a href="{{ route('home') }}"
               class="ss-back-link inline-flex items-center gap-2 text-sm font-bold transition-all"
               style="color:rgba(45,212,191,.7);">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Showcase
            </a>
            <a href="#" onclick="window.scrollTo({top:0,behavior:'smooth'});return false;"
               class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest transition-all hover:scale-105"
               style="color:rgba(45,212,191,.5);">
                <i data-lucide="arrow-up" class="w-4 h-4"></i> Top
            </a>
        </div>
    </div>
</div>


<style>
    /* ── Page wrapper dark bg ──────────────────────────────── */
    .ss-detail-wrap { background: #0e0b1a; }
    html.light .ss-detail-wrap { background: #f0fdfa; }

    /* ── Hero ─────────────────────────────────────────────── */
    .ss-detail-hero { background: transparent; }

    /* Back link hover ────────────────────────────────────── */
    .ss-back-link:hover { color: #2dd4bf !important; transform: translateX(-3px); }

    /* CTA buttons ────────────────────────────────────────── */
    .ss-btn-primary { transition: transform .2s, box-shadow .2s; }
    .ss-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(13,148,136,.55) !important; }
    .ss-btn-outline { transition: transform .2s, background .2s; }
    .ss-btn-outline:hover { transform: translateY(-2px); background: rgba(255,255,255,.12) !important; }

    /* ── Light mode overrides ─────────────────────────────── */
    html.light .ss-detail-hero h1           { color: #0c2926 !important; text-shadow: none !important; }
    html.light .ss-detail-hero .text-white  { color: #0c2926 !important; }

    html.light .ss-detail-wrap .rounded-2xl[style*="rgba(255,255,255,.04)"] {
        background: rgba(255,255,255,.88) !important;
        border-color: rgba(13,148,136,.12) !important;
        box-shadow: 0 4px 20px rgba(13,148,136,.06) !important;
    }
    html.light .ss-detail-wrap [style*="rgba(255,255,255,.65)"] { color: #374151 !important; }
    html.light .ss-detail-wrap [style*="rgba(255,255,255,.45)"] { color: #64748b !important; }
    html.light .ss-detail-wrap [style*="rgba(255,255,255,.3)"]  { color: #94a3b8 !important; }
    html.light .ss-detail-wrap [style*="border-top:1px solid rgba(255,255,255,.07)"] {
        border-color: rgba(13,148,136,.15) !important;
    }
    html.light .ss-detail-wrap [style*="border:1px solid rgba(255,255,255,.07)"] {
        border-color: rgba(13,148,136,.1) !important;
    }
    html.light #99f6e4,
    html.light strong[style*="color:#99f6e4"] { color: #0d7a6e !important; }
</style>

@endsection
