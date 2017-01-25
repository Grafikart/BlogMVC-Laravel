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
        $faker = \Faker\Factory::create();

        $user_id = DB::table('users')->insertGetId([
            'name' => 'admin',
            'email'=> 'admin@localhost.dev',
            'password' => \Illuminate\Support\Facades\Hash::make('admin')
        ]);

        for($i = 0; $i < 3; $i++) {
            $category_id = DB::table('categories')->insertGetId([
                'name' => $faker->name,
                'slug' => $faker->slug,
                'posts_count' => 5
            ]);
            for($j = 0; $j < 5; $j++) {
                DB::table('posts')->insert([
                    'name' => $faker->name,
                    'slug' => $faker->slug,
                    'content' => $faker->text,
                    'created_at' => $faker->dateTime,
                    'updated_at' => $faker->dateTime,
                    'user_id'    => $user_id,
                    'category_id' => $category_id
                ]);
            }
        }
    }
}
