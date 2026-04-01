@extends('layouts.student')

@section('title', 'Edit Project')

@section('student-content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold mb-8 text-gray-800">Edit Project</h1>

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
                class="bg-white rounded-lg shadow p-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Project Title *</label>
                    <input type="text" id="title" name="title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                        value="{{ old('title', $project->title) }}" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-semibold mb-2">Description *</label>
                    <textarea id="description" name="description" rows="5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                        required>{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL -->
                <div class="mb-6">
                    <label for="url" class="block text-gray-700 font-semibold mb-2">Project URL (optional)</label>
                    <input type="url" id="url" name="url"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('url', $project->url) }}">
                    @error('url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- GitHub Link -->
                <div class="mb-6">
                    <label for="github_link" class="block text-gray-700 font-semibold mb-2">GitHub Repository URL
                        (optional)</label>
                    <input type="url" id="github_link" name="github_link"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('github_link') border-red-500 @enderror"
                        value="{{ old('github_link', $project->github_link) }}"
                        placeholder="https://github.com/your-username/repo">
                    @error('github_link')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cover Image -->
                <div class="mb-6">
                    <label for="cover_image" class="block text-gray-700 font-semibold mb-2">Cover Image (optional)</label>
                    @if ($project->cover_image)
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                            <img src="{{ Storage::url($project->cover_image) }}" alt="Current cover image"
                                class="h-32 w-auto object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <input type="file" id="cover_image" name="cover_image" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('cover_image') border-red-500 @enderror">
                    @error('cover_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Upload a new image to replace the current one (Max 2MB).</p>
                </div>

                <!-- Gallery Images -->
                <div class="mb-6">
                    <label for="gallery_images" class="block text-gray-700 font-semibold mb-2">Add to Project
                        Gallery</label>
                    <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('gallery_images.*') border-red-500 @enderror">
                    @error('gallery_images.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Select multiple images to add to the gallery.</p>

                    @if ($project->projectImages->count() > 0)
                        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ($project->projectImages as $image)
                                <div class="relative">
                                    <img src="{{ Storage::url($image->image_path) }}" alt="Gallery image"
                                        class="h-24 w-full object-cover rounded-lg border border-gray-200">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Technologies -->
                <div class="mb-6">
                    <label for="technologies" class="block text-gray-700 font-semibold mb-2">Technologies Used *</label>
                    <input type="text" id="technologies" name="technologies"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('technologies') border-red-500 @enderror"
                        value="{{ old('technologies', implode(', ', $project->technologies ?? [])) }}" required>
                    @error('technologies')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Separate technologies with commas</p>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label for="status" class="block text-gray-700 font-semibold mb-2">Status *</label>
                    <select id="status" name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
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
                <div class="flex gap-4">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition">
                        Update Project
                    </button>
                    <a href="{{ route('student.projects.show', $project) }}"
                        class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
