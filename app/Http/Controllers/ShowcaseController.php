<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
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

        // Search by keyword (Project title or Student name)
        if ($request->filled('search')) {
            $keyword = $request->query('search');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhereHas('user', function ($q2) use ($keyword) {
                        $q2->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $category = $request->query('category');
            if ($category === 'uncategorized') {
                $query->whereNull('category_id');
            } else {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category)
                        ->orWhere('id', $category);
                });
            }
        }

        // Filter by technology
        if ($request->filled('technology')) {
            $technologyId = $request->query('technology');
            $technology = \App\Models\Technology::find($technologyId);
            if ($technology) {
                // Search the JSON column for the name of the admin-defined technology
                $query->whereJsonContains('technologies', $technology->name);
            }
        }

        $projects = $query->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        // Get technologies managed by admin (from the database table)
        $allTechnologies = \App\Models\Technology::orderBy('name')->get();

        return view('public.showcase', compact('projects', 'categories', 'allTechnologies'));
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
