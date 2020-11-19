<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Principal',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Eletro',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Games',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
