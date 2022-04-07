<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Villa;
use Illuminate\Auth\Access\HandlesAuthorization;

class VillaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the villa can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list villas');
    }

    /**
     * Determine whether the villa can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Villa  $model
     * @return mixed
     */
    public function view(User $user, Villa $model)
    {
        return $user->hasPermissionTo('view villas');
    }

    /**
     * Determine whether the villa can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create villas');
    }

    /**
     * Determine whether the villa can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Villa  $model
     * @return mixed
     */
    public function update(User $user, Villa $model)
    {
        return $user->hasPermissionTo('update villas');
    }

    /**
     * Determine whether the villa can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Villa  $model
     * @return mixed
     */
    public function delete(User $user, Villa $model)
    {
        return $user->hasPermissionTo('delete villas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Villa  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete villas');
    }

    /**
     * Determine whether the villa can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Villa  $model
     * @return mixed
     */
    public function restore(User $user, Villa $model)
    {
        return false;
    }

    /**
     * Determine whether the villa can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Villa  $model
     * @return mixed
     */
    public function forceDelete(User $user, Villa $model)
    {
        return false;
    }
}
