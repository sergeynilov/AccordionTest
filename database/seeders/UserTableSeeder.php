<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        app(CreateNewUser::class)->create([
            'id'         => 1,
            'name'       => 'John Doe',
            'email'      => 'john_doe@site.com',
            'password'   => '11111111',
            'email_verified_at' => '2019-04-29 11:03:50',
            'created_at' => '2019-04-29 11:03:50',
        ], true, [ACCESS_CLIENT_LABEL]);

        app(CreateNewUser::class)->create([
            'id'         => 2,
            'name'       => 'Jane Doe',
            'email'      => 'jane_doe@site.com',
            'password'   => '11111111',
            'email_verified_at' => '2019-04-29 11:03:50',
            'created_at' => '2019-04-29 11:03:50',
        ], true, [ACCESS_CLIENT_LABEL]);

        app(CreateNewUser::class)->create([
            'id'         => 3,
            'name'       => 'Manager',
            'email'      => 'manager@site.com',
            'password'   => '11111111',
            'email_verified_at' => '2019-04-29 11:03:50',
            'created_at' => '2019-04-29 11:03:50',
        ], true, [ACCESS_MANAGER_LABEL]);


    }
}
