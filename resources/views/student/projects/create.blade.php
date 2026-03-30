@extends('layouts.student')

@section('title', 'Create Project')

@section('student-content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Create New Project</h1>

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

        <form action="{{ route('student.projects.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
            @csrf

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Project Title *</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                    value="{{ old('title') }}"
                    placeholder="Enter project title"
                    required
                >
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description *</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                    placeholder="Enter project description"
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL -->
            <div class="mb-6">
                <label for="url" class="block text-gray-700 font-semibold mb-2">Project URL (optional)</label>
                <input 
                    type="url" 
                    id="url" 
                    name="url" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('url') }}"
                    placeholder="https://example.com"
                >
                @error('url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Technologies -->
            <div class="mb-6">
                <label for="technologies" class="block text-gray-700 font-semibold mb-2">Technologies Used *</label>
                <input 
                    type="text" 
                    id="technologies" 
                    name="technologies" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('technologies') border-red-500 @enderror"
                    value="{{ old('technologies') }}"
                    placeholder="e.g., Laravel, Vue.js, MySQL, Tailwind CSS (comma-separated)"
                    required
                >
                @error('technologies')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-1">Separate technologies with commas</p>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="block text-gray-700 font-semibold mb-2">Status *</label>
                <select 
                    id="status" 
                    name="status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition"
                >
                    Create Project
                </button>
                <a 
                    href="{{ route('student.projects.index') }}"
                    class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
