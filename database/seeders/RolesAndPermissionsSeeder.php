<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
//        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $appAdminPermission = \Spatie\Permission\Models\Permission::create(['name' => ACCESS_APP_ADMIN_LABEL, 'guard_name' => 'web']);

        $supportManagerPermission = Permission::create(['name' => ACCESS_APP_SUPPORT_MANAGER_LABEL, 'guard_name' => 'web']);

        $contentEditorPermission = Permission::create(['name' => ACCESS_APP_CONTENT_EDITOR_LABEL, 'guard_name' => 'web']);

    }
}
