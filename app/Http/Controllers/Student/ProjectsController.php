<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display list of projects
     */
    public function index()
    {
        $user = Auth::user();
        $projects = $user->projects()->latest()->paginate(10);

        return view('student.projects.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show create project form
     */
    public function create()
    {
        return view('student.projects.create');
    }

    /**
     * Store project
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'nullable|url',
            'technologies' => 'nullable|string',
            'status' => 'required|in:draft,in-progress,completed',
        ]);

        $technologies = $request->technologies 
            ? array_map('trim', explode(',', $request->technologies))
            : [];

        Auth::user()->projects()->create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'technologies' => $technologies,
            'status' => $request->status,
        ]);

        return redirect()->route('student.projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Show project
     */
    public function show(Project $project)
    {
        // Ensure user owns this project
        $this->authorize('view', $project);

        return view('student.projects.show', [
            'project' => $project,
        ]);
    }

    /**
     * Show edit form
     */
    public function edit(Project $project)
    {
        // Ensure user owns this project
        $this->authorize('update', $project);

        return view('student.projects.edit', [
            'project' => $project,
        ]);
    }

    /**
     * Update project
     */
    public function update(Request $request, Project $project)
    {
        // Ensure user owns this project
        $this->authorize('update', $project);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'nullable|url',
            'technologies' => 'nullable|string',
            'status' => 'required|in:draft,in-progress,completed',
        ]);

        $technologies = $request->technologies 
            ? array_map('trim', explode(',', $request->technologies))
            : [];

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'technologies' => $technologies,
            'status' => $request->status,
        ]);

        return redirect()->route('student.projects.show', $project)
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Delete project
     */
    public function destroy(Project $project)
    {
        // Ensure user owns this project
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('student.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
