@extends('layouts.student')

@section('title', 'My Profile')

@section('student-content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-8">
        <div class="flex justify-between items-start mb-6">
            <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
            <a href="{{ route('student.profile.edit') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Edit Profile</a>
        </div>

        <!-- Profile Header -->
        <div class="mb-8 pb-8 border-b">
            <div class="flex items-center gap-6">
                @if($profile->profile_image)
                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover">
                @else
                    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="text-gray-600"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="text-gray-600"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                    <p class="text-gray-600"><strong>Status:</strong> <span class="text-green-600 font-semibold">{{ ucfirst($user->status) }}</span></p>
                </div>
            </div>
        </div>

        <!-- Bio -->
        <div class="mb-6">
            <h3 class="text-xl font-bold mb-2">Bio</h3>
            <p class="text-gray-600">{{ $profile->bio ?? 'No bio added yet.' }}</p>
        </div>

        <!-- Skills -->
        <div class="mb-6">
            <h3 class="text-xl font-bold mb-2">Skills</h3>
            @if($profile->skills && count($profile->skills) > 0)
                <div class="flex flex-wrap gap-2">
                    @foreach($profile->skills as $skill)
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $skill }}</span>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No skills added yet.</p>
            @endif
        </div>

        <!-- Member Since -->
        <div class="text-gray-500 text-sm">
            Member since {{ $user->created_at->format('M d, Y') }}
        </div>
    </div>
</div>
@endsection
