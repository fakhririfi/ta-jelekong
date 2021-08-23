<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'last_name' => '1',
            'email' => 'admin@admin.com',
            'email_verified_at' => NOW(),
            'password' => bcrypt('password'),
        ]);
    }
}
