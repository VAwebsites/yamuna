<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VillaImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class VillaImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the villaImage can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list villaimages');
    }

    /**
     * Determine whether the villaImage can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VillaImage  $model
     * @return mixed
     */
    public function view(User $user, VillaImage $model)
    {
        return $user->hasPermissionTo('view villaimages');
    }

    /**
     * Determine whether the villaImage can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create villaimages');
    }

    /**
     * Determine whether the villaImage can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VillaImage  $model
     * @return mixed
     */
    public function update(User $user, VillaImage $model)
    {
        return $user->hasPermissionTo('update villaimages');
    }

    /**
     * Determine whether the villaImage can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VillaImage  $model
     * @return mixed
     */
    public function delete(User $user, VillaImage $model)
    {
        return $user->hasPermissionTo('delete villaimages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VillaImage  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete villaimages');
    }

    /**
     * Determine whether the villaImage can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VillaImage  $model
     * @return mixed
     */
    public function restore(User $user, VillaImage $model)
    {
        return false;
    }

    /**
     * Determine whether the villaImage can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VillaImage  $model
     * @return mixed
     */
    public function forceDelete(User $user, VillaImage $model)
    {
        return false;
    }
}
