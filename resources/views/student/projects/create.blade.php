@extends('layouts.student')

@section('title', 'Create Project — Student Showcase')

@section('student-content')
<div class="cf-wrap min-h-screen py-12 px-6">
<div class="max-w-2xl mx-auto">

    {{-- ── Page header ─────────────────────────────────────── --}}
    <div class="mb-8">
        <a href="{{ route('student.projects.index') }}"
           class="cf-back inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest mb-5 transition-all"
           style="color:rgba(45,212,191,.7);">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> My Projects
        </a>
        <p class="text-xs font-black uppercase tracking-widest mb-2" style="color:#2dd4bf;">Submit Work</p>
        <h1 class="text-3xl md:text-4xl font-black tracking-tight cf-heading">Create New Project</h1>
    </div>

    {{-- ── Error box ───────────────────────────────────────── --}}
    @if ($errors->any())
    <div class="rounded-2xl p-5 mb-6 flex gap-3"
         style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);">
        <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0 mt-0.5" style="color:#f87171;"></i>
        <div>
            <p class="text-sm font-black mb-2" style="color:#f87171;">Please fix the following errors:</p>
            <ul class="space-y-1">
                @foreach ($errors->all() as $error)
                <li class="text-sm font-medium" style="color:rgba(248,113,113,.8);">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- ── Form card ───────────────────────────────────────── --}}
    <form action="{{ route('student.projects.store') }}" method="POST" enctype="multipart/form-data"
          class="cf-card rounded-2xl p-8 space-y-6">
        @csrf

        {{-- Title --}}
        <div>
            <label for="title" class="cf-label">Project Title <span style="color:#f87171;">*</span></label>
            <input type="text" id="title" name="title"
                   class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('title') cf-input-err @enderror"
                   value="{{ old('title') }}"
                   placeholder="My Awesome Project"
                   required>
            @error('title')
            <p class="text-xs font-bold mt-1.5" style="color:#f87171;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="cf-label">Description <span style="color:#f87171;">*</span></label>
            <textarea id="description" name="description" rows="5"
                      class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all resize-none @error('description') cf-input-err @enderror"
                      placeholder="Describe what your project does, the problem it solves, and what you learned..."
                      required>{{ old('description') }}</textarea>
            @error('description')
            <p class="text-xs font-bold mt-1.5" style="color:#f87171;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Two-column row: URL + GitHub --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="url" class="cf-label">
                    <i data-lucide="external-link" class="w-3.5 h-3.5 inline mr-1" style="color:#2dd4bf;"></i>
                    Live URL <span class="cf-optional">(optional)</span>
                </label>
                <input type="url" id="url" name="url"
                       class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('url') cf-input-err @enderror"
                       value="{{ old('url') }}"
                       placeholder="https://myproject.com">
                @error('url')
                <p class="text-xs font-bold mt-1.5" style="color:#f87171;">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="github_link" class="cf-label">
                    <svg class="w-3.5 h-3.5 inline mr-1" fill="currentColor" viewBox="0 0 24 24" style="color:#2dd4bf;"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                    GitHub <span class="cf-optional">(optional)</span>
                </label>
                <input type="url" id="github_link" name="github_link"
                       class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('github_link') cf-input-err @enderror"
                       value="{{ old('github_link') }}"
                       placeholder="https://github.com/user/repo">
                @error('github_link')
                <p class="text-xs font-bold mt-1.5" style="color:#f87171;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Cover Image --}}
        <div>
            <label for="cover_image" class="cf-label">
                <i data-lucide="image" class="w-3.5 h-3.5 inline mr-1" style="color:#2dd4bf;"></i>
                Cover Image <span class="cf-optional">(optional)</span>
            </label>
            <label for="cover_image" class="cf-file-zone mt-1.5 flex flex-col items-center justify-center gap-2 rounded-xl cursor-pointer transition-all">
                <i data-lucide="upload-cloud" class="w-8 h-8" style="color:rgba(45,212,191,.5);"></i>
                <span class="text-sm font-bold cf-heading">Click to upload cover image</span>
                <span class="text-xs cf-muted">PNG, JPG, WEBP up to 5MB</span>
                <input type="file" id="cover_image" name="cover_image" accept="image/*" class="hidden"
                       onchange="previewFile(this, 'cover-preview')">
            </label>
            <img id="cover-preview" src="" alt="Preview" class="hidden mt-3 w-full rounded-xl object-cover" style="max-height:220px;">
            @error('cover_image')
            <p class="text-xs font-bold mt-1.5" style="color:#f87171;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gallery Images --}}
        <div>
            <label class="cf-label">
                <i data-lucide="layout-grid" class="w-3.5 h-3.5 inline mr-1" style="color:#2dd4bf;"></i>
                Project Gallery <span class="cf-optional">(optional — multiple images)</span>
            </label>
            <label for="gallery_images" class="cf-file-zone mt-1.5 flex flex-col items-center justify-center gap-2 rounded-xl cursor-pointer transition-all">
                <i data-lucide="images" class="w-8 h-8" style="color:rgba(45,212,191,.5);"></i>
                <span class="text-sm font-bold cf-heading">Click to upload gallery images</span>
                <span class="text-xs cf-muted">Select multiple files at once</span>
                <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple class="hidden">
            </label>
            @error('gallery_images.*')
            <p class="text-xs font-bold mt-1.5" style="color:#f87171;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Technologies --}}
        <div>
            <label for="technologies" class="cf-label">
                <i data-lucide="code-2" class="w-3.5 h-3.5 inline mr-1" style="color:#2dd4bf;"></i>
                Technologies Used <span style="color:#f87171;">*</span>
            </label>
            <input type="text" id="technologies" name="technologies"
                   class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('technologies') cf-input-err @enderror"
                   value="{{ old('technologies') }}"
                   placeholder="Laravel, Vue.js, MySQL, Tailwind CSS"
                   required>
            <p class="text-xs cf-muted mt-1.5">Separate with commas</p>
            @error('technologies')
            <p class="text-xs font-bold mt-1.5" style="color:#f87171;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Category --}}
        @if(isset($categories) && $categories->count() > 0)
        <div>
            <label for="category_id" class="cf-label">
                <i data-lucide="tag" class="w-3.5 h-3.5 inline mr-1" style="color:#2dd4bf;"></i>
                Category <span class="cf-optional">(optional)</span>
            </label>
            <select id="category_id" name="category_id"
                    class="cf-input cf-select w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all">
                <option value="">— Select a category —</option>
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
        </div>
        @endif

        {{-- Status --}}
        <div>
            <label for="status" class="cf-label">
                <i data-lucide="activity" class="w-3.5 h-3.5 inline mr-1" style="color:#2dd4bf;"></i>
                Project Status <span style="color:#f87171;">*</span>
            </label>
            <select id="status" name="status"
                    class="cf-input cf-select w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all"
                    required>
                <option value="draft"       {{ old('status','draft') == 'draft'       ? 'selected' : '' }}>Draft</option>
                <option value="in_progress" {{ old('status') == 'in_progress'         ? 'selected' : '' }}>In Progress</option>
                <option value="completed"   {{ old('status') == 'completed'           ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status')
            <p class="text-xs font-bold mt-1.5" style="color:#f87171;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Divider --}}
        <div class="cf-divider"></div>

        {{-- Submit buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-1">
            <button type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-black text-white transition-all hover:scale-[1.02] hover:shadow-xl"
                    style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 24px rgba(13,148,136,.35);">
                <i data-lucide="upload-cloud" class="w-4 h-4"></i>
                Create Project
            </button>
            <a href="{{ route('student.projects.index') }}"
               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-black transition-all hover:scale-[1.02] cf-btn-ghost">
                <i data-lucide="x" class="w-4 h-4"></i>
                Cancel
            </a>
        </div>
    </form>

</div>
</div>

<style>
    /* ── Page ───────────────────────────────────────────────── */
    .cf-back:hover { color:#2dd4bf !important; transform:translateX(-3px); }

    /* ── Form card ──────────────────────────────────────────── */
    .cf-card {
        background: rgba(255,255,255,.05);
        border: 1px solid rgba(255,255,255,.09);
        backdrop-filter: blur(16px);
        box-shadow: 0 8px 40px rgba(0,0,0,.3);
    }

    /* ── Labels ─────────────────────────────────────────────── */
    .cf-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: rgba(255,255,255,.7);
    }
    .cf-optional { font-weight:500; text-transform:none; letter-spacing:normal; color:rgba(255,255,255,.35); font-size:0.7rem; }

    /* ── Inputs ─────────────────────────────────────────────── */
    .cf-input {
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.12);
        color: #ffffff;
        outline: none;
    }
    .cf-input::placeholder { color: rgba(255,255,255,.3); }
    .cf-input:focus {
        border-color: rgba(13,148,136,.6);
        box-shadow: 0 0 0 3px rgba(13,148,136,.12);
        background: rgba(255,255,255,.08);
    }
    .cf-input-err { border-color: rgba(239,68,68,.5) !important; }
    .cf-select { appearance: none; cursor: pointer; }
    .cf-select option { background: #1a1a2e; color: #fff; }

    /* ── Upload zone ────────────────────────────────────────── */
    .cf-file-zone {
        min-height: 110px;
        border: 2px dashed rgba(13,148,136,.25);
        background: rgba(13,148,136,.04);
        padding: 1.5rem;
    }
    .cf-file-zone:hover {
        border-color: rgba(13,148,136,.5);
        background: rgba(13,148,136,.08);
    }

    /* ── Typography ─────────────────────────────────────────── */
    .cf-heading { color: #ffffff; }
    .cf-muted   { color: rgba(148,163,184,.7); }

    /* ── Ghost button ───────────────────────────────────────── */
    .cf-btn-ghost {
        background: rgba(255,255,255,.06);
        color: rgba(255,255,255,.65);
        border: 1px solid rgba(255,255,255,.1);
    }
    .cf-btn-ghost:hover { background: rgba(255,255,255,.1); color: #fff; }

    /* ── Divider ────────────────────────────────────────────── */
    .cf-divider { border-top: 1px solid rgba(255,255,255,.07); }

    /* ══ LIGHT MODE ════════════════════════════════════════════ */
    html.light .cf-card {
        background: rgba(255,255,255,.9);
        border-color: rgba(13,148,136,.12);
        box-shadow: 0 8px 40px rgba(13,148,136,.08);
    }
    html.light .cf-label { color: #0c2926; }
    html.light .cf-optional { color: #94a3b8; }
    html.light .cf-input {
        background: rgba(255,255,255,.8);
        border-color: rgba(13,148,136,.2);
        color: #0f172a;
    }
    html.light .cf-input::placeholder { color: rgba(15,23,42,.35); }
    html.light .cf-input:focus {
        border-color: rgba(13,148,136,.5);
        box-shadow: 0 0 0 3px rgba(13,148,136,.1);
        background: #fff;
    }
    html.light .cf-select option { background: #fff; color: #0f172a; }
    html.light .cf-file-zone {
        border-color: rgba(13,148,136,.2);
        background: rgba(13,148,136,.03);
    }
    html.light .cf-file-zone:hover {
        border-color: rgba(13,148,136,.4);
        background: rgba(13,148,136,.07);
    }
    html.light .cf-heading { color: #0c2926; }
    html.light .cf-muted   { color: #64748b; }
    html.light .cf-btn-ghost {
        background: rgba(13,148,136,.07);
        color: #0f766e;
        border-color: rgba(13,148,136,.18);
    }
    html.light .cf-btn-ghost:hover { background: rgba(13,148,136,.13); color: #0d9488; }
    html.light .cf-divider { border-color: rgba(13,148,136,.1); }
</style>

<script>
    function previewFile(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
