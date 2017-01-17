<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 3; $i++) {
            DB::table('categories')->insert([
                'name' => "Catégorie $i",
                'slug' => "category-$i",
                'posts_count' => 0
            ]);
        }

        DB::table('users')->insert([
            'name' => 'admin',
            'email'=> 'admin@localhost.dev',
            'password' => \Illuminate\Support\Facades\Hash::make('admin')
        ]);
    }
}
