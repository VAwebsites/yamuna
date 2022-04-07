<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list approvedbanks']);
        Permission::create(['name' => 'view approvedbanks']);
        Permission::create(['name' => 'create approvedbanks']);
        Permission::create(['name' => 'update approvedbanks']);
        Permission::create(['name' => 'delete approvedbanks']);

        Permission::create(['name' => 'list brochurerequests']);
        Permission::create(['name' => 'view brochurerequests']);
        Permission::create(['name' => 'create brochurerequests']);
        Permission::create(['name' => 'update brochurerequests']);
        Permission::create(['name' => 'delete brochurerequests']);

        Permission::create(['name' => 'list homepagebanners']);
        Permission::create(['name' => 'view homepagebanners']);
        Permission::create(['name' => 'create homepagebanners']);
        Permission::create(['name' => 'update homepagebanners']);
        Permission::create(['name' => 'delete homepagebanners']);

        Permission::create(['name' => 'list homepagesettings']);
        Permission::create(['name' => 'view homepagesettings']);
        Permission::create(['name' => 'create homepagesettings']);
        Permission::create(['name' => 'update homepagesettings']);
        Permission::create(['name' => 'delete homepagesettings']);

        Permission::create(['name' => 'list images']);
        Permission::create(['name' => 'view images']);
        Permission::create(['name' => 'create images']);
        Permission::create(['name' => 'update images']);
        Permission::create(['name' => 'delete images']);

        Permission::create(['name' => 'list villas']);
        Permission::create(['name' => 'view villas']);
        Permission::create(['name' => 'create villas']);
        Permission::create(['name' => 'update villas']);
        Permission::create(['name' => 'delete villas']);

        Permission::create(['name' => 'list villaimages']);
        Permission::create(['name' => 'view villaimages']);
        Permission::create(['name' => 'create villaimages']);
        Permission::create(['name' => 'update villaimages']);
        Permission::create(['name' => 'delete villaimages']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
