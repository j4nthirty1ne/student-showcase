<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display list of all users with pagination
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Filter by role
        if ($request->role) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            $isActive = $request->status === 'active';
            $query->where('is_active', $isActive);
        }

        $users = $query->paginate(10);

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show user details
     */
    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Update user status
     */
    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $user->update(['status' => $request->status]);

        return back()->with('success', 'User status updated successfully!');
    }

    /**
     * Change user role
     */
    public function changeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:student,admin',
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', 'User role updated successfully!');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        // Optionally: check if admin before allowing deletion
        if ($user->isAdmin() && User::admins()->count() <= 1) {
            return back()->with('error', 'Cannot delete the last admin user!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}
