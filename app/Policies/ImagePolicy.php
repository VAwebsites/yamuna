<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Image;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the image can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list images');
    }

    /**
     * Determine whether the image can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Image  $model
     * @return mixed
     */
    public function view(User $user, Image $model)
    {
        return $user->hasPermissionTo('view images');
    }

    /**
     * Determine whether the image can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create images');
    }

    /**
     * Determine whether the image can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Image  $model
     * @return mixed
     */
    public function update(User $user, Image $model)
    {
        return $user->hasPermissionTo('update images');
    }

    /**
     * Determine whether the image can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Image  $model
     * @return mixed
     */
    public function delete(User $user, Image $model)
    {
        return $user->hasPermissionTo('delete images');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Image  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete images');
    }

    /**
     * Determine whether the image can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Image  $model
     * @return mixed
     */
    public function restore(User $user, Image $model)
    {
        return false;
    }

    /**
     * Determine whether the image can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Image  $model
     * @return mixed
     */
    public function forceDelete(User $user, Image $model)
    {
        return false;
    }
}
