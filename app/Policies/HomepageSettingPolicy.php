<?php

namespace App\Policies;

use App\Models\User;
use App\Models\HomepageSetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomepageSettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the homepageSetting can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list homepagesettings');
    }

    /**
     * Determine whether the homepageSetting can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageSetting  $model
     * @return mixed
     */
    public function view(User $user, HomepageSetting $model)
    {
        return $user->hasPermissionTo('view homepagesettings');
    }

    /**
     * Determine whether the homepageSetting can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create homepagesettings');
    }

    /**
     * Determine whether the homepageSetting can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageSetting  $model
     * @return mixed
     */
    public function update(User $user, HomepageSetting $model)
    {
        return $user->hasPermissionTo('update homepagesettings');
    }

    /**
     * Determine whether the homepageSetting can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageSetting  $model
     * @return mixed
     */
    public function delete(User $user, HomepageSetting $model)
    {
        return $user->hasPermissionTo('delete homepagesettings');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageSetting  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete homepagesettings');
    }

    /**
     * Determine whether the homepageSetting can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageSetting  $model
     * @return mixed
     */
    public function restore(User $user, HomepageSetting $model)
    {
        return false;
    }

    /**
     * Determine whether the homepageSetting can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageSetting  $model
     * @return mixed
     */
    public function forceDelete(User $user, HomepageSetting $model)
    {
        return false;
    }
}
