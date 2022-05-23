<?php

namespace App\Policies;

use App\Models\User;
use App\Models\NearByLocation;
use Illuminate\Auth\Access\HandlesAuthorization;

class NearByLocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the nearByLocation can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list nearbylocations');
    }

    /**
     * Determine whether the nearByLocation can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\NearByLocation  $model
     * @return mixed
     */
    public function view(User $user, NearByLocation $model)
    {
        return $user->hasPermissionTo('view nearbylocations');
    }

    /**
     * Determine whether the nearByLocation can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create nearbylocations');
    }

    /**
     * Determine whether the nearByLocation can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\NearByLocation  $model
     * @return mixed
     */
    public function update(User $user, NearByLocation $model)
    {
        return $user->hasPermissionTo('update nearbylocations');
    }

    /**
     * Determine whether the nearByLocation can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\NearByLocation  $model
     * @return mixed
     */
    public function delete(User $user, NearByLocation $model)
    {
        return $user->hasPermissionTo('delete nearbylocations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\NearByLocation  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete nearbylocations');
    }

    /**
     * Determine whether the nearByLocation can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\NearByLocation  $model
     * @return mixed
     */
    public function restore(User $user, NearByLocation $model)
    {
        return false;
    }

    /**
     * Determine whether the nearByLocation can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\NearByLocation  $model
     * @return mixed
     */
    public function forceDelete(User $user, NearByLocation $model)
    {
        return false;
    }
}
