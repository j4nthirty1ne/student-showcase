@extends('layouts.student')

@section('title', 'My Projects')

@section('student-content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">My Projects</h1>
        <a 
            href="{{ route('student.projects.create') }}"
            class="px-6 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition"
        >
            + New Project
        </a>
    </div>

    @if ($projects->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 mb-3 line-clamp-2">{{ $project->description }}</p>
                    
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                            @if($project->status === 'completed') bg-green-100 text-green-800
                            @elseif($project->status === 'in_progress') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif
                        ">
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </span>
                    </div>

                    @if ($project->technologies && count($project->technologies) > 0)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 font-semibold mb-1">Technologies:</p>
                            <div class="flex flex-wrap gap-1">
                                @foreach ($project->technologies as $tech)
                                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex gap-2 pt-4 border-t border-gray-200">
                        <a 
                            href="{{ route('student.projects.show', $project) }}"
                            class="flex-1 text-center px-3 py-2 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition text-sm font-semibold"
                        >
                            View
                        </a>
                        <a 
                            href="{{ route('student.projects.edit', $project) }}"
                            class="flex-1 text-center px-3 py-2 bg-gray-50 text-gray-600 rounded hover:bg-gray-100 transition text-sm font-semibold"
                        >
                            Edit
                        </a>
                        <form action="{{ route('student.projects.destroy', $project) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                onclick="return confirm('Are you sure?')"
                                class="w-full px-3 py-2 bg-red-50 text-red-600 rounded hover:bg-red-100 transition text-sm font-semibold"
                            >
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($projects->hasPages())
            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        @endif
    @else
        <div class="bg-gray-50 rounded-lg p-12 text-center">
            <p class="text-gray-600 text-lg mb-4">You haven't created any projects yet.</p>
            <a 
                href="{{ route('student.projects.create') }}"
                class="inline-block px-6 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition"
            >
                Create Your First Project
            </a>
        </div>
    @endif
</div>
@endsection
