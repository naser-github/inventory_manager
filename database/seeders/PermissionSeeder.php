<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dashboard Permission
        $dashboard_permissions = [
            ['name' => 'dashboard_read', 'guard_name' => 'web'],
        ];
        Permission::insert($dashboard_permissions);

        // Begin:: Settings

        // Category Permissions
        $category_management_permissions = [
            ['name' => 'category_management_read', 'guard_name' => 'web'],
            ['name' => 'category_management_write', 'guard_name' => 'web'],
        ];
        Permission::insert($category_management_permissions);

        // Item Permissions
        $item_management_permissions = [
            ['name' => 'item_management_read', 'guard_name' => 'web'],
            ['name' => 'item_management_write', 'guard_name' => 'web'],
        ];
        Permission::insert($item_management_permissions);

        // Location Permissions
        $location_management_permissions = [
            ['name' => 'location_management_read', 'guard_name' => 'web'],
            ['name' => 'location_management_write', 'guard_name' => 'web'],
        ];
        Permission::insert($location_management_permissions);

        // End:: Settings

        // Vendor Permissions
        $vendor_management_permissions = [
            ['name' => 'vendor_management_read', 'guard_name' => 'web'],
            ['name' => 'vendor_management_write', 'guard_name' => 'web'],
        ];
        Permission::insert($vendor_management_permissions);

        // Begin:: System Settings

        // Permission Permissions
        $permission_management_permissions = [
            ['name' => 'permission_management_read', 'guard_name' => 'web'],
            ['name' => 'permission_management_write', 'guard_name' => 'web'],
        ];
        Permission::insert($permission_management_permissions);

        // Role Permissions
        $role_management_permissions = [
            ['name' => 'role_management_read', 'guard_name' => 'web'],
            ['name' => 'role_management_write', 'guard_name' => 'web'],
        ];
        Permission::insert($role_management_permissions);

        // User Permissions
        $user_management_permissions = [
            ['name' => 'user_management_read', 'guard_name' => 'web'],
            ['name' => 'user_management_write', 'guard_name' => 'web'],
        ];
        Permission::insert($user_management_permissions);

        // End:: System Settings
    }
}

