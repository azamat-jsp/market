<?php

use App\Tbuy\Permission\Cabinet\Enums\CabinetPages;
use App\Tbuy\Permission\Cabinet\Enums\CabinetPagesPermissions;

return [

    'list' => [
        App\Tbuy\AttributeValue\Enums\Permission::class,
        App\Tbuy\Attribute\Enums\Permission::class,
        App\Tbuy\Audience\Enums\Permission::class,
        App\Tbuy\User\Enums\Permission::class,
        App\Tbuy\Banner\Enums\Permission::class,
        App\Tbuy\Brand\Enums\Permission::class,
        App\Tbuy\Company\Enums\Permission::class,
        App\Tbuy\Category\Enums\Permission::class,
        App\Tbuy\Locale\Enums\Permission::class,
        App\Tbuy\Menu\Enums\Permission::class,
        App\Tbuy\Product\Enums\Permission::class,
        App\Tbuy\Question\Enums\Permission::class,
        App\Tbuy\Rejection\Enums\Permission::class,
        App\Tbuy\Region\Enums\Permission::class,
        App\Tbuy\Search\Enums\Permission::class,
        App\Tbuy\Settings\Enums\Permission::class,
        App\Tbuy\Target\Enums\Permission::class,
        App\Tbuy\Tariff\Enums\Permission::class,
        App\Tbuy\Vacancy\Enums\Permission::class,
        App\Tbuy\Filial\Enums\Permission::class,
        App\Tbuy\Gallery\Enums\Permission::class,
        App\Tbuy\Employee\Enums\Permission::class,
        App\Tbuy\Invite\Enums\Permission::class,
        App\Tbuy\Resume\Enums\Permission::class,
        App\Tbuy\ProfessionalLevel\Enums\Permission::class,
        App\Tbuy\Community\Enums\Permission::class,
        App\Tbuy\AttributeCategory\Enums\Permission::class,
    ],

    //TODO: При добавлении сущностей добавлять пермишены для кабинета содрудников
    'permission_group' => [
        'cabinet' => [
            CabinetPages::PERSON->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [
                    App\Tbuy\User\Enums\Permission::STORE_USER,
                    App\Tbuy\User\Enums\Permission::UPDATE_USER,
                    App\Tbuy\User\Enums\Permission::DELETE_USER,
                    App\Tbuy\Employee\Enums\Permission::STORE_COMPANY_EMPLOYEE,
                    App\Tbuy\Employee\Enums\Permission::UPDATE_COMPANY_EMPLOYEE,
                    App\Tbuy\Employee\Enums\Permission::DELETE_COMPANY_EMPLOYEE,
                ],
                CabinetPagesPermissions::CAN_VIEW->value => [
                    App\Tbuy\User\Enums\Permission::VIEW_ANY,
                    App\Tbuy\User\Enums\Permission::VIEW_USER,
                    App\Tbuy\User\Enums\Permission::SHOW_USER,
                    App\Tbuy\Employee\Enums\Permission::ViEW_COMPANY_EMPLOYEE,
                    App\Tbuy\Employee\Enums\Permission::SHOW_COMPANY_EMPLOYEE,
                    App\Tbuy\Employee\Enums\Permission::VIEW_PERMISSIONS_EMPLOYEE,
                ]
            ],

            CabinetPages::ADVERTISING->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [],
                CabinetPagesPermissions::CAN_VIEW->value => []
            ],

            CabinetPages::SALES->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [],
                CabinetPagesPermissions::CAN_VIEW->value => []
            ],

            CabinetPages::PROMO->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [],
                CabinetPagesPermissions::CAN_VIEW->value => []
            ],

            CabinetPages::WALLET->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [],
                CabinetPagesPermissions::CAN_VIEW->value => []
            ],

            CabinetPages::TARIFF->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [
                    App\Tbuy\Tariff\Enums\Permission::CREATE_TARIFF,
                    App\Tbuy\Tariff\Enums\Permission::UPDATE_TARIFF,
                    App\Tbuy\Tariff\Enums\Permission::DELETE_TARIFF,
                ],
                CabinetPagesPermissions::CAN_VIEW->value => [
                    App\Tbuy\Tariff\Enums\Permission::VIEW_TARIFF_LIST,
                    App\Tbuy\Tariff\Enums\Permission::VIEW_TARIFF_LOG,
                    App\Tbuy\Tariff\Enums\Permission::BUY_TARIFF,
                ]
            ],

            CabinetPages::BULLETIN->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [],
                CabinetPagesPermissions::CAN_VIEW->value => []
            ],

            CabinetPages::SHIPMENT->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [],
                CabinetPagesPermissions::CAN_VIEW->value => []
            ],

            CabinetPages::MESSAGES->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [],
                CabinetPagesPermissions::CAN_VIEW->value => []
            ],

            CabinetPages::FAQ->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [],
                CabinetPagesPermissions::CAN_VIEW->value => []
            ],

            CabinetPages::SUPPORT->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [],
                CabinetPagesPermissions::CAN_VIEW->value => []
            ],

            CabinetPages::VACANCIES->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [
                    App\Tbuy\Vacancy\Enums\Permission::CREATE_VACANCY,
                    App\Tbuy\Vacancy\Enums\Permission::UPDATE_VACANCY,
                    App\Tbuy\Vacancy\Enums\Permission::DELETE_VACANCY,
                    App\Tbuy\Vacancy\Enums\Permission::TOGGLE_STATUS_VACANCY,
                    App\Tbuy\Vacancy\Enums\Permission::CREATE_VACANCY_CATEGORY,
                    App\Tbuy\Vacancy\Enums\Permission::UPDATE_VACANCY_CATEGORY,
                    App\Tbuy\Vacancy\Enums\Permission::DELETE_VACANCY_CATEGORY,
                ],
                CabinetPagesPermissions::CAN_VIEW->value => [
                    App\Tbuy\Vacancy\Enums\Permission::VIEW_VACANCY_LIST,
                    App\Tbuy\Vacancy\Enums\Permission::VIEW_VACANCY_CATEGORY_LIST
                ]
            ],

            CabinetPages::SERVICES->value => [
                CabinetPagesPermissions::CAN_ALL->value => [],
                CabinetPagesPermissions::CAN_EDIT->value => [],
                CabinetPagesPermissions::CAN_VIEW->value => []
            ],

        ]
    ],

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        /*
         * Change this if you want to name the related pivots other than defaults
         */
        'role_pivot_key' => null, //default 'role_id',
        'permission_pivot_key' => null, //default 'permission_id',

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',

        /*
         * Change this if you want to use the teams feature and your related model's
         * foreign key is other than `team_id`.
         */

        'team_foreign_key' => 'team_id',
    ],

    /*
     * When set to true, the method for checking permissions will be registered on the gate.
     * Set this to false, if you want to implement custom logic for checking permissions.
     */

    'register_permission_check_method' => true,

    /*
     * When set to true the package implements teams using the 'team_foreign_key'. If you want
     * the migrations to register the 'team_foreign_key', you must set this to true
     * before doing the migration. If you already did the migration then you must make a new
     * migration to also add 'team_foreign_key' to 'roles', 'model_has_roles', and
     * 'model_has_permissions'(view the latest version of package's migration file)
     */

    'teams' => false,

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ]
];
