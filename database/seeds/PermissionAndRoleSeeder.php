<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndRoleSeeder extends BasePermissionAndRoleSeeder
{

    /**
     * Roles to create
     *
     * @var array
     */
    protected $roles = [
        'admin' // Allow the user to do the bare minimum adminstration
    ];

    /**
     * Permissions to create
     *
     * @var array
     */
    protected $permissions = [
        'act-as-admin', // Allows the user to be seen as an administrator
        'view-as-student', // Allow the user to view the portal as a specific student
        'bypass-maintenance', // Pass the maintenance middleware for modules
        'act-as-super-admin', // Pass every gate check
    ];

    /**
     * Assignments to setup
     *
     * @var array
     */
    protected $assignments = [
        'admin' => [
            'act-as-admin'
        ]
    ];

}