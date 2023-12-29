<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superAdminRole = Role::create(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdminRole->givePermissionTo(Permission::all()->pluck('name')->toArray());

        $userAdminRole = Role::create(['name' => 'user_admin', 'guard_name' => 'web']);
        $userAdminRole->givePermissionTo(['create_user', 'edit_user', 'read_user', 'delete_user']);

        $salesTeamRole = Role::create(['name' => 'sales_team', 'guard_name' => 'web']);
        $salesTeamRole->givePermissionTo(['read_user', 'product_module', 'category_module', 'delete_product', 'update_product', 'delete_category', 'update_category']);
    }
}
