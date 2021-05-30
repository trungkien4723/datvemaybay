<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
 
class permissionSeeder extends Seeder
{
/**
* Create the initial roles and permissions.
*
* @return void
*/
public function run()
{
// Reset cached roles and permissions
app()[PermissionRegistrar::class]->forgetCachedPermissions();
 
// create permissions
Permission::create(['name' => 'edit articles']);
Permission::create(['name' => 'delete articles']);
Permission::create(['name' => 'create articles']);

Permission::create(['name' => 'edit admin-user']);
Permission::create(['name' => 'delete admin-user']);
Permission::create(['name' => 'create admin-user']);
 
// create roles and assign existing permissions
$role1 = Role::create(['name' => 'super-admin']);
$role1->givePermissionTo('edit admin-user');
$role1->givePermissionTo('delete admin-user');
$role1->givePermissionTo('create admin-user');
$role1->givePermissionTo('edit articles');
$role1->givePermissionTo('delete articles');
$role1->givePermissionTo('create articles');
 
$role2 = Role::create(['name' => 'admin']);
$role2->givePermissionTo('edit articles');
$role2->givePermissionTo('delete articles');
$role2->givePermissionTo('create articles');

$role3 = Role::create(['name' => 'user']);
 
// gets all permissions via Gate::before rule; see AuthServiceProvider
 
// create demo users
$superAdminUser = \App\Models\User::create([
    'name' => 'Example Super-Admin User',
    'email' => 'superadmin@example.com',
    'birthday' => '1991/1/1',
    'address' => 'test address',
    'phone' => '0987654321',
    'password' => Hash::make('12345678'),
    ]);
$superAdminUser->assignRole($role1);

$adminUser = \App\Models\User::create([
    'name' => 'Example Admin User',
    'email' => 'admin@example.com',
    'birthday' => '1991/1/1',
    'address' => 'test address',
    'phone' => '0987654321',
    'password' => Hash::make('12345678'),
    ]);
$adminUser->assignRole($role2);

$user = \App\Models\User::create([
'name' => 'Example User',
'email' => 'test@example.com',
'birthday' => '1991/1/1',
'address' => 'test address',
'phone' => '0987654321',
'password' => Hash::make('12345678'),
    ]);
$user->assignRole($role3); 
}
}