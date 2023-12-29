<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
         

            DB::table('permissions')->insert(
                [
                    ['name' => 'create_user', 'guard_name' => 'web'],
                    ['name' => 'edit_user', 'guard_name' => 'web'],
                    ['name' => 'read_user', 'guard_name' => 'web'],
                    ['name' => 'delete_user', 'guard_name' => 'web'],
                    ['name' => 'delete_product', 'guard_name' => 'web'],
                    ['name' => 'update_product', 'guard_name' => 'web'],
                    ['name' => 'delete_category', 'guard_name' => 'web'],
                    ['name' => 'update_category', 'guard_name' => 'web'],
                    ['name' => 'category_module', 'guard_name' => 'web'],
                    ['name' => 'product_module', 'guard_name' => 'web']
                ]
            );
            // Example: Seed multiple posts using the factory
            //      \App\Models\property_data::factory(5)->create();
        }
    }
}
