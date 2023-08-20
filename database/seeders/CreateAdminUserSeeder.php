<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'hamed',
            'email' => 'hamed@gmail.com',
            'password' => bcrypt('123456'),
            'roles_name' => 'SuperAdmin',
            'Status' => 'مفعل',
        ]);

        $user = User::create([
            'name' => 'hassan',
            'email' => 'hassan@gmail.com',
            'password' => bcrypt('12345678'),
            'roles_name' => 'SuperAdmin',
            'Status' => 'مفعل',
        ]);

        // $role = Role::create(['name' => 'SuperAdmin']);

        // $permissions = Permission::pluck('id', 'id')->all();

        // $role->syncPermissions($permissions);

        // $user->assignRole([$role->id]);
    }
}
