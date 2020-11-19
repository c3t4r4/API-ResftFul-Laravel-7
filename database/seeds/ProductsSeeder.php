<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Glauco Garcia Cetara',
            'email' => 'neocetara@hotmail.com',
            '' => bcrypt('1234')
        ]);
    }
}
