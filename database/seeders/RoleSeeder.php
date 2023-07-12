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
		$role3 = Role::create(['name' => 'Foodtrucker']);

		//---------------------- PERMISSIONS ---------------------------
		// ----------------------- Users ----------------------------
		Permission::create([
			'name' => 'users.create'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'users.read'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'users.update'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'users.delete'
		])->syncRoles([$role1]);

		// ----------------------- Roles ----------------------------
		Permission::create([
			'name' => 'roles.create'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'roles.read'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'roles.update'
		])->syncRoles([$role1]);

		Permission::create([
			'name' => 'roles.delete'
		])->syncRoles([$role1]);

		// ----------------------- Events ----------------------------
		Permission::create([
			'name' => 'events.create'
		])->syncRoles([$role1, $role2]);

		Permission::create([
			'name' => 'events.read'
		])->syncRoles([$role1, $role2]);

		Permission::create([
			'name' => 'events.update'
		])->syncRoles([$role1, $role2]);

		Permission::create([
			'name' => 'events.delete'
		])->syncRoles([$role1, $role2]);

		// ----------------------- Foodtrucks ----------------------------
		Permission::create([
			'name' => 'foodtrucks.create'
		])->syncRoles([$role3]);

		Permission::create([
			'name' => 'foodtrucks.read'
		])->syncRoles([$role1, $role2]);

		Permission::create([
			'name' => 'foodtrucks.update'
		])->syncRoles([$role1, $role2]);

		Permission::create([
			'name' => 'foodtrucks.delete'
		])->syncRoles([$role1, $role2]);
    }
}