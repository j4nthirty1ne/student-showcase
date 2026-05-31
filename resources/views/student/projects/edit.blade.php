@extends('layouts.student')

@section('title', 'Edit Project')

@section('student-content')
    <div class="cf-wrap min-h-screen py-12 px-6">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight cf-heading mb-8">Edit Project</h1>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <h2 class="text-red-800 font-semibold mb-2">Please fix the following errors:</h2>
                    <ul class="list-disc list-inside text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('student.projects.update', $project) }}" method="POST" enctype="multipart/form-data"
                class="cf-card rounded-2xl p-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="cf-label">Project Title <span style="color:#f87171;">*</span></label>
                    <input type="text" id="title" name="title"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('title') cf-input-err @enderror"
                        value="{{ old('title', $project->title) }}" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="cf-label">Description <span style="color:#f87171;">*</span></label>
                    <textarea id="description" name="description" rows="5"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all resize-none @error('description') cf-input-err @enderror"
                        required>{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL -->
                <div>
                    <label for="url" class="cf-label">Project URL <span class="cf-optional">(optional)</span></label>
                    <input type="url" id="url" name="url"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all"
                        value="{{ old('url', $project->url) }}">
                    @error('url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- GitHub Link -->
                <div>
                    <label for="github_link" class="cf-label">GitHub Repository URL <span
                            class="cf-optional">(optional)</span></label>
                    <input type="url" id="github_link" name="github_link"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('github_link') cf-input-err @enderror"
                        value="{{ old('github_link', $project->github_link) }}"
                        placeholder="https://github.com/your-username/repo">
                    @error('github_link')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover Image -->
                <div>
                    <label for="cover_image" class="cf-label">Cover Image <span
                            class="cf-optional">(optional)</span></label>
                    @if ($project->cover_image)
                        <div class="mb-3">
                            <p class="text-sm cf-muted mb-2">Current Image:</p>
                            <img src="{{ Storage::url($project->cover_image) }}" alt="Current cover image"
                                class="h-32 w-auto object-cover rounded-xl" style="border:1px solid rgba(255,255,255,.12);">
                        </div>
                    @endif
                    <input type="file" id="cover_image" name="cover_image" accept="image/*"
                        class="cf-input w-full rounded-xl px-4 py-2 text-sm font-medium @error('cover_image') cf-input-err @enderror">
                    @error('cover_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm cf-muted mt-1">Upload a new image to replace the current one (Max 2MB).</p>
                </div>

                <!-- Gallery Images -->
                <div>
                    <label for="gallery_images" class="cf-label">Add to Project Gallery</label>
                    <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple
                        class="cf-input w-full rounded-xl px-4 py-2 text-sm font-medium @error('gallery_images.*') cf-input-err @enderror">
                    @error('gallery_images.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm cf-muted mt-1">Select multiple images to add to the gallery.</p>

                    @if ($project->projectImages->count() > 0)
                        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ($project->projectImages as $image)
                                <div class="relative">
                                    <img src="{{ Storage::url($image->image_path) }}" alt="Gallery image"
                                        class="h-24 w-full object-cover rounded-xl"
                                        style="border:1px solid rgba(255,255,255,.12);">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Technologies -->
                <div>
                    <label for="technologies" class="cf-label">Technologies Used <span
                            style="color:#f87171;">*</span></label>
                    <input type="text" id="technologies" name="technologies"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('technologies') cf-input-err @enderror"
                        value="{{ old('technologies', implode(', ', $project->technologies ?? [])) }}" required>
                    @error('technologies')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm cf-muted mt-1">Separate technologies with commas</p>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="cf-label">Status <span style="color:#f87171;">*</span></label>
                    <select id="status" name="status"
                        class="cf-input cf-select w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all"
                        required>
                        <option value="draft" {{ old('status', $project->status) === 'draft' ? 'selected' : '' }}>Draft
                        </option>
                        <option value="in_progress"
                            {{ old('status', $project->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>
                            Completed</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-black text-white transition-all hover:scale-[1.02] hover:shadow-xl"
                        style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 24px rgba(13,148,136,.35);">
                        Update Project
                    </button>
                    <a href="{{ route('student.projects.show', $project) }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-black transition-all hover:scale-[1.02] cf-btn-ghost">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

<style>
    /* ── Form card ──────────────────────────────────────────── */
    .cf-card {
        background: rgba(255, 255, 255, .05);
        border: 1px solid rgba(255, 255, 255, .09);
        backdrop-filter: blur(16px);
        box-shadow: 0 8px 40px rgba(0, 0, 0, .3);
    }

    /* ── Labels ─────────────────────────────────────────────── */
    .cf-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: rgba(255, 255, 255, .7);
    }

    .cf-optional {
        font-weight: 500;
        text-transform: none;
        letter-spacing: normal;
        color: rgba(255, 255, 255, .35);
        font-size: 0.7rem;
    }

    /* ── Inputs ─────────────────────────────────────────────── */
    .cf-input {
        background: rgba(255, 255, 255, .06);
        border: 1px solid rgba(255, 255, 255, .12);
        color: #ffffff;
        outline: none;
    }

    .cf-input::placeholder {
        color: rgba(255, 255, 255, .3);
    }

    .cf-input:focus {
        border-color: rgba(13, 148, 136, .6);
        box-shadow: 0 0 0 3px rgba(13, 148, 136, .12);
        background: rgba(255, 255, 255, .08);
    }

    .cf-input-err {
        border-color: rgba(239, 68, 68, .5) !important;
    }

    .cf-select {
        appearance: none;
        cursor: pointer;
    }

    .cf-select option {
        background: #1a1a2e;
        color: #fff;
    }

    /* ── Typography ─────────────────────────────────────────── */
    .cf-heading {
        color: #ffffff;
    }

    .cf-muted {
        color: rgba(148, 163, 184, .7);
    }

    /* ── Ghost button ───────────────────────────────────────── */
    .cf-btn-ghost {
        background: rgba(255, 255, 255, .06);
        color: rgba(255, 255, 255, .65);
        border: 1px solid rgba(255, 255, 255, .1);
    }

    .cf-btn-ghost:hover {
        background: rgba(255, 255, 255, .1);
        color: #fff;
    }

    /* ══ LIGHT MODE ════════════════════════════════════════════ */
    html.light .cf-card {
        background: rgba(255, 255, 255, .9);
        border-color: rgba(13, 148, 136, .12);
        box-shadow: 0 8px 40px rgba(13, 148, 136, .08);
    }

    html.light .cf-label {
        color: #0c2926;
    }

    html.light .cf-optional {
        color: #94a3b8;
    }

    html.light .cf-input {
        background: rgba(255, 255, 255, .8);
        border-color: rgba(13, 148, 136, .2);
        color: #0f172a;
    }

    html.light .cf-input::placeholder {
        color: rgba(15, 23, 42, .35);
    }

    html.light .cf-input:focus {
        border-color: rgba(13, 148, 136, .5);
        box-shadow: 0 0 0 3px rgba(13, 148, 136, .1);
        background: #fff;
    }

    html.light .cf-select option {
        background: #fff;
        color: #0f172a;
    }

    html.light .cf-heading {
        color: #0c2926;
    }

    html.light .cf-muted {
        color: #64748b;
    }

    html.light .cf-btn-ghost {
        background: rgba(13, 148, 136, .07);
        color: #0f766e;
        border-color: rgba(13, 148, 136, .18);
    }

    html.light .cf-btn-ghost:hover {
        background: rgba(13, 148, 136, .13);
        color: #0d9488;
    }
</style>
