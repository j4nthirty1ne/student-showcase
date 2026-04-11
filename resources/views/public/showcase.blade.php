@extends('layouts.app')

@section('title', 'Student Showcase — Design & Build the Future')

@section('content')

<div class="ss-page-wrap">

{{-- ══════════════════════════════════════════════════════════
     HERO SLIDER  — guests only
══════════════════════════════════════════════════════════ --}}
@guest
<section id="hero-slider" class="ss-hero-section relative w-full overflow-hidden" style="height:100svh;min-height:520px;">

    {{-- Background art --}}
    <div class="absolute inset-0 -z-10">
        <img src="/images/hero_bg.png" alt="" class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0" style="background: linear-gradient(135deg, #030d12 0%, #0f3d35 40%, #0d1a3a 100%); opacity: 0.75;"></div>
        {{-- Animated orbs --}}
        <div class="ss-orb" style="width:520px;height:520px;top:-100px;left:-120px;background:radial-gradient(circle,#0d9488 0%,transparent 70%);opacity:.18;animation:orbFloat 8s ease-in-out infinite;"></div>
        <div class="ss-orb" style="width:400px;height:400px;bottom:-80px;right:-100px;background:radial-gradient(circle,#0f766e 0%,transparent 70%);opacity:.15;animation:orbFloat 11s ease-in-out infinite reverse;"></div>
        <div class="ss-orb" style="width:300px;height:300px;top:40%;left:55%;background:radial-gradient(circle,#0891b2 0%,transparent 70%);opacity:.12;animation:orbFloat 14s ease-in-out infinite;"></div>
    </div>

    {{-- Slides --}}
    <div id="ss-slides" class="relative h-full">

        @php $slides = $featuredProjects->count() > 0 ? $featuredProjects : collect([null]); @endphp

        @foreach ($slides as $i => $proj)
        <div class="ss-slide absolute inset-0 flex flex-col items-center justify-center px-6 text-center transition-all duration-700"
             @style([
                 'opacity: 0; pointer-events: none;' => $i > 0,
                 'opacity: 1;' => $i === 0,
             ])
             data-slide="{{ $i }}">

            {{-- Category badge --}}
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6
                         backdrop-blur-md border"
                  style="background:rgba(13,148,136,.15);border-color:rgba(13,148,136,.4);color:#5eead4;">
                <i data-lucide="{{ $proj ? 'layers' : 'sparkles' }}" class="w-3.5 h-3.5"></i>
                {{ $proj?->category?->name ?? 'Student Project Showcase' }}
            </span>

            {{-- Headline --}}
            <h1 class="ss-slide-title font-black leading-tight mb-5 text-white"
                style="font-size:clamp(2.2rem,6vw,5rem);max-width:900px;text-shadow:0 2px 40px rgba(0,0,0,.6);">
                @if ($proj)
                    {{ $proj->title }}
                @else
                    Build, Share &amp;<br>
                    <span style="background:linear-gradient(90deg,#2dd4bf,#34d399,#22d3ee);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;">
                        Inspire
                    </span>
                @endif
            </h1>

            {{-- Sub-text --}}
            <p class="max-w-xl text-lg font-medium mb-10" style="color:rgba(255,255,255,.55);">
                @if ($proj)
                    By <strong style="color:#99f6e4;">{{ $proj->user?->name ?? 'A Student' }}</strong>
                    @if ($proj->description)
                        &mdash; {{ Str::limit($proj->description, 100) }}
                    @endif
                @else
                    A curated gallery of innovation, creativity, and breakthroughs from the next generation of makers.
                @endif
            </p>

            {{-- CTAs --}}
            <div class="flex flex-wrap gap-4 justify-center">
                @if ($proj)
                    <a href="{{ route('project.show', $proj) }}"
                       class="ss-btn-primary flex items-center gap-2 px-8 py-3.5 rounded-2xl font-bold text-sm"
                       style="background:linear-gradient(135deg,#0d9488,#0f766e);color:#fff;box-shadow:0 8px 32px rgba(13,148,136,.45);">
                        <i data-lucide="eye" class="w-4 h-4"></i> View Project
                    </a>
                @else
                    <a href="#projects"
                       class="ss-btn-primary flex items-center gap-2 px-8 py-3.5 rounded-2xl font-bold text-sm"
                       style="background:linear-gradient(135deg,#0d9488,#0f766e);color:#fff;box-shadow:0 8px 32px rgba(13,148,136,.45);">
                        <i data-lucide="grid" class="w-4 h-4"></i> Browse Projects
                    </a>
                @endif
                @auth
                    <a href="{{ route('student.projects.index') }}"
                       class="ss-btn-outline flex items-center gap-2 px-8 py-3.5 rounded-2xl font-bold text-sm"
                       style="border:1.5px solid rgba(255,255,255,.2);color:rgba(255,255,255,.85);backdrop-filter:blur(12px);background:rgba(255,255,255,.06);">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> My Dashboard
                    </a>
                @elseif (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="ss-btn-outline flex items-center gap-2 px-8 py-3.5 rounded-2xl font-bold text-sm"
                       style="border:1.5px solid rgba(255,255,255,.2);color:rgba(255,255,255,.85);backdrop-filter:blur(12px);background:rgba(255,255,255,.06);">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i> Submit Yours
                    </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    {{-- Slide indicators --}}
    @if ($slides->count() > 1)
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex gap-2 z-20" id="ss-dots">
        @foreach ($slides as $i => $proj)
            <button data-index="{{ $i }}" data-dot="{{ $i }}"
                    class="ss-dot rounded-full transition-all duration-300"
                    @style([
                        'width: 32px; height: 8px; background: #2dd4bf;' => $i === 0,
                        'width: 8px; height: 8px; background: rgba(255,255,255,.3);' => $i > 0,
                    ])></button>
        @endforeach
    </div>
    @endif

    {{-- Scroll arrow --}}
    <a href="#stats" class="absolute bottom-10 right-8 z-20 flex flex-col items-center gap-1 group" style="color:rgba(255,255,255,.4);">
        <span class="text-[10px] uppercase tracking-widest font-bold">Scroll</span>
        <i data-lucide="chevrons-down" class="w-5 h-5 animate-bounce"></i>
    </a>
</section>
@endguest


{{-- ══════════════════════════════════════════════════════════
     DASHBOARD BANNER — logged-in users only
══════════════════════════════════════════════════════════ --}}
@auth
@php
    $myProjectCount = auth()->user()->projects()->count();
    $myPublished    = auth()->user()->projects()->whereIn('status', ['published','completed'])->count();
    $myPending      = auth()->user()->projects()->where('status', 'pending')->count();
@endphp
<section class="ss-dashboard-section relative w-full overflow-hidden" style="min-height:100svh;display:flex;flex-direction:column;justify-content:center;">

    {{-- Background --}}
    <div class="absolute inset-0 -z-10">
        <img src="/images/hero_bg.png" alt="" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background:linear-gradient(135deg,#030d12 0%,#0f3d35 40%,#0d1a3a 100%);opacity:.85;"></div>
        <div class="ss-orb" style="width:520px;height:520px;top:-100px;left:-120px;background:radial-gradient(circle,#0d9488 0%,transparent 70%);opacity:.18;animation:orbFloat 8s ease-in-out infinite;"></div>
        <div class="ss-orb" style="width:400px;height:400px;bottom:-80px;right:-100px;background:radial-gradient(circle,#0f766e 0%,transparent 70%);opacity:.15;animation:orbFloat 11s ease-in-out infinite reverse;"></div>
        <div class="ss-orb" style="width:300px;height:300px;top:40%;left:55%;background:radial-gradient(circle,#0891b2 0%,transparent 70%);opacity:.12;animation:orbFloat 14s ease-in-out infinite;"></div>
    </div>

    {{-- Content: 2-column grid (text left | stats right) --}}
    <div class="relative z-10 w-full max-w-7xl mx-auto px-6"
         style="display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:3rem;">

        {{-- Left: Welcome text --}}
        <div>
            <span class="ss-dashboard-badge inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-md border"
                  style="background:rgba(13,148,136,.15);border-color:rgba(13,148,136,.4);color:#5eead4;">
                <i data-lucide="layout-dashboard" class="w-3.5 h-3.5"></i>
                My Dashboard
            </span>
            <h1 class="font-black text-white leading-tight mb-4"
                style="font-size:clamp(2.2rem,4vw,4rem);text-shadow:0 2px 40px rgba(0,0,0,.6);">
                Welcome back,<br>
                <span style="background:linear-gradient(90deg,#2dd4bf,#34d399,#22d3ee);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;">
                    {{ auth()->user()->name }}
                </span> 👋
            </h1>
            <p class="text-base font-medium mb-10" style="color:rgba(255,255,255,.5);max-width:420px;">
                Keep building, keep sharing. The world wants to see what you create next.
            </p>

            {{-- CTA buttons --}}
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('student.projects.create') }}"
                   class="ss-btn-primary flex items-center gap-2 px-8 py-4 rounded-2xl font-bold text-sm text-white"
                   style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 32px rgba(13,148,136,.45);">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i> Submit New Project
                </a>
                <a href="{{ route('student.projects.index') }}"
                   class="ss-btn-outline flex items-center gap-2 px-8 py-4 rounded-2xl font-bold text-sm"
                   style="border:1.5px solid rgba(255,255,255,.2);color:rgba(255,255,255,.85);backdrop-filter:blur(12px);background:rgba(255,255,255,.06);">
                    <i data-lucide="folder-open" class="w-4 h-4"></i> My Projects
                </a>
                <a href="#projects"
                   class="ss-btn-outline flex items-center gap-2 px-8 py-4 rounded-2xl font-bold text-sm"
                   style="border:1.5px solid rgba(255,255,255,.12);color:rgba(255,255,255,.5);backdrop-filter:blur(12px);background:rgba(255,255,255,.04);">
                    <i data-lucide="grid" class="w-4 h-4"></i> Browse All
                </a>
            </div>
        </div>

        {{-- Right: Quick stats — 3 equal columns --}}
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;">
            {{-- Total --}}
            <div class="flex flex-col items-center justify-center py-10 px-3 text-center rounded-2xl"
                 style="background:rgba(10,15,46,.75);border:1px solid rgba(255,255,255,.09);backdrop-filter:blur(20px);">
                <i data-lucide="folder" class="w-7 h-7 mb-3 text-white"></i>
                <span class="text-4xl font-black text-white mb-1">{{ $myProjectCount }}</span>
                <span class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,.4);">Total</span>
            </div>
            {{-- Published --}}
            <div class="flex flex-col items-center justify-center py-10 px-3 text-center rounded-2xl"
                 style="background:rgba(10,15,46,.75);border:1px solid rgba(255,255,255,.09);backdrop-filter:blur(20px);">
                <i data-lucide="check-circle-2" class="w-7 h-7 mb-3 text-white"></i>
                <span class="text-4xl font-black text-white mb-1">{{ $myPublished }}</span>
                <span class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,.4);">Published</span>
            </div>
            {{-- Pending --}}
            <div class="flex flex-col items-center justify-center py-10 px-3 text-center rounded-2xl"
                 style="background:rgba(10,15,46,.75);border:1px solid rgba(255,255,255,.09);backdrop-filter:blur(20px);">
                <i data-lucide="clock" class="w-7 h-7 mb-3 text-white"></i>
                <span class="text-4xl font-black text-white mb-1">{{ $myPending }}</span>
                <span class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,.4);">Pending</span>
            </div>
        </div>
    </div>

    {{-- Scroll hint --}}
    <a href="#stats" class="absolute bottom-10 right-8 z-20 flex flex-col items-center gap-1" style="color:rgba(255,255,255,.4);">
        <span class="text-[10px] uppercase tracking-widest font-bold">Scroll</span>
        <i data-lucide="chevrons-down" class="w-5 h-5 animate-bounce"></i>
    </a>
