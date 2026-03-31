@extends('layouts.student')

@section('title', 'Project Details')

@section('student-content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header with Back Button -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('student.projects.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold">← Back
                    to Projects</a>
                @can('update', $project)
                    <div class="flex gap-2">
                        <a href="{{ route('student.projects.edit', $project) }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition">
                            Edit
                        </a>
                        <form action="{{ route('student.projects.destroy', $project) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this project?')"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                @endcan
            </div>

            <!-- Project Card -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Title and Status -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-3">
                        <h1 class="text-4xl font-bold text-gray-800">{{ $project->title }}</h1>
                        <span
                            class="inline-block px-4 py-2 text-sm font-semibold rounded-full 
                        @if ($project->status === 'completed') bg-green-100 text-green-800
                        @elseif($project->status === 'in_progress') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800 @endif
                    ">
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </span>
                    </div>
                    <p class="text-gray-600 text-sm">by {{ $project->user->name }}</p>
                </div>

                <!-- Description -->
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-3">Description</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $project->description }}</p>
                </div>

                <!-- Cover Image -->
                @if ($project->cover_image)
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-3">Cover Image</h2>
                        <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }} cover image"
                            class="w-full max-w-2xl rounded-lg shadow-md border border-gray-200">
                    </div>
                @endif

                <!-- Image Gallery -->
                @if ($project->projectImages->count() > 0)
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-3">Gallery</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($project->projectImages as $image)
                                <a href="{{ Storage::url($image->image_path) }}" target="_blank">
                                    <img src="{{ Storage::url($image->image_path) }}" alt="Gallery Image"
                                        class="w-full h-48 object-cover rounded-lg shadow-sm border border-gray-200 hover:opacity-75 transition">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Technologies -->
                @if ($project->technologies && count($project->technologies) > 0)
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-3">Technologies</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($project->technologies as $tech)
                                <span
                                    class="px-4 py-2 bg-blue-100 text-blue-800 rounded-lg font-semibold">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Project URL -->
                @if ($project->url)
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-3">Project Demo URL</h2>
                        <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
                            class="text-blue-500 hover:text-blue-700 font-semibold break-all">
                            {{ $project->url }}
                        </a>
                    </div>
                @endif

                <!-- GitHub URL -->
                @if ($project->github_link)
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-3">GitHub Repository</h2>
                        <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer"
                            class="text-blue-500 hover:text-blue-700 font-semibold break-all">
                            {{ $project->github_link }}
                        </a>
                    </div>
                @endif

                <!-- Meta Information -->
                <div class="text-gray-600 text-sm">
                    <p class="mb-2"><strong>Created:</strong> {{ $project->created_at->format('F d, Y') }}</p>
                    <p><strong>Last Updated:</strong> {{ $project->updated_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
