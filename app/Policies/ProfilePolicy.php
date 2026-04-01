<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;
use App\Models\Profile;

class ProfilePolicy
{
    /**
     * Determine whether the user can view any profiles.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the profile.
     */
    public function view(User $user, Profile $profile): bool
    {
        // User can view their own profile
        if ($user->id === $profile->user_id) {
            return true;
        }

        // Admins can view all profiles
        if ($user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create profiles.
     */
    public function create(User $user): bool
    {
        return $user->isStudent() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the profile.
     */
    public function update(User $user, Profile $profile): bool
    {
        // User can only edit their own profile
        if ($user->id === $profile->user_id) {
            return true;
        }

        // Admins can edit all profiles
        if ($user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the profile.
     */
    public function delete(User $user, Profile $profile): bool
    {
        // User can only delete their own profile
        if ($user->id === $profile->user_id) {
            return true;
        }

        // Admins can delete any profile
        if ($user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the profile.
     */
    public function restore(User $user, Profile $profile): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the profile.
     */
    public function forceDelete(User $user, Profile $profile): bool
    {
        return $user->isAdmin();
    }
}
