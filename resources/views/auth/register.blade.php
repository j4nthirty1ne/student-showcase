@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="cf-wrap min-h-screen py-12 px-6">
        <div class="cf-card rounded-2xl p-8 max-w-md mx-auto">
            <h1 class="text-2xl font-black mb-6 text-center cf-heading">Create Account</h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="cf-label">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('name') cf-input-err @enderror"
                        required>
                    @error('name')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="cf-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('email') cf-input-err @enderror"
                        required>
                    @error('email')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="cf-label">Password</label>
                    <input type="password" id="password" name="password"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('password') cf-input-err @enderror"
                        required>
                    @error('password')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                    <p class="text-sm cf-muted mt-1">Minimum 8 characters</p>
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="cf-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="cf-input w-full rounded-xl px-4 py-3 text-sm font-medium mt-1.5 transition-all @error('password_confirmation') cf-input-err @enderror"
                        required>
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl text-sm font-black text-white transition-all hover:scale-[1.02] hover:shadow-xl"
                    style="background:linear-gradient(135deg,#0d9488,#0f766e);box-shadow:0 8px 24px rgba(13,148,136,.35);">
                    Create Account
                </button>
            </form>

            <p class="text-center mt-6 text-sm cf-muted">
                Already have an account?
                <a href="{{ route('login') }}" class="font-bold" style="color:#2dd4bf;">Login</a>
            </p>
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

    .cf-input-err {
        border-color: rgba(239, 68, 68, .5) !important;
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
</style>