</section>
@endauth


{{-- ══════════════════════════════════════════════════════════
     STATS BAR
══════════════════════════════════════════════════════════ --}}
<section id="stats" class="relative z-10">
    <div class="max-w-5xl mx-auto px-6 -translate-y-8">
        <div class="grid grid-cols-3 gap-px rounded-2xl overflow-hidden shadow-2xl"
             style="background:rgba(13,148,136,.2);">
            @foreach ([
                ['icon'=>'folder-open', 'val'=>$totalProjects, 'label'=>'Projects Published'],
                ['icon'=>'users',       'val'=>$totalStudents,  'label'=>'Student Builders'],
                ['icon'=>'tag',         'val'=>$totalCategories,'label'=>'Categories'],
            ] as $stat)
            <div class="flex flex-col items-center justify-center py-8 px-4 text-center"
                 style="background:rgba(10,15,46,.85);backdrop-filter:blur(20px);">
                <i data-lucide="{{ $stat['icon'] }}" class="w-6 h-6 mb-3" style="color:#2dd4bf;"></i>
                <span class="text-3xl font-black text-white mb-1">{{ $stat['val'] }}</span>
                <span class="text-xs font-bold uppercase tracking-widest" style="color:rgba(255,255,255,.4);">{{ $stat['label'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════════
     RECENT / FEATURED PROJECTS (splatteredink product shelf)
══════════════════════════════════════════════════════════ --}}
@if ($recentProjects->count() > 0)
<section id="ss-recent" class="py-16 px-6">
    <div class="max-w-7xl mx-auto">

        {{-- Section header --}}
        <div class="flex items-end justify-between mb-10 flex-wrap gap-4">
            <div>
                <p class="text-xs font-black uppercase tracking-widest mb-2" style="color:#2dd4bf;">Featured Work</p>
                <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight">
                    Latest Projects
                </h2>
            </div>
            <div class="flex gap-3">
                <a href="#projects" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-105"
                   style="background:rgba(13,148,136,.12);color:#2dd4bf;border:1px solid rgba(13,148,136,.25);">
                    Browse All
                </a>
                <a href="#projects" class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-105 text-white"
                   style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 4px 20px rgba(13,148,136,.3);">
                    All Categories →
                </a>
            </div>
        </div>

        {{-- 4-card shelf --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ($recentProjects as $rp)
            <a href="{{ route('project.show', $rp) }}"
               class="group relative rounded-2xl overflow-hidden block"
               style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);backdrop-filter:blur(10px);transition:transform .25s,box-shadow .25s;"
               onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 20px 60px rgba(13,148,136,.25)'"
               onmouseout="this.style.transform='';this.style.boxShadow=''">

                {{-- Cover / placeholder --}}
                <div class="h-44 overflow-hidden" style="background:linear-gradient(135deg,#042f2e,#0f3d35);">
                    @if ($rp->cover_image)
                        <img src="{{ Storage::url($rp->cover_image) }}" alt="{{ $rp->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i data-lucide="code-2" class="w-12 h-12" style="color:rgba(45,212,191,.4);"></i>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-4">
                    @if ($rp->category)
                        <span class="text-[10px] font-black uppercase tracking-widest" style="color:#2dd4bf;">
                            {{ $rp->category->name }}
                        </span>
                    @endif
                    <h3 class="font-black text-white mt-1 mb-1 line-clamp-2 leading-snug">
                        {{ $rp->title }}
                    </h3>
                    <p class="text-xs font-medium" style="color:rgba(255,255,255,.4);">
                        By {{ $rp->user?->name ?? 'Student' }}
                    </p>
                </div>

                {{-- Hover: view indicator --}}
                <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                    <span class="flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold text-white"
                          style="background:rgba(13,148,136,.8);backdrop-filter:blur(8px);">
                        <i data-lucide="arrow-up-right" class="w-3 h-3"></i> View
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ══════════════════════════════════════════════════════════
     TAGLINE MARQUEE (splatteredink vibe divider)
══════════════════════════════════════════════════════════ --}}
<div class="w-full overflow-hidden py-5 border-y" style="border-color:rgba(13,148,136,.15);background:rgba(13,148,136,.04);">
    <div class="ss-marquee whitespace-nowrap text-xs font-black uppercase tracking-[0.3em]" style="color:rgba(45,212,191,.5);">
        @for ($m = 0; $m < 3; $m++)
        &nbsp;&nbsp;&nbsp;✦ Student Innovation &nbsp;&nbsp;&nbsp;✦ Real Projects &nbsp;&nbsp;&nbsp;✦ Open Source &nbsp;&nbsp;&nbsp;✦ Code &bull; Design &bull; Build &nbsp;&nbsp;&nbsp;✦ Next Generation Makers &nbsp;&nbsp;&nbsp;✦ Cambodia Tech Future&nbsp;&nbsp;&nbsp;
        @endfor
    </div>
