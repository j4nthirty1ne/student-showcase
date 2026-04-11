<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Display list of projects
     */
    public function index()
    {
        /** @var \App\Models\User $user */
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
        $categories = Category::all();
        return view('student.projects.create', compact('categories'));
    }

    /**
     * Store project
     */
    public function store(StoreProjectRequest $request)
    {
        $technologies = $request->technologies
            ? array_map('trim', explode(',', $request->technologies))
            : [];

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('projects', 'public');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $project = $user->projects()->create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'github_link' => $request->github_link,
            'cover_image' => $coverImagePath,
            'technologies' => $technologies,
            'status' => $request->status,
        ]);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $project->projectImages()->create([
                    'image_path' => $image->store('projects/gallery', 'public'),
                    'sort_order' => $index,
                ]);
            }
        }

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

        $categories = Category::all();
        return view('student.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update project
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // Ensure user owns this project
        $this->authorize('update', $project);

        $technologies = $request->technologies
            ? array_map('trim', explode(',', $request->technologies))
            : [];

        $dataToUpdate = [
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'github_link' => $request->github_link,
            'technologies' => $technologies,
            'status' => $request->status,
        ];

        if ($request->hasFile('cover_image')) {
            // Delete old image if it exists
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $dataToUpdate['cover_image'] = $request->file('cover_image')->store('projects', 'public');
        }

        $project->update($dataToUpdate);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $project->projectImages()->create([
                    'image_path' => $image->store('projects/gallery', 'public'),
                    'sort_order' => $project->projectImages()->count() + $index,
                ]);
            }
        }

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
