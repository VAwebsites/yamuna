<?php

namespace App\Policies;

use App\Models\User;
use App\Models\HomepageBanner;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomepageBannerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the homepageBanner can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list homepagebanners');
    }

    /**
     * Determine whether the homepageBanner can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageBanner  $model
     * @return mixed
     */
    public function view(User $user, HomepageBanner $model)
    {
        return $user->hasPermissionTo('view homepagebanners');
    }

    /**
     * Determine whether the homepageBanner can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create homepagebanners');
    }

    /**
     * Determine whether the homepageBanner can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageBanner  $model
     * @return mixed
     */
    public function update(User $user, HomepageBanner $model)
    {
        return $user->hasPermissionTo('update homepagebanners');
    }

    /**
     * Determine whether the homepageBanner can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageBanner  $model
     * @return mixed
     */
    public function delete(User $user, HomepageBanner $model)
    {
        return $user->hasPermissionTo('delete homepagebanners');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageBanner  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete homepagebanners');
    }

    /**
     * Determine whether the homepageBanner can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageBanner  $model
     * @return mixed
     */
    public function restore(User $user, HomepageBanner $model)
    {
        return false;
    }

    /**
     * Determine whether the homepageBanner can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HomepageBanner  $model
     * @return mixed
     */
    public function forceDelete(User $user, HomepageBanner $model)
    {
        return false;
    }
}
