<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BrochureRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrochureRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the brochureRequest can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list brochurerequests');
    }

    /**
     * Determine whether the brochureRequest can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BrochureRequest  $model
     * @return mixed
     */
    public function view(User $user, BrochureRequest $model)
    {
        return $user->hasPermissionTo('view brochurerequests');
    }

    /**
     * Determine whether the brochureRequest can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create brochurerequests');
    }

    /**
     * Determine whether the brochureRequest can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BrochureRequest  $model
     * @return mixed
     */
    public function update(User $user, BrochureRequest $model)
    {
        return $user->hasPermissionTo('update brochurerequests');
    }

    /**
     * Determine whether the brochureRequest can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BrochureRequest  $model
     * @return mixed
     */
    public function delete(User $user, BrochureRequest $model)
    {
        return $user->hasPermissionTo('delete brochurerequests');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BrochureRequest  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete brochurerequests');
    }

    /**
     * Determine whether the brochureRequest can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BrochureRequest  $model
     * @return mixed
     */
    public function restore(User $user, BrochureRequest $model)
    {
        return false;
    }

    /**
     * Determine whether the brochureRequest can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BrochureRequest  $model
     * @return mixed
     */
    public function forceDelete(User $user, BrochureRequest $model)
    {
        return false;
    }
}
