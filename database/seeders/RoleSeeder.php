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
        //
        $role1 = Role::create(['name' => 'Admin']);

 /*
        Permission::create(['name' => 'user.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'user.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'user.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'user.destroy'])->syncRoles([$role1]);
 
        Permission::create(['name' => 'role.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'role.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'role.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'role.destroy'])->syncRoles([$role1]); */


     

    }
}
