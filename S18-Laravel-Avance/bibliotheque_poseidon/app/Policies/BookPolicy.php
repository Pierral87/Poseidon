<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{

// Methode before, s'execute avant toutes les autres méthodes, pour permettre de donner tous les droits à notre admin
    public function before(User $user, string $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Book $book): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('staff');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Book $book): bool
    {
        // return $user->role->name === "admin";
        return $user->hasRole('staff');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Book $book): bool
    {
        // return $user->role->name === "admin";
        return $user->hasAnyRole('staff') && $book->created_by === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Book $book): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return false;
    }
}
