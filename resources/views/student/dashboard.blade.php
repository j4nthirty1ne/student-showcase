@extends('layouts.student')

@section('title', 'Dashboard — Student Showcase')

@section('student-content')
<div class="min-h-screen py-10 px-6">
<div class="max-w-5xl mx-auto">

    {{-- ── Welcome header ─────────────────────────────────── --}}
    <div class="mb-10">
        <p class="text-xs font-black uppercase tracking-widest mb-2" style="color:#2dd4bf;">Welcome back</p>
        <h1 class="text-3xl md:text-4xl font-black tracking-tight text-slate-800 dark:text-white">
            {{ Auth::user()->name }} 👋
        </h1>
        <p class="mt-2 text-sm font-medium" style="color:rgba(148,163,184,.75);">
            Manage your projects and profile from here.
        </p>
    </div>

    {{-- ── Quick stats ─────────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10">

        {{-- Projects count --}}
        <div class="rounded-2xl p-6 flex items-center gap-4"
             style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);backdrop-filter:blur(12px);">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:rgba(13,148,136,.15);border:1px solid rgba(13,148,136,.25);">
                <i data-lucide="folder-open" class="w-5 h-5" style="color:#2dd4bf;"></i>
            </div>
            <div>
                <p class="text-2xl font-black text-white">{{ Auth::user()->projects()->count() }}</p>
                <p class="text-xs font-bold uppercase tracking-widest" style="color:rgba(148,163,184,.6);">Your Projects</p>
            </div>
        </div>

        {{-- Profile status --}}
        <div class="rounded-2xl p-6 flex items-center gap-4"
             style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);backdrop-filter:blur(12px);">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);">
                <i data-lucide="user-check" class="w-5 h-5" style="color:#4ade80;"></i>
            </div>
            <div>
                <p class="text-sm font-black text-green-400">✓ Active</p>
                <p class="text-xs font-bold uppercase tracking-widest" style="color:rgba(148,163,184,.6);">Profile Status</p>
            </div>
        </div>

        {{-- Quick action --}}
        <a href="{{ route('student.projects.create') }}"
           class="rounded-2xl p-6 flex items-center gap-4 transition-all duration-200 hover:scale-[1.02] hover:shadow-xl group"
           style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 24px rgba(13,148,136,.3);">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                <i data-lucide="plus-circle" class="w-5 h-5 text-white"></i>
            </div>
            <div>
                <p class="text-sm font-black text-white">New Project</p>
                <p class="text-xs font-medium text-white/60">Add something new</p>
            </div>
        </a>
    </div>

    {{-- ── Quick links ─────────────────────────────────────── --}}
    <div class="rounded-2xl p-6"
         style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);backdrop-filter:blur(12px);">
        <h2 class="text-base font-black text-white mb-5">Quick Links</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('student.projects.index') }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.03]"
               style="background:rgba(13,148,136,.12);color:#2dd4bf;border:1px solid rgba(13,148,136,.25);">
                <i data-lucide="folder" class="w-4 h-4"></i> My Projects
            </a>
            <a href="{{ route('student.profile.edit') }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.03]"
               style="background:rgba(255,255,255,.06);color:rgba(255,255,255,.7);border:1px solid rgba(255,255,255,.1);">
                <i data-lucide="pencil" class="w-4 h-4"></i> Edit Profile
            </a>
            <a href="{{ route('home') }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-[1.03]"
               style="background:rgba(255,255,255,.06);color:rgba(255,255,255,.7);border:1px solid rgba(255,255,255,.1);">
                <i data-lucide="globe" class="w-4 h-4"></i> Browse Showcase
            </a>
        </div>
    </div>

</div>
</div>
@endsection
