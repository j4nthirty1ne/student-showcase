<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show student dashboard
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $projectCount = $user->projects() instanceof \Illuminate\Support\Collection 
            ? $user->projects()->count() 
            : 0;

        return view('student.dashboard', [
            'user' => $user,
            'projectCount' => $projectCount,
        ]);
    }
}
