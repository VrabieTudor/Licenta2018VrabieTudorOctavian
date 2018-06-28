<?php

namespace App\Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class UserTypeTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		DB::table("user_types")->insert(array (
		  'id' => 1,
		  'name' => 'Admin',
		  'created_at' => '2017-10-02 09:09:48',
		  'updated_at' => '2017-10-02 09:09:48',
		));

		DB::table("user_types")->insert(array (
		  'id' => 2,
		  'name' => 'Member',
		  'created_at' => '2017-10-02 09:09:48',
		  'updated_at' => '2017-10-02 09:09:48',
		));
    }
}
