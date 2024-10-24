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
       $permissions[] = Permission::create(['name' => 'user-admin'])->syncRoles(['administrator']);
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
       $permissions[] = Permission::create(['name' => 'image-upload'])->syncRoles(['administrator','student','pdi']);
       $permissions[] = Permission::create(['name' => 'garment-borrow'])->syncRoles(['administrator', 'pdi']);
       $permissions[] = Permission::create(['name' => 'garment-lend'])->syncRoles(['administrator','student', 'pdi']);
       $permissions[] = Permission::create(['name' => 'seat-reserve'])->syncRoles(['administrator','student', 'pdi']);
       $permissions[] = Permission::create(['name' => 'profile'])->syncRoles(['administrator','student', 'pdi']);
       

       $permissions[] = Permission::create(['name' => 'admin-all']);
       $permissions[] = Permission::create(['name' => 'email-admin']);
       $permissions[] = Permission::create(['name' => 'email-delete']);
       $permissions[] = Permission::create(['name' => 'email-edit']);
       $permissions[] = Permission::create(['name' => 'email-read']);
       $permissions[] = Permission::create(['name' => 'message-admin']);
       $permissions[] = Permission::create(['name' => 'attachment-admin']);
       $permissions[] = Permission::create(['name' => 'event-admin']);
       $permissions[] = Permission::create(['name' => 'room-admin']);
    
       $permissions[] = Permission::create(['name' => 'import']);
       $permissions[] = Permission::create(['name' => 'export']);
    

       //admin role
       $role1->syncPermissions($permissions);

        // Usuario admin
        $admin = User::create([
            'name' => 'administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $admin->assignRole(1);
 
        //Creados a posteriori
        // Permission::create(['name' => 'export'])->syncRoles(['role1','role2'])
        // 	User::create([ … ])->assignRole('Admin');

       

        $student = User::create([
            'name' => 'student',
            'email' => 'student@example.com',
            'password' => Hash::make('password')
        ]);
        $student->assignRole($role2);
 


    }
}
