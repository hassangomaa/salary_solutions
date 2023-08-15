<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_create',
            ],
            [
                'id'    => 18,
                'title' => 'product_edit',
            ],
            [
                'id'    => 19,
                'title' => 'product_show',
            ],
            [
                'id'    => 20,
                'title' => 'product_delete',
            ],
            [
                'id'    => 21,
                'title' => 'product_access',
            ],
            [
                'id'    => 22,
                'title' => 'category_create',
            ],
            [
                'id'    => 23,
                'title' => 'category_edit',
            ],
            [
                'id'    => 24,
                'title' => 'category_show',
            ],
            [
                'id'    => 25,
                'title' => 'category_delete',
            ],
            [
                'id'    => 26,
                'title' => 'category_access',
            ],
            [
                'id'    => 27,
                'title' => 'detail_create',
            ],
            [
                'id'    => 28,
                'title' => 'detail_edit',
            ],
            [
                'id'    => 29,
                'title' => 'detail_show',
            ],
            [
                'id'    => 30,
                'title' => 'detail_delete',
            ],
            [
                'id'    => 31,
                'title' => 'detail_access',
            ],
            [
                'id'    => 32,
                'title' => 'variation_create',
            ],
            [
                'id'    => 33,
                'title' => 'variation_edit',
            ],
            [
                'id'    => 34,
                'title' => 'variation_show',
            ],
            [
                'id'    => 35,
                'title' => 'variation_delete',
            ],
            [
                'id'    => 36,
                'title' => 'variation_access',
            ],
            [
                'id'    => 37,
                'title' => 'service_create',
            ],
            [
                'id'    => 38,
                'title' => 'service_edit',
            ],
            [
                'id'    => 39,
                'title' => 'service_show',
            ],
            [
                'id'    => 40,
                'title' => 'service_delete',
            ],
            [
                'id'    => 41,
                'title' => 'service_access',
            ],
            [
                'id'    => 42,
                'title' => 'image_create',
            ],
            [
                'id'    => 43,
                'title' => 'image_edit',
            ],
            [
                'id'    => 44,
                'title' => 'image_delete',
            ],
            [
                'id'    => 45,
                'title' => 'image_access',
            ],
            [
                'id'    => 46,
                'title' => 'brand_create',
            ],
            [
                'id'    => 47,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 48,
                'title' => 'brand_show',
            ],
            [
                'id'    => 49,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 50,
                'title' => 'brand_access',
            ],
            [
                'id'    => 51,
                'title' => 'modeel_create',
            ],
            [
                'id'    => 52,
                'title' => 'modeel_edit',
            ],
            [
                'id'    => 53,
                'title' => 'modeel_show',
            ],
            [
                'id'    => 54,
                'title' => 'modeel_delete',
            ],
            [
                'id'    => 55,
                'title' => 'modeel_access',
            ],
            [
                'id'    => 56,
                'title' => 'year_create',
            ],
            [
                'id'    => 57,
                'title' => 'year_edit',
            ],
            [
                'id'    => 58,
                'title' => 'year_show',
            ],
            [
                'id'    => 59,
                'title' => 'year_delete',
            ],
            [
                'id'    => 60,
                'title' => 'year_access',
            ],
            [
                'id'    => 61,
                'title' => 'engine_capacity_cc_create',
            ],
            [
                'id'    => 62,
                'title' => 'engine_capacity_cc_edit',
            ],
            [
                'id'    => 63,
                'title' => 'engine_capacity_cc_show',
            ],
            [
                'id'    => 64,
                'title' => 'engine_capacity_cc_delete',
            ],
            [
                'id'    => 65,
                'title' => 'engine_capacity_cc_access',
            ],
            [
                'id'    => 66,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
