@props(['projects'])

{{-- ══════════════════════════════════════════
     BENTO GRID  — masonry-inspired project grid
     Accepts a paginated/collection of $projects
══════════════════════════════════════════ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach ($projects as $project)
    <a href="{{ route('project.show', $project) }}"
       class="group relative flex flex-col rounded-2xl overflow-hidden"
       style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);backdrop-filter:blur(10px);transition:transform .25s,box-shadow .25s;"
       onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 24px 60px rgba(13,148,136,.22)'"
       onmouseout="this.style.transform='';this.style.boxShadow=''">

        {{-- Cover image / placeholder --}}
        <div class="relative h-48 overflow-hidden flex-shrink-0"
             style="background:linear-gradient(135deg,#042f2e 0%,#0f3d35 100%);">
            @if ($project->cover_image)
                <img src="{{ Storage::url($project->cover_image) }}"
                     alt="{{ $project->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            @else
                {{-- Decorative placeholder --}}
                <div class="w-full h-full flex items-center justify-center">
                    <i data-lucide="code-2" class="w-14 h-14" style="color:rgba(45,212,191,.3);"></i>
                </div>
                {{-- Grid pattern overlay --}}
                <div class="absolute inset-0 opacity-10"
                     style="background-image:linear-gradient(rgba(45,212,191,.4) 1px,transparent 1px),linear-gradient(90deg,rgba(45,212,191,.4) 1px,transparent 1px);background-size:24px 24px;">
                </div>
            @endif

            {{-- Hover view badge --}}
            <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <span class="flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold text-white"
                      style="background:rgba(13,148,136,.85);backdrop-filter:blur(8px);">
                    <i data-lucide="arrow-up-right" class="w-3 h-3"></i> View
                </span>
            </div>

            {{-- Category pill --}}
            @if ($project->category)
            <div class="absolute bottom-3 left-3">
                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider"
                      style="background:rgba(13,148,136,.75);color:#ccfbf1;backdrop-filter:blur(6px);">
                    {{ $project->category->name }}
                </span>
            </div>
            @endif
        </div>

        {{-- Card body --}}
        <div class="flex flex-col flex-1 p-5">
            <h3 class="font-black text-slate-800 dark:text-white leading-snug mb-1 line-clamp-2 group-hover:text-teal-400 transition-colors duration-200">
                {{ $project->title }}
            </h3>

            @if ($project->description)
            <p class="text-xs font-medium leading-relaxed line-clamp-2 mb-3"
               style="color:rgba(148,163,184,.75);">
                {{ $project->description }}
            </p>
            @endif

            {{-- Footer row --}}
            <div class="mt-auto flex items-center justify-between gap-2 pt-3"
                 style="border-top:1px solid rgba(255,255,255,.07);">
                {{-- Author avatar + name --}}
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-black text-white flex-shrink-0"
                         style="background:linear-gradient(135deg,#0d9488,#0f766e);">
                        {{ strtoupper(substr($project->user?->name ?? 'S', 0, 1)) }}
                    </div>
                    <span class="text-xs font-semibold truncate max-w-[120px]"
                          style="color:rgba(148,163,184,.7);">
                        {{ $project->user?->name ?? 'Student' }}
                    </span>
                </div>

                {{-- Date --}}
                <span class="text-[10px] font-medium flex-shrink-0"
                      style="color:rgba(148,163,184,.45);">
                    {{ ($project->published_at ?? $project->created_at)?->diffForHumans() }}
                </span>
            </div>
        </div>
    </a>
    @endforeach
</div>
