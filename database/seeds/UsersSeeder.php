<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Glauco Garcia Cetara',
            'email' => 'neocetara@hotmail.com',
            'password' => bcrypt('1234')
        ]);
    }
}
