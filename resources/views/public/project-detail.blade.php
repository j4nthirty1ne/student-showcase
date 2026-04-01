@extends('layouts.app')

@section('content')
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('home') }}"
                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 mb-8 transition-colors">
                <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back to Showcase
            </a>

            <div class="mb-10 text-center">
                <span
                    class="inline-block bg-neutral-100 text-neutral-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4">
                    {{ $project->category ? $project->category->name : 'Uncategorized' }}
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight font-serif mb-4">
                    {{ $project->title }}
                </h1>
                <div class="flex items-center justify-center text-gray-500 gap-2 mb-6 text-sm">
                    <span>By <strong class="text-gray-900">{{ $project->user?->name ?? 'Student' }}</strong></span>
                    <span>&bull;</span>
                    @if ($project->status === 'published')
                        <span>Published
                            {{ $project->published_at ? \Carbon\Carbon::parse($project->published_at)->format('M d, Y') : $project->updated_at->format('M d, Y') }}</span>
                    @else
                        <span>{{ ucfirst($project->status) }}</span>
                    @endif
                </div>
            </div>

            @if ($project->cover_image)
                <div class="rounded-2xl overflow-hidden shadow-lg mb-12 border border-neutral-100">
                    <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}"
                        class="w-full object-cover">
                </div>
            @endif

            <div class="prose prose-lg max-w-none text-gray-600 mb-12">
                @if ($project->description)
                    {!! nl2br(e($project->description)) !!}
                @else
                    <p class="italic">No description provided.</p>
                @endif
            </div>

            @if ($project->technologies && count($project->technologies) > 0)
                <div class="mb-12">
                    <h3 class="text-xl font-bold text-gray-900 border-b pb-2 mb-4 font-serif">Technologies Used</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($project->technologies as $tech)
                            <span
                                class="bg-gray-100 text-gray-800 px-3 py-1 rounded-md text-sm font-medium border border-gray-200">
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($project->url || $project->github_link)
                <div
                    class="bg-neutral-50 p-6 rounded-xl border border-neutral-200 flex flex-col sm:flex-row gap-4 justify-between items-center mb-12">
                    <div>
                        <h4 class="font-bold text-gray-900 font-serif">Check out the project</h4>
                        <p class="text-sm text-gray-500">View the live project or check out the source code.</p>
                    </div>
                    <div class="flex gap-3 w-full sm:w-auto">
                        @if ($project->url)
                            <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
                                class="flex-1 sm:flex-none text-center bg-black hover:bg-gray-800 text-white font-medium py-2 px-6 rounded-lg transition-colors inline-block">
                                View Live Demo
                            </a>
                        @endif
                        @if ($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer"
                                class="flex-1 sm:flex-none text-center bg-white hover:bg-gray-50 border border-neutral-300 text-gray-900 font-medium py-2 px-6 rounded-lg transition-colors inline-block flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd" />
                                </svg>
                                GitHub
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            @if ($project->projectImages && $project->projectImages->count() > 0)
                <div>
                    <h3 class="text-xl font-bold text-gray-900 border-b pb-2 mb-6 font-serif">Project Gallery</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($project->projectImages as $p_image)
                            <div class="rounded-xl overflow-hidden border border-neutral-100 shadow-sm">
                                <img src="{{ Storage::url($p_image->image_path) }}" alt="Project screenshot"
                                    class="w-full h-auto object-cover hover:scale-105 transition duration-300">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
