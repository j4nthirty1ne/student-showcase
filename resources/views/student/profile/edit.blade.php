@extends('layouts.student')

@section('title', 'Edit Profile')

@section('student-content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-3xl font-bold mb-8">Edit Your Profile</h1>

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

    <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-8">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-6">
            <label for="name" class="block text-gray-700 font-bold mb-2">Full Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', $user->name) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Profile Image -->
        <div class="mb-6">
            <label for="profile_image" class="block text-gray-700 font-bold mb-2">Profile Image</label>
            <div class="flex items-center gap-4">
                @if($profile->profile_image)
                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover">
                @endif
                <input 
                    type="file" 
                    id="profile_image" 
                    name="profile_image"
                    accept="image/jpeg,image/png,image/jpg"
                    class="px-4 py-2 border border-gray-300 rounded-lg"
                >
            </div>
            <p class="text-sm text-gray-500 mt-2">Max 2MB, formats: JPEG, PNG</p>
            @error('profile_image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Bio -->
        <div class="mb-6">
            <label for="bio" class="block text-gray-700 font-bold mb-2">Bio</label>
            <textarea 
                id="bio" 
                name="bio" 
                rows="5"
                maxlength="500"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Write a brief bio about yourself..."
            >{{ old('bio', $profile->bio) }}</textarea>
            <p class="text-sm text-gray-500 mt-2">{{ strlen(old('bio', $profile->bio ?? '')) }}/500 characters</p>
            @error('bio')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Skills -->
        <div class="mb-6">
            <label for="skills" class="block text-gray-700 font-bold mb-2">Skills</label>
            <input 
                type="text" 
                id="skills" 
                name="skills" 
                value="{{ old('skills', implode(', ', $profile->skills ?? [])) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="e.g., PHP, Laravel, JavaScript, React (comma-separated)"
            >
            @error('skills')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('student.profile.show') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
            <button 
                type="submit"
                class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg"
            >
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
