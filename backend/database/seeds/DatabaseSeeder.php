<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = [
        'users',
        'user_types',
        'user_permissions'
     ];

    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();

        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->call(\App\Database\Seeds\UserTypeTableSeeder::class);
        $this->call(\App\Database\Seeds\UserTableSeeder::class);
        $this->call(\App\Database\Seeds\UserPermissionTableSeeder::class);
    }
}
