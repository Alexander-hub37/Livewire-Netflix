<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleUser = Role::create(['name' => 'User']);

        Permission::create(['name' => 'genres'])->assignRole($roleAdmin);
        Permission::create(['name' => 'movies'])->assignRole($roleAdmin);
        Permission::create(['name' => 'browse'])->syncRoles([$roleAdmin, $roleUser]);
        Permission::create(['name' => 'search.movies'])->syncRoles([$roleAdmin, $roleUser]);
        Permission::create(['name' => 'playlists'])->syncRoles([$roleAdmin, $roleUser]);

    }
}
