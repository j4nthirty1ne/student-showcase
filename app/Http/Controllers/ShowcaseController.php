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
        $baseQuery = Project::with('category', 'user')
            ->whereIn('status', ['published', 'completed']);

        // ── Featured projects for hero slider (latest 5, no filters) ──
        $featuredProjects = (clone $baseQuery)
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->limit(5)
            ->get();

        // ── Stats ──
        $totalProjects  = Project::whereIn('status', ['published', 'completed'])->count();
        $totalStudents  = \App\Models\User::where('role', '!=', 'admin')->count();
        $totalCategories = Category::count();

        // ── Latest projects for "Recent Work" strip (latest 4) ──
        $recentProjects = (clone $baseQuery)
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->limit(4)
            ->get();

        $query = clone $baseQuery;

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
                $query->whereJsonContains('technologies', $technology->name);
            }
        }

        $projects = $query->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();
        $allTechnologies = \App\Models\Technology::orderBy('name')->get();

        return view('public.showcase', compact(
            'projects', 'categories', 'allTechnologies',
            'featuredProjects', 'recentProjects',
            'totalProjects', 'totalStudents', 'totalCategories'
        ));
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
