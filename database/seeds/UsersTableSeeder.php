<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '4space',
            'email' => '4space@gmail.com',
            'phone' => ' 920022433',
            'type' => 'Admin',
            'password' => Hash::make('4space'),
        ]);
    }
}
