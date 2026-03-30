<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show user profile
     */
    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $profile = $user->profile ?? $user->profile()->create([]);

        return view('student.profile.show', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    /**
     * Show edit profile form
     */
    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $profile = $user->profile ?? $user->profile()->create([]);

        return view('student.profile.edit', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    /**
     * Update user profile
     */
    public function update(UpdateProfileRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $profile = $user->profile ?? $user->profile()->create([]);

        // Update user data
        $user->update([
            'name' => $request->name,
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($profile->profile_image && Storage::exists('public/' . $profile->profile_image)) {
                Storage::delete('public/' . $profile->profile_image);
            }

            $path = $request->file('profile_image')
                ->store('profiles', 'public');
            $profile->profile_image = $path;
        }

        // Update profile data
        $profile->update([
            'bio' => $request->bio,
            'skills' => $request->skills ? explode(',', $request->skills) : [],
            'profile_image' => $profile->profile_image ?? null,
        ]);

        return redirect()->route('student.profile.show')
            ->with('success', 'Profile updated successfully!');
    }
}
