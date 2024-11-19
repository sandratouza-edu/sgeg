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
       $role4 = Role::create(['name' => 'doctoral-student']);
       $role5 = Role::create(['name' => 'speacker']);
       $role6 = Role::create(['name' => 'guest']);
       
       $permissions[] = Permission::create(['name' => 'user-admin']); 
       $permissions[] = Permission::create(['name' => 'user-delete']);
       $permissions[] = Permission::create(['name' => 'user-edit']);
       //$permissions[] = Permission::create(['name' => 'user-read']);
       $permissions[] = Permission::create(['name' => 'role-admin']);
       $permissions[] = Permission::create(['name' => 'role-edit']);
       $permissions[] = Permission::create(['name' => 'role-delete']);
       $permissions[] = Permission::create(['name' => 'permission-admin']);
       $permissions[] = Permission::create(['name' => 'garment-admin'])->syncRoles(['administrator','doctoral-student', 'pdi']);
       $permissions[] = Permission::create(['name' => 'garment-borrow'])->syncRoles(['administrator', 'pdi']);
       $permissions[] = Permission::create(['name' => 'garment-lend'])->syncRoles(['administrator','doctoral-student', 'pdi']);
       $permissions[] = Permission::create(['name' => 'degree-admin']);
       $permissions[] = Permission::create(['name' => 'document-admin']);
       $permissions[] = Permission::create(['name' => 'document-print']);
       $permissions[] = Permission::create(['name' => 'image-admin'])->syncRoles(['administrator','student', 'pdi']);
       $permissions[] = Permission::create(['name' => 'image-upload'])->syncRoles(['administrator','student','pdi']);

       $permissions[] = Permission::create(['name' => 'seat-reserve'])->syncRoles(['administrator','student', 'pdi']);
       $permissions[] = Permission::create(['name' => 'profile'])->syncRoles(['administrator','student', 'pdi']);
       

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
       $permissions[] = Permission::create(['name' => 'send-email']);
       $permissions[] = Permission::create(['name' => 'send-msg'])->syncRoles(['administrator','student', 'pdi']);
    

       //admin role
       $role1->syncPermissions($permissions);

        // Usuario admin
        $admin = User::create([
            'name' => 'administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $admin->assignRole(1);
 
     
        $student = User::create([
            'name' => 'doctoralStudent',
            'email' => 'doctoralstudent@example.com',
            'password' => Hash::make('password')
        ]);
        $student->assignRole($role2);
        $student->assignRole($role4);

        $student = User::create([
            'name' => 'student',
            'email' => 'student@example.com',
            'password' => Hash::make('password')
        ]);
        $student->assignRole($role2);
 


    }
}
