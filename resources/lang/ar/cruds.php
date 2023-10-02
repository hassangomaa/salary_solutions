<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
        'cars'           => 'cars'
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title' => 'المستخدمون',
        'title_singular' => 'مستخدم',
        'fields' => [
            'id' => 'المعرّف',
            'id_helper' => ' ',
            'name' => 'الاسم',
            'name_helper' => ' ',
            'email' => 'البريد الإلكتروني',
            'email_helper' => ' ',
            'email_verified_at' => 'تم التحقق من البريد الإلكتروني في',
            'email_verified_at_helper' => ' ',
            'password' => 'كلمة المرور',
            'password_helper' => ' ',
            'roles' => 'الأدوار',
            'roles_helper' => ' ',
            'remember_token' => 'رمز التذكير',
            'remember_token_helper' => ' ',
            'created_at' => 'تم الإنشاء في',
            'created_at_helper' => ' ',
            'updated_at' => 'تم التحديث في',
            'updated_at_helper' => ' ',
            'deleted_at' => 'تم الحذف في',
            'deleted_at_helper' => ' ',
            'phone' => 'الهاتف',
            'phone_helper' => ' ',
            'adress' => 'العنوان',
            'address_helper' => ' ',
        ],
    ], 'safe' => [
        'title' => 'الخزن',
        'title_singular' => 'خزنه',
        'create'=>'اضافه خزنه',
        'transaction'=>'المعاملات',
        'edit'=>'تعديل خزنه',
        'amount'=>'المبلغ',
        'details'=>'التفاصيل',
        'created_at' => 'تم الإنشاء في',

        'fields' => [
            'id' => 'المعرّف',
            'name' => 'اسم الخزنه',
            'created_at' => 'تم الإنشاء في',
            'updated_at' => 'تم التحديث في',
            'deleted_at' => 'تم الحذف في',
            'balance'=>'الرصيد',
            'transaction'=>'المعاملات ',
            'type'=>'النوع'
        ],
    ],
    'product' => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'seller'            => 'Seller',
            'seller_helper'     => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'price'             => 'Price',
            'price_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'best'              => 'Best',
            'best_helper'       => ' ',
            'featured'          => 'Featured',
            'featured_helper'   => ' ',
            'hgg'               => 'Hgg',
            'hgg_helper'        => ' ',
        ],
    ],
    'category' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'image'             => 'Image',
            'image_helper'      => ' ',
            'color'             => 'Name_ar',
            'color_helper'      => ' ',
        ],
    ],
    'detail' => [
        'title'          => 'Details',
        'title_singular' => 'Detail',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'value'             => 'Value',
            'value_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'product'           => 'Product',
            'product_helper'    => ' ',
            'variation'         => 'Variation',
            'variation_helper'  => ' ',
        ],
    ],
    'variation' => [
        'title'          => 'Variation',
        'title_singular' => 'Variation',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'name_ar'           => 'Name Ar',
            'name_ar_helper'    => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
        ],
    ],
    'service' => [
        'title'          => 'Service',
        'title_singular' => 'Service',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'image' => [
        'title'          => 'Images',
        'title_singular' => 'Image',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'product'           => 'Product',
            'product_helper'    => ' ',
            'photo'             => 'Photo',
            'photo_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'brand' => [
        'title'          => 'Brand',
        'title_singular' => 'Brand',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'English Name',
            'name_ar'              => 'Arabic Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
        ],
    ],
    'modeel' => [
        'title'          => 'Model',
        'title_singular' => 'Model',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'English Name',
            'name_ar'              => 'Arabic Name',
            'name_helper'       => ' ',
            'brand'             => 'Brand',
            'brand_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],

    'year' => [
        'title'          => 'Year',
        'title_singular' => 'Year',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'year'              => 'Year',
            'year_helper'       => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'engineCapacityCc' => [
        'title'          => 'Engine Capacity Cc',
        'title_singular' => 'Engine Capacity Cc',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'engine_capacity_cc'        => 'Engine Capacity Cc',
            'engine_capacity_cc_helper' => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
        ],
    ],
];
