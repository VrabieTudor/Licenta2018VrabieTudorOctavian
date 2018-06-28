<?php

namespace App\Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class UserPermissionTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

		DB::table("user_permissions")->insert(array (
		  'label' => 'create',
		  'entity' => 'User',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'create',
		  'entity' => 'UserType',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'create',
		  'entity' => 'UserPermission',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'read',
		  'entity' => 'User',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'read',
		  'entity' => 'UserType',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'read',
		  'entity' => 'UserPermission',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'update',
		  'entity' => 'User',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'update',
		  'entity' => 'UserType',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'update',
		  'entity' => 'UserPermission',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'delete',
		  'entity' => 'User',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'delete',
		  'entity' => 'UserType',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));

		DB::table("user_permissions")->insert(array (
		  'label' => 'delete',
		  'entity' => 'UserPermission',
		  'user_type_id' => 1,
		  'created_at' => '2017-04-27 08:46:20',
		  'updated_at' => '2017-04-27 08:46:20',
		));
    }
}
