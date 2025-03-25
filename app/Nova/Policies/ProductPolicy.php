<?php

namespace App\Nova\Policies;

use App\Models\User;
use App\Nova\Product;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Nova::whenServing(function (NovaRequest $request) use ($user) {
            // user has access deny and allow based on user id. Only admin can view all the resources and others can't see product resource. 
            return in_array($user->id, [1]) || in_array('view-posts', $user->permissions ?? []);

        }, function (Request $request) use ($user) {
            return in_array('view-posts', $user->permissions);
        });
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return false;
    }
}
