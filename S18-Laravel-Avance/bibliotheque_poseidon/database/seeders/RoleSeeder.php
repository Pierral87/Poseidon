<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::create([
        //     'name' => "admin"
        // ]);
        // Role::create([
        //     'name' => "staff"
        // ]);
        // Role::create([
        //     'name' => "abonne"
        // ]);
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $staffRole = Role::create(['name' => 'staff', 'guard_name' => 'web']);
        $abonneRole = Role::create(['name' => 'abonne', 'guard_name' => 'web']);

        $pCreate = Permission::create(['name' => 'create books', 'guard_name' => 'web']);
        $pEdit   = Permission::create(['name' => 'edit books', 'guard_name' => 'web']);
        $pDelete = Permission::create(['name' => 'delete books', 'guard_name' => 'web']);
        $pBorrow = Permission::create(['name' => 'borrow books', 'guard_name' => 'web']);

         $adminRole->givePermissionTo([ $pCreate,  $pEdit, $pDelete, $pBorrow]);
    }
}