</div>


{{-- ══════════════════════════════════════════════════════════
     SEARCH + FILTER + FULL GRID  (anchor: #projects)
══════════════════════════════════════════════════════════ --}}
<section id="projects" class="py-20 px-6">
    <div class="max-w-7xl mx-auto">

        {{-- Section heading --}}
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6
                         backdrop-blur-md border"
                  style="background:rgba(13,148,136,.1);border-color:rgba(13,148,136,.25);color:#2dd4bf;">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                Student Project Gallery
            </span>
            <h2 class="text-4xl md:text-6xl font-black tracking-tight text-white mb-5 leading-tight">
                Built by<br>
                <span style="background:linear-gradient(90deg,#2dd4bf,#34d399,#22d3ee);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;">
                    Students
                </span>
            </h2>
            <p class="max-w-xl text-lg font-medium mx-auto" style="color:rgba(148,163,184,.8);">
                Explore innovation, creativity, and breakthroughs from the next generation.
            </p>
        </div>

        {{-- Search & Filter bar --}}
        <div class="relative max-w-3xl mx-auto mb-14">
            <div class="absolute -inset-1 rounded-3xl blur-xl" style="background:linear-gradient(90deg,rgba(13,148,136,.2),rgba(15,118,110,.2),rgba(8,145,178,.2));"></div>
            <form action="{{ route('home') }}" method="GET"
                  class="relative flex flex-col md:flex-row items-stretch gap-2 p-2.5 rounded-2xl"
                  style="background:rgba(5,15,25,.7);border:1px solid rgba(13,148,136,.25);backdrop-filter:blur(24px);box-shadow:0 8px 32px rgba(13,148,136,.15);">

                {{-- Search input --}}
                <div class="flex-grow flex items-center gap-3 px-4">
                    <i data-lucide="search" class="w-5 h-5 flex-shrink-0" style="color:#2dd4bf;"></i>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Search projects or students..."
                           class="w-full py-3.5 bg-transparent outline-none border-none focus:ring-0 font-semibold
                                  text-white placeholder:font-normal placeholder:text-white/35">
                </div>

                {{-- Category select --}}
                <div class="relative">
                    <select name="category" id="category"
                            class="appearance-none pl-4 pr-10 py-3 rounded-xl text-xs font-black uppercase tracking-widest cursor-pointer border outline-none focus:ring-2 focus:ring-teal-500/30"
                            style="background:rgba(5,15,30,.8);border-color:rgba(13,148,136,.3);color:rgba(255,255,255,.7);">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <i data-lucide="chevron-down" class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" style="color:#94a3b8;"></i>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold transition-all hover:scale-[1.02] active:scale-95 text-white"
                        style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 4px 20px rgba(13,148,136,.3);">
                    <i data-lucide="filter" class="w-4 h-4"></i> Filter
                </button>

                {{-- Clear --}}
                @if(request()->hasAny(['search', 'category', 'technology']))
                    <a href="{{ route('home') }}"
                       class="p-3 rounded-xl transition-all hover:scale-[1.02]"
                       style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.5);"
                       title="Clear filters">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </a>
                @endif
            </form>
        </div>

        {{-- Projects Grid --}}
        @if ($projects->isEmpty())
            <div class="text-center py-28 rounded-2xl"
                 style="background:rgba(255,255,255,.04);backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.08);">
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-5"
                     style="background:rgba(13,148,136,.1);border:1px solid rgba(13,148,136,.2);">
                    <i data-lucide="search-x" class="w-9 h-9" style="color:rgba(45,212,191,.6);"></i>
                </div>
                <h3 class="text-2xl font-black text-white tracking-tight">No projects found</h3>
                <p class="mt-3 font-medium max-w-sm mx-auto" style="color:rgba(148,163,184,.8);">
                    Try a different search or browse all categories.
                </p>
            </div>
        @else
            <x-bento-grid :projects="$projects" />
            <div class="mt-12 flex justify-center">
                {{ $projects->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</section>


{{-- ══════════════════════════════════════════════════════════
     TESTIMONIALS / QUOTES  (splatteredink "listen to gossip")
══════════════════════════════════════════════════════════ --}}
<section id="ss-testimonials" class="py-20 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-14">
            <p class="text-xs font-black uppercase tracking-widest mb-3" style="color:#2dd4bf;">What People Say</p>
            <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight">
                When you see it, you <span style="color:#2dd4bf;">believe it</span>.
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ([
                ['quote' => 'This platform gave me the confidence to share my capstone project with the world. The feedback was incredible!', 'name' => 'Sokha R.', 'role' => 'Computer Science, Year 4'],
                ['quote' => 'I found two amazing collaborators for my open-source project just by being on this showcase. Highly recommend submitting!', 'name' => 'Vicheth L.', 'role' => 'Software Engineering, Year 3'],
                ['quote' => 'Being featured here helped me land my first internship. The portfolio visibility is unmatched for students in our program.', 'name' => 'Sreyleap P.', 'role' => 'Information Technology, Year 4'],
            ] as $testimonial)
            <div class="relative rounded-2xl p-7"
                 style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);backdrop-filter:blur(12px);">
                {{-- Quote mark --}}
                <div class="text-6xl font-black leading-none mb-4" style="color:rgba(45,212,191,.25);">&ldquo;</div>
                <p class="text-sm font-medium leading-relaxed mb-6" style="color:rgba(255,255,255,.65);">
                    {{ $testimonial['quote'] }}
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-black text-white"
                         style="background:linear-gradient(135deg,#0d9488,#0f766e);font-size:1rem;">
                        {{ strtoupper(substr($testimonial['name'], 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-black text-sm text-white">{{ $testimonial['name'] }}</p>
                        <p class="text-xs font-medium" style="color:rgba(148,163,184,.6);">{{ $testimonial['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════════
     CTA STRIP  (newsletter-style from splatteredink)
══════════════════════════════════════════════════════════ --}}
<section class="py-20 px-6">
    <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden relative"
         style="background:linear-gradient(135deg,#042f2e 0%,#0f3d35 50%,#0c2234 100%);">
        {{-- Glow orbs inside card --}}
        <div style="position:absolute;width:320px;height:320px;top:-80px;right:-60px;background:radial-gradient(circle,rgba(15,118,110,.3) 0%,transparent 70%);pointer-events:none;"></div>
        <div style="position:absolute;width:200px;height:200px;bottom:-40px;left:-40px;background:radial-gradient(circle,rgba(8,145,178,.2) 0%,transparent 70%);pointer-events:none;"></div>

        <div class="relative z-10 px-10 py-16 text-center">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-6"
                  style="background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);color:rgba(153,246,228,1);">
                <i data-lucide="rocket" class="w-3.5 h-3.5"></i> Join the Community
            </span>
            <h2 class="text-3xl md:text-5xl font-black text-white mb-4 leading-tight tracking-tight">
                Ready to share your<br>
                <span style="background:linear-gradient(90deg,#5eead4,#34d399);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;">next big idea?</span>
            </h2>
            <p class="text-base font-medium mb-10" style="color:rgba(255,255,255,.55);max-width:480px;margin-left:auto;margin-right:auto;">
                Create an account, submit your project, and let the world discover what you've built.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                @auth
                    <a href="{{ route('student.projects.index') }}"
                       class="flex items-center gap-2 px-8 py-4 rounded-2xl font-black text-sm text-white transition-all hover:scale-105"
                       style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 32px rgba(13,148,136,.45);">
                        <i data-lucide="upload-cloud" class="w-4.5 h-4.5"></i> My Projects
                    </a>
                @else
                    <a href="{{ route('register') }}"
                       class="flex items-center gap-2 px-8 py-4 rounded-2xl font-black text-sm text-white transition-all hover:scale-105"
                       style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 32px rgba(13,148,136,.45);">
                        <i data-lucide="user-plus" class="w-4 h-4"></i> Create Account
                    </a>
                    <a href="{{ route('login') }}"
                       class="flex items-center gap-2 px-8 py-4 rounded-2xl font-black text-sm transition-all hover:scale-105"
                       style="background:rgba(255,255,255,.1);border:1.5px solid rgba(255,255,255,.2);color:rgba(255,255,255,.85);">
                        <i data-lucide="log-in" class="w-4 h-4"></i> Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════════
     FOOTER  (splatteredink 4-column footer)
══════════════════════════════════════════════════════════ --}}
<footer class="border-t" style="background:rgba(10,15,46,.95);border-color:rgba(13,148,136,.15);">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

            {{-- Brand --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                         style="background:linear-gradient(135deg,#0d9488,#0f766e);">
                        <i data-lucide="graduation-cap" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="font-black text-white text-lg tracking-tight">StudentShowcase</span>
                </div>
                <p class="text-sm font-medium leading-relaxed" style="color:rgba(255,255,255,.4);">
                    A platform built to celebrate student innovation. Every project tells a story — share yours.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest mb-5" style="color:#2dd4bf;">Quick Links</h4>
                <ul class="space-y-3">
                    @foreach ([
                        ['label'=>'Browse Projects',  'href'=> route('home')],
                        ['label'=>'Submit a Project', 'href'=> Route::has('register') ? route('register') : '#'],
                        ['label'=>'Sign In',          'href'=> Route::has('login') ? route('login') : '#'],
                    ] as $link)
                    <li>
                        <a href="{{ $link['href'] }}"
                           class="text-sm font-medium transition-all hover:translate-x-1 inline-flex items-center gap-1.5"
                           style="color:rgba(255,255,255,.45);"
                           onmouseover="this.style.color='#5eead4'" onmouseout="this.style.color='rgba(255,255,255,.45)'">
                            <i data-lucide="arrow-right" class="w-3 h-3"></i> {{ $link['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Categories --}}
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest mb-5" style="color:#2dd4bf;">Categories</h4>
                <ul class="space-y-3">
                    @forelse ($categories->take(5) as $cat)
                    <li>
                        <a href="{{ route('home', ['category' => $cat->slug]) }}"
                           class="text-sm font-medium transition-all hover:translate-x-1 inline-flex items-center gap-1.5"
                           style="color:rgba(255,255,255,.45);"
                           onmouseover="this.style.color='#5eead4'" onmouseout="this.style.color='rgba(255,255,255,.45)'">
                            <i data-lucide="arrow-right" class="w-3 h-3"></i> {{ $cat->name }}
                        </a>
                    </li>
                    @empty
                    <li class="text-sm" style="color:rgba(255,255,255,.25);">No categories yet.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Support --}}
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest mb-5" style="color:#2dd4bf;">For Students</h4>
                <ul class="space-y-3">
                    @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}"
                           class="text-sm font-medium transition-all hover:translate-x-1 inline-flex items-center gap-1.5"
                           style="color:rgba(255,255,255,.45);"
                           onmouseover="this.style.color='#5eead4'" onmouseout="this.style.color='rgba(255,255,255,.45)'">
                            <i data-lucide="arrow-right" class="w-3 h-3"></i> Create Account
                        </a>
                    </li>
                    @endif
                    @if (Route::has('login'))
                    <li>
                        <a href="{{ route('login') }}"
                           class="text-sm font-medium transition-all hover:translate-x-1 inline-flex items-center gap-1.5"
                           style="color:rgba(255,255,255,.45);"
                           onmouseover="this.style.color='#5eead4'" onmouseout="this.style.color='rgba(255,255,255,.45)'">
                            <i data-lucide="arrow-right" class="w-3 h-3"></i> Sign In
                        </a>
                    </li>
                    @endif
                    @auth
                    <li>
                        <a href="{{ route('student.projects.index') }}"
                           class="text-sm font-medium transition-all hover:translate-x-1 inline-flex items-center gap-1.5"
                           style="color:rgba(255,255,255,.45);"
                           onmouseover="this.style.color='#5eead4'" onmouseout="this.style.color='rgba(255,255,255,.45)'">
                            <i data-lucide="arrow-right" class="w-3 h-3"></i> My Projects
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4"
             style="border-top:1px solid rgba(13,148,136,.15);">
            <p class="text-xs font-medium" style="color:rgba(255,255,255,.25);">
                &copy; {{ date('Y') }} StudentShowcase. Built with ❤️ by students, for students.
            </p>
            <a href="#" onclick="window.scrollTo({top:0,behavior:'smooth'});return false;"
               class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest transition-all hover:scale-105"
               style="color:rgba(45,212,191,.5);">
                <i data-lucide="arrow-up" class="w-4 h-4"></i> Back to top
            </a>
        </div>
    </div>
</footer>


{{-- ══════════════════════════════════════════════════════════
     STYLES & SCRIPTS
══════════════════════════════════════════════════════════ --}}
<style>
    /* ── Animations ─────────────────────────────────────── */
    @keyframes orbFloat {
        0%,100% { transform:translate(0,0) scale(1); }
        50%      { transform:translate(20px,-30px) scale(1.05); }
    }
    .ss-orb { position:absolute; border-radius:9999px; pointer-events:none; }

    .ss-marquee { display:inline-block; animation: marqueeScroll 30s linear infinite; }
    @keyframes marqueeScroll {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-33.333%); }
    }

    /* ── Buttons ─────────────────────────────────────────── */
    .ss-btn-primary { transition: transform .2s, box-shadow .2s; }
    .ss-btn-primary:hover { transform: translateY(-2px); box-shadow:0 12px 40px rgba(13,148,136,.55) !important; }
    .ss-btn-outline  { transition: transform .2s, background .2s; }
    .ss-btn-outline:hover { transform: translateY(-2px); background:rgba(255,255,255,.12) !important; }

    /* ══ PAGE WRAPPER ══════════════════════════════════════ */
    .ss-page-wrap               { background:#040d12; }
    html.light .ss-page-wrap   { background:#edf7f5; }

    /* ══ HERO & DASHBOARD (dark by default) ════════════════ */
    .ss-hero-section,
    .ss-dashboard-section { background:#030d12; }

    /* ── Hero light ─────────────────────────────────────── */
    html.light .ss-hero-section {
        background: linear-gradient(145deg,#eaf8f5 0%,#d4f4ec 50%,#ddeeff 100%);
    }
    html.light .ss-hero-section h1                            { color:#0c2926 !important; text-shadow:none !important; }
    html.light .ss-hero-section p[style*="rgba(255,255,255"]  { color:#475569 !important; }
    html.light .ss-hero-section .ss-btn-outline               { border-color:rgba(13,148,136,.35) !important; color:#0f2b28 !important; background:rgba(13,148,136,.08) !important; }
    html.light .ss-hero-section .absolute > div[style*="gradient"] { opacity:0 !important; }
    html.light .ss-hero-section .absolute > img               { opacity:.06 !important; }
    html.light .ss-hero-section .ss-orb                       { opacity:.3 !important; }
    /* slide category badge border in light */
    html.light .ss-hero-section span[style*="rgba(13,148,136,.15)"] { background:rgba(13,148,136,.12) !important; }

    /* ── Dashboard light ───────────────────────────────── */
    html.light .ss-dashboard-section {
        background: linear-gradient(145deg,#eaf8f5 0%,#d4f4ec 50%,#ddeeff 100%);
    }
    html.light .ss-dashboard-section h1                           { color:#0c2926 !important; text-shadow:none !important; }
    html.light .ss-dashboard-badge                               { color:#0b524e !important; border-color:rgba(13,148,136,.6) !important; background:rgba(13,148,136,.12) !important; }
    html.light .ss-dashboard-section .text-white                  { color:#0c2926 !important; }
    html.light .ss-dashboard-section p[style*="rgba(255,255,255"] { color:#475569 !important; }
    html.light .ss-dashboard-section span[style*="rgba(255,255,255"] { color:#64748b !important; }
    html.light .ss-dashboard-section .ss-btn-outline              { border-color:rgba(13,148,136,.35) !important; color:#0f2b28 !important; background:rgba(13,148,136,.08) !important; }
    /* stat cards */
    html.light .ss-dashboard-section .rounded-2xl[style*="rgba(10,15,46"] {
        background:rgba(255,255,255,.88) !important;
        border-color:rgba(13,148,136,.18) !important;
        box-shadow:0 4px 20px rgba(13,148,136,.08) !important;
    }
    html.light .ss-dashboard-section i[data-lucide="folder"]         { color:#0d9488 !important; }
    html.light .ss-dashboard-section i[data-lucide="check-circle-2"] { color:#059669 !important; }
    html.light .ss-dashboard-section i[data-lucide="clock"]          { color:#d97706 !important; }
    html.light .ss-dashboard-section .absolute > div[style*="gradient"] { opacity:0 !important; }
    html.light .ss-dashboard-section .absolute > img           { opacity:.05 !important; }
    html.light .ss-dashboard-section .ss-orb                  { opacity:.25 !important; }

    /* ══ STATS BAR (#stats) ════════════════════════════════ */
    html.light #stats .grid > div {
        background:rgba(255,255,255,.92) !important;
        border-color:rgba(13,148,136,.12) !important;
        box-shadow:0 2px 16px rgba(13,148,136,.06) !important;
    }
    html.light #stats .text-white                    { color:#0c2926 !important; }
    html.light #stats [style*="rgba(255,255,255,.4"] { color:#64748b !important; }
    html.light #stats i                              { color:#0d9488 !important; }

    /* ══ FEATURED PROJECTS SHELF (#ss-recent) ══════════════ */
    html.light #ss-recent h2.text-white               { color:#0c2926 !important; }
    html.light #ss-recent h3.text-white               { color:#0c2926 !important; }
    html.light #ss-recent [style*="rgba(255,255,255,.07)"] {
        background:rgba(255,255,255,.92) !important;
        border-color:rgba(0,0,0,.07) !important;
        box-shadow:0 2px 12px rgba(0,0,0,.06) !important;
    }
    html.light #ss-recent [style*="rgba(255,255,255,.4"] { color:#64748b !important; }
    html.light #ss-recent [style*="rgba(255,255,255,.1"] { border-color:rgba(0,0,0,.07) !important; }

    /* ══ MARQUEE DIVIDER ═══════════════════════════════════ */
    html.light .ss-page-wrap [style*="border-color:rgba(13,148,136,.15)"] {
        background:rgba(13,148,136,.05) !important;
        border-color:rgba(13,148,136,.18) !important;
    }

    /* ══ PROJECT GALLERY / SEARCH (#projects) ══════════════ */
    html.light #projects h1,
    html.light #projects h2,
    html.light #projects h3                               { color:#0c2926 !important; }
    html.light #projects .text-white                      { color:#0c2926 !important; }
    html.light #projects p[style*="rgba(255,255,255"]     { color:#64748b !important; }
    html.light #projects form[style*="rgba(5,15,25"] {
        background:rgba(255,255,255,.92) !important;
        border-color:rgba(13,148,136,.3) !important;
        box-shadow:0 2px 20px rgba(13,148,136,.08) !important;
    }
    html.light #projects input                            { color:#0f172a !important; background:transparent; }
    html.light #projects select                           { background:rgba(240,252,250,.9) !important; color:#0f172a !important; }
    html.light #projects [style*="rgba(255,255,255,.04)"] {
        background:rgba(255,255,255,.92) !important;
        border-color:rgba(0,0,0,.07) !important;
        box-shadow:0 2px 12px rgba(0,0,0,.05) !important;
    }
    html.light #projects [style*="rgba(148,163,184"]      { color:#64748b !important; }
    html.light #projects time                             { color:#64748b !important; }
    html.light #projects [style*="rgba(255,255,255,.25)"] { color:#94a3b8 !important; }

    /* ══ TESTIMONIALS (#ss-testimonials) ══════════════════ */
    html.light #ss-testimonials h2.text-white             { color:#0c2926 !important; }
    html.light #ss-testimonials .text-white               { color:#0c2926 !important; }
    html.light #ss-testimonials .rounded-2xl {
        background:rgba(255,255,255,.92) !important;
        border-color:rgba(13,148,136,.1) !important;
        box-shadow:0 4px 24px rgba(13,148,136,.07) !important;
    }
    /* quote mark */
    html.light #ss-testimonials [style*="rgba(45,212,191,.25)"] { color:rgba(13,148,136,.45) !important; }
    /* quote body */
    html.light #ss-testimonials [style*="rgba(255,255,255,.65)"] { color:#475569 !important; }
    /* role / year */
    html.light #ss-testimonials [style*="rgba(148,163,184"]      { color:#64748b !important; }

    /* ══ FOOTER ════════════════════════════════════════════ */
    html.light footer {
        background:rgba(240,252,250,.99) !important;
        border-color:rgba(13,148,136,.18) !important;
    }
    html.light footer .text-white                          { color:#0c2926 !important; }
    html.light footer [style*="rgba(255,255,255,.4"]       { color:#64748b !important; }
    html.light footer [style*="rgba(255,255,255,.45)"],
    html.light footer a[style*="rgba(255,255,255"]         { color:#0d7a6e !important; }
    html.light footer [style*="rgba(255,255,255,.25)"]     { color:#94a3b8 !important; }
    html.light footer a[style*="rgba(45,212,191"]          { color:#0d9488 !important; }
    html.light footer [style*="border-top"]                { border-color:rgba(13,148,136,.15) !important; }
    html.light footer li[style]                            { color:#94a3b8 !important; }
</style>

<script>
    // ── Hero Slider ──────────────────────────────────────────
    (function() {
        const slides = document.querySelectorAll('.ss-slide');
        const dots   = document.querySelectorAll('.ss-dot');
        let current  = 0;
        let timer;

        function goSlide(idx) {
            slides[current].style.opacity = '0';
            slides[current].style.pointerEvents = 'none';
            dots[current].style.width = '8px';
            dots[current].style.background = 'rgba(255,255,255,.3)';

            current = idx;
            slides[current].style.opacity = '1';
            slides[current].style.pointerEvents = '';
            dots[current].style.width = '32px';
            dots[current].style.background = '#2dd4bf';
        }

        // Wire dot clicks via event delegation (no inline onclick needed)
        const dotsContainer = document.getElementById('ss-dots');
        if (dotsContainer) {
            dotsContainer.addEventListener('click', function(e) {
                const btn = e.target.closest('[data-index]');
                if (btn) goSlide(parseInt(btn.dataset.index, 10));
            });
        }

        function nextSlide() {
            if (slides.length < 2) return;
            goSlide((current + 1) % slides.length);
        }

        if (slides.length > 1) {
            timer = setInterval(nextSlide, 6000);
            const sliderEl = document.getElementById('ss-slides');
            if (sliderEl) {
                sliderEl.addEventListener('mouseenter', () => clearInterval(timer));
                sliderEl.addEventListener('mouseleave', () => { timer = setInterval(nextSlide, 6000); });
            }
        }
    })();

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) { e.preventDefault(); target.scrollIntoView({behavior:'smooth', block:'start'}); }
        });
    });
</script>

</div>{{-- /dark wrapper --}}

@endsection
