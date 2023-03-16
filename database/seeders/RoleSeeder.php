<?php

namespace Database\Seeders;

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
		//---------------------- ROLES ---------------------------
		$role1 = Role::create(['name' => 'Administrator']);
		$role2 = Role::create(['name' => 'Manager']);

		//---------------------- PERMISOS ---------------------------
		// ----------------------- Usuarios ---------------------------
		Permission::create([
			'name' => 'users.create',
			'description' => 'Create users'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'users.read',
			'description' => 'Read users'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'users.update',
			'description' => 'Update users'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'users.delete',
			'description' => 'Delete users'
		])->syncRoles([$role1]);

		// ----------------------- Roles ----------------------------
		Permission::create([
			'name' => 'roles.create',
			'description' => 'Create roles'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'roles.read',
			'description' => 'Read roles'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'roles.update',
			'description' => 'Edit roles'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'roles.delete',
			'description' => 'Delete roles'
		])->syncRoles([$role1]);

		// ----------------------- Events ----------------------------
		Permission::create([
			'name' => 'events.create',
			'description' => 'Create events'
		])->syncRoles([$role1, $role2]);

		Permission::create([
			'name' => 'events.read',
			'description' => 'Read events'
		])->syncRoles([$role1, $role2]);

		Permission::create([
			'name' => 'events.update',
			'description' => 'Edit events'
		])->syncRoles([$role1, $role2]);

		Permission::create([
			'name' => 'events.delete',
			'description' => 'Delete events'
		])->syncRoles([$role1, $role2]);
    }
}