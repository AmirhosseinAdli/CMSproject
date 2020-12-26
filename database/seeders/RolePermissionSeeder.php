<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'viewAny-post']);
        Permission::create(['name' => 'view-post']);
        Permission::create(['name' => 'create-post']);
        Permission::create(['name' => 'publish-post']);
        Permission::create(['name' => 'edit-post']);
        Permission::create(['name' => 'delete-post']);
        Permission::create(['name' => 'viewAny-tag']);
        Permission::create(['name' => 'view-tag']);
        Permission::create(['name' => 'create-tag']);
        Permission::create(['name' => 'edit-tag']);
        Permission::create(['name' => 'delete-tag']);
        Permission::create(['name' => 'viewAny-category']);
        Permission::create(['name' => 'view-category']);
        Permission::create(['name' => 'create-category']);
        Permission::create(['name' => 'edit-category']);
        Permission::create(['name' => 'delete-category']);
        Permission::create(['name' => 'viewAny-user']);
        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'activate-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'assign-role']);
        Permission::create(['name' => 'give-permission']);

        Role::create(['name' => 'super-admin'])->givePermissionTo([
            'viewAny-post',
            'view-post',
            'create-post',
            'publish-post',
            'edit-post',
            'delete-post',
            'viewAny-tag',
            'view-tag',
            'create-tag',
            'edit-tag',
            'delete-tag',
            'viewAny-category',
            'view-category',
            'create-category',
            'edit-category',
            'delete-category',
            'viewAny-user',
            'view-user',
            'create-user',
            'edit-user',
            'activate-user',
            'delete-user',
            'assign-role',
            'give-permission',
        ]);
        Role::create(['name' => 'admin'])->givePermissionTo([
            'viewAny-post',
            'view-post',
            'create-post',
            'publish-post',
            'edit-post',
            'delete-post',
            'viewAny-tag',
            'view-tag',
            'create-tag',
            'edit-tag',
            'delete-tag',
            'viewAny-category',
            'view-category',
            'create-category',
            'edit-category',
            'delete-category',
            'viewAny-user',
            'view-user',
            'create-user',
            'edit-user',
            'activate-user',
            'delete-user',
            'assign-role',
            'give-permission',
        ]);
        Role::create(['name' => 'author'])->givePermissionTo([
            'create-post',
            'create-tag',
            'create-category',
            'edit-post',
            'edit-tag',
            'edit-category',
            'delete-post',
            'delete-tag',
            'delete-category',
            'view-post',
            'view-tag',
            'view-category',
            'viewAny-post',
            'viewAny-tag',
            'viewAny-category',
        ]);
        Role::create(['name' => 'publisher'])->givePermissionTo([
            'viewAny-post',
            'view-post',
            'publish-post',
            'viewAny-tag',
            'view-tag',
            'viewAny-category',
            'view-category',
        ]);
        Role::create(['name' => 'guest'])->givePermissionTo([
            'viewAny-post',
            'viewAny-tag',
            'viewAny-category',
            'view-post',
            'view-tag',
            'view-category',
        ]);
    }
}
