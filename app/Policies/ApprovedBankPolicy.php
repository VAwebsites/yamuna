<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ApprovedBank;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApprovedBankPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the approvedBank can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list approvedbanks');
    }

    /**
     * Determine whether the approvedBank can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApprovedBank  $model
     * @return mixed
     */
    public function view(User $user, ApprovedBank $model)
    {
        return $user->hasPermissionTo('view approvedbanks');
    }

    /**
     * Determine whether the approvedBank can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create approvedbanks');
    }

    /**
     * Determine whether the approvedBank can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApprovedBank  $model
     * @return mixed
     */
    public function update(User $user, ApprovedBank $model)
    {
        return $user->hasPermissionTo('update approvedbanks');
    }

    /**
     * Determine whether the approvedBank can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApprovedBank  $model
     * @return mixed
     */
    public function delete(User $user, ApprovedBank $model)
    {
        return $user->hasPermissionTo('delete approvedbanks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApprovedBank  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete approvedbanks');
    }

    /**
     * Determine whether the approvedBank can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApprovedBank  $model
     * @return mixed
     */
    public function restore(User $user, ApprovedBank $model)
    {
        return false;
    }

    /**
     * Determine whether the approvedBank can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ApprovedBank  $model
     * @return mixed
     */
    public function forceDelete(User $user, ApprovedBank $model)
    {
        return false;
    }
}
