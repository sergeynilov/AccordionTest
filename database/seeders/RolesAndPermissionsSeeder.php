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



        $managerPermission = Permission::create(['name' => ACCESS_MANAGER_LABEL, 'guard_name' => 'web']);

        $clientPermission = Permission::create(['name' => ACCESS_CLIENT_LABEL, 'guard_name' => 'web']);
    }
}
