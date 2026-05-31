@extends('layouts.student')

@section('title', 'Edit Profile')

@section('student-content')
    <div class="cf-wrap min-h-screen py-12 px-6">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight cf-heading mb-8">Edit Your Profile</h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data"
                class="cf-card rounded-2xl p-8">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="cf-label">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Profile Image -->
                <div class="mb-6">
                    <label for="profile_image" class="cf-label">Profile Image</label>
                    <div class="flex items-center gap-4">
                        @if ($profile->profile_image)
                            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $user->name }}"
                                class="w-20 h-20 rounded-full object-cover">
                        @endif
                        <input type="file" id="profile_image" name="profile_image"
                            accept="image/jpeg,image/png,image/jpg"
                            class="cf-input rounded-xl px-4 py-2 text-sm font-medium">
                    </div>
                    <p class="text-sm cf-muted mt-2">Max 2MB, formats: JPEG, PNG</p>
                    @error('profile_image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bio -->
                <div class="mb-6">
                    <label for="bio" class="cf-label">Bio</label>
                    <textarea id="bio" name="bio" rows="5" maxlength="500"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all"
                        placeholder="Write a brief bio about yourself...">{{ old('bio', $profile->bio) }}</textarea>
                    <p class="text-sm cf-muted mt-2">{{ strlen(old('bio', $profile->bio ?? '')) }}/500 characters</p>
                    @error('bio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Skills -->
                <div class="mb-6">
                    <label for="skills" class="cf-label">Skills</label>
                    <input type="text" id="skills" name="skills"
                        value="{{ old('skills', implode(', ', $profile->skills ?? [])) }}"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all"
                        placeholder="e.g., PHP, Laravel, JavaScript, React (comma-separated)">
                    @error('skills')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-4">
                    <a href="{{ route('student.profile.show') }}" class="px-6 py-2 rounded-xl cf-btn-ghost">Cancel</a>
                    <button type="submit"
                        class="px-6 py-2 rounded-xl text-sm font-black text-white transition-all hover:scale-[1.02] hover:shadow-xl"
                        style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 24px rgba(13,148,136,.35);">
                        Save Changes
                    </button>
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

    /* ── Buttons ────────────────────────────────────────────── */
    .cf-btn-ghost {
        background: rgba(255, 255, 255, .06);
        color: rgba(255, 255, 255, .65);
        border: 1px solid rgba(255, 255, 255, .1);
    }

    .cf-btn-ghost:hover {
        background: rgba(255, 255, 255, .1);
        color: #fff;
    }

    /* ── Typography ─────────────────────────────────────────── */
    .cf-heading {
        color: #ffffff;
    }

    .cf-muted {
        color: rgba(148, 163, 184, .7);
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
