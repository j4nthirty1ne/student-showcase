@extends('layouts.student')

@section('title', 'My Profile')

@section('student-content')
    <div class="cf-wrap min-h-screen py-12 px-6">
        <div class="cf-card rounded-2xl p-8 max-w-4xl mx-auto">
            <div class="flex justify-between items-start mb-6">
                <h1 class="text-3xl font-black cf-heading">{{ $user->name }}</h1>
                <a href="{{ route('student.profile.edit') }}"
                    class="px-5 py-2.5 rounded-xl text-sm font-black text-white transition-all hover:scale-[1.02] hover:shadow-xl"
                    style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 24px rgba(13,148,136,.35);">
                    Edit Profile
                </a>
            </div>

            <!-- Profile Header -->
            <div class="mb-8 pb-8" style="border-bottom:1px solid rgba(255,255,255,.08);">
                <div class="flex items-center gap-6">
                    @if ($profile->profile_image)
                        <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $user->name }}"
                            class="w-24 h-24 rounded-full object-cover">
                    @else
                        <div class="w-24 h-24 rounded-full flex items-center justify-center"
                            style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20"
                                style="color:rgba(255,255,255,.35);">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm" style="color:rgba(255,255,255,.6);"><strong class="cf-heading">Email:</strong>
                            {{ $user->email }}</p>
                        <p class="text-sm" style="color:rgba(255,255,255,.6);"><strong class="cf-heading">Role:</strong>
                            {{ ucfirst($user->role) }}</p>
                        <p class="text-sm" style="color:rgba(255,255,255,.6);">
                            <strong class="cf-heading">Status:</strong>
                            <span class="font-semibold" style="color:#2dd4bf;">{{ ucfirst($user->status) }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bio -->
            <div class="mb-6">
                <h3 class="text-xl font-black mb-2 cf-heading">Bio</h3>
                <p class="text-sm" style="color:rgba(255,255,255,.6);">{{ $profile->bio ?? 'No bio added yet.' }}</p>
            </div>

            <!-- Skills -->
            <div class="mb-6">
                <h3 class="text-xl font-black mb-2 cf-heading">Skills</h3>
                @if ($profile->skills && count($profile->skills) > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach ($profile->skills as $skill)
                            <span class="px-3 py-1 rounded-full text-sm font-semibold"
                                style="background:rgba(13,148,136,.18);color:#5eead4;border:1px solid rgba(45,212,191,.35);">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm" style="color:rgba(255,255,255,.45);">No skills added yet.</p>
                @endif
            </div>

            <!-- Member Since -->
            <div class="text-sm" style="color:rgba(255,255,255,.35);">
                Member since {{ $user->created_at->format('M d, Y') }}
            </div>
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

    /* ── Typography ─────────────────────────────────────────── */
    .cf-heading {
        color: #ffffff;
    }

    /* ══ LIGHT MODE ════════════════════════════════════════════ */
    html.light .cf-card {
        background: rgba(255, 255, 255, .9);
        border-color: rgba(13, 148, 136, .12);
        box-shadow: 0 8px 40px rgba(13, 148, 136, .08);
    }

    html.light .cf-heading {
        color: #0c2926;
    }

    html.light [style*="color:rgba(255,255,255"] {
        color: #64748b !important;
    }
</style>
