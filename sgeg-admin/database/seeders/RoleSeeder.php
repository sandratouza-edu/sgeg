<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           //Create roles and initial content permissions
      
       $role1 = Role::create(['name' => 'administrator']);
       $role2 = Role::create(['name' => 'student']);
       $role3 = Role::create(['name' => 'pdi']);
       $role4 = Role::create(['name' => 'speacker']);
       $role5 = Role::create(['name' => 'guest']);
       
       $permissions[] = Permission::create(['name' => 'adminall']);
       $permissions[] = Permission::create(['name' => 'user-admin']);
       $permissions[] = Permission::create(['name' => 'user-delete']);
       $permissions[] = Permission::create(['name' => 'user-edit']);
       $permissions[] = Permission::create(['name' => 'user-read']);
       $permissions[] = Permission::create(['name' => 'role-admin']);
       $permissions[] = Permission::create(['name' => 'permission-admin']);
       $permissions[] = Permission::create(['name' => 'garment-admin']);
       $permissions[] = Permission::create(['name' => 'degree-admin']);
       $permissions[] = Permission::create(['name' => 'document-admin']);
       $permissions[] = Permission::create(['name' => 'document-print']);
       $permissions[] = Permission::create(['name' => 'image-admin']);
       $permissions[] = Permission::create(['name' => 'image-upload']);
       $permissions[] = Permission::create(['name' => 'garment-borrow']);
       $permissions[] = Permission::create(['name' => 'garment-lend']);
       $permissions[] = Permission::create(['name' => 'seat-reserve']);
       $permissions[] = Permission::create(['name' => 'profile']);

       //admin role
       $role1->syncPermissions($permissions);

        // Usuario admin
        $admin = User::create([
            'name' => 'administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $admin->assignRole(1);
 



    }
}
