<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $teams = config('permission.teams');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->string('group_name')->nullable();
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
            $table->bigIncrements('id');
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->string('description')->nullable();
            $table->timestamps();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                $table->primary([PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }

        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                $table->primary([PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([PermissionRegistrar::$pivotPermission, PermissionRegistrar::$pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));



         // Create Roles
         $roleSuperAdmin = Role::create(['name' => 'super-admin']);
         $roleAdmin = Role::create(['name' => 'admin','description'=>'Admin can access everything.']);
         $roleStaff = Role::create(['name' => 'staff','description'=>'Staff can access specific things.']);
         $roleUser = Role::create(['name' => 'user']);


         // Permission List as array
         $adminPermissions = [

             [
                 'group_name' => 'dashboard',
                 'permissions' => [
                     'dashboard-view',
                 ]
             ],
             [
                 'group_name' => 'user',
                 'permissions' => [
                     // user Permissions
                     'user-create',
                     'user-view',
                     'user-update',
                     'user-delete',
                     'user-login',
                 ]
             ],
             [
                 'group_name' => 'system-administrator',
                 'permissions' => [
                     // user Permissions
                     'admin-create',
                     'admin-view',
                     'admin-update',
                     'admin-delete',
                 ]
             ],
             [
                 'group_name' => 'role',
                 'permissions' => [
                     // role Permissions
                     'role-create',
                     'role-update',
                     'role-delete',
                     'role-view',
                 ]
             ],
             [
                 'group_name' => 'profile',
                 'permissions' => [
                     // profile Permissions
                     'change-password',
                 ]
             ],
             [
                 'group_name' => 'setting',
                 'permissions' => [
                     // profile Permissions
                     'backup',
                     'setting-view',
                     'setting-update',
                     'maintenance-mode',
                 ]
             ],
             [
                 'group_name' => 'others',
                 'permissions' => [
                     // profile Permissions
                     'contact-view',
                     'feedback-view',
                     'contact-feedback-delete',
                 ]
             ],
             [
                 'group_name' => 'log-activity',
                 'permissions' => [
                     'log-activity-view',
                     'log-activity-delete',
                     'log-activity-configure',
                 ]
             ],
             [
                'group_name' => 'Language',
                'permissions' => [
                    // Language Permissions
                    'Language-create',
                    'Language-view',
                    'Language-update',
                    'Language-delete',
                    'Language-translate',
                    'Language-set-default',
                ]
            ],
             [
                'group_name' => 'Frontend CMS',
                'permissions' => [
                    'Page-view',
                    'Page-update',
                    'Content-view',
                    'Content-update',
                ]
            ],
             [
                'group_name' => 'Visitor',
                'permissions' => [
                    'Visitor-info',
                    'Visitor-info-delete',
                    'Visitor-block-list',
                    'Visitor-block-create',
                    'Visitor-block-remove',
                ]
            ],
            //  [
            //     'group_name' => 'LastTest',
            //     'permissions' => [
            //         // LastTest Permissions
            //         'LastTest-create',
            //         'LastTest-view',
            //         'LastTest-update',
            //         'LastTest-delete',
            //     ]
            // ],
         ];




         $staffPermissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard-view',
                ]
            ],
            [
                'group_name' => 'user',
                'permissions' => [
                    // user Permissions
                    'user-create',
                    'user-view',
                    'user-update',
                    'user-delete',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role-view',
                ]
            ],
            [
                'group_name' => 'profile',
                'permissions' => [
                    // profile Permissions
                    'change-password',
                ]
            ],
            [
                'group_name' => 'setting',
                'permissions' => [
                    // profile Permissions
                    'backup',
                    'setting-view',
                ]
            ],
            [
                'group_name' => 'others',
                'permissions' => [
                    // profile Permissions
                    'contact-view',
                    'feedback-view',
                ]
            ],


         ];


         //  Super admin will permit all from authServiceProvider Gate
         // Create and Assign Admin Permissions
          for ($i = 0; $i < count($adminPermissions); $i++) {
              $permissionGroup = $adminPermissions[$i]['group_name'];
              for ($j = 0; $j < count($adminPermissions[$i]['permissions']); $j++) {
                  // Create Permission
                  $permission = Permission::updateOrCreate(
                     ['name' => $adminPermissions[$i]['permissions'][$j]],
                     [
                         'name' => $adminPermissions[$i]['permissions'][$j],
                         'group_name' => $permissionGroup
                     ]
                 );
                  $roleAdmin->givePermissionTo($permission);
              }
          }
         //  StaffRole
         for ($i = 0; $i < count($staffPermissions); $i++) {
             $permissionGroup = $staffPermissions[$i]['group_name'];
             for ($j = 0; $j < count($staffPermissions[$i]['permissions']); $j++) {
                 // Create Permission
                 $permission = Permission::updateOrCreate(
                     ['name' => $staffPermissions[$i]['permissions'][$j]],
                     [
                         'name' => $staffPermissions[$i]['permissions'][$j],
                         'group_name' => $permissionGroup
                     ]
                 );
                 $roleStaff->givePermissionTo($permission);
             }
         }
         $superAdmin = User::first();
         $superAdmin->assignRole('super-admin');
         $admin = User::find(2);
         $admin->assignRole('admin');
         $staff = User::find(3);
         $staff->assignRole('staff');
         $user = User::find(4);
         $user->assignRole('user');
         $user = User::find(5);
         $user->assignRole('user');
         $user = User::find(6);
         $user->assignRole('user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
