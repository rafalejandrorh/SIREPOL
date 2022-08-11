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
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Superadmin']);

        Permission::create(['name' => 'users.index', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.create', 'description' => 'Crear usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.edit', 'description' => 'Editar usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'users.show', 'description' => 'ver usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'roles.index', 'description' => 'Ver listado de roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.edit', 'description' => 'Editar roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.show', 'description' => 'Ver roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.create', 'description' => 'Crear roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar roles'])->syncRoles([$role1]);

    }
}
