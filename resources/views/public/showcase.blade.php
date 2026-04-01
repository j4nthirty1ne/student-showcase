@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h1
                    class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl border-b-2 border-black inline-block pb-2">
                    Student <i class="font-serif italic font-normal text-stone-600">Showcase</i>
                </h1>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Discover the amazing projects created by our talented students.
                </p>
            </div>
            <!-- Search and Filter Form -->
            <div class="mb-12">
                <form action="{{ route('home') }}" method="GET"
                    class="flex flex-col md:flex-row gap-4 items-end justify-between bg-white p-6 md:p-4 rounded-xl border border-neutral-200 shadow-sm">
                    <div class="w-full md:w-1/3">
                        <label for="search"
                            class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Search</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Title or Student Name"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black transition-colors bg-gray-50 hover:bg-white text-sm">
                    </div>

                    <div class="w-full md:w-1/4">
                        <label for="category"
                            class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Category</label>
                        <select name="category" id="category"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black transition-colors bg-gray-50 hover:bg-white text-sm">
                            <option value="">All Categories</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->slug }}"
                                    {{ request('category') === $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                            <option value="uncategorized" {{ request('category') === 'uncategorized' ? 'selected' : '' }}>
                                Uncategorized</option>
                        </select>
                    </div>

                    <div class="w-full md:w-1/4">
                        <label for="technology"
                            class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Technology</label>
                        <select name="technology" id="technology"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black transition-colors bg-gray-50 hover:bg-white text-sm">
                            <option value="">All Technologies</option>
                            @foreach ($allTechnologies as $tech)
                                <option value="{{ $tech->id }}"
                                    {{ request('technology') == $tech->id ? 'selected' : '' }}>
                                    {{ $tech->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:w-auto flex gap-2">
                        <button type="submit"
                            class="w-full md:w-auto px-6 py-3 bg-black text-white font-bold uppercase tracking-wider text-xs rounded-md hover:bg-neutral-800 transition-colors">
                            Filter
                        </button>
                        @if (request()->hasAny(['search', 'category', 'technology']))
                            <a href="{{ route('home') }}"
                                class="w-full md:w-auto px-4 py-3 bg-gray-100 text-gray-600 font-bold uppercase tracking-wider text-xs rounded-md hover:bg-gray-200 transition-colors text-center border border-gray-200">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            @if ($projects->isEmpty())
                <div class="text-center py-20 bg-white shadow-sm rounded-lg border border-gray-200">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">No projects found.</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back soon for new student work!</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($projects as $project)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 border border-neutral-100 flex flex-col group block">

                            <a href="{{ route('project.show', $project) }}"
                                class="relative h-48 w-full bg-neutral-200 overflow-hidden block">
                                @if ($project->cover_image)
                                    <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div
                                        class="flex items-center justify-center w-full h-full text-neutral-400 font-serif italic">
                                        No Image
                                    </div>
                                @endif
                                <div
                                    class="absolute top-3 right-3 bg-white/90 backdrop-blur text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider text-black">
                                    {{ $project->category ? $project->category->name : 'Uncategorized' }}
                                </div>
                            </a>

                            <div class="p-6 flex-grow flex flex-col">
                                <a href="{{ route('project.show', $project) }}">
                                    <h3
                                        class="text-xl font-bold text-gray-900 mb-2 font-serif group-hover:text-amber-700 transition-colors">
                                        {{ $project->title }}</h3>
                                </a>

                                <p class="text-gray-600 line-clamp-3 mb-4 text-sm leading-relaxed flex-grow">
                                    {{ $project->short_description ?? Str::limit($project->description, 100) }}
                                </p>

                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                                    <div class="text-sm text-gray-500 flex items-center gap-2">
                                        <span
                                            class="w-6 h-6 rounded-full bg-neutral-200 flex items-center justify-center text-xs text-neutral-600 font-bold">
                                            {{ strtoupper(substr($project->user?->name ?? 'S', 0, 1)) }}
                                        </span>
                                        {{ $project->user?->name ?? 'Unknown Student' }}
                                    </div>
                                    <div class="flex items-center gap-3">
                                        @if ($project->url)
                                            <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
                                                title="Live Demo"
                                                class="text-gray-400 hover:text-black transition-colors rounded-full bg-gray-50 flex items-center justify-center w-8 h-8">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        @endif
                                        <a href="{{ route('project.show', $project) }}"
                                            class="text-xs font-bold uppercase tracking-wider text-black hover:text-amber-700 transition">
                                            Details &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    {{ $projects->links('pagination::tailwind') }}
                </div>
            @endif

        </div>
    </div>
@endsection
