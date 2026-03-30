<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard with basic counts
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalStudents = User::students()->count();
        $totalAdmins = User::admins()->count();
        $activeUsers = User::active()->count();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalStudents' => $totalStudents,
            'totalAdmins' => $totalAdmins,
            'activeUsers' => $activeUsers,
        ]);
    }
}
