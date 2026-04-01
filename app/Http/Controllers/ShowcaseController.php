<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ShowcaseController extends Controller
{
    /**
     * Display the public showcase of approved/published projects.
     */
    public function index(Request $request)
    {
        $query = Project::with('category', 'user')
            ->whereIn('status', ['published', 'completed']);

        if ($request->has('category')) {
            $query->where(function ($q) use ($request) {
                $category = $request->query('category');

                if ($category === 'uncategorized') {
                    $q->whereNull('category_id');
                } else {
                    $q->whereHas('category', function ($q2) use ($category) {
                        $q2->where('slug', $category)
                            ->orWhere('id', $category);
                    });
                }
            });
        }

        $projects = $query->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate(12)
            ->withQueryString();

        return view('public.showcase', compact('projects'));
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project)
    {
        // Optional: Ensure the project is public (published/completed)
        if (!in_array($project->status, ['published', 'completed'])) {
            abort(404);
        }

        $project->load(['category', 'user', 'projectImages']);

        return view('public.project-detail', compact('project'));
    }
}
