<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminNewPermissions = [

            [
                'group_name' => 'new',
                'permissions' => [
                    'new-view',
                    'new-edit',
                ]
            ],
            [
                'group_name' => 'check',
                'permissions' => [
                    'check-view',
                ]
            ],
        ];

        // // Create and Assign Admin Permissions
        for ($i = 0; $i < count($adminNewPermissions); $i++) {
            $permissionGroup = $adminNewPermissions[$i]['group_name'];
            for ($j = 0; $j < count($adminNewPermissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::updateOrCreate(
                    ['name' => $adminNewPermissions[$i]['permissions'][$j]],
                    [
                        'name' => $adminNewPermissions[$i]['permissions'][$j],
                        'group_name' => $permissionGroup
                    ]
                );
                $roleAdmin = Role::where('name', 'admin')->first();
                $roleAdmin->givePermissionTo($permission);
            }
        }
        // // Create Roles
        // $roleSuperAdmin = Role::create(['name' => 'super-admin']);
        // $roleAdmin = Role::create(['name' => 'admin','description'=>'Admin can access everything.']);
        // $roleStaff = Role::create(['name' => 'staff','description'=>'Staff can access specific things.']);
        // $roleUser = Role::create(['name' => 'user']);


        // // Permission List as array
        // $adminPermissions = [

        //     [
        //         'group_name' => 'dashboard',
        //         'permissions' => [
        //             'dashboard-view',
        //         ]
        //     ],
        //     [
        //         'group_name' => 'user',
        //         'permissions' => [
        //             // user Permissions
        //             'user-create',
        //             'user-view',
        //             'user-update',
        //             'user-delete',
        //             'user-approve',
        //         ]
        //     ],
        //     [
        //         'group_name' => 'role',
        //         'permissions' => [
        //             // role Permissions
        //             'role-create',
        //             'role-update',
        //             'role-delete',
        //             'role-list',
        //         ]
        //     ],
        //     [
        //         'group_name' => 'profile',
        //         'permissions' => [
        //             // profile Permissions
        //             'profile-view',
        //             'profile-update',
        //         ]
        //     ],
        //     [
        //         'group_name' => 'setting',
        //         'permissions' => [
        //             // profile Permissions
        //             'backup',
        //             'setting',
        //         ]
        //     ],
        // ];
        // $staffPermissions = [

        //     [
        //         'group_name' => 'dashboard',
        //         'permissions' => [
        //             'dashboard-view',
        //         ]
        //     ],
        //     [
        //         'group_name' => 'user',
        //         'permissions' => [
        //             // user Permissions
        //             'user-create',
        //             'user-view',
        //             'user-update',
        //             'user-delete',
        //             'user-approve',
        //         ]
        //     ],
        //     [
        //         'group_name' => 'profile',
        //         'permissions' => [
        //             // profile Permissions
        //             'profile-view',
        //             'profile-update',
        //         ]
        //     ],
        // ];


        // //  Super admin will permit all from authServiceProvider Gate
        // // Create and Assign Admin Permissions
        //  for ($i = 0; $i < count($adminPermissions); $i++) {
        //      $permissionGroup = $adminPermissions[$i]['group_name'];
        //      for ($j = 0; $j < count($adminPermissions[$i]['permissions']); $j++) {
        //          // Create Permission
        //          $permission = Permission::updateOrCreate(
        //             ['name' => $adminPermissions[$i]['permissions'][$j]],
        //             [
        //                 'name' => $adminPermissions[$i]['permissions'][$j],
        //                 'group_name' => $permissionGroup
        //             ]
        //         );
        //          $roleAdmin->givePermissionTo($permission);
        //      }
        //  }
        // //  StaffRole
        // for ($i = 0; $i < count($staffPermissions); $i++) {
        //     $permissionGroup = $staffPermissions[$i]['group_name'];
        //     for ($j = 0; $j < count($staffPermissions[$i]['permissions']); $j++) {
        //         // Create Permission
        //         $permission = Permission::updateOrCreate(
        //             ['name' => $staffPermissions[$i]['permissions'][$j]],
        //             [
        //                 'name' => $staffPermissions[$i]['permissions'][$j],
        //                 'group_name' => $permissionGroup
        //             ]
        //         );
        //         $roleStaff->givePermissionTo($permission);
        //     }
        // }
        // $superAdmin = User::first();
        // $superAdmin->assignRole('super-admin');
        // $admin = User::find(2);
        // $admin->assignRole('admin');
        // $staff = User::find(3);
        // $staff->assignRole('staff');


    }
}
