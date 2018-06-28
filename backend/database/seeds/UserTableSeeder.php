<?php

namespace App\Database\Seeds;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(\App\User::class, 10)->create();
    }
}
